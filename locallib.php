<?php

/**
 * Telemetry plugin for Moodle.
 *
 * @author Luke Carrier <luke.carrier@floream.com>
 * @copyright 2015 Floream Limited
 * @license GPL v3
 */

use local_telemetry\config;
use local_telemetry\request;
use local_telemetry\request_state\wincache_request_state;

defined('MOODLE_INTERNAL') || die;

/**
 * Register shutdown handler.
 *
 * Should be called from your config.php
 *
 * @return void
 */
function local_telemetry_init() {
    global $DB, $ME;

    if (defined('ABORT_AFTER_CONFIG') && ABORT_AFTER_CONFIG
            || defined('AJAX_SCRIPT') && AJAX_SCRIPT
            || defined('CLI_SCRIPT') && CLI_SCRIPT) {
        /* We should probably be logging these, but since an extremely minimal
         * subset of the Moodle framework is loaded we can't locate our classes
         * without installing our own class autoloader. A task for a rainier
         * day. */
        return;
    }

    $config = new config();
    if (!$config->get('enable', false)) {
        return;
    }

    $url = new moodle_url($ME);
    $request = new request($config, $DB, $url);
    core_shutdown_manager::register_function(array($request, 'commit'));

    if ($config->get('rs_wincache')) {
        $request->add_state(new wincache_request_state());
    }
}
