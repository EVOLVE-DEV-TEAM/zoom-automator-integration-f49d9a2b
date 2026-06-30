=== Zoom Automator Integration ===
Contributors: abdurrehmanabbasi
Tags: zoom, automator, uncanny automator, meetings
Requires at least: 5.8
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.2.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Connects WP Zoomy with Uncanny Automator for Zoom meeting automation.

== Description ==

Zoom Automator Integration adds Zoom triggers and actions to Uncanny Automator when used with **WP Zoomy** (wp-zoom-addon) and **Uncanny Automator**.

**Triggers**

* A Zoom meeting is created
* A Zoom meeting is updated

**Actions**

* Create a Zoom meeting
* Register an attendee for a Zoom meeting

== Installation ==

1. Install and activate [Uncanny Automator](https://wordpress.org/plugins/uncanny-automator/) and **WP Zoomy** (wp-zoom-addon).
2. Upload the plugin folder to `/wp-content/plugins/zoom-automator-integration/`.
3. Activate the plugin through the Plugins screen.
4. Create or edit an Automator recipe and select Zoom triggers or actions.

== Frequently Asked Questions ==

= What plugins are required? =

Uncanny Automator and WP Zoomy (wp-zoom-addon) must both be installed and active.

= Why is my Create Meeting action failing? =

Assign a Zoom host ID to at least one WordPress user under Zoom Meetings settings, and ensure Zoom API credentials are configured in WP Zoomy.

== Changelog ==

= 1.2.0 =
* Removed webinar triggers (requires separate Zoom webinar license; planned for a future release)

= 1.1.0 =
* Added Zoom triggers with dynamic tokens
* Added Create Meeting and Register Attendee actions
* Added dependency checks and Automator library submission polish

= 1.0.0 =
* Initial meeting created trigger
