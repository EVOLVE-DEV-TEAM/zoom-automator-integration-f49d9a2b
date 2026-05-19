<?php

class Zoom_Automator_Integration extends \Uncanny_Automator\Integration {

    protected function setup() {
        // unique ID for this integration - must be all caps
        $this->set_integration( 'ZOOM_WP' );

        // the name that shows in the Automator UI
        $this->set_name( 'Zoom' );

        // icon - you can use any publicly accessible image URL or a local one
        $this->set_icon_url( 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7b/Zoom_Communications_Logo.svg/1200px-Zoom_Communications_Logo.svg.png' );
    }
}