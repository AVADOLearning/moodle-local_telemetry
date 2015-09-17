<?php

/**
 * Telemetry plugin for Moodle.
 *
 * @author Luke Carrier <luke.carrier@floream.com>
 * @copyright 2015 Floream Limited
 * @license GPL v3
 */

namespace local_telemetry\request_state;

use local_telemetry\request_state;
use stdClass;

defined('MOODLE_INTERNAL') || die;

/**
 * WinCache request state for the telemetry plugin.
 */
class wincache_request_state implements request_state {
    /**
     * @override \local_telemetry\request_state
     */
    public function get_records() {
        $record = new stdClass();

        $filecachefileinfo = wincache_fcache_fileinfo(true);
        if ($filecachefileinfo) {
            $record->f_f_uptime = $filecachefileinfo['total_cache_uptime'];
            $record->f_f_items  = $filecachefileinfo['total_file_count'];
            $record->f_f_hits   = $filecachefileinfo['total_hit_count'];
            $record->f_f_misses = $filecachefileinfo['total_miss_count'];
        }
        $filecachememinfo = wincache_fcache_meminfo();
        if ($filecachememinfo) {
            $record->f_m_total       = $filecachememinfo['memory_total'];
            $record->f_m_free        = $filecachememinfo['memory_free'];
            $record->f_m_used_blocks = $filecachememinfo['num_used_blks'];
            $record->f_m_free_blocks = $filecachememinfo['num_free_blks'];
            $record->f_m_overhead    = $filecachememinfo['memory_overhead'];
        }

        $opcodecachefileinfo = wincache_ocache_fileinfo(true);
        if ($opcodecachefileinfo) {
            $record->o_f_uptime  = $opcodecachefileinfo['total_cache_uptime'];
            $record->o_f_items   = $opcodecachefileinfo['total_file_count'];
            $record->o_f_hits    = $opcodecachefileinfo['total_hit_count'];
            $record->o_f_misses  = $opcodecachefileinfo['total_miss_count'];
            $record->o_f_islocal = $opcodecachefileinfo['is_local_cache'];
        }
        $opcodecachememinfo = wincache_ocache_meminfo();
        if ($opcodecachememinfo) {
            $record->o_m_total       = $opcodecachememinfo['memory_total'];
            $record->o_m_free        = $opcodecachememinfo['memory_free'];
            $record->o_m_used_blocks = $opcodecachememinfo['num_used_blks'];
            $record->o_m_free_blocks = $opcodecachememinfo['num_free_blks'];
            $record->o_m_overhead    = $opcodecachememinfo['memory_overhead'];
        }

        $resolvedpathcachefileinfo = wincache_rplist_fileinfo(true);
        if ($resolvedpathcachefileinfo) {
            $record->rp_f_files = $resolvedpathcachefileinfo['total_file_count'];
        }
        $resolvedpathcachememinfo = wincache_rplist_meminfo();
        if ($resolvedpathcachememinfo) {
            $record->rp_m_total       = $resolvedpathcachememinfo['memory_total'];
            $record->rp_m_free        = $resolvedpathcachememinfo['memory_free'];
            $record->rp_m_used_blocks = $resolvedpathcachememinfo['num_used_blks'];
            $record->rp_m_free_blocks = $resolvedpathcachememinfo['num_free_blks'];
            $record->rp_m_overhead    = $resolvedpathcachememinfo['memory_overhead'];
        }

        $sessioncacheinfo = wincache_scache_info(true);
        if ($sessioncacheinfo) {
            $record->s_i_uptime  = $sessioncacheinfo['total_cache_uptime'];
            $record->s_i_items   = $sessioncacheinfo['total_item_count'];
            $record->s_i_islocal = $sessioncacheinfo['is_local_cache'];
            $record->s_i_hits    = $sessioncacheinfo['total_hit_count'];
            $record->s_i_misses  = $sessioncacheinfo['total_miss_count'];
        }
        $sessioncachememinfo = wincache_scache_meminfo();
        if ($sessioncachememinfo) {
            $record->s_m_total       = $sessioncachememinfo['memory_total'];
            $record->s_m_free        = $sessioncachememinfo['memory_free'];
            $record->s_m_used_blocks = $sessioncachememinfo['num_used_blks'];
            $record->s_m_free_blocks = $sessioncachememinfo['num_free_blks'];
            $record->s_m_overhead    = $sessioncachememinfo['memory_overhead'];
        }

        $usercacheinfo = wincache_ucache_info(true);
        if ($usercacheinfo) {
            $record->u_i_uptime  = $usercacheinfo['total_cache_uptime'];
            $record->u_i_items   = $usercacheinfo['total_item_count'];
            $record->u_i_islocal = $usercacheinfo['is_local_cache'];
            $record->u_i_hits    = $usercacheinfo['total_hit_count'];
            $record->u_i_misses  = $usercacheinfo['total_miss_count'];
        }
        $usercachememinfo = wincache_ucache_meminfo();
        if ($usercachememinfo) {
            $record->u_m_total       = $usercachememinfo['memory_total'];
            $record->u_m_free        = $usercachememinfo['memory_free'];
            $record->u_m_used_blocks = $usercachememinfo['num_used_blks'];
            $record->u_m_free_blocks = $usercachememinfo['num_free_blks'];
            $record->u_m_overhead    = $usercachememinfo['memory_overhead'];
        }

        return array($record);
    }

    /**
     * @override \local_telemetry\request_state
     */
    public function get_table() {
        return 'telemetry_wincache';
    }
}
