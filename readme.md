futusign Monitor
====
Support for screen monitoring; detecting if screens are offline.

- [Description](#description)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [Contact](#contact)
- [License](#license)

Description
===

A plugin that adds support for screen monitoring, detecting if screens are offline, with the [futusign](https://github.com/larkintuckerllc/futusign-wordpress)
digital signage management software.

Installation
====

The latest plugin is available for download from the *release* tab.

Upload and activate the plugin via the WordPress Plugins admin screen.

Unlike other futusign plugins, futusign Monitor also requires the setup of a third-party tool; Firebase.

1. Create a no-cost Firebase account.
2. From Firebase console, use the Add project link to create a project.
3. From the newly created Firebase project, use the Add Firebase to your web app link to obtain information to be used in next steps.
4. From the WordPress administrative screens.
    1. Select menu, Settings > futusign Monitor
    2. Enter values from step 3 into the Firebase Config section.
    3. Press the Save Changes button.
5. From the newly created Firebase project, use the Authentication menu item:
    1. Select Sign-in Method tab and enable Email/Password provider.
    2. Select Users tab and create an account (email and password).
6. From the WordPress administrative screens.
    1. Select menu, Settings > futusign Monitor
    2. Enter email and password from step 5 into the Firebase Credentials section.
    3. Press the Save Changes button.

Usage
====
Once properly installed, loading a screen will display:
* A red border around screen.
* Within seconds a fading to transparent green border around screen; indicates screen is being monitored.

**note**: If the red border persists, the screen is unable to be monitored.

From the WordPress administrative screens select menu, Tools > futusign Monitor to see both the Screens Status and Screens History.

note: If need existing running screens to reload, update the futusign settings version from WordPress administrative screens select menu, Settings > futusign.

Contributing
====
Submit bug or enhancement requests using the *GitHub* issues feature.

Contact
====
General questions and comments can be directed to
<mailto:john@larkintuckerllc.com>.

License
====
GPLv2 or later <https://www.gnu.org/licenses/gpl.html>