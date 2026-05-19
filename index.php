<?php
/*
 * Plugin Name: Zoom Automator Integration
 * Description: Connects the Zoom WordPress plugin with Uncanny Automator.
 * Version: 1.1
 * Author: Abdurrehman Abbasi
 */

add_action( 'automator_add_integration', 'zoom_automator_load_integration' );

function zoom_automator_load_integration() {

    if ( ! class_exists( '\\Uncanny_Automator\\Integration' ) ) {
        return;
    }

    if ( ! function_exists( 'zoom_conference' ) ) {
        return;
    }

    require_once plugin_dir_path( __FILE__ ) . 'integration/class-zoom-integration.php';
    new Zoom_Automator_Integration();

    require_once plugin_dir_path( __FILE__ ) . 'triggers/class-zoom-meeting-created-trigger.php';
    new Zoom_Meeting_Created_Trigger();

    require_once plugin_dir_path( __FILE__ ) . 'triggers/class-zoom-meeting-updated-trigger.php';
    new Zoom_Meeting_Updated_Trigger();

    require_once plugin_dir_path( __FILE__ ) . 'triggers/class-zoom-webinar-created-trigger.php';
    new Zoom_Webinar_Created_Trigger();
    require_once plugin_dir_path( __FILE__ ) . 'triggers/class-zoom-webinar-updated-trigger.php';
    new Zoom_Webinar_Updated_Trigger();
    require_once plugin_dir_path( __FILE__ ) . 'actions/class-zoom-create-meeting-action.php';
    new Zoom_Create_Meeting_Action();
    require_once plugin_dir_path( __FILE__ ) . 'actions/class-zoom-register-attendee-action.php';
    new Zoom_Register_Attendee_Action();
}
