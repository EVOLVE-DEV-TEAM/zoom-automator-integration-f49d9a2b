<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Zoom_Register_Attendee_Action extends \Uncanny_Automator\Recipe\Action {

	protected function setup_action() {
		$this->set_integration( 'ZOOM_WP' );
		$this->set_action_code( 'ZOOM_REGISTER_ATTENDEE' );
		$this->set_action_meta( 'ZOOM_REGISTER_ATTENDEE_META' );
		$this->set_author( 'Abdurrehman Abbasi' );
		$this->set_sentence( 'Register {{ZOOM_ATTENDEE_EMAIL}} for Zoom meeting {{ZOOM_MEETING_ID}}' );
		$this->set_readable_sentence( 'Register an attendee for a Zoom meeting' );
	}

	public function options() {
		return array(
			array(
				'option_code' => 'ZOOM_MEETING_ID',
				'label'       => esc_html__( 'Meeting ID', 'zoom-automator-integration' ),
				'input_type'  => 'text',
				'required'    => true,
			),
			array(
				'option_code' => 'ZOOM_ATTENDEE_EMAIL',
				'label'       => esc_html__( 'Attendee Email', 'zoom-automator-integration' ),
				'input_type'  => 'email',
				'required'    => true,
			),
			array(
				'option_code' => 'ZOOM_ATTENDEE_FIRST_NAME',
				'label'       => esc_html__( 'First Name', 'zoom-automator-integration' ),
				'input_type'  => 'text',
				'required'    => true,
			),
			array(
				'option_code' => 'ZOOM_ATTENDEE_LAST_NAME',
				'label'       => esc_html__( 'Last Name', 'zoom-automator-integration' ),
				'input_type'  => 'text',
				'required'    => false,
			),
		);
	}

	protected function process_action( $user_id, $action_data, $recipe_id, $args, $parsed ) {
		$meeting_id = isset( $parsed['ZOOM_MEETING_ID'] ) ? $parsed['ZOOM_MEETING_ID'] : '';
		$email      = isset( $parsed['ZOOM_ATTENDEE_EMAIL'] ) ? $parsed['ZOOM_ATTENDEE_EMAIL'] : '';
		$first_name = isset( $parsed['ZOOM_ATTENDEE_FIRST_NAME'] ) ? $parsed['ZOOM_ATTENDEE_FIRST_NAME'] : '';
		$last_name  = isset( $parsed['ZOOM_ATTENDEE_LAST_NAME'] ) ? $parsed['ZOOM_ATTENDEE_LAST_NAME'] : '';

		if ( empty( $meeting_id ) || empty( $email ) || empty( $first_name ) ) {
			throw new \Exception( esc_html__( 'Meeting ID, email, and first name are required.', 'zoom-automator-integration' ) );
		}

		$response   = zoom_automator_register_meeting_participant( $meeting_id, $first_name, $last_name, $email );
		$registrant = zoom_automator_decode_zoom_response( $response );

		if ( zoom_automator_is_zoom_api_error( $registrant ) ) {
			$error_message = isset( $registrant->message ) ? $registrant->message : esc_html__( 'Zoom API could not register the attendee.', 'zoom-automator-integration' );
			throw new \Exception( $error_message );
		}

		return true;
	}
}
