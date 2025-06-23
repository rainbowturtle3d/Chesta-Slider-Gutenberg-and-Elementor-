<?php
/**
 * Define the internationalization functionality
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes
 */
class Chesta_Slider_i18n {

    /**
     * Load the plugin text domain for translation.
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain(
            'chesta-slider',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}

