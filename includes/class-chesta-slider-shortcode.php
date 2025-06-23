<?php
/**
 * Shortcode Handler for Chesta Slider
 * Handles all shortcode functionality for 25+ slider types
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes
 */

/**
 * Shortcode Handler class.
 *
 * Manages all slider shortcodes and their rendering.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes
 */
class Chesta_Slider_Shortcode {

    /**
     * The template manager instance.
     *
     * @access private
     * @var Chesta_Slider_Template_Manager $template_manager Template manager.
     */
    private $template_manager;

    /**
     * Initialize the class and set its properties.
     *
     * @param Chesta_Slider_Template_Manager $template_manager Template manager instance.
     */
    public function __construct($template_manager) {
        $this->template_manager = $template_manager;
        $this->register_shortcodes();
    }

    /**
     * Register all shortcodes.
     */
    private function register_shortcodes() {
        // Main slider shortcode
        add_shortcode('chesta_slider', array($this, 'render_slider_shortcode'));
        
        // Individual slider type shortcodes for convenience
        $templates = $this->template_manager->get_templates();
        foreach ($templates as $type => $template) {
            add_shortcode("chesta_{$type}", array($this, 'render_specific_slider_shortcode'));
        }
        
        // Legacy shortcode support
        add_shortcode('chesta-slider', array($this, 'render_slider_shortcode'));
    }

    /**
     * Render main slider shortcode.
     *
     * @param array $atts Shortcode attributes.
     * @param string $content Shortcode content.
     * @return string Rendered slider HTML.
     */
    public function render_slider_shortcode($atts, $content = '') {
        $default_atts = array(
            'id' => '',
            'type' => 'carousel',
            'slides_to_show' => 1,
            'slides_to_scroll' => 1,
            'autoplay' => 'false',
            'autoplay_speed' => 3000,
            'speed' => 500,
            'infinite' => 'true',
            'arrows' => 'true',
            'arrow_type' => 'default',
            'arrow_size' => 50,
            'arrow_color' => '#ffffff',
            'arrow_background' => 'rgba(0,0,0,0.5)',
            'arrow_position' => 'sides',
            'arrow_follow_mouse' => 'false',
            'dots' => 'true',
            'dots_type' => 'dots',
            'dots_position' => 'bottom-center',
            'dots_color' => '#cccccc',
            'dots_active_color' => '#007cba',
            'dots_size' => 12,
            'dots_gap' => 8,
            'transition_mode' => 'slide',
            'easing' => 'ease',
            'height' => '400px',
            'height_tablet' => '350px',
            'height_mobile' => '300px',
            'margin_top' => '0px',
            'margin_right' => '0px',
            'margin_bottom' => '20px',
            'margin_left' => '0px',
            'padding_top' => '0px',
            'padding_right' => '0px',
            'padding_bottom' => '0px',
            'padding_left' => '0px',
            'inner_gap' => 0,
            'content_position' => 'bottom-left',
            'title_animation' => 'fadeInUp',
            'title_delay' => 200,
            'title_duration' => 600,
            'description_animation' => 'fadeInUp',
            'description_delay' => 400,
            'description_duration' => 600,
            'button_animation' => 'fadeInUp',
            'button_delay' => 600,
            'button_duration' => 600,
            'mouse_wheel' => 'false',
            'mouse_drag' => 'true',
            'touch_swipe' => 'true',
            'keyboard' => 'true',
            'pause_on_hover' => 'true',
            'pause_on_focus' => 'true',
            'center_mode' => 'false',
            'center_padding' => 60,
            'variable_width' => 'false',
            'lazy_load' => 'true',
            'preload_images' => 1,
            'accessibility' => 'true',
            'rtl' => 'false',
            'custom_css' => '',
            'custom_js' => '',
            'slides' => '',
        );

        $atts = shortcode_atts($default_atts, $atts, 'chesta_slider');

        // Convert string booleans to actual booleans
        $boolean_fields = array(
            'autoplay', 'infinite', 'arrows', 'arrow_follow_mouse', 'dots', 
            'mouse_wheel', 'mouse_drag', 'touch_swipe', 'keyboard', 
            'pause_on_hover', 'pause_on_focus', 'center_mode', 'variable_width', 
            'lazy_load', 'accessibility', 'rtl'
        );

        foreach ($boolean_fields as $field) {
            $atts[$field] = filter_var($atts[$field], FILTER_VALIDATE_BOOLEAN);
        }

        // Convert numeric fields
        $numeric_fields = array(
            'slides_to_show', 'slides_to_scroll', 'autoplay_speed', 'speed',
            'arrow_size', 'dots_size', 'dots_gap', 'inner_gap', 'title_delay',
            'title_duration', 'description_delay', 'description_duration',
            'button_delay', 'button_duration', 'center_padding', 'preload_images'
        );

        foreach ($numeric_fields as $field) {
            $atts[$field] = intval($atts[$field]);
        }

        // Parse slides data
        $slides_data = $this->parse_slides_data($atts['slides'], $content);

        // Build configuration
        $config = $this->build_slider_config($atts);

        // Generate unique slider ID
        $slider_id = !empty($atts['id']) ? $atts['id'] : 'chesta-slider-' . wp_rand();

        // Prepare template arguments
        $template_args = array(
            'slider_id' => $slider_id,
            'slides' => $slides_data,
            'settings' => $config,
        );

        // Add custom CSS if provided
        if (!empty($atts['custom_css'])) {
            $this->add_inline_css($slider_id, $atts['custom_css']);
        }

        // Add custom JS if provided
        if (!empty($atts['custom_js'])) {
            $this->add_inline_js($slider_id, $atts['custom_js']);
        }

        // Render the slider
        return $this->template_manager->render_template($atts['type'], $template_args);
    }

    /**
     * Render specific slider type shortcode.
     *
     * @param array $atts Shortcode attributes.
     * @param string $content Shortcode content.
     * @param string $tag Shortcode tag.
     * @return string Rendered slider HTML.
     */
    public function render_specific_slider_shortcode($atts, $content = '', $tag = '') {
        // Extract slider type from shortcode tag
        $type = str_replace('chesta_', '', $tag);
        
        // Add type to attributes
        $atts['type'] = $type;
        
        // Render using main shortcode function
        return $this->render_slider_shortcode($atts, $content);
    }

    /**
     * Parse slides data from shortcode attributes or content.
     *
     * @param string $slides_attr Slides attribute value.
     * @param string $content Shortcode content.
     * @return array Parsed slides data.
     */
    private function parse_slides_data($slides_attr, $content) {
        $slides = array();

        // Try to parse from slides attribute first (JSON format)
        if (!empty($slides_attr)) {
            $decoded_slides = json_decode(stripslashes($slides_attr), true);
            if (is_array($decoded_slides)) {
                return $decoded_slides;
            }
        }

        // Parse from shortcode content
        if (!empty($content)) {
            // Look for [slide] shortcodes within content
            $slide_pattern = '/\[slide([^\]]*)\](.*?)\[\/slide\]/s';
            preg_match_all($slide_pattern, $content, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                $slide_atts = shortcode_parse_atts($match[1]);
                $slide_content = $match[2];

                $slide = array(
                    'title' => isset($slide_atts['title']) ? $slide_atts['title'] : '',
                    'description' => !empty($slide_content) ? $slide_content : (isset($slide_atts['description']) ? $slide_atts['description'] : ''),
                    'image' => array(
                        'url' => isset($slide_atts['image']) ? $slide_atts['image'] : '',
                        'alt' => isset($slide_atts['alt']) ? $slide_atts['alt'] : '',
                    ),
                    'button' => array(
                        'text' => isset($slide_atts['button_text']) ? $slide_atts['button_text'] : '',
                        'url' => isset($slide_atts['button_url']) ? $slide_atts['button_url'] : '',
                        'target' => isset($slide_atts['button_target']) ? $slide_atts['button_target'] : '_self',
                    ),
                );

                // Add additional slide-specific attributes
                if (isset($slide_atts['video'])) {
                    $slide['video'] = array('url' => $slide_atts['video']);
                }

                if (isset($slide_atts['background_color'])) {
                    $slide['background_color'] = $slide_atts['background_color'];
                }

                $slides[] = $slide;
            }
        }

        // If no slides found, return demo slides
        if (empty($slides)) {
            return $this->get_demo_slides();
        }

        return $slides;
    }

    /**
     * Build slider configuration from shortcode attributes.
     *
     * @param array $atts Shortcode attributes.
     * @return array Slider configuration.
     */
    private function build_slider_config($atts) {
        return array(
            'slidesToShow' => $atts['slides_to_show'],
            'slidesToScroll' => $atts['slides_to_scroll'],
            'autoplay' => $atts['autoplay'],
            'autoplaySpeed' => $atts['autoplay_speed'],
            'speed' => $atts['speed'],
            'infinite' => $atts['infinite'],
            'arrows' => $atts['arrows'],
            'arrowType' => $atts['arrow_type'],
            'arrowSize' => $atts['arrow_size'],
            'arrowColor' => $atts['arrow_color'],
            'arrowBackground' => $atts['arrow_background'],
            'arrowPosition' => $atts['arrow_position'],
            'arrowFollowMouse' => $atts['arrow_follow_mouse'],
            'dots' => $atts['dots'],
            'dotsType' => $atts['dots_type'],
            'dotsPosition' => $atts['dots_position'],
            'dotsColor' => $atts['dots_color'],
            'dotsActiveColor' => $atts['dots_active_color'],
            'dotsSize' => $atts['dots_size'],
            'dotsGap' => $atts['dots_gap'],
            'transitionMode' => $atts['transition_mode'],
            'easing' => $atts['easing'],
            'height' => array(
                'desktop' => $atts['height'],
                'tablet' => $atts['height_tablet'],
                'mobile' => $atts['height_mobile'],
            ),
            'margin' => array(
                'top' => $atts['margin_top'],
                'right' => $atts['margin_right'],
                'bottom' => $atts['margin_bottom'],
                'left' => $atts['margin_left'],
            ),
            'padding' => array(
                'top' => $atts['padding_top'],
                'right' => $atts['padding_right'],
                'bottom' => $atts['padding_bottom'],
                'left' => $atts['padding_left'],
            ),
            'innerGap' => $atts['inner_gap'],
            'contentPosition' => $atts['content_position'],
            'titleAnimation' => $atts['title_animation'],
            'titleDelay' => $atts['title_delay'],
            'titleDuration' => $atts['title_duration'],
            'descriptionAnimation' => $atts['description_animation'],
            'descriptionDelay' => $atts['description_delay'],
            'descriptionDuration' => $atts['description_duration'],
            'buttonAnimation' => $atts['button_animation'],
            'buttonDelay' => $atts['button_delay'],
            'buttonDuration' => $atts['button_duration'],
            'mouseWheel' => $atts['mouse_wheel'],
            'mouseDrag' => $atts['mouse_drag'],
            'touchSwipe' => $atts['touch_swipe'],
            'keyboard' => $atts['keyboard'],
            'pauseOnHover' => $atts['pause_on_hover'],
            'pauseOnFocus' => $atts['pause_on_focus'],
            'centerMode' => $atts['center_mode'],
            'centerPadding' => $atts['center_padding'],
            'variableWidth' => $atts['variable_width'],
            'lazyLoad' => $atts['lazy_load'],
            'preloadImages' => $atts['preload_images'],
            'accessibility' => $atts['accessibility'],
            'rtl' => $atts['rtl'],
        );
    }

    /**
     * Get demo slides for empty sliders.
     *
     * @return array Demo slides data.
     */
    private function get_demo_slides() {
        return array(
            array(
                'title' => __('Beautiful Slider Demo', 'chesta-slider'),
                'description' => __('This is a demo slide showcasing the amazing capabilities of Chesta Slider.', 'chesta-slider'),
                'image' => array(
                    'url' => 'https://via.placeholder.com/800x400/007cba/ffffff?text=Demo+Slide+1',
                    'alt' => __('Demo slide 1', 'chesta-slider'),
                ),
                'button' => array(
                    'text' => __('Learn More', 'chesta-slider'),
                    'url' => '#',
                    'target' => '_self',
                ),
            ),
            array(
                'title' => __('Stunning Visual Effects', 'chesta-slider'),
                'description' => __('Experience smooth transitions and beautiful animations with our premium slider.', 'chesta-slider'),
                'image' => array(
                    'url' => 'https://via.placeholder.com/800x400/28a745/ffffff?text=Demo+Slide+2',
                    'alt' => __('Demo slide 2', 'chesta-slider'),
                ),
                'button' => array(
                    'text' => __('Discover More', 'chesta-slider'),
                    'url' => '#',
                    'target' => '_self',
                ),
            ),
            array(
                'title' => __('Fully Customizable', 'chesta-slider'),
                'description' => __('Customize every aspect of your slider with our extensive options and settings.', 'chesta-slider'),
                'image' => array(
                    'url' => 'https://via.placeholder.com/800x400/dc3545/ffffff?text=Demo+Slide+3',
                    'alt' => __('Demo slide 3', 'chesta-slider'),
                ),
                'button' => array(
                    'text' => __('Get Started', 'chesta-slider'),
                    'url' => '#',
                    'target' => '_self',
                ),
            ),
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
        wp_add_inline_style('chesta-slider', $css);
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
        wp_add_inline_script('chesta-slider-core', $js);
    }

    /**
     * Get shortcode documentation.
     *
     * @return array Shortcode documentation.
     */
    public function get_shortcode_documentation() {
        return array(
            'basic_usage' => array(
                'title' => __('Basic Usage', 'chesta-slider'),
                'examples' => array(
                    '[chesta_slider type="carousel"]',
                    '[chesta_carousel autoplay="true" arrows="false"]',
                    '[chesta_hero height="100vh" transition_mode="fade"]',
                ),
            ),
            'with_slides' => array(
                'title' => __('With Custom Slides', 'chesta-slider'),
                'examples' => array(
                    '[chesta_slider type="carousel"]
                        [slide title="Slide 1" image="image1.jpg" button_text="Learn More" button_url="#"]Content here[/slide]
                        [slide title="Slide 2" image="image2.jpg" button_text="Get Started" button_url="#"]More content[/slide]
                    [/chesta_slider]',
                ),
            ),
            'advanced_options' => array(
                'title' => __('Advanced Customization', 'chesta-slider'),
                'examples' => array(
                    '[chesta_slider 
                        type="hero" 
                        autoplay="true" 
                        autoplay_speed="5000"
                        transition_mode="fade"
                        arrow_type="circle"
                        arrow_color="#ffffff"
                        dots_type="progress"
                        height="80vh"
                        height_tablet="60vh"
                        height_mobile="50vh"
                        title_animation="fadeInUp"
                        title_delay="200"
                        content_position="center-center"
                        mouse_wheel="true"
                    ]',
                ),
            ),
            'all_parameters' => array(
                'title' => __('All Available Parameters', 'chesta-slider'),
                'parameters' => array(
                    'type' => __('Slider type (carousel, hero, cube, testimonial, etc.)', 'chesta-slider'),
                    'slides_to_show' => __('Number of slides to show at once', 'chesta-slider'),
                    'slides_to_scroll' => __('Number of slides to scroll per action', 'chesta-slider'),
                    'autoplay' => __('Enable autoplay (true/false)', 'chesta-slider'),
                    'autoplay_speed' => __('Autoplay speed in milliseconds', 'chesta-slider'),
                    'speed' => __('Animation speed in milliseconds', 'chesta-slider'),
                    'infinite' => __('Enable infinite loop (true/false)', 'chesta-slider'),
                    'arrows' => __('Show navigation arrows (true/false)', 'chesta-slider'),
                    'arrow_type' => __('Arrow style (default, circle, square, minimal)', 'chesta-slider'),
                    'arrow_size' => __('Arrow size in pixels', 'chesta-slider'),
                    'arrow_color' => __('Arrow color (hex code)', 'chesta-slider'),
                    'arrow_background' => __('Arrow background color', 'chesta-slider'),
                    'arrow_position' => __('Arrow position (sides, bottom, top, center)', 'chesta-slider'),
                    'arrow_follow_mouse' => __('Arrows follow mouse (true/false)', 'chesta-slider'),
                    'dots' => __('Show dot indicators (true/false)', 'chesta-slider'),
                    'dots_type' => __('Indicator type (dots, lines, numbers, thumbnails, progress)', 'chesta-slider'),
                    'dots_position' => __('Indicator position', 'chesta-slider'),
                    'dots_color' => __('Indicator color', 'chesta-slider'),
                    'dots_active_color' => __('Active indicator color', 'chesta-slider'),
                    'dots_size' => __('Indicator size in pixels', 'chesta-slider'),
                    'dots_gap' => __('Gap between indicators', 'chesta-slider'),
                    'transition_mode' => __('Transition effect (slide, fade, flip, cube, coverflow)', 'chesta-slider'),
                    'easing' => __('Animation easing function', 'chesta-slider'),
                    'height' => __('Slider height for desktop', 'chesta-slider'),
                    'height_tablet' => __('Slider height for tablet', 'chesta-slider'),
                    'height_mobile' => __('Slider height for mobile', 'chesta-slider'),
                    'content_position' => __('Position of text content on slides', 'chesta-slider'),
                    'title_animation' => __('Animation for slide titles', 'chesta-slider'),
                    'title_delay' => __('Delay before title animation', 'chesta-slider'),
                    'title_duration' => __('Duration of title animation', 'chesta-slider'),
                    'description_animation' => __('Animation for slide descriptions', 'chesta-slider'),
                    'button_animation' => __('Animation for slide buttons', 'chesta-slider'),
                    'mouse_wheel' => __('Enable mouse wheel navigation (true/false)', 'chesta-slider'),
                    'mouse_drag' => __('Enable mouse drag navigation (true/false)', 'chesta-slider'),
                    'touch_swipe' => __('Enable touch swipe navigation (true/false)', 'chesta-slider'),
                    'keyboard' => __('Enable keyboard navigation (true/false)', 'chesta-slider'),
                    'center_mode' => __('Enable center mode (true/false)', 'chesta-slider'),
                    'variable_width' => __('Allow variable width slides (true/false)', 'chesta-slider'),
                    'lazy_load' => __('Enable lazy loading (true/false)', 'chesta-slider'),
                    'accessibility' => __('Enable accessibility features (true/false)', 'chesta-slider'),
                    'rtl' => __('Enable RTL support (true/false)', 'chesta-slider'),
                    'custom_css' => __('Add custom CSS styles', 'chesta-slider'),
                    'custom_js' => __('Add custom JavaScript code', 'chesta-slider'),
                ),
            ),
        );
    }
}
