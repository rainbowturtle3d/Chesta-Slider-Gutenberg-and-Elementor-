<?php
/**
 * Fired during plugin activation
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes
 */
class Chesta_Slider_Activator {

    /**
     * Plugin activation tasks.
     *
     * Create default options, check system requirements, and set up initial data.
     */
    public static function activate() {
        // Check WordPress version
        if (version_compare(get_bloginfo('version'), '5.0', '<')) {
            wp_die(__('Chesta Slider requires WordPress 5.0 or higher.', 'chesta-slider'));
        }

        // Check PHP version
        if (version_compare(PHP_VERSION, '7.4', '<')) {
            wp_die(__('Chesta Slider requires PHP 7.4 or higher.', 'chesta-slider'));
        }

        // Create default options
        self::create_default_options();

        // Create custom database tables if needed
        self::create_tables();

        // Set activation flag
        add_option('chesta_slider_activated', true);

        // Flush rewrite rules
        flush_rewrite_rules();
    }

    /**
     * Create default plugin options.
     */
    private static function create_default_options() {
        $default_options = array(
            'version' => CHESTA_SLIDER_VERSION,
            'enable_lazy_loading' => true,
            'enable_touch_swipe' => true,
            'enable_keyboard_navigation' => true,
            'default_autoplay' => false,
            'default_autoplay_speed' => 3000,
            'default_animation_speed' => 500,
            'enable_rtl_support' => false,
            'load_fontawesome' => true,
            'custom_css' => '',
            'custom_js' => '',
            'enable_analytics' => false,
            'cache_duration' => 3600,
            'optimize_images' => true,
            'enable_preloader' => true,
            'accessibility_mode' => true
        );

        add_option('chesta_slider_options', $default_options);
    }

    /**
     * Create custom database tables.
     */
    private static function create_tables() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        // Table for storing slider configurations
        $table_name = $wpdb->prefix . 'chesta_sliders';

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            type varchar(50) NOT NULL,
            settings longtext NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            status varchar(20) DEFAULT 'active',
            PRIMARY KEY (id),
            KEY type (type),
            KEY status (status)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        // Table for slider analytics (optional)
        $analytics_table = $wpdb->prefix . 'chesta_slider_analytics';

        $analytics_sql = "CREATE TABLE $analytics_table (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            slider_id mediumint(9) NOT NULL,
            event_type varchar(50) NOT NULL,
            event_data longtext,
            user_agent varchar(255),
            ip_address varchar(45),
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY slider_id (slider_id),
            KEY event_type (event_type),
            KEY created_at (created_at)
        ) $charset_collate;";

        dbDelta($analytics_sql);
    }
}

