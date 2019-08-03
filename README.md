# SecurityExtend MantisBT Plugin

![app-type](https://img.shields.io/badge/category-mantisbt%20plugins-blue.svg)
![app-lang](https://img.shields.io/badge/language-php-blue.svg)
[![app-publisher](https://img.shields.io/badge/%20%20%F0%9F%93%A6%F0%9F%9A%80-app--publisher-e10000.svg)](https://github.com/spmeesseman/app-publisher)
[![authors](https://img.shields.io/badge/authors-scott%20meesseman-6F02B5.svg?logo=visual%20studio%20code)](https://github.com/spmeesseman)

[![GitHub issues open](https://img.shields.io/github/issues-raw/mantisbt-plugins/SecurityExtend.svg?maxAge=2592000&logo=github)](https://github.com/mantisbt-plugins/SecurityExtend/issues)
[![GitHub issues closed](https://img.shields.io/github/issues-closed-raw/mantisbt-plugins/SecurityExtend.svg?maxAge=2592000&logo=github)](https://github.com/mantisbt-plugins/SecurityExtend/issues)
[![MantisBT issues open](https://app1.spmeesseman.com/projects/plugins/ApiExtend/api/issues/countbadge/SecurityExtend/open)](https://app1.spmeesseman.com/projects/set_project.php?project=SecurityExtend&make_default=no&ref=bug_report_page.php)
[![MantisBT issues closed](https://app1.spmeesseman.com/projects/plugins/ApiExtend/api/issues/countbadge/SecurityExtend/closed)](https://app1.spmeesseman.com/projects/set_project.php?project=SecurityExtend&make_default=no&ref=bug_report_page.php)
[![MantisBT version current](https://app1.spmeesseman.com/projects/plugins/ApiExtend/api/versionbadge/SecurityExtend/current)](https://app1.spmeesseman.com/projects/set_project.php?project=SecurityExtend&make_default=no&ref=plugin.php?page=Releases/releases)
[![MantisBT version next](https://app1.spmeesseman.com/projects/plugins/ApiExtend/api/versionbadge/SecurityExtend/next)](https://app1.spmeesseman.com/projects/set_project.php?project=SecurityExtend&make_default=no&ref=plugin.php?page=Releases/releases)

- [SecurityExtend MantisBT Plugin](#SecurityExtend-MantisBT-Plugin)
  - [Description](#Description)
  - [Installation](#Installation)
  - [Issues and Feature Requests](#Issues-and-Feature-Requests)
  - [Screenshots](#Screenshots)
    - [Editor Screen](#Editor-Screen)
  - [Todos](#Todos)

## Description

This plugin adds some additional spam security to MantisBT, including the following:

1. Block a bug from being created/updated if it contains a certain keyword or phrase
2. Block a bug from being created/updated if it contains a certain keyword or phrase, and `disable` the offending user account
3. Block a bug from being created/updated if it contains a certain keyword or phrase, and `delete` the offending user account

## Installation

Extract the release archive to the MantisBT installations plugins folder:

    cd /var/www/mantisbt/plugins
    wget -O SecurityExtend.zip https://github.com/mantisbt-plugins/SecurityExtend/releases/download/v1.0.0/SecurityExtend.zip
    unzip SecurityExtend.zip
    rm -f SecurityExtend.zip

Ensure to use the latest released version number in the download url: [![MantisBT version current](https://app1.spmeesseman.com/projects/plugins/ApiExtend/api/versionbadge/SecurityExtend/current)](https://app1.spmeesseman.com/projects) (version badge available via the [ApiExtend Plugin](https://github.com/mantisbt-plugins/ApiExtend))

Install the plugin using the default installation procedure for a MantisBT plugin in `Manage -> Plugins`.

## Issues and Feature Requests

Issues for my plugins will probably at some point be hosted by my [MantisBT](https://app1.spmeesseman.com/projects/set_project.php?project=SecurityExtend&make_default=no&ref=bug_report_page.php) site.  Until that is up and running and configured correctly, please use [GitHub Issues](https://github.com/mantisbt-plugins/SecurityExtend/issues) to report any problems or requests.

## Screenshots

### Editor Screen

![Editor Page](res/bugblock.png)

## Todos

- [ ] Support for blacklisting email domains from creating accounts
- [ ] Support for blacklisting specific email addresses from creating accounts
