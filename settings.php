<?php

/**
 * Telemetry plugin for Moodle.
 *
 * @author Luke Carrier <luke.carrier@floream.com>
 * @copyright 2015 Floream Limited
 * @license GPL v3
 */

defined('MOODLE_INTERNAL') || die;

$component = 'local_telemetry';

if ($hassiteconfig) {
    $page = new admin_settingpage(
        $component,
        new lang_string('pluginname', $component)
    );
    $ADMIN->add('localplugins', $page);

    if ($ADMIN->fulltree) {
        $page->add(new admin_setting_configcheckbox(
            "{$component}/enable",
            new lang_string('enable', $component),
            new lang_string('enable_desc', $component),
            false
        ));

        $page->add(new admin_setting_configcheckbox(
            "{$component}/rs_wincache",
            new lang_string('rs_wincache', $component),
            new lang_string('rs_wincache_desc', $component),
            false
        ));
    }
}
