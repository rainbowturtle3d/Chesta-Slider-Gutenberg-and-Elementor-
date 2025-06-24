<?php
/**
 * Gutenberg Integration for Chesta Slider
 * Registers all 25+ slider types as Gutenberg blocks
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/gutenberg
 */

/**
 * Gutenberg Integration class.
 *
 * Handles registration and management of all Chesta Slider Gutenberg blocks.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/gutenberg
 */
class Chesta_Slider_Gutenberg {

    /**
     * The template manager instance.
     *
     * @access private
     * @var Chesta_Slider_Template_Manager $template_manager Template manager.
     */
    private $template_manager;

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
     */
    public function __construct($plugin_name, $version, $template_manager) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->template_manager = $template_manager;

        $this->init_hooks();
    }

    /**
     * Initialize WordPress hooks.
     */
    private function init_hooks() {
        add_action('init', array($this, 'register_blocks'));
        add_action('enqueue_block_editor_assets', array($this, 'enqueue_block_editor_assets'));
        add_action('enqueue_block_assets', array($this, 'enqueue_block_assets'));
        add_filter('block_categories_all', array($this, 'register_block_category'), 10, 2);
    }

    /**
     * Register the Chesta Sliders block categories.
     *
     * @param array $categories Existing block categories.
     * @param WP_Block_Editor_Context $editor_context Block editor context.
     * @return array Modified block categories.
     */
    public function register_block_category($categories, $editor_context) {
        $chesta_categories = array(
            array(
                'slug'  => 'chesta-sliders',
                'title' => __('🎨 Chesta Sliders', 'chesta-slider'),
                'icon'  => 'slides',
            ),
            array(
                'slug'  => 'chesta-image-sliders',
                'title' => __('🖼️ Image Sliders', 'chesta-slider'),
                'icon'  => 'format-gallery',
            ),
            array(
                'slug'  => 'chesta-content-sliders',
                'title' => __('📝 Content Sliders', 'chesta-slider'),
                'icon'  => 'admin-post',
            ),
            array(
                'slug'  => 'chesta-media-sliders',
                'title' => __('🎬 Media Sliders', 'chesta-slider'),
                'icon'  => 'video-alt3',
            ),
            array(
                'slug'  => 'chesta-layout-sliders',
                'title' => __('📐 Layout Sliders', 'chesta-slider'),
                'icon'  => 'grid-view',
            ),
            array(
                'slug'  => 'chesta-interactive-sliders',
                'title' => __('⚡ Interactive Sliders', 'chesta-slider'),
                'icon'  => 'admin-page',
            ),
            array(
                'slug'  => 'chesta-ecommerce-sliders',
                'title' => __('🛒 E-commerce Sliders', 'chesta-slider'),
                'icon'  => 'products',
            ),
        );
        
        return array_merge($chesta_categories, $categories);
    }

    /**
     * Register all slider blocks.
     */
    public function register_blocks() {
        // Check if Gutenberg is available
        if (!function_exists('register_block_type')) {
            return;
        }

        $templates = $this->template_manager->get_templates();

        foreach ($templates as $type => $template) {
            $this->register_single_block($type, $template);
        }
    }

    /**
     * Register a single slider block.
     *
     * @param string $type Slider type.
     * @param array $template Template configuration.
     */
    private function register_single_block($type, $template) {
        $block_name = "chesta-slider/{$type}";
        $category = $this->get_block_category($template['category']);
        
        register_block_type($block_name, array(
            'attributes' => $this->get_block_attributes($type),
            'render_callback' => array($this, 'render_block'),
            'editor_script' => 'chesta-slider-blocks',
            'editor_style' => 'chesta-slider-blocks-editor',
            'style' => 'chesta-slider-blocks-style',
            'category' => $category,
        ));
    }

    /**
     * Get the Gutenberg block category for a template category.
     *
     * @param string $template_category Template category.
     * @return string Block category slug.
     */
    private function get_block_category($template_category) {
        $category_map = array(
            'image' => 'chesta-image-sliders',
            'content' => 'chesta-content-sliders',
            'media' => 'chesta-media-sliders',
            'layout' => 'chesta-layout-sliders',
            'interactive' => 'chesta-interactive-sliders',
            'ecommerce' => 'chesta-ecommerce-sliders',
        );
        
        return isset($category_map[$template_category]) ? $category_map[$template_category] : 'chesta-sliders';
    }

    /**
     * Get block attributes for a slider type.
     *
     * @param string $type Slider type.
     * @return array Block attributes.
     */
    private function get_block_attributes($type) {
        $common_attributes = array(
            'sliderType' => array(
                'type' => 'string',
                'default' => $type,
            ),
            'sliderId' => array(
                'type' => 'string',
                'default' => '',
            ),
            'slides' => array(
                'type' => 'array',
                'default' => array(),
            ),
            
            // Display Settings
            'slidesToShow' => array(
                'type' => 'number',
                'default' => 1,
            ),
            'slidesToScroll' => array(
                'type' => 'number',
                'default' => 1,
            ),
            'height' => array(
                'type' => 'string',
                'default' => '400px',
            ),
            'heightTablet' => array(
                'type' => 'string',
                'default' => '350px',
            ),
            'heightMobile' => array(
                'type' => 'string',
                'default' => '300px',
            ),
            
            // Animation Settings
            'autoplay' => array(
                'type' => 'boolean',
                'default' => false,
            ),
            'autoplaySpeed' => array(
                'type' => 'number',
                'default' => 3000,
            ),
            'speed' => array(
                'type' => 'number',
                'default' => 500,
            ),
            'infinite' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'transitionMode' => array(
                'type' => 'string',
                'default' => 'slide',
            ),
            'easing' => array(
                'type' => 'string',
                'default' => 'ease',
            ),
            
            // Navigation Settings
            'arrows' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'arrowType' => array(
                'type' => 'string',
                'default' => 'default',
            ),
            'arrowSize' => array(
                'type' => 'number',
                'default' => 50,
            ),
            'arrowColor' => array(
                'type' => 'string',
                'default' => '#ffffff',
            ),
            'arrowBackground' => array(
                'type' => 'string',
                'default' => 'rgba(0,0,0,0.5)',
            ),
            'arrowPosition' => array(
                'type' => 'string',
                'default' => 'sides',
            ),
            
            // Indicators Settings
            'dots' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'dotsType' => array(
                'type' => 'string',
                'default' => 'dots',
            ),
            'dotsPosition' => array(
                'type' => 'string',
                'default' => 'bottom-center',
            ),
            'dotsColor' => array(
                'type' => 'string',
                'default' => '#cccccc',
            ),
            'dotsActiveColor' => array(
                'type' => 'string',
                'default' => '#007cba',
            ),
            'dotsSize' => array(
                'type' => 'number',
                'default' => 12,
            ),
            'dotsGap' => array(
                'type' => 'number',
                'default' => 8,
            ),
            
            // Layout Settings
            'margin' => array(
                'type' => 'object',
                'default' => array(
                    'top' => '0px',
                    'right' => '0px',
                    'bottom' => '20px',
                    'left' => '0px',
                ),
            ),
            'padding' => array(
                'type' => 'object',
                'default' => array(
                    'top' => '0px',
                    'right' => '0px',
                    'bottom' => '0px',
                    'left' => '0px',
                ),
            ),
            'innerGap' => array(
                'type' => 'number',
                'default' => 0,
            ),
            
            // Content Settings
            'contentPosition' => array(
                'type' => 'string',
                'default' => 'bottom-left',
            ),
            'titleAnimation' => array(
                'type' => 'string',
                'default' => 'fadeInUp',
            ),
            'titleDelay' => array(
                'type' => 'number',
                'default' => 200,
            ),
            'titleDuration' => array(
                'type' => 'number',
                'default' => 600,
            ),
            'descriptionAnimation' => array(
                'type' => 'string',
                'default' => 'fadeInUp',
            ),
            'descriptionDelay' => array(
                'type' => 'number',
                'default' => 400,
            ),
            'descriptionDuration' => array(
                'type' => 'number',
                'default' => 600,
            ),
            'buttonAnimation' => array(
                'type' => 'string',
                'default' => 'fadeInUp',
            ),
            'buttonDelay' => array(
                'type' => 'number',
                'default' => 600,
            ),
            'buttonDuration' => array(
                'type' => 'number',
                'default' => 600,
            ),
            
            // Interaction Settings
            'mouseWheel' => array(
                'type' => 'boolean',
                'default' => false,
            ),
            'mouseDrag' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'touchSwipe' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'keyboard' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'pauseOnHover' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'pauseOnFocus' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            
            // Advanced Settings
            'centerMode' => array(
                'type' => 'boolean',
                'default' => false,
            ),
            'centerPadding' => array(
                'type' => 'number',
                'default' => 60,
            ),
            'variableWidth' => array(
                'type' => 'boolean',
                'default' => false,
            ),
            'lazyLoad' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'preloadImages' => array(
                'type' => 'number',
                'default' => 1,
            ),
            'accessibility' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'rtl' => array(
                'type' => 'boolean',
                'default' => false,
            ),
            
            // Custom Styling
            'customCSS' => array(
                'type' => 'string',
                'default' => '',
            ),
            'customJS' => array(
                'type' => 'string',
                'default' => '',
            ),
        );

        // Add type-specific attributes
        $type_specific = $this->get_type_specific_attributes($type);
        
        return array_merge($common_attributes, $type_specific);
    }

    /**
     * Get type-specific attributes for different slider types.
     *
     * @param string $type Slider type.
     * @return array Type-specific attributes.
     */
    private function get_type_specific_attributes($type) {
        $attributes = array();

        switch ($type) {
            case 'hero':
                $attributes['fullWidth'] = array(
                    'type' => 'boolean',
                    'default' => true,
                );
                $attributes['overlayOpacity'] = array(
                    'type' => 'number',
                    'default' => 0.5,
                );
                break;

            case 'testimonial':
                $attributes['showAuthorImage'] = array(
                    'type' => 'boolean',
                    'default' => true,
                );
                $attributes['showRating'] = array(
                    'type' => 'boolean',
                    'default' => true,
                );
                break;

            case 'product':
                $attributes['showPrice'] = array(
                    'type' => 'boolean',
                    'default' => true,
                );
                $attributes['showAddToCart'] = array(
                    'type' => 'boolean',
                    'default' => true,
                );
                break;

            case 'video':
                $attributes['videoProvider'] = array(
                    'type' => 'string',
                    'default' => 'youtube',
                );
                $attributes['autoplayVideo'] = array(
                    'type' => 'boolean',
                    'default' => false,
                );
                break;

            case 'post':
                $attributes['postType'] = array(
                    'type' => 'string',
                    'default' => 'post',
                );
                $attributes['postsPerSlide'] = array(
                    'type' => 'number',
                    'default' => 1,
                );
                $attributes['showExcerpt'] = array(
                    'type' => 'boolean',
                    'default' => true,
                );
                $attributes['showMeta'] = array(
                    'type' => 'boolean',
                    'default' => true,
                );
                break;

            case 'countdown':
                $attributes['targetDate'] = array(
                    'type' => 'string',
                    'default' => '',
                );
                $attributes['countdownFormat'] = array(
                    'type' => 'string',
                    'default' => 'days-hours-minutes-seconds',
                );
                break;

            case 'comparison':
                $attributes['comparisonMode'] = array(
                    'type' => 'string',
                    'default' => 'slider',
                );
                break;

            case 'timeline':
                $attributes['timelineOrientation'] = array(
                    'type' => 'string',
                    'default' => 'horizontal',
                );
                break;
        }

        return $attributes;
    }

    /**
     * Render block callback.
     *
     * @param array $attributes Block attributes.
     * @param string $content Block content.
     * @return string Rendered block HTML.
     */
    public function render_block($attributes, $content = '') {
        // Generate unique slider ID
        $slider_id = !empty($attributes['sliderId']) ? $attributes['sliderId'] : 'chesta-slider-' . wp_rand();
        
        // Prepare template arguments
        $template_args = array(
            'slider_id' => $slider_id,
            'slides' => isset($attributes['slides']) ? $attributes['slides'] : array(),
            'settings' => $this->convert_attributes_to_settings($attributes),
        );

        // Add custom CSS if provided
        if (!empty($attributes['customCSS'])) {
            $this->add_inline_css($slider_id, $attributes['customCSS']);
        }

        // Add custom JS if provided
        if (!empty($attributes['customJS'])) {
            $this->add_inline_js($slider_id, $attributes['customJS']);
        }

        // Render the slider using template manager
        return $this->template_manager->render_template($attributes['sliderType'], $template_args);
    }

    /**
     * Convert block attributes to slider settings.
     *
     * @param array $attributes Block attributes.
     * @return array Slider settings.
     */
    private function convert_attributes_to_settings($attributes) {
        return array(
            'slidesToShow' => $attributes['slidesToShow'],
            'slidesToScroll' => $attributes['slidesToScroll'],
            'autoplay' => $attributes['autoplay'],
            'autoplaySpeed' => $attributes['autoplaySpeed'],
            'speed' => $attributes['speed'],
            'infinite' => $attributes['infinite'],
            'arrows' => $attributes['arrows'],
            'arrowType' => $attributes['arrowType'],
            'arrowSize' => $attributes['arrowSize'],
            'arrowColor' => $attributes['arrowColor'],
            'arrowBackground' => $attributes['arrowBackground'],
            'arrowPosition' => $attributes['arrowPosition'],
            'dots' => $attributes['dots'],
            'dotsType' => $attributes['dotsType'],
            'dotsPosition' => $attributes['dotsPosition'],
            'dotsColor' => $attributes['dotsColor'],
            'dotsActiveColor' => $attributes['dotsActiveColor'],
            'dotsSize' => $attributes['dotsSize'],
            'dotsGap' => $attributes['dotsGap'],
            'transitionMode' => $attributes['transitionMode'],
            'easing' => $attributes['easing'],
            'height' => array(
                'desktop' => $attributes['height'],
                'tablet' => $attributes['heightTablet'],
                'mobile' => $attributes['heightMobile'],
            ),
            'margin' => $attributes['margin'],
            'padding' => $attributes['padding'],
            'innerGap' => $attributes['innerGap'],
            'contentPosition' => $attributes['contentPosition'],
            'titleAnimation' => $attributes['titleAnimation'],
            'titleDelay' => $attributes['titleDelay'],
            'titleDuration' => $attributes['titleDuration'],
            'descriptionAnimation' => $attributes['descriptionAnimation'],
            'descriptionDelay' => $attributes['descriptionDelay'],
            'descriptionDuration' => $attributes['descriptionDuration'],
            'buttonAnimation' => $attributes['buttonAnimation'],
            'buttonDelay' => $attributes['buttonDelay'],
            'buttonDuration' => $attributes['buttonDuration'],
            'mouseWheel' => $attributes['mouseWheel'],
            'mouseDrag' => $attributes['mouseDrag'],
            'touchSwipe' => $attributes['touchSwipe'],
            'keyboard' => $attributes['keyboard'],
            'pauseOnHover' => $attributes['pauseOnHover'],
            'pauseOnFocus' => $attributes['pauseOnFocus'],
            'centerMode' => $attributes['centerMode'],
            'centerPadding' => $attributes['centerPadding'],
            'variableWidth' => $attributes['variableWidth'],
            'lazyLoad' => $attributes['lazyLoad'],
            'preloadImages' => $attributes['preloadImages'],
            'accessibility' => $attributes['accessibility'],
            'rtl' => $attributes['rtl'],
        );
    }

    /**
     * Enqueue block editor assets.
     */
    public function enqueue_block_editor_assets() {
        wp_enqueue_script(
            'chesta-slider-blocks',
            CHESTA_SLIDER_PLUGIN_URL . 'assets/js/gutenberg/blocks.js',
            array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor'),
            $this->version,
            true
        );

        wp_enqueue_style(
            'chesta-slider-blocks-editor',
            CHESTA_SLIDER_PLUGIN_URL . 'assets/css/gutenberg/blocks-editor.css',
            array('wp-edit-blocks'),
            $this->version
        );

        // Localize script with template data
        wp_localize_script('chesta-slider-blocks', 'chestaSliderBlocks', array(
            'templates' => $this->template_manager->get_templates(),
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('chesta_slider_nonce'),
        ));
    }

    /**
     * Enqueue block assets (both editor and frontend).
     */
    public function enqueue_block_assets() {
        wp_enqueue_style(
            'chesta-slider-blocks-style',
            CHESTA_SLIDER_PLUGIN_URL . 'assets/css/gutenberg/blocks.css',
            array(),
            $this->version
        );
    }

    /**
     * Add inline CSS for slider.
     *
     * @param string $slider_id Slider ID.
     * @param string $css Custom CSS.
     */
    private function add_inline_css($slider_id, $css) {
        $css = "#{$slider_id} { {$css} }";
        wp_add_inline_style('chesta-slider-blocks-style', $css);
    }

    /**
     * Add inline JavaScript for slider.
     *
     * @param string $slider_id Slider ID.
     * @param string $js Custom JavaScript.
     */
    private function add_inline_js($slider_id, $js) {
        $js = "
        document.addEventListener('DOMContentLoaded', function() {
            var slider = document.getElementById('{$slider_id}');
            if (slider) {
                {$js}
            }
        });
        ";
        wp_add_inline_script('chesta-slider-blocks-style', $js);
    }
}
