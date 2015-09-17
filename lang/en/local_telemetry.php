<?php

/**
 * Telemetry plugin for Moodle.
 *
 * @author Luke Carrier <luke.carrier@floream.com>
 * @copyright 2015 Floream Limited
 * @license GPL v3
 */

defined('MOODLE_INTERNAL') || die;

// Moodle component metadata
$string['pluginname'] = 'Telemetry';

// Configuration
$string['enable']           = 'Enable';
$string['enable_desc']      = 'If enabled, the telemetry plugin will install a shutdown handler during Moodle\'s initialisation which will enable it to collect and gather state about the site once the bulk of the request\'s processing has completed.';
$string['rs_wincache']      = 'Log WinCache state';
$string['rs_wincache_desc'] = 'If enabled, state about the WinCache extension will be logged.';

