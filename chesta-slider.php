<?php
/**
 * Plugin Name: Chesta Slider - Gutenberg & Elementor
 * Plugin URI: https://github.com/tarulahsan/Chesta-Slider-Gutenberg-and-Elementor-
 * Description: A powerful, lightweight, and fully customizable slider plugin for Gutenberg and Elementor with 25+ slider types. No jQuery dependency, modern React-based interface, and seamless theme integration.
 * Version: 1.0.0
 * Author: Tarul Ahsan
 * Author URI: mailto:tarulahsan@gmail.com
 * License: Proprietary
 * License URI: https://chesta-slider.com/license
 * Text Domain: chesta-slider
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.4
 * Requires PHP: 7.4
 * Network: false
 *
 * @package ChestaSlider
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Plugin version.
 */
define('CHESTA_SLIDER_VERSION', '1.0.0');

/**
 * Plugin root file.
 */
define('CHESTA_SLIDER_PLUGIN_FILE', __FILE__);

/**
 * Plugin root directory.
 */
define('CHESTA_SLIDER_PLUGIN_DIR', plugin_dir_path(__FILE__));

/**
 * Plugin root URL.
 */
define('CHESTA_SLIDER_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Plugin assets URL.
 */
define('CHESTA_SLIDER_ASSETS_URL', CHESTA_SLIDER_PLUGIN_URL . 'assets/');

/**
 * Plugin includes directory.
 */
define('CHESTA_SLIDER_INCLUDES_DIR', CHESTA_SLIDER_PLUGIN_DIR . 'includes/');

/**
 * The code that runs during plugin activation.
 */
function activate_chesta_slider() {
    require_once CHESTA_SLIDER_INCLUDES_DIR . 'class-chesta-slider-activator.php';
    Chesta_Slider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_chesta_slider() {
    require_once CHESTA_SLIDER_INCLUDES_DIR . 'class-chesta-slider-deactivator.php';
    Chesta_Slider_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_chesta_slider');
register_deactivation_hook(__FILE__, 'deactivate_chesta_slider');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require CHESTA_SLIDER_INCLUDES_DIR . 'class-chesta-slider.php';

/**
 * Begins execution of the plugin.
 */
function run_chesta_slider() {
    $plugin = new Chesta_Slider();
    $plugin->run();
}

run_chesta_slider();
