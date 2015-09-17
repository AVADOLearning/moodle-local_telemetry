<?php

/**
 * Telemetry plugin for Moodle.
 *
 * @author Luke Carrier <luke.carrier@floream.com>
 * @copyright 2015 Floream Limited
 * @license GPL v3
 */

namespace local_telemetry;

defined('MOODLE_INTERNAL') || die;

/**
 * Additional request state.
 */
interface request_state {
    /**
     * Get the records.
     *
     * @return \stdClass[]
     */
    public function get_records();

    /**
     * Get the table name.
     *
     * @return string
     */
    public function get_table();
}
