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
 * Telemetry plugin configuration.
 *
 * @property boolean $enable
 */
class config {
    /**
     * Moodle component name.
     *
     * @var string
     */
    const MOODLE_COMPONENT = 'local_telemetry';

    /**
     * Actual configuration values.
     *
     * @var \stdClass
     */
    protected $config;

    /**
     * Initialiser.
     */
    public function __construct() {
        $this->config = get_config(static::MOODLE_COMPONENT);
    }

    /**
     * Get a property value.
     *
     * @param string $property
     *
     * @return mixed
     */
    public function __get($property) {
        return $this->config->{$property};
    }

    /**
     * Set a property value.
     *
     * @param string $property
     * @param mixed  $value
     *
     * @return void
     */
    public function __set($property, $value) {
        $this->config->{$property} = $value;

        set_config($property, $value, static::MOODLE_COMPONENT);
    }

    /**
     * Get a property, supplying a default value (or null).
     *
     * @param string $property
     * @param mixed  $default
     *
     * @return null
     */
    public function get($property, $default=null) {
        return (isset($this->config->{$property}))
                ? $this->config->{$property} : $default;
    }
}
