<?php
/**
 * The Gutenberg-specific functionality of the plugin.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/gutenberg
 */

/**
 * The Gutenberg-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks for Gutenberg blocks.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/gutenberg
 */
class Chesta_Slider_Gutenberg {

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
     * Register Gutenberg blocks.
     */
    public function register_blocks() {
        // Check if Gutenberg is active
        if (!function_exists('register_block_type')) {
            return;
        }

        // Register main slider block
        register_block_type(
            CHESTA_SLIDER_PLUGIN_DIR . 'blocks/chesta-slider-block/block.json',
            array(
                'render_callback' => array($this, 'render_slider_block'),
            )
        );

        // Register slide block (for inner blocks)
        register_block_type(
            CHESTA_SLIDER_PLUGIN_DIR . 'blocks/chesta-slide-block/block.json',
            array(
                'render_callback' => array($this, 'render_slide_block'),
            )
        );

        // Register block category
        add_filter('block_categories_all', array($this, 'add_block_category'), 10, 2);
    }

    /**
     * Add custom block category.
     *
     * @param array $categories Existing block categories.
     * @param WP_Post $post Current post object.
     * @return array Modified block categories.
     */
    public function add_block_category($categories, $post) {
        return array_merge(
            $categories,
            array(
                array(
                    'slug' => 'chesta-slider',
                    'title' => __('Chesta Slider', 'chesta-slider'),
                    'icon' => 'slides',
                ),
            )
        );
    }

    /**
     * Render the slider block.
     *
     * @param array $attributes Block attributes.
     * @param string $content Block content.
     * @return string Rendered block HTML.
     */
    public function render_slider_block($attributes, $content) {
        $default_attributes = array(
            'sliderType' => 'carousel',
            'slidesToShow' => 1,
            'slidesToScroll' => 1,
            'autoplay' => false,
            'autoplaySpeed' => 3000,
            'speed' => 500,
            'infinite' => true,
            'arrows' => true,
            'dots' => true,
            'fade' => false,
            'vertical' => false,
            'centerMode' => false,
            'variableWidth' => false,
            'lazyLoad' => true,
            'pauseOnHover' => true,
            'pauseOnFocus' => true,
            'accessibility' => true,
            'swipe' => true,
            'draggable' => true,
            'rtl' => false,
            'responsive' => array(),
            'customCSS' => '',
            'sliderHeight' => '',
            'sliderWidth' => '',
            'backgroundColor' => '',
            'textColor' => '',
            'arrowColor' => '',
            'dotColor' => '',
            'borderRadius' => '',
            'boxShadow' => '',
            'margin' => '',
            'padding' => '',
            'className' => '',
            'align' => '',
        );

        $attributes = wp_parse_args($attributes, $default_attributes);

        // Generate unique ID for this slider
        $slider_id = 'chesta-slider-' . wp_generate_uuid4();

        // Prepare slider options
        $slider_options = array(
            'type' => $attributes['sliderType'],
            'slidesToShow' => intval($attributes['slidesToShow']),
            'slidesToScroll' => intval($attributes['slidesToScroll']),
            'autoplay' => $attributes['autoplay'],
            'autoplaySpeed' => intval($attributes['autoplaySpeed']),
            'speed' => intval($attributes['speed']),
            'infinite' => $attributes['infinite'],
            'arrows' => $attributes['arrows'],
            'dots' => $attributes['dots'],
            'fade' => $attributes['fade'],
            'vertical' => $attributes['vertical'],
            'centerMode' => $attributes['centerMode'],
            'variableWidth' => $attributes['variableWidth'],
            'lazyLoad' => $attributes['lazyLoad'],
            'pauseOnHover' => $attributes['pauseOnHover'],
            'pauseOnFocus' => $attributes['pauseOnFocus'],
            'accessibility' => $attributes['accessibility'],
            'swipe' => $attributes['swipe'],
            'draggable' => $attributes['draggable'],
            'rtl' => $attributes['rtl'],
            'responsive' => $attributes['responsive'],
        );

        // Build CSS classes
        $css_classes = array('chesta-slider-wrapper');
        
        if (!empty($attributes['className'])) {
            $css_classes[] = $attributes['className'];
        }
        
        if (!empty($attributes['align'])) {
            $css_classes[] = 'align' . $attributes['align'];
        }

        $css_classes[] = 'chesta-' . $attributes['sliderType'];

        // Build inline styles
        $inline_styles = array();
        
        if (!empty($attributes['sliderHeight'])) {
            $inline_styles[] = 'height: ' . $attributes['sliderHeight'];
        }
        
        if (!empty($attributes['sliderWidth'])) {
            $inline_styles[] = 'width: ' . $attributes['sliderWidth'];
        }
        
        if (!empty($attributes['backgroundColor'])) {
            $inline_styles[] = 'background-color: ' . $attributes['backgroundColor'];
        }
        
        if (!empty($attributes['textColor'])) {
            $inline_styles[] = 'color: ' . $attributes['textColor'];
        }
        
        if (!empty($attributes['borderRadius'])) {
            $inline_styles[] = 'border-radius: ' . $attributes['borderRadius'];
        }
        
        if (!empty($attributes['boxShadow'])) {
            $inline_styles[] = 'box-shadow: ' . $attributes['boxShadow'];
        }
        
        if (!empty($attributes['margin'])) {
            $inline_styles[] = 'margin: ' . $attributes['margin'];
        }
        
        if (!empty($attributes['padding'])) {
            $inline_styles[] = 'padding: ' . $attributes['padding'];
        }

        // Generate custom CSS for arrows and dots
        $custom_css = '';
        if (!empty($attributes['arrowColor'])) {
            $custom_css .= "#{$slider_id} .chesta-arrow { background-color: {$attributes['arrowColor']}; }";
        }
        
        if (!empty($attributes['dotColor'])) {
            $custom_css .= "#{$slider_id} .chesta-dots li button { background-color: {$attributes['dotColor']}; }";
        }
        
        if (!empty($attributes['customCSS'])) {
            $custom_css .= $attributes['customCSS'];
        }

        // Start output buffering
        ob_start();
        ?>
        
        <div 
            id="<?php echo esc_attr($slider_id); ?>" 
            class="<?php echo esc_attr(implode(' ', $css_classes)); ?>"
            <?php if (!empty($inline_styles)): ?>
                style="<?php echo esc_attr(implode('; ', $inline_styles)); ?>"
            <?php endif; ?>
            data-chesta-slider
            data-chesta-options="<?php echo esc_attr(wp_json_encode($slider_options)); ?>"
        >
            <?php echo $content; ?>
        </div>

        <?php if (!empty($custom_css)): ?>
            <style>
                <?php echo wp_strip_all_tags($custom_css); ?>
            </style>
        <?php endif; ?>

        <?php
        return ob_get_clean();
    }

    /**
     * Render the slide block.
     *
     * @param array $attributes Block attributes.
     * @param string $content Block content.
     * @return string Rendered block HTML.
     */
    public function render_slide_block($attributes, $content) {
        $default_attributes = array(
            'slideType' => 'content',
            'backgroundImage' => '',
            'backgroundPosition' => 'center center',
            'backgroundSize' => 'cover',
            'backgroundColor' => '',
            'textColor' => '',
            'overlayColor' => '',
            'overlayOpacity' => 0.5,
            'verticalAlignment' => 'center',
            'horizontalAlignment' => 'center',
            'padding' => '',
            'margin' => '',
            'minHeight' => '',
            'className' => '',
        );

        $attributes = wp_parse_args($attributes, $default_attributes);

        // Build CSS classes
        $css_classes = array('chesta-slide');
        
        if (!empty($attributes['className'])) {
            $css_classes[] = $attributes['className'];
        }

        $css_classes[] = 'chesta-slide-' . $attributes['slideType'];
        $css_classes[] = 'chesta-align-' . $attributes['verticalAlignment'];
        $css_classes[] = 'chesta-justify-' . $attributes['horizontalAlignment'];

        // Build inline styles
        $inline_styles = array();
        
        if (!empty($attributes['backgroundImage'])) {
            $inline_styles[] = 'background-image: url(' . esc_url($attributes['backgroundImage']) . ')';
            $inline_styles[] = 'background-position: ' . $attributes['backgroundPosition'];
            $inline_styles[] = 'background-size: ' . $attributes['backgroundSize'];
            $inline_styles[] = 'background-repeat: no-repeat';
        }
        
        if (!empty($attributes['backgroundColor'])) {
            $inline_styles[] = 'background-color: ' . $attributes['backgroundColor'];
        }
        
        if (!empty($attributes['textColor'])) {
            $inline_styles[] = 'color: ' . $attributes['textColor'];
        }
        
        if (!empty($attributes['padding'])) {
            $inline_styles[] = 'padding: ' . $attributes['padding'];
        }
        
        if (!empty($attributes['margin'])) {
            $inline_styles[] = 'margin: ' . $attributes['margin'];
        }
        
        if (!empty($attributes['minHeight'])) {
            $inline_styles[] = 'min-height: ' . $attributes['minHeight'];
        }

        // Start output buffering
        ob_start();
        ?>
        
        <div 
            class="<?php echo esc_attr(implode(' ', $css_classes)); ?>"
            <?php if (!empty($inline_styles)): ?>
                style="<?php echo esc_attr(implode('; ', $inline_styles)); ?>"
            <?php endif; ?>
        >
            <?php if (!empty($attributes['backgroundImage']) && !empty($attributes['overlayColor'])): ?>
                <div 
                    class="chesta-slide-overlay" 
                    style="background-color: <?php echo esc_attr($attributes['overlayColor']); ?>; opacity: <?php echo esc_attr($attributes['overlayOpacity']); ?>;"
                ></div>
            <?php endif; ?>
            
            <div class="chesta-slide-content">
                <?php echo $content; ?>
            </div>
        </div>

        <?php
        return ob_get_clean();
    }

    /**
     * Enqueue block editor assets.
     */
    public function enqueue_block_editor_assets() {
        // Enqueue block editor script
        wp_enqueue_script(
            'chesta-slider-block-editor',
            CHESTA_SLIDER_ASSETS_URL . 'js/blocks.js',
            array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-block-editor'),
            $this->version,
            true
        );

        // Enqueue block editor styles
        wp_enqueue_style(
            'chesta-slider-block-editor',
            CHESTA_SLIDER_ASSETS_URL . 'css/blocks-editor.css',
            array('wp-edit-blocks'),
            $this->version
        );

        // Localize script with data
        wp_localize_script(
            'chesta-slider-block-editor',
            'chestaSliderData',
            array(
                'pluginUrl' => CHESTA_SLIDER_PLUGIN_URL,
                'assetsUrl' => CHESTA_SLIDER_ASSETS_URL,
                'sliderTypes' => $this->get_slider_types(),
                'slideTypes' => $this->get_slide_types(),
                'nonce' => wp_create_nonce('chesta_slider_nonce'),
                'ajaxUrl' => admin_url('admin-ajax.php'),
            )
        );
    }

    /**
     * Enqueue block assets (frontend and editor).
     */
    public function enqueue_block_assets() {
        // Enqueue frontend styles
        wp_enqueue_style(
            'chesta-slider-blocks',
            CHESTA_SLIDER_ASSETS_URL . 'css/chesta-slider.css',
            array(),
            $this->version
        );

        // Enqueue frontend script
        wp_enqueue_script(
            'chesta-slider-core',
            CHESTA_SLIDER_ASSETS_URL . 'js/chesta-slider-core.js',
            array(),
            $this->version,
            true
        );
    }

    /**
     * Get available slider types.
     *
     * @return array Slider types.
     */
    private function get_slider_types() {
        return array(
            array(
                'value' => 'carousel',
                'label' => __('Carousel', 'chesta-slider'),
                'description' => __('Classic horizontal carousel slider', 'chesta-slider'),
            ),
            array(
                'value' => 'fade',
                'label' => __('Fade', 'chesta-slider'),
                'description' => __('Slides fade in and out', 'chesta-slider'),
            ),
            array(
                'value' => 'hero',
                'label' => __('Hero Slider', 'chesta-slider'),
                'description' => __('Full-width hero banner slider', 'chesta-slider'),
            ),
            array(
                'value' => 'vertical',
                'label' => __('Vertical', 'chesta-slider'),
                'description' => __('Vertical sliding direction', 'chesta-slider'),
            ),
            array(
                'value' => 'thumbnail',
                'label' => __('Thumbnail Navigation', 'chesta-slider'),
                'description' => __('Slider with thumbnail navigation', 'chesta-slider'),
            ),
            array(
                'value' => 'testimonial',
                'label' => __('Testimonial', 'chesta-slider'),
                'description' => __('Testimonial carousel with author info', 'chesta-slider'),
            ),
            array(
                'value' => 'logo',
                'label' => __('Logo Carousel', 'chesta-slider'),
                'description' => __('Logo/client carousel', 'chesta-slider'),
            ),
            array(
                'value' => 'product',
                'label' => __('Product Slider', 'chesta-slider'),
                'description' => __('Product showcase slider', 'chesta-slider'),
            ),
            array(
                'value' => 'video',
                'label' => __('Video Slider', 'chesta-slider'),
                'description' => __('Video content slider', 'chesta-slider'),
            ),
            array(
                'value' => 'parallax',
                'label' => __('Parallax', 'chesta-slider'),
                'description' => __('Parallax background effect', 'chesta-slider'),
            ),
            array(
                'value' => 'multirow',
                'label' => __('Multi-row', 'chesta-slider'),
                'description' => __('Multiple rows of slides', 'chesta-slider'),
            ),
            array(
                'value' => 'center',
                'label' => __('Center Mode', 'chesta-slider'),
                'description' => __('Center active slide with partial view of others', 'chesta-slider'),
            ),
        );
    }

    /**
     * Get available slide types.
     *
     * @return array Slide types.
     */
    private function get_slide_types() {
        return array(
            array(
                'value' => 'content',
                'label' => __('Content', 'chesta-slider'),
                'description' => __('Any content blocks', 'chesta-slider'),
            ),
            array(
                'value' => 'image',
                'label' => __('Image', 'chesta-slider'),
                'description' => __('Image slide', 'chesta-slider'),
            ),
            array(
                'value' => 'video',
                'label' => __('Video', 'chesta-slider'),
                'description' => __('Video slide', 'chesta-slider'),
            ),
            array(
                'value' => 'post',
                'label' => __('Post', 'chesta-slider'),
                'description' => __('Post content slide', 'chesta-slider'),
            ),
            array(
                'value' => 'testimonial',
                'label' => __('Testimonial', 'chesta-slider'),
                'description' => __('Testimonial slide', 'chesta-slider'),
            ),
            array(
                'value' => 'cta',
                'label' => __('Call to Action', 'chesta-slider'),
                'description' => __('CTA slide with button', 'chesta-slider'),
            ),
        );
    }
}

