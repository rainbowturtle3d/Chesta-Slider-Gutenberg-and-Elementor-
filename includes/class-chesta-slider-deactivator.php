<?php
/**
 * Fired during plugin deactivation
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes
 */
class Chesta_Slider_Deactivator {

    /**
     * Plugin deactivation tasks.
     *
     * Clean up temporary data and flush rewrite rules.
     */
    public static function deactivate() {
        // Clear any cached data
        self::clear_cache();

        // Remove activation flag
        delete_option('chesta_slider_activated');

        // Flush rewrite rules
        flush_rewrite_rules();

        // Clear any scheduled events
        wp_clear_scheduled_hook('chesta_slider_cleanup');
        wp_clear_scheduled_hook('chesta_slider_analytics_cleanup');
    }

    /**
     * Clear plugin cache.
     */
    private static function clear_cache() {
        // Clear WordPress object cache
        wp_cache_flush();

        // Clear any plugin-specific transients
        global $wpdb;
        
        $wpdb->query(
            "DELETE FROM {$wpdb->options} 
             WHERE option_name LIKE '_transient_chesta_slider_%' 
             OR option_name LIKE '_transient_timeout_chesta_slider_%'"
        );
    }
}

