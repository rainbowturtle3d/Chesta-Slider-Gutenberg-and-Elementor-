<?php
/**
 * Admin Menu and Dashboard for Chesta Slider
 * Creates admin interface with documentation, tutorials, and shortcode reference
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/admin
 */

/**
 * Admin Menu class.
 *
 * Handles the WordPress admin interface for Chesta Slider.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/admin
 */
class Chesta_Slider_Admin_Menu {

    /**
     * The template manager instance.
     *
     * @access private
     * @var Chesta_Slider_Template_Manager $template_manager Template manager.
     */
    private $template_manager;

    /**
     * The shortcode handler instance.
     *
     * @access private
     * @var Chesta_Slider_Shortcode $shortcode_handler Shortcode handler.
     */
    private $shortcode_handler;

    /**
     * The plugin name.
     *
     * @access private
     * @var string $plugin_name Plugin name.
     */
    private $plugin_name;

    /**
     * The plugin version.
     *
     * @access private
     * @var string $version Plugin version.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name Plugin name.
     * @param string $version Plugin version.
     * @param Chesta_Slider_Template_Manager $template_manager Template manager instance.
     * @param Chesta_Slider_Shortcode $shortcode_handler Shortcode handler instance.
     */
    public function __construct($plugin_name, $version, $template_manager, $shortcode_handler) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->template_manager = $template_manager;
        $this->shortcode_handler = $shortcode_handler;

        $this->init_hooks();
    }

    /**
     * Initialize WordPress hooks.
     */
    private function init_hooks() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
        add_action('wp_ajax_chesta_slider_get_shortcode', array($this, 'ajax_get_shortcode'));
    }

    /**
     * Add admin menu pages.
     */
    public function add_admin_menu() {
        // Main menu page
        add_menu_page(
            __('Chesta Sliders', 'chesta-slider'),
            __('Chesta Sliders', 'chesta-slider'),
            'manage_options',
            'chesta-sliders',
            array($this, 'display_dashboard_page'),
            'dashicons-slides',
            30
        );

        // Dashboard submenu
        add_submenu_page(
            'chesta-sliders',
            __('Dashboard', 'chesta-slider'),
            __('Dashboard', 'chesta-slider'),
            'manage_options',
            'chesta-sliders',
            array($this, 'display_dashboard_page')
        );

        // Documentation submenu
        add_submenu_page(
            'chesta-sliders',
            __('Documentation', 'chesta-slider'),
            __('Documentation', 'chesta-slider'),
            'manage_options',
            'chesta-sliders-docs',
            array($this, 'display_documentation_page')
        );

        // Features & Sliders submenu
        add_submenu_page(
            'chesta-sliders',
            __('Features & Sliders', 'chesta-slider'),
            __('Features & Sliders', 'chesta-slider'),
            'manage_options',
            'chesta-sliders-tutorials',
            array($this, 'display_tutorials_page')
        );

        // Shortcodes submenu
        add_submenu_page(
            'chesta-sliders',
            __('Shortcodes', 'chesta-slider'),
            __('Shortcodes', 'chesta-slider'),
            'manage_options',
            'chesta-sliders-shortcodes',
            array($this, 'display_shortcodes_page')
        );

        // Settings submenu
        add_submenu_page(
            'chesta-sliders',
            __('Settings', 'chesta-slider'),
            __('Settings', 'chesta-slider'),
            'manage_options',
            'chesta-sliders-settings',
            array($this, 'display_settings_page')
        );

        // Support submenu
        add_submenu_page(
            'chesta-sliders',
            __('Support', 'chesta-slider'),
            __('Support', 'chesta-slider'),
            'manage_options',
            'chesta-sliders-support',
            array($this, 'display_support_page')
        );
    }

    /**
     * Enqueue admin assets.
     *
     * @param string $hook_suffix Current admin page hook suffix.
     */
    public function enqueue_admin_assets($hook_suffix) {
        // Only load on our admin pages
        if (strpos($hook_suffix, 'chesta-sliders') === false) {
            return;
        }

        wp_enqueue_style(
            'chesta-slider-admin',
            CHESTA_SLIDER_PLUGIN_URL . 'assets/css/admin/admin.css',
            array(),
            $this->version
        );

        wp_enqueue_script(
            'chesta-slider-admin',
            CHESTA_SLIDER_PLUGIN_URL . 'assets/js/admin/admin.js',
            array('jquery'),
            $this->version,
            true
        );

        wp_localize_script('chesta-slider-admin', 'chestaSliderAdmin', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('chesta_slider_admin_nonce'),
            'templates' => $this->template_manager->get_templates(),
        ));
    }

    /**
     * Display dashboard page.
     */
    public function display_dashboard_page() {
        $templates = $this->template_manager->get_templates();
        $template_count = count($templates);
        $basic_count = count(array_filter($templates, function($t) { return $t['category'] === 'basic'; }));
        $advanced_count = count(array_filter($templates, function($t) { return $t['category'] === 'advanced'; }));
        $premium_count = count(array_filter($templates, function($t) { return $t['premium'] === true; }));

        include CHESTA_SLIDER_PLUGIN_DIR . 'includes/admin/views/dashboard.php';
    }

    /**
     * Display documentation page.
     */
    public function display_documentation_page() {
        $templates = $this->template_manager->get_templates();
        include CHESTA_SLIDER_PLUGIN_DIR . 'includes/admin/views/documentation.php';
    }

    /**
     * Display features & sliders page.
     */
    public function display_tutorials_page() {
        include CHESTA_SLIDER_PLUGIN_DIR . 'includes/admin/views/tutorials.php';
    }

    /**
     * Display shortcodes page.
     */
    public function display_shortcodes_page() {
        $templates = $this->template_manager->get_templates();
        $shortcode_docs = $this->shortcode_handler->get_shortcode_documentation();
        include CHESTA_SLIDER_PLUGIN_DIR . 'includes/admin/views/shortcodes.php';
    }

    /**
     * Display settings page.
     */
    public function display_settings_page() {
        include CHESTA_SLIDER_PLUGIN_DIR . 'includes/admin/views/settings.php';
    }

    /**
     * Display support page.
     */
    public function display_support_page() {
        include CHESTA_SLIDER_PLUGIN_DIR . 'includes/admin/views/support.php';
    }

    /**
     * AJAX handler for getting shortcode.
     */
    public function ajax_get_shortcode() {
        check_ajax_referer('chesta_slider_admin_nonce', 'nonce');

        $slider_type = sanitize_text_field($_POST['slider_type']);
        $templates = $this->template_manager->get_templates();

        if (!isset($templates[$slider_type])) {
            wp_die(__('Invalid slider type', 'chesta-slider'));
        }

        $template = $templates[$slider_type];
        $shortcode = "[chesta_slider type=\"{$slider_type}\"]";

        // Add common parameters as example
        $example_shortcode = "[chesta_slider type=\"{$slider_type}\" autoplay=\"true\" arrows=\"true\" dots=\"true\" height=\"400px\"]";

        wp_send_json_success(array(
            'basic_shortcode' => $shortcode,
            'example_shortcode' => $example_shortcode,
            'template' => $template,
        ));
    }

    /**
     * Get plugin statistics.
     *
     * @return array Plugin statistics.
     */
    public function get_plugin_stats() {
        $templates = $this->template_manager->get_templates();
        
        return array(
            'total_sliders' => count($templates),
            'basic_sliders' => count(array_filter($templates, function($t) { return $t['category'] === 'basic'; })),
            'advanced_sliders' => count(array_filter($templates, function($t) { return $t['category'] === 'advanced'; })),
            'content_sliders' => count(array_filter($templates, function($t) { return $t['category'] === 'content'; })),
            'interactive_sliders' => count(array_filter($templates, function($t) { return $t['category'] === 'interactive'; })),
            'specialized_sliders' => count(array_filter($templates, function($t) { return $t['category'] === 'specialized'; })),
            'premium_sliders' => count(array_filter($templates, function($t) { return $t['premium'] === true; })),
            'free_sliders' => count(array_filter($templates, function($t) { return $t['premium'] === false; })),
        );
    }

    /**
     * Get quick start guide.
     *
     * @return array Quick start steps.
     */
    public function get_quick_start_guide() {
        return array(
            array(
                'title' => __('Choose Your Slider Type', 'chesta-slider'),
                'description' => __('Browse through 25+ slider types and pick the one that fits your needs.', 'chesta-slider'),
                'icon' => 'dashicons-slides',
            ),
            array(
                'title' => __('Add to Your Content', 'chesta-slider'),
                'description' => __('Use Gutenberg blocks or shortcodes to add sliders to your posts and pages.', 'chesta-slider'),
                'icon' => 'dashicons-plus-alt2',
            ),
            array(
                'title' => __('Customize Settings', 'chesta-slider'),
                'description' => __('Adjust colors, animations, navigation, and other settings to match your design.', 'chesta-slider'),
                'icon' => 'dashicons-admin-customizer',
            ),
            array(
                'title' => __('Publish & Enjoy', 'chesta-slider'),
                'description' => __('Your beautiful, responsive slider is ready to impress your visitors!', 'chesta-slider'),
                'icon' => 'dashicons-yes-alt',
            ),
        );
    }

    /**
     * Get feature highlights.
     *
     * @return array Feature highlights.
     */
    public function get_feature_highlights() {
        return array(
            array(
                'title' => __('25+ Slider Types', 'chesta-slider'),
                'description' => __('From basic carousels to advanced 3D effects, we have every slider type you need.', 'chesta-slider'),
                'icon' => 'dashicons-images-alt2',
            ),
            array(
                'title' => __('Gutenberg Integration', 'chesta-slider'),
                'description' => __('Native Gutenberg blocks for seamless WordPress editing experience.', 'chesta-slider'),
                'icon' => 'dashicons-editor-table',
            ),
            array(
                'title' => __('Fully Responsive', 'chesta-slider'),
                'description' => __('Perfect display on all devices with mobile-first responsive design.', 'chesta-slider'),
                'icon' => 'dashicons-smartphone',
            ),
            array(
                'title' => __('Performance Optimized', 'chesta-slider'),
                'description' => __('Lightweight code, lazy loading, and optimized assets for fast loading.', 'chesta-slider'),
                'icon' => 'dashicons-performance',
            ),
            array(
                'title' => __('Accessibility Ready', 'chesta-slider'),
                'description' => __('WCAG compliant with keyboard navigation and screen reader support.', 'chesta-slider'),
                'icon' => 'dashicons-universal-access-alt',
            ),
            array(
                'title' => __('Easy Customization', 'chesta-slider'),
                'description' => __('50+ customization options with live preview and intuitive controls.', 'chesta-slider'),
                'icon' => 'dashicons-admin-appearance',
            ),
        );
    }
}
