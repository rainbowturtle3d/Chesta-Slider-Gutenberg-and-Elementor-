<?php
/**
 * The file that defines the core plugin class
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes
 */
class Chesta_Slider {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @access protected
     * @var Chesta_Slider_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @access protected
     * @var string $plugin_name The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @access protected
     * @var string $version The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     */
    public function __construct() {
        if (defined('CHESTA_SLIDER_VERSION')) {
            $this->version = CHESTA_SLIDER_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'chesta-slider';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        $this->define_gutenberg_hooks();
        $this->define_elementor_hooks();
        
        // Initialize template system on init hook
        $this->loader->add_action('init', $this, 'init_template_system');
        $this->define_widget_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     */
    private function load_dependencies() {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once CHESTA_SLIDER_INCLUDES_DIR . 'class-chesta-slider-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once CHESTA_SLIDER_INCLUDES_DIR . 'class-chesta-slider-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once CHESTA_SLIDER_INCLUDES_DIR . 'admin/class-chesta-slider-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once CHESTA_SLIDER_INCLUDES_DIR . 'public/class-chesta-slider-public.php';

        /**
         * The class responsible for Gutenberg block functionality.
         */
        require_once CHESTA_SLIDER_INCLUDES_DIR . 'gutenberg/class-chesta-slider-gutenberg.php';

        /**
         * The class responsible for Elementor integration.
         */
        require_once CHESTA_SLIDER_INCLUDES_DIR . 'elementor/class-chesta-slider-elementor.php';

        /**
         * Security and performance classes.
         */
        require_once CHESTA_SLIDER_INCLUDES_DIR . 'class-chesta-slider-security.php';
        require_once CHESTA_SLIDER_INCLUDES_DIR . 'class-chesta-slider-performance.php';

        /**
         * Template manager and shortcode classes.
         * Only load these when needed to prevent activation issues.
         */
        if (did_action('init') || doing_action('init')) {
            require_once CHESTA_SLIDER_INCLUDES_DIR . 'class-chesta-slider-template-manager.php';
            require_once CHESTA_SLIDER_INCLUDES_DIR . 'class-chesta-slider-shortcode.php';
        }

        /**
         * Widget classes.
         */
        require_once CHESTA_SLIDER_INCLUDES_DIR . 'widgets/class-chesta-slider-widget.php';

        $this->loader = new Chesta_Slider_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     */
    private function set_locale() {
        $plugin_i18n = new Chesta_Slider_i18n();
        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Initialize template manager and shortcode system.
     */
    public function init_template_system() {
        // Load template manager and shortcode classes if not already loaded
        if (!class_exists('Chesta_Slider_Template_Manager')) {
            require_once CHESTA_SLIDER_INCLUDES_DIR . 'class-chesta-slider-template-manager.php';
        }
        if (!class_exists('Chesta_Slider_Shortcode')) {
            require_once CHESTA_SLIDER_INCLUDES_DIR . 'class-chesta-slider-shortcode.php';
        }
        
        // Initialize template manager with error handling
        global $chesta_slider_template_manager;
        try {
            $chesta_slider_template_manager = new Chesta_Slider_Template_Manager($this->plugin_name, $this->version);
            
            // Initialize shortcode system
            new Chesta_Slider_Shortcode($chesta_slider_template_manager);
        } catch (Exception $e) {
            // Log error but don't break plugin activation
            error_log('Chesta Slider: Error initializing template manager - ' . $e->getMessage());
        }
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     */
    private function define_admin_hooks() {
        $plugin_admin = new Chesta_Slider_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action('admin_menu', $plugin_admin, 'add_plugin_admin_menu');
        $this->loader->add_action('admin_init', $plugin_admin, 'options_update');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     */
    private function define_public_hooks() {
        $plugin_public = new Chesta_Slider_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
    }

    /**
     * Register all of the hooks related to Gutenberg functionality.
     */
    private function define_gutenberg_hooks() {
        $plugin_gutenberg = new Chesta_Slider_Gutenberg($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('init', $plugin_gutenberg, 'register_blocks');
        $this->loader->add_action('enqueue_block_editor_assets', $plugin_gutenberg, 'enqueue_block_editor_assets');
        $this->loader->add_action('enqueue_block_assets', $plugin_gutenberg, 'enqueue_block_assets');
    }

    /**
     * Register all of the hooks related to Elementor functionality.
     */
    private function define_elementor_hooks() {
        $plugin_elementor = new Chesta_Slider_Elementor($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('elementor/widgets/widgets_registered', $plugin_elementor, 'register_widgets');
        $this->loader->add_action('elementor/elements/categories_registered', $plugin_elementor, 'add_elementor_widget_categories');
    }

    /**
     * Register all of the hooks related to WordPress widgets.
     */
    private function define_widget_hooks() {
        $this->loader->add_action('widgets_init', $this, 'register_widgets');
    }

    /**
     * Register WordPress widgets.
     */
    public function register_widgets() {
        if (class_exists('Chesta_Slider_Widget')) {
            register_widget('Chesta_Slider_Widget');
        }
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }
}
