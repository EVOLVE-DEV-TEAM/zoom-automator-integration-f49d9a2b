<?php
class Zoom_Webinar_Updated_Trigger extends \Uncanny_Automator\Recipe\Trigger {

    protected function setup_trigger() {
        $this->set_integration( 'ZOOM_WP' );
        $this->set_trigger_code( 'ZOOM_WEBINAR_UPDATED' );
        $this->set_trigger_meta( 'ZOOM_WEBINAR_UPDATED_META' );
        $this->set_author( 'Abdurrehman Abbasi' );
        $this->set_sentence( 'A Zoom webinar is updated' );
        $this->set_readable_sentence( 'A Zoom webinar is updated' );
        $this->add_action( 'zoom_wp_after_update_webinar', 10, 3 );
    }

    public function validate( $trigger, $hook_args ) {
        $webinar_data = isset( $hook_args[0] ) ? $hook_args[0] : null;
        if ( empty( $webinar_data ) ) { return false; }
        $this->set_trigger_hook_args( $hook_args );
        return true;
    }

    public function possible_tokens( $tokens = array(), $args = array() ) {
        $tokens[] = array( 'tokenId' => 'ZOOM_WEBINAR_ID', 'tokenName' => 'Webinar ID', 'tokenType' => 'int' );
        $tokens[] = array( 'tokenId' => 'ZOOM_WEBINAR_TOPIC', 'tokenName' => 'Webinar Topic', 'tokenType' => 'text' );
        $tokens[] = array( 'tokenId' => 'ZOOM_WEBINAR_JOIN_URL', 'tokenName' => 'Join URL', 'tokenType' => 'url' );
        $tokens[] = array( 'tokenId' => 'ZOOM_WEBINAR_START_TIME', 'tokenName' => 'Start Time', 'tokenType' => 'text' );
        return $tokens;
    }

    public function hydrate_tokens( $trigger, $hook_args ) {
        $webinar_data = isset( $hook_args[0] ) ? $hook_args[0] : null;
        return array(
            'ZOOM_WEBINAR_ID'         => isset( $webinar_data->id )         ? $webinar_data->id         : '',
            'ZOOM_WEBINAR_TOPIC'      => isset( $webinar_data->topic )      ? $webinar_data->topic      : '',
            'ZOOM_WEBINAR_JOIN_URL'   => isset( $webinar_data->join_url )   ? $webinar_data->join_url   : '',
            'ZOOM_WEBINAR_START_TIME' => isset( $webinar_data->start_time ) ? $webinar_data->start_time : '',
        );
    }
}
