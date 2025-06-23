<?php
/**
 * Elementor integration for Chesta Slider.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/elementor
 */

/**
 * Elementor integration class.
 *
 * Handles all Elementor-specific functionality including widget registration
 * and custom controls.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/elementor
 */
class Chesta_Slider_Elementor {

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

        // Check if Elementor is installed and activated
        add_action('plugins_loaded', array($this, 'init'));
    }

    /**
     * Initialize Elementor integration.
     */
    public function init() {
        // Check if Elementor is installed and activated
        if (!did_action('elementor/loaded')) {
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, '3.0.0', '>=')) {
            add_action('admin_notices', array($this, 'admin_notice_minimum_elementor_version'));
            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, '7.4', '<')) {
            add_action('admin_notices', array($this, 'admin_notice_minimum_php_version'));
            return;
        }

        // Add plugin actions
        add_action('elementor/init', array($this, 'elementor_init'));
    }

    /**
     * Initialize Elementor functionality.
     */
    public function elementor_init() {
        // Add custom widget category
        add_action('elementor/elements/categories_registered', array($this, 'add_elementor_widget_categories'));

        // Register widgets
        add_action('elementor/widgets/widgets_registered', array($this, 'register_widgets'));

        // Register controls
        add_action('elementor/controls/controls_registered', array($this, 'register_controls'));

        // Enqueue scripts and styles
        add_action('elementor/frontend/after_enqueue_styles', array($this, 'enqueue_frontend_styles'));
        add_action('elementor/frontend/after_enqueue_scripts', array($this, 'enqueue_frontend_scripts'));
        add_action('elementor/editor/after_enqueue_scripts', array($this, 'enqueue_editor_scripts'));
    }

    /**
     * Add custom widget category.
     *
     * @param \Elementor\Elements_Manager $elements_manager Elementor elements manager.
     */
    public function add_elementor_widget_categories($elements_manager) {
        $elements_manager->add_category(
            'chesta-slider',
            array(
                'title' => __('Chesta Slider', 'chesta-slider'),
                'icon' => 'fa fa-plug',
            )
        );
    }

    /**
     * Register widgets.
     *
     * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
     */
    public function register_widgets($widgets_manager) {
        // Include widget files
        require_once CHESTA_SLIDER_PLUGIN_DIR . 'includes/elementor/widgets/class-chesta-slider-widget.php';
        require_once CHESTA_SLIDER_PLUGIN_DIR . 'includes/elementor/widgets/class-chesta-hero-slider-widget.php';
        require_once CHESTA_SLIDER_PLUGIN_DIR . 'includes/elementor/widgets/class-chesta-testimonial-slider-widget.php';
        require_once CHESTA_SLIDER_PLUGIN_DIR . 'includes/elementor/widgets/class-chesta-logo-carousel-widget.php';
        require_once CHESTA_SLIDER_PLUGIN_DIR . 'includes/elementor/widgets/class-chesta-product-slider-widget.php';

        // Register widgets
        $widgets_manager->register_widget_type(new \Chesta_Slider_Widget());
        $widgets_manager->register_widget_type(new \Chesta_Hero_Slider_Widget());
        $widgets_manager->register_widget_type(new \Chesta_Testimonial_Slider_Widget());
        $widgets_manager->register_widget_type(new \Chesta_Logo_Carousel_Widget());
        $widgets_manager->register_widget_type(new \Chesta_Product_Slider_Widget());
    }

    /**
     * Register custom controls.
     *
     * @param \Elementor\Controls_Manager $controls_manager Elementor controls manager.
     */
    public function register_controls($controls_manager) {
        // Include custom control files
        require_once CHESTA_SLIDER_PLUGIN_DIR . 'includes/elementor/controls/class-chesta-slider-control.php';

        // Register custom controls
        $controls_manager->register_control('chesta-slider-control', new \Chesta_Slider_Control());
    }

    /**
     * Enqueue frontend styles.
     */
    public function enqueue_frontend_styles() {
        wp_enqueue_style(
            'chesta-slider-elementor',
            CHESTA_SLIDER_ASSETS_URL . 'css/chesta-slider-elementor.css',
            array(),
            $this->version
        );
    }

    /**
     * Enqueue frontend scripts.
     */
    public function enqueue_frontend_scripts() {
        wp_enqueue_script(
            'chesta-slider-elementor',
            CHESTA_SLIDER_ASSETS_URL . 'js/chesta-slider-elementor.js',
            array('chesta-slider-core'),
            $this->version,
            true
        );
    }

    /**
     * Enqueue editor scripts.
     */
    public function enqueue_editor_scripts() {
        wp_enqueue_script(
            'chesta-slider-elementor-editor',
            CHESTA_SLIDER_ASSETS_URL . 'js/chesta-slider-elementor-editor.js',
            array('elementor-editor'),
            $this->version,
            true
        );
    }

    /**
     * Admin notice for minimum Elementor version.
     */
    public function admin_notice_minimum_elementor_version() {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'chesta-slider'),
            '<strong>' . esc_html__('Chesta Slider', 'chesta-slider') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'chesta-slider') . '</strong>',
            '3.0.0'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice for minimum PHP version.
     */
    public function admin_notice_minimum_php_version() {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'chesta-slider'),
            '<strong>' . esc_html__('Chesta Slider', 'chesta-slider') . '</strong>',
            '<strong>' . esc_html__('PHP', 'chesta-slider') . '</strong>',
            '7.4'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Get slider types for Elementor.
     *
     * @return array Slider types.
     */
    public static function get_slider_types() {
        return array(
            'carousel' => __('Carousel', 'chesta-slider'),
            'fade' => __('Fade', 'chesta-slider'),
            'hero' => __('Hero Slider', 'chesta-slider'),
            'vertical' => __('Vertical', 'chesta-slider'),
            'thumbnail' => __('Thumbnail Navigation', 'chesta-slider'),
            'testimonial' => __('Testimonial', 'chesta-slider'),
            'logo' => __('Logo Carousel', 'chesta-slider'),
            'product' => __('Product Slider', 'chesta-slider'),
            'video' => __('Video Slider', 'chesta-slider'),
            'parallax' => __('Parallax', 'chesta-slider'),
            'multirow' => __('Multi-row', 'chesta-slider'),
            'center' => __('Center Mode', 'chesta-slider'),
        );
    }

    /**
     * Get animation types for Elementor.
     *
     * @return array Animation types.
     */
    public static function get_animation_types() {
        return array(
            'slide' => __('Slide', 'chesta-slider'),
            'fade' => __('Fade', 'chesta-slider'),
            'cube' => __('Cube', 'chesta-slider'),
            'flip' => __('Flip', 'chesta-slider'),
            'coverflow' => __('Coverflow', 'chesta-slider'),
            'cards' => __('Cards', 'chesta-slider'),
        );
    }

    /**
     * Get common slider controls for Elementor widgets.
     *
     * @return array Common controls.
     */
    public static function get_common_slider_controls() {
        return array(
            'slider_type' => array(
                'label' => __('Slider Type', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'carousel',
                'options' => self::get_slider_types(),
            ),
            'slides_to_show' => array(
                'label' => __('Slides to Show', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 1,
            ),
            'slides_to_scroll' => array(
                'label' => __('Slides to Scroll', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 1,
            ),
            'autoplay' => array(
                'label' => __('Autoplay', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'chesta-slider'),
                'label_off' => __('No', 'chesta-slider'),
                'return_value' => 'yes',
                'default' => '',
            ),
            'autoplay_speed' => array(
                'label' => __('Autoplay Speed (ms)', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1000,
                'max' => 10000,
                'step' => 500,
                'default' => 3000,
                'condition' => array(
                    'autoplay' => 'yes',
                ),
            ),
            'speed' => array(
                'label' => __('Animation Speed (ms)', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 2000,
                'step' => 100,
                'default' => 500,
            ),
            'infinite' => array(
                'label' => __('Infinite Loop', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'chesta-slider'),
                'label_off' => __('No', 'chesta-slider'),
                'return_value' => 'yes',
                'default' => 'yes',
            ),
            'arrows' => array(
                'label' => __('Show Arrows', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'chesta-slider'),
                'label_off' => __('No', 'chesta-slider'),
                'return_value' => 'yes',
                'default' => 'yes',
            ),
            'dots' => array(
                'label' => __('Show Dots', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'chesta-slider'),
                'label_off' => __('No', 'chesta-slider'),
                'return_value' => 'yes',
                'default' => 'yes',
            ),
            'pause_on_hover' => array(
                'label' => __('Pause on Hover', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'chesta-slider'),
                'label_off' => __('No', 'chesta-slider'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'autoplay' => 'yes',
                ),
            ),
            'center_mode' => array(
                'label' => __('Center Mode', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'chesta-slider'),
                'label_off' => __('No', 'chesta-slider'),
                'return_value' => 'yes',
                'default' => '',
            ),
            'lazy_load' => array(
                'label' => __('Lazy Loading', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'chesta-slider'),
                'label_off' => __('No', 'chesta-slider'),
                'return_value' => 'yes',
                'default' => 'yes',
            ),
        );
    }

    /**
     * Get responsive controls for Elementor widgets.
     *
     * @return array Responsive controls.
     */
    public static function get_responsive_controls() {
        return array(
            'slides_to_show_tablet' => array(
                'label' => __('Slides to Show (Tablet)', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 2,
            ),
            'slides_to_show_mobile' => array(
                'label' => __('Slides to Show (Mobile)', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 1,
            ),
            'arrows_tablet' => array(
                'label' => __('Show Arrows (Tablet)', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'chesta-slider'),
                'label_off' => __('No', 'chesta-slider'),
                'return_value' => 'yes',
                'default' => 'yes',
            ),
            'arrows_mobile' => array(
                'label' => __('Show Arrows (Mobile)', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'chesta-slider'),
                'label_off' => __('No', 'chesta-slider'),
                'return_value' => 'yes',
                'default' => '',
            ),
            'dots_tablet' => array(
                'label' => __('Show Dots (Tablet)', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'chesta-slider'),
                'label_off' => __('No', 'chesta-slider'),
                'return_value' => 'yes',
                'default' => 'yes',
            ),
            'dots_mobile' => array(
                'label' => __('Show Dots (Mobile)', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'chesta-slider'),
                'label_off' => __('No', 'chesta-slider'),
                'return_value' => 'yes',
                'default' => 'yes',
            ),
        );
    }

    /**
     * Get style controls for Elementor widgets.
     *
     * @return array Style controls.
     */
    public static function get_style_controls() {
        return array(
            'arrow_color' => array(
                'label' => __('Arrow Color', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .chesta-arrow' => 'background-color: {{VALUE}};',
                ),
            ),
            'arrow_hover_color' => array(
                'label' => __('Arrow Hover Color', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .chesta-arrow:hover' => 'background-color: {{VALUE}};',
                ),
            ),
            'dot_color' => array(
                'label' => __('Dot Color', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .chesta-dots li button' => 'background-color: {{VALUE}};',
                ),
            ),
            'dot_active_color' => array(
                'label' => __('Active Dot Color', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .chesta-dots li.chesta-active button' => 'background-color: {{VALUE}};',
                ),
            ),
            'slider_height' => array(
                'label' => __('Slider Height', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'vh', '%'),
                'range' => array(
                    'px' => array(
                        'min' => 200,
                        'max' => 1000,
                    ),
                    'vh' => array(
                        'min' => 20,
                        'max' => 100,
                    ),
                    '%' => array(
                        'min' => 20,
                        'max' => 100,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .chesta-slider-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ),
            ),
        );
    }
}

