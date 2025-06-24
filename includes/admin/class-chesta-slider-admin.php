<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks for admin functionality.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/admin
 */
class Chesta_Slider_Admin {

    /**
     * The ID of this plugin.
     *
     * @access private
     * @var string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @access private
     * @var string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     */
    public function enqueue_styles() {
        wp_enqueue_style(
            $this->plugin_name,
            CHESTA_SLIDER_ASSETS_URL . 'css/chesta-slider-admin.css',
            array(),
            $this->version,
            'all'
        );
    }

    /**
     * Register the JavaScript for the admin area.
     */
    public function enqueue_scripts() {
        wp_enqueue_script(
            $this->plugin_name,
            CHESTA_SLIDER_ASSETS_URL . 'js/chesta-slider-admin.js',
            array('jquery'),
            $this->version,
            false
        );

        // Localize script with admin data
        wp_localize_script(
            $this->plugin_name,
            'chestaSliderAdmin',
            array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('chesta_slider_admin_nonce'),
                'strings' => array(
                    'confirmDelete' => __('Are you sure you want to delete this slider?', 'chesta-slider'),
                    'saving' => __('Saving...', 'chesta-slider'),
                    'saved' => __('Settings saved!', 'chesta-slider'),
                    'error' => __('An error occurred. Please try again.', 'chesta-slider'),
                ),
            )
        );
    }

    /**
     * Add plugin admin menu.
     * DEPRECATED: Legacy admin menu - now using Chesta_Slider_Admin_Menu class
     */
    public function add_plugin_admin_menu() {
        // Legacy admin menu has been replaced by Chesta_Slider_Admin_Menu
        // This method is kept for backward compatibility but does nothing
        return;
        
        /*
        // Main menu page
        add_menu_page(
            __('Chesta Slider', 'chesta-slider'),
            __('Chesta Slider', 'chesta-slider'),
            'manage_options',
            $this->plugin_name,
            array($this, 'display_plugin_admin_page'),
            'dashicons-slides',
            30
        );

        // Settings submenu
        add_submenu_page(
            $this->plugin_name,
            __('Settings', 'chesta-slider'),
            __('Settings', 'chesta-slider'),
            'manage_options',
            $this->plugin_name . '-settings',
            array($this, 'display_plugin_settings_page')
        );

        // Slider Library submenu
        add_submenu_page(
            $this->plugin_name,
            __('Slider Library', 'chesta-slider'),
            __('Slider Library', 'chesta-slider'),
            'manage_options',
            $this->plugin_name . '-library',
            array($this, 'display_plugin_library_page')
        );

        // Help & Documentation submenu
        add_submenu_page(
            $this->plugin_name,
            __('Help & Documentation', 'chesta-slider'),
            __('Help & Docs', 'chesta-slider'),
            'manage_options',
            $this->plugin_name . '-help',
            array($this, 'display_plugin_help_page')
        );
        */
    }

    /**
     * Display the main admin page.
     */
    public function display_plugin_admin_page() {
        include_once CHESTA_SLIDER_PLUGIN_DIR . 'admin/partials/chesta-slider-admin-display.php';
    }

    /**
     * Display the settings page.
     */
    public function display_plugin_settings_page() {
        include_once CHESTA_SLIDER_PLUGIN_DIR . 'admin/partials/chesta-slider-admin-settings.php';
    }

    /**
     * Display the slider library page.
     */
    public function display_plugin_library_page() {
        include_once CHESTA_SLIDER_PLUGIN_DIR . 'admin/partials/chesta-slider-admin-library.php';
    }

    /**
     * Display the help page.
     */
    public function display_plugin_help_page() {
        include_once CHESTA_SLIDER_PLUGIN_DIR . 'admin/partials/chesta-slider-admin-help.php';
    }

    /**
     * Register and add settings.
     */
    public function options_update() {
        register_setting(
            'chesta_slider_options_group',
            'chesta_slider_options',
            array($this, 'validate_options')
        );

        // General Settings Section
        add_settings_section(
            'chesta_slider_general_section',
            __('General Settings', 'chesta-slider'),
            array($this, 'general_section_callback'),
            'chesta_slider_general'
        );

        // Performance Settings Section
        add_settings_section(
            'chesta_slider_performance_section',
            __('Performance Settings', 'chesta-slider'),
            array($this, 'performance_section_callback'),
            'chesta_slider_performance'
        );

        // Default Settings Section
        add_settings_section(
            'chesta_slider_defaults_section',
            __('Default Slider Settings', 'chesta-slider'),
            array($this, 'defaults_section_callback'),
            'chesta_slider_defaults'
        );

        // Add individual settings fields
        $this->add_settings_fields();
    }

    /**
     * Add individual settings fields.
     */
    private function add_settings_fields() {
        $options = get_option('chesta_slider_options');

        // General Settings
        add_settings_field(
            'enable_lazy_loading',
            __('Enable Lazy Loading', 'chesta-slider'),
            array($this, 'checkbox_field_callback'),
            'chesta_slider_general',
            'chesta_slider_general_section',
            array(
                'field' => 'enable_lazy_loading',
                'value' => isset($options['enable_lazy_loading']) ? $options['enable_lazy_loading'] : true,
                'description' => __('Load images only when needed for better performance.', 'chesta-slider')
            )
        );

        add_settings_field(
            'enable_touch_swipe',
            __('Enable Touch/Swipe', 'chesta-slider'),
            array($this, 'checkbox_field_callback'),
            'chesta_slider_general',
            'chesta_slider_general_section',
            array(
                'field' => 'enable_touch_swipe',
                'value' => isset($options['enable_touch_swipe']) ? $options['enable_touch_swipe'] : true,
                'description' => __('Enable touch and swipe navigation on mobile devices.', 'chesta-slider')
            )
        );

        add_settings_field(
            'enable_keyboard_navigation',
            __('Enable Keyboard Navigation', 'chesta-slider'),
            array($this, 'checkbox_field_callback'),
            'chesta_slider_general',
            'chesta_slider_general_section',
            array(
                'field' => 'enable_keyboard_navigation',
                'value' => isset($options['enable_keyboard_navigation']) ? $options['enable_keyboard_navigation'] : true,
                'description' => __('Enable arrow key navigation for accessibility.', 'chesta-slider')
            )
        );

        add_settings_field(
            'enable_rtl_support',
            __('Enable RTL Support', 'chesta-slider'),
            array($this, 'checkbox_field_callback'),
            'chesta_slider_general',
            'chesta_slider_general_section',
            array(
                'field' => 'enable_rtl_support',
                'value' => isset($options['enable_rtl_support']) ? $options['enable_rtl_support'] : false,
                'description' => __('Enable right-to-left language support.', 'chesta-slider')
            )
        );

        add_settings_field(
            'load_fontawesome',
            __('Load Font Awesome', 'chesta-slider'),
            array($this, 'checkbox_field_callback'),
            'chesta_slider_general',
            'chesta_slider_general_section',
            array(
                'field' => 'load_fontawesome',
                'value' => isset($options['load_fontawesome']) ? $options['load_fontawesome'] : true,
                'description' => __('Load Font Awesome icons for arrows and navigation.', 'chesta-slider')
            )
        );

        // Performance Settings
        add_settings_field(
            'optimize_images',
            __('Optimize Images', 'chesta-slider'),
            array($this, 'checkbox_field_callback'),
            'chesta_slider_performance',
            'chesta_slider_performance_section',
            array(
                'field' => 'optimize_images',
                'value' => isset($options['optimize_images']) ? $options['optimize_images'] : true,
                'description' => __('Automatically optimize slider images for better performance.', 'chesta-slider')
            )
        );

        add_settings_field(
            'enable_preloader',
            __('Enable Preloader', 'chesta-slider'),
            array($this, 'checkbox_field_callback'),
            'chesta_slider_performance',
            'chesta_slider_performance_section',
            array(
                'field' => 'enable_preloader',
                'value' => isset($options['enable_preloader']) ? $options['enable_preloader'] : true,
                'description' => __('Show loading animation while slider initializes.', 'chesta-slider')
            )
        );

        add_settings_field(
            'cache_duration',
            __('Cache Duration (seconds)', 'chesta-slider'),
            array($this, 'number_field_callback'),
            'chesta_slider_performance',
            'chesta_slider_performance_section',
            array(
                'field' => 'cache_duration',
                'value' => isset($options['cache_duration']) ? $options['cache_duration'] : 3600,
                'min' => 300,
                'max' => 86400,
                'description' => __('How long to cache slider data (300-86400 seconds).', 'chesta-slider')
            )
        );

        // Default Settings
        add_settings_field(
            'default_autoplay',
            __('Default Autoplay', 'chesta-slider'),
            array($this, 'checkbox_field_callback'),
            'chesta_slider_defaults',
            'chesta_slider_defaults_section',
            array(
                'field' => 'default_autoplay',
                'value' => isset($options['default_autoplay']) ? $options['default_autoplay'] : false,
                'description' => __('Enable autoplay by default for new sliders.', 'chesta-slider')
            )
        );

        add_settings_field(
            'default_autoplay_speed',
            __('Default Autoplay Speed (ms)', 'chesta-slider'),
            array($this, 'number_field_callback'),
            'chesta_slider_defaults',
            'chesta_slider_defaults_section',
            array(
                'field' => 'default_autoplay_speed',
                'value' => isset($options['default_autoplay_speed']) ? $options['default_autoplay_speed'] : 3000,
                'min' => 1000,
                'max' => 10000,
                'description' => __('Default autoplay speed in milliseconds.', 'chesta-slider')
            )
        );

        add_settings_field(
            'default_animation_speed',
            __('Default Animation Speed (ms)', 'chesta-slider'),
            array($this, 'number_field_callback'),
            'chesta_slider_defaults',
            'chesta_slider_defaults_section',
            array(
                'field' => 'default_animation_speed',
                'value' => isset($options['default_animation_speed']) ? $options['default_animation_speed'] : 500,
                'min' => 100,
                'max' => 2000,
                'description' => __('Default animation speed in milliseconds.', 'chesta-slider')
            )
        );

        // Custom CSS/JS
        add_settings_field(
            'custom_css',
            __('Custom CSS', 'chesta-slider'),
            array($this, 'textarea_field_callback'),
            'chesta_slider_defaults',
            'chesta_slider_defaults_section',
            array(
                'field' => 'custom_css',
                'value' => isset($options['custom_css']) ? $options['custom_css'] : '',
                'description' => __('Add custom CSS that will be applied to all sliders.', 'chesta-slider')
            )
        );

        add_settings_field(
            'custom_js',
            __('Custom JavaScript', 'chesta-slider'),
            array($this, 'textarea_field_callback'),
            'chesta_slider_defaults',
            'chesta_slider_defaults_section',
            array(
                'field' => 'custom_js',
                'value' => isset($options['custom_js']) ? $options['custom_js'] : '',
                'description' => __('Add custom JavaScript for advanced functionality.', 'chesta-slider')
            )
        );
    }

    /**
     * Validate options.
     *
     * @param array $input Input options.
     * @return array Validated options.
     */
    public function validate_options($input) {
        $valid = array();

        // Validate boolean fields
        $boolean_fields = array(
            'enable_lazy_loading',
            'enable_touch_swipe',
            'enable_keyboard_navigation',
            'enable_rtl_support',
            'load_fontawesome',
            'optimize_images',
            'enable_preloader',
            'default_autoplay',
            'accessibility_mode'
        );

        foreach ($boolean_fields as $field) {
            $valid[$field] = isset($input[$field]) ? (bool) $input[$field] : false;
        }

        // Validate numeric fields
        $valid['cache_duration'] = isset($input['cache_duration']) ? 
            max(300, min(86400, intval($input['cache_duration']))) : 3600;
        
        $valid['default_autoplay_speed'] = isset($input['default_autoplay_speed']) ? 
            max(1000, min(10000, intval($input['default_autoplay_speed']))) : 3000;
        
        $valid['default_animation_speed'] = isset($input['default_animation_speed']) ? 
            max(100, min(2000, intval($input['default_animation_speed']))) : 500;

        // Validate and sanitize text fields
        $valid['custom_css'] = isset($input['custom_css']) ? 
            wp_strip_all_tags($input['custom_css']) : '';
        
        $valid['custom_js'] = isset($input['custom_js']) ? 
            wp_strip_all_tags($input['custom_js']) : '';

        // Keep version info
        $valid['version'] = CHESTA_SLIDER_VERSION;

        return $valid;
    }

    /**
     * Section callbacks.
     */
    public function general_section_callback() {
        echo '<p>' . __('Configure general plugin settings.', 'chesta-slider') . '</p>';
    }

    public function performance_section_callback() {
        echo '<p>' . __('Optimize plugin performance and loading times.', 'chesta-slider') . '</p>';
    }

    public function defaults_section_callback() {
        echo '<p>' . __('Set default values for new sliders.', 'chesta-slider') . '</p>';
    }

    /**
     * Field callbacks.
     */
    public function checkbox_field_callback($args) {
        $field = $args['field'];
        $value = $args['value'];
        $description = isset($args['description']) ? $args['description'] : '';
        
        echo '<input type="checkbox" id="' . esc_attr($field) . '" name="chesta_slider_options[' . esc_attr($field) . ']" value="1" ' . checked(1, $value, false) . ' />';
        
        if ($description) {
            echo '<p class="description">' . esc_html($description) . '</p>';
        }
    }

    public function number_field_callback($args) {
        $field = $args['field'];
        $value = $args['value'];
        $min = isset($args['min']) ? $args['min'] : 0;
        $max = isset($args['max']) ? $args['max'] : 999999;
        $description = isset($args['description']) ? $args['description'] : '';
        
        echo '<input type="number" id="' . esc_attr($field) . '" name="chesta_slider_options[' . esc_attr($field) . ']" value="' . esc_attr($value) . '" min="' . esc_attr($min) . '" max="' . esc_attr($max) . '" />';
        
        if ($description) {
            echo '<p class="description">' . esc_html($description) . '</p>';
        }
    }

    public function textarea_field_callback($args) {
        $field = $args['field'];
        $value = $args['value'];
        $description = isset($args['description']) ? $args['description'] : '';
        
        echo '<textarea id="' . esc_attr($field) . '" name="chesta_slider_options[' . esc_attr($field) . ']" rows="6" cols="50">' . esc_textarea($value) . '</textarea>';
        
        if ($description) {
            echo '<p class="description">' . esc_html($description) . '</p>';
        }
    }
}
