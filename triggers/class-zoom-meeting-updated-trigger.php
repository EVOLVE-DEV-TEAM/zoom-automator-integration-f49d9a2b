<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Zoom_Meeting_Updated_Trigger extends \Uncanny_Automator\Recipe\Trigger {

    protected function setup_trigger() {
        $this->set_integration( 'ZOOM_WP' );
        $this->set_trigger_code( 'ZOOM_MEETING_UPDATED' );
        $this->set_trigger_meta( 'ZOOM_MEETING_UPDATED_META' );
        $this->set_author( 'Abdurrehman Abbasi' );
        $this->set_sentence( 'A Zoom meeting is updated' );
        $this->set_readable_sentence( 'A Zoom meeting is updated' );
        $this->add_action( 'zoom_wp_after_update_meeting', 10, 3 );
    }

    public function validate( $trigger, $hook_args ) {
        $meeting_data = isset( $hook_args[0] ) ? $hook_args[0] : null;
        if ( empty( $meeting_data ) ) {
            return false;
        }
        $this->set_trigger_hook_args( $hook_args );
        return true;
    }

    public function possible_tokens( $tokens = array(), $args = array() ) {
        $tokens[] = array( 'tokenId' => 'ZOOM_MEETING_ID', 'tokenName' => 'Meeting ID', 'tokenType' => 'int' );
        $tokens[] = array( 'tokenId' => 'ZOOM_MEETING_TOPIC', 'tokenName' => 'Meeting Topic', 'tokenType' => 'text' );
        $tokens[] = array( 'tokenId' => 'ZOOM_MEETING_JOIN_URL', 'tokenName' => 'Join URL', 'tokenType' => 'url' );
        $tokens[] = array( 'tokenId' => 'ZOOM_MEETING_START_TIME', 'tokenName' => 'Start Time', 'tokenType' => 'text' );
        return $tokens;
    }

    public function hydrate_tokens( $trigger, $hook_args ) {
        $meeting_data = isset( $hook_args[0] ) ? $hook_args[0] : null;
        return array(
            'ZOOM_MEETING_ID'         => isset( $meeting_data->id )         ? $meeting_data->id         : '',
            'ZOOM_MEETING_TOPIC'      => isset( $meeting_data->topic )      ? $meeting_data->topic      : '',
            'ZOOM_MEETING_JOIN_URL'   => isset( $meeting_data->join_url )   ? $meeting_data->join_url   : '',
            'ZOOM_MEETING_START_TIME' => isset( $meeting_data->start_time ) ? $meeting_data->start_time : '',
        );
    }
}
