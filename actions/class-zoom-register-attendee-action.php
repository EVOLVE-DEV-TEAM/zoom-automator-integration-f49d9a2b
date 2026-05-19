<?php
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
                'label'       => 'Meeting ID',
                'input_type'  => 'text',
                'required'    => true,
            ),
            array(
                'option_code' => 'ZOOM_ATTENDEE_EMAIL',
                'label'       => 'Attendee Email',
                'input_type'  => 'email',
                'required'    => true,
            ),
            array(
                'option_code' => 'ZOOM_ATTENDEE_FIRST_NAME',
                'label'       => 'First Name',
                'input_type'  => 'text',
                'required'    => true,
            ),
            array(
                'option_code' => 'ZOOM_ATTENDEE_LAST_NAME',
                'label'       => 'Last Name',
                'input_type'  => 'text',
                'required'    => false,
            ),
        );
    }

    protected function do_action( $user_id, $action_data, $recipe_id, $args ) {
        $meeting_id = $this->get_parsed_meta_value( 'ZOOM_MEETING_ID' );
        $email      = $this->get_parsed_meta_value( 'ZOOM_ATTENDEE_EMAIL' );
        $first_name = $this->get_parsed_meta_value( 'ZOOM_ATTENDEE_FIRST_NAME' );
        $last_name  = $this->get_parsed_meta_value( 'ZOOM_ATTENDEE_LAST_NAME' );

        $api = new ZVC_Zoom_API_V2();

        $registrant = array(
            'email'      => $email,
            'first_name' => $first_name,
            'last_name'  => $last_name,
        );

        $response = $api->meeting_registrants( $meeting_id, $registrant );

        if ( is_wp_error( $response ) ) {
            $this->do_fail( $action_data );
            return;
        }

        $this->do_success( $action_data );
    }
}