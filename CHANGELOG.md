# SECURITYEXTEND CHANGE LOG

## Version 1.3.0 (August 8th, 2019)

### Features

- add support for blocking bugnotes in the same manner as that of submitting and editing bugs.
- add support for disabling/deleting user on a anti-spam trigger
- make different actions more configurable in plugin settings
- add info page content README.md and CHANGELOG.md using erusev/parsedown

### Bug Fixes

- markdown conversion doesnt create relative urls to screenshots correctly in info page
- php include path is being filled with mutliple entries for core_path
- tgz release package does not contain the plugin directory as the top level

## Version 1.2.0 (August 4th, 2019)

### Features

- **bug blocking:** add support to block issue/bug report on a duplicate summary and description(script attack).

### Refactoring

- **general:** dont run blocking checks if the user has a threshhold higher than g_default_new_account_access_level
- **logging:** modify log display to allow for display of different types of bug blocking events

## Version 1.1.0 (August 4th, 2019)

### Documentation

- **readme:** add configuration section, touch sections
- **readme:** add general security config section
- **readme:** add usage section
- **readme:** update info and screenshots

### Features

- **logging:** add event logging and log tab
- **miscellaneous:** add support for the 'bird window' to show to spammers just before being booted
- **account blocking:** add supprt for account blocking on signup, based on email address
- **account blocking:** add support to automatically add email addresses to account blocking component on a triggered account disable or delete
- **management:** display confirmation dialog before clearing/deleting items when using the 'clear' button
- **management:** add info page andframework for supporting viewing of readme and changelog in info tab

### Bug Fixes

- **management:** management tab is showing for users without view access
- **management:** user with edit access cannot edit options if user does not have plugin_threshhold_level

### Visual Enhancements

- **management:** make tab content fill the width of container

## Version 1.0.3 (August 3rd, 2019)

### Bug Fixes

- **domains:** blocked email domains are not saving

### Minor Features

- add initial framework to view the blocked events that have been enforced

## Version 1.0.2 (August 3rd, 2019)

### Build System

- **ap:** add missing core files to release

## Version 1.0.1 (August 3rd, 2019)

### Build System

- **ap:** fix version config for first package release

## Version 1.0.0 (August 1st, 2019)

### Initial Release

- Initial release of SecurityExtend plugin

