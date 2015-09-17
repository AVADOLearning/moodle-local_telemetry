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
 * Single request.
 */
class request {
    /**
     * Additional request state.
     *
     * @var \local_telemetry\request_state[]
     */
    protected $additionalstate;

    /**
     * Plugin configuration.
     *
     * @var \local_telemetry\config
     */
    protected $config;

    /**
     * Moodle database instance.
     *
     * @var \moodle_database
     */
    protected $db;

    /**
     * Current page URL.
     *
     * @var \moodle_url
     */
    protected $url;

    /**
     * Initialiser.
     */
    public function __construct($config, $db, $url) {
        $this->additionalstate = array();

        $this->config = $config;
        $this->db     = $db;
        $this->url    = $url;
    }

    /**
     * Add additional request state.
     *
     * @param request_state $state
     *
     * @return void
     */
    public function add_state(request_state $state) {
        $this->additionalstate[] = $state;
    }

    /**
     * Commit new records.
     *
     * @return void
     */
    public function commit() {
        $request = (object) array(
            'pid'      => getmypid(),
            'threadid' => ZEND_THREAD_SAFE ? zend_thread_id() : null,
            'uid'      => getmyuid(),
            'url'      => $this->url->out_as_local_url(false),
            'hostname' => gethostname(),

            'memory'     => memory_get_usage(),
            'peakmemory' => memory_get_peak_usage(),
        );

        // Not supported on Windows until PHP 7
        if (function_exists('getrusage')) {
            $resourceusage = getrusage();

            $request->numswaps      = $resourceusage['ru_nswap'];
            $request->numpagefaults = $resourceusage['ru_majflt'];
            $request->usertime      = $resourceusage['ru_utime.tv_usec'];
        }

        $request->id = $this->db->insert_record('telemetry_request', $request);

        foreach ($this->additionalstate as $collector) {
            $table   = $collector->get_table();
            $records = $collector->get_records();

            foreach ($records as $record) {
                $record->requestid = $request->id;
            }

            $this->db->insert_records($table, $records);
        }
    }
}
