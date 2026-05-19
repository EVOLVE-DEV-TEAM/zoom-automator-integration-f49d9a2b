<?php
class Zoom_Create_Meeting_Action extends \Uncanny_Automator\Recipe\Action {

    protected function setup_action() {
        $this->set_integration( 'ZOOM_WP' );
        $this->set_action_code( 'ZOOM_CREATE_MEETING' );
        $this->set_action_meta( 'ZOOM_CREATE_MEETING_META' );
        $this->set_author( 'Abdurrehman Abbasi' );
        $this->set_sentence( 'Create a Zoom meeting with topic {{ZOOM_MEETING_TOPIC}}' );
        $this->set_readable_sentence( 'Create a Zoom meeting' );
    }

    public function options() {
        return array(
            array(
                'option_code' => 'ZOOM_MEETING_TOPIC',
                'label'       => 'Meeting Topic',
                'input_type'  => 'text',
                'required'    => true,
            ),
            array(
                'option_code' => 'ZOOM_MEETING_START_TIME',
                'label'       => 'Start Time (YYYY-MM-DD HH:MM:SS)',
                'input_type'  => 'text',
                'required'    => true,
            ),
            array(
                'option_code' => 'ZOOM_MEETING_DURATION',
                'label'       => 'Duration (minutes)',
                'input_type'  => 'text',
                'required'    => true,
            ),
        );
    }

    protected function do_action( $user_id, $action_data, $recipe_id, $args ) {
        $topic      = $this->get_parsed_meta_value( 'ZOOM_MEETING_TOPIC' );
        $start_time = $this->get_parsed_meta_value( 'ZOOM_MEETING_START_TIME' );
        $duration   = $this->get_parsed_meta_value( 'ZOOM_MEETING_DURATION' );

        $api = new ZVC_Zoom_API_V2();
        $host = get_users( array( 'role' => 'administrator', 'number' => 1 ) );
        $host_id = ! empty( $host ) ? get_user_meta( $host[0]->ID, 'zvc_zoom_host_id', true ) : '';

        $meeting_data = array(
            'topic'      => $topic,
            'type'       => 2,
            'start_time' => date( 'Y-m-d\TH:i:s', strtotime( $start_time ) ),
            'duration'   => intval( $duration ),
            'settings'   => array( 'join_before_host' => true ),
        );

        $response = $api->create_meeting( $host_id, $meeting_data );

        if ( is_wp_error( $response ) ) {
            $this->do_fail( $action_data );
            return;
        }

        $this->do_success( $action_data );
    }
}
