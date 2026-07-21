=== Zoom Automator Integration ===
Contributors: elearningevolve
Tags: zoom, automator, uncanny automator, meetings
Requires at least: 5.8
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 1.2.3
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

= Why is Register Attendee failing? =

The meeting must have Zoom registration enabled. Meetings created by this integration use automatic approval registration so attendees can be registered. Existing meetings need registration enabled in Zoom/WP Zoomy. Zoom Pro or higher is required for meeting registration.

== Changelog ==

= 1.2.3 =
* Fixed action config panel: sentence tokens now use Automator fillable format {{label:META}}

= 1.2.2 =
* Fixed Zoom actions not expanding in the recipe builder (sentence tokens now match action_meta / options_group)

= 1.2.1 =
* Fixed trigger tokens for current Automator API (define_tokens)
* Create Meeting now enables auto-approve registration so Register Attendee works
* Added action tokens for created meetings and registrant join URLs
* Aligned Meeting Updated trigger tokens with Meeting Created
* Corrected Plugin URI

= 1.2.0 =
* Removed webinar triggers (requires separate Zoom webinar license; planned for a future release)

= 1.1.0 =
* Added Zoom triggers with dynamic tokens
* Added Create Meeting and Register Attendee actions
* Added dependency checks and Automator library submission polish

= 1.0.0 =
* Initial meeting created trigger

== Upgrade Notice ==

= 1.2.3 =
Fixes action config panel tokens for current Automator sentence format.
