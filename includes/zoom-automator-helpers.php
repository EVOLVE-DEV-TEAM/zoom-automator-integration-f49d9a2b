<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WordPress timezone used by WP Zoomy when creating meetings.
 */
function zoom_automator_get_timezone() {
    $timezone = get_option( 'timezone_string' );

    if ( empty( $timezone ) ) {
        $timezone = 'UTC';
    }

    return $timezone;
}

/**
 * Resolve a Zoom host ID from recipe user, current user, or any administrator.
 */
function zoom_automator_get_zoom_host_id( $user_id = 0 ) {
    $user_ids = array();

    if ( $user_id ) {
        $user_ids[] = (int) $user_id;
    }

    $current_user_id = get_current_user_id();
    if ( $current_user_id ) {
        $user_ids[] = $current_user_id;
    }

    $admin_ids = get_users(
        array(
            'role'   => 'administrator',
            'fields' => 'ID',
        )
    );

    if ( ! empty( $admin_ids ) ) {
        $user_ids = array_merge( $user_ids, $admin_ids );
    }

    foreach ( array_unique( array_filter( $user_ids ) ) as $candidate_user_id ) {
        $host_id = get_user_meta( $candidate_user_id, 'user_zoom_hostid', true );

        if ( is_array( $host_id ) ) {
            $host_id = reset( $host_id );
        }

        if ( ! empty( $host_id ) ) {
            return $host_id;
        }
    }

    return '';
}

/**
 * Normalize WP Zoomy API responses to an object.
 */
function zoom_automator_decode_zoom_response( $response ) {
    if ( false === $response || null === $response || '' === $response ) {
        return null;
    }

    if ( is_object( $response ) ) {
        return $response;
    }

    return json_decode( $response );
}

/**
 * Check whether a decoded Zoom API response represents an error.
 */
function zoom_automator_is_zoom_api_error( $response ) {
    return empty( $response ) || ! empty( $response->code );
}

/**
 * Register an attendee for a Zoom meeting.
 * WP Zoomy exposes webinar registration but not meeting registration publicly.
 */
function zoom_automator_register_meeting_participant( $meeting_id, $first_name, $last_name, $email ) {
    if ( ! function_exists( 'zoom_conference' ) ) {
        return null;
    }

    $api = zoom_conference(
        array(
            'meeting_id' => $meeting_id,
        )
    );

    $request_url = 'https://api.zoom.us/v2/meetings/' . absint( $meeting_id ) . '/registrants';
    $args        = array(
        'headers'   => array(
            'Authorization' => 'Bearer ' . $api->generateJWTKey(),
            'Content-Type'  => 'application/json',
        ),
        'timeout'   => 60,
        'sslverify' => false,
        'compress'  => true,
    );
    $data        = array(
        'email'      => $email,
        'first_name' => $first_name,
        'last_name'  => $last_name,
    );

    return $api->makeRequest( $request_url, $args, $data, 'POST' );
}
