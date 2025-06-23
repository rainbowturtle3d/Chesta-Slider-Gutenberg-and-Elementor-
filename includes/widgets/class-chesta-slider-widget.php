<?php
/**
 * WordPress Widget for Chesta Slider
 * Allows users to add sliders to widget areas
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/widgets
 */

/**
 * Chesta Slider Widget class.
 *
 * Extends WP_Widget to create a slider widget.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/widgets
 */
class Chesta_Slider_Widget extends WP_Widget {

    /**
     * The template manager instance.
     *
     * @access private
     * @var Chesta_Slider_Template_Manager $template_manager Template manager.
     */
    private $template_manager;

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'chesta_slider_widget',
            'description' => __('Display beautiful, customizable sliders in your widget areas.', 'chesta-slider'),
            'customize_selective_refresh' => true,
        );
        parent::__construct('chesta_slider_widget', __('Chesta Slider', 'chesta-slider'), $widget_ops);

        // Get template manager instance
        global $chesta_slider_template_manager;
        $this->template_manager = $chesta_slider_template_manager;
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args Widget arguments.
     * @param array $instance Widget instance.
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Build slider configuration
        $slider_config = $this->build_slider_config($instance);
        
        // Parse slides data
        $slides_data = $this->parse_slides_data($instance);

        // Generate unique slider ID
        $slider_id = 'chesta-widget-slider-' . $this->id;

        // Prepare template arguments
        $template_args = array(
            'slider_id' => $slider_id,
            'slides' => $slides_data,
            'settings' => $slider_config,
        );

        // Render the slider
        if ($this->template_manager) {
            echo $this->template_manager->render_template($instance['slider_type'], $template_args);
        } else {
            echo '<p>' . __('Slider template manager not available.', 'chesta-slider') . '</p>';
        }

        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options.
     */
    public function form($instance) {
        // Set default values
        $defaults = array(
            'title' => '',
            'slider_type' => 'carousel',
            'slides_to_show' => 1,
            'slides_to_scroll' => 1,
            'autoplay' => false,
            'autoplay_speed' => 3000,
            'speed' => 500,
            'infinite' => true,
            'arrows' => true,
            'arrow_type' => 'default',
            'arrow_size' => 50,
            'arrow_color' => '#ffffff',
            'arrow_background' => 'rgba(0,0,0,0.5)',
            'dots' => true,
            'dots_type' => 'dots',
            'dots_position' => 'bottom-center',
            'dots_color' => '#cccccc',
            'dots_active_color' => '#007cba',
            'height' => '300px',
            'transition_mode' => 'slide',
            'content_position' => 'bottom-left',
            'title_animation' => 'fadeInUp',
            'description_animation' => 'fadeInUp',
            'button_animation' => 'fadeInUp',
            'mouse_wheel' => false,
            'mouse_drag' => true,
            'touch_swipe' => true,
            'keyboard' => true,
            'pause_on_hover' => true,
            'lazy_load' => true,
            'accessibility' => true,
            'rtl' => false,
            'slides_json' => '',
        );

        $instance = wp_parse_args((array) $instance, $defaults);

        // Get available slider types
        $slider_types = array();
        if ($this->template_manager) {
            $templates = $this->template_manager->get_templates();
            foreach ($templates as $type => $template) {
                $slider_types[$type] = $template['name'];
            }
        }

        ?>
        <div class="chesta-widget-form">
            <!-- Title -->
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'chesta-slider'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>">
            </p>

            <!-- Slider Type -->
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('slider_type')); ?>"><?php _e('Slider Type:', 'chesta-slider'); ?></label>
                <select class="widefat" id="<?php echo esc_attr($this->get_field_id('slider_type')); ?>" name="<?php echo esc_attr($this->get_field_name('slider_type')); ?>">
                    <?php foreach ($slider_types as $type => $name) : ?>
                        <option value="<?php echo esc_attr($type); ?>" <?php selected($instance['slider_type'], $type); ?>>
                            <?php echo esc_html($name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>

            <!-- Basic Settings -->
            <h4><?php _e('Basic Settings', 'chesta-slider'); ?></h4>
            
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('slides_to_show')); ?>"><?php _e('Slides to Show:', 'chesta-slider'); ?></label>
                <input class="small-text" id="<?php echo esc_attr($this->get_field_id('slides_to_show')); ?>" name="<?php echo esc_attr($this->get_field_name('slides_to_show')); ?>" type="number" min="1" max="6" value="<?php echo esc_attr($instance['slides_to_show']); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('height')); ?>"><?php _e('Height:', 'chesta-slider'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('height')); ?>" name="<?php echo esc_attr($this->get_field_name('height')); ?>" type="text" value="<?php echo esc_attr($instance['height']); ?>" placeholder="300px">
                <small><?php _e('Use CSS units like px, vh, em, etc.', 'chesta-slider'); ?></small>
            </p>

            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['autoplay']); ?> id="<?php echo esc_attr($this->get_field_id('autoplay')); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay')); ?>">
                <label for="<?php echo esc_attr($this->get_field_id('autoplay')); ?>"><?php _e('Enable Autoplay', 'chesta-slider'); ?></label>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('autoplay_speed')); ?>"><?php _e('Autoplay Speed (ms):', 'chesta-slider'); ?></label>
                <input class="small-text" id="<?php echo esc_attr($this->get_field_id('autoplay_speed')); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay_speed')); ?>" type="number" min="1000" max="10000" step="500" value="<?php echo esc_attr($instance['autoplay_speed']); ?>">
            </p>

            <!-- Navigation Settings -->
            <h4><?php _e('Navigation', 'chesta-slider'); ?></h4>

            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['arrows']); ?> id="<?php echo esc_attr($this->get_field_id('arrows')); ?>" name="<?php echo esc_attr($this->get_field_name('arrows')); ?>">
                <label for="<?php echo esc_attr($this->get_field_id('arrows')); ?>"><?php _e('Show Arrows', 'chesta-slider'); ?></label>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('arrow_type')); ?>"><?php _e('Arrow Type:', 'chesta-slider'); ?></label>
                <select class="widefat" id="<?php echo esc_attr($this->get_field_id('arrow_type')); ?>" name="<?php echo esc_attr($this->get_field_name('arrow_type')); ?>">
                    <option value="default" <?php selected($instance['arrow_type'], 'default'); ?>><?php _e('Default', 'chesta-slider'); ?></option>
                    <option value="circle" <?php selected($instance['arrow_type'], 'circle'); ?>><?php _e('Circle', 'chesta-slider'); ?></option>
                    <option value="square" <?php selected($instance['arrow_type'], 'square'); ?>><?php _e('Square', 'chesta-slider'); ?></option>
                    <option value="minimal" <?php selected($instance['arrow_type'], 'minimal'); ?>><?php _e('Minimal', 'chesta-slider'); ?></option>
                </select>
            </p>

            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['dots']); ?> id="<?php echo esc_attr($this->get_field_id('dots')); ?>" name="<?php echo esc_attr($this->get_field_name('dots')); ?>">
                <label for="<?php echo esc_attr($this->get_field_id('dots')); ?>"><?php _e('Show Dots', 'chesta-slider'); ?></label>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('dots_type')); ?>"><?php _e('Dots Type:', 'chesta-slider'); ?></label>
                <select class="widefat" id="<?php echo esc_attr($this->get_field_id('dots_type')); ?>" name="<?php echo esc_attr($this->get_field_name('dots_type')); ?>">
                    <option value="dots" <?php selected($instance['dots_type'], 'dots'); ?>><?php _e('Dots', 'chesta-slider'); ?></option>
                    <option value="lines" <?php selected($instance['dots_type'], 'lines'); ?>><?php _e('Lines', 'chesta-slider'); ?></option>
                    <option value="numbers" <?php selected($instance['dots_type'], 'numbers'); ?>><?php _e('Numbers', 'chesta-slider'); ?></option>
                    <option value="progress" <?php selected($instance['dots_type'], 'progress'); ?>><?php _e('Progress Bar', 'chesta-slider'); ?></option>
                </select>
            </p>

            <!-- Animation Settings -->
            <h4><?php _e('Animations', 'chesta-slider'); ?></h4>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('transition_mode')); ?>"><?php _e('Transition Mode:', 'chesta-slider'); ?></label>
                <select class="widefat" id="<?php echo esc_attr($this->get_field_id('transition_mode')); ?>" name="<?php echo esc_attr($this->get_field_name('transition_mode')); ?>">
                    <option value="slide" <?php selected($instance['transition_mode'], 'slide'); ?>><?php _e('Slide', 'chesta-slider'); ?></option>
                    <option value="fade" <?php selected($instance['transition_mode'], 'fade'); ?>><?php _e('Fade', 'chesta-slider'); ?></option>
                    <option value="flip" <?php selected($instance['transition_mode'], 'flip'); ?>><?php _e('Flip', 'chesta-slider'); ?></option>
                    <option value="cube" <?php selected($instance['transition_mode'], 'cube'); ?>><?php _e('3D Cube', 'chesta-slider'); ?></option>
                </select>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title_animation')); ?>"><?php _e('Title Animation:', 'chesta-slider'); ?></label>
                <select class="widefat" id="<?php echo esc_attr($this->get_field_id('title_animation')); ?>" name="<?php echo esc_attr($this->get_field_name('title_animation')); ?>">
                    <option value="none" <?php selected($instance['title_animation'], 'none'); ?>><?php _e('None', 'chesta-slider'); ?></option>
                    <option value="fadeIn" <?php selected($instance['title_animation'], 'fadeIn'); ?>><?php _e('Fade In', 'chesta-slider'); ?></option>
                    <option value="fadeInUp" <?php selected($instance['title_animation'], 'fadeInUp'); ?>><?php _e('Fade In Up', 'chesta-slider'); ?></option>
                    <option value="fadeInDown" <?php selected($instance['title_animation'], 'fadeInDown'); ?>><?php _e('Fade In Down', 'chesta-slider'); ?></option>
                    <option value="slideInUp" <?php selected($instance['title_animation'], 'slideInUp'); ?>><?php _e('Slide In Up', 'chesta-slider'); ?></option>
                    <option value="zoomIn" <?php selected($instance['title_animation'], 'zoomIn'); ?>><?php _e('Zoom In', 'chesta-slider'); ?></option>
                </select>
            </p>

            <!-- Interaction Settings -->
            <h4><?php _e('Interaction', 'chesta-slider'); ?></h4>

            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['mouse_drag']); ?> id="<?php echo esc_attr($this->get_field_id('mouse_drag')); ?>" name="<?php echo esc_attr($this->get_field_name('mouse_drag')); ?>">
                <label for="<?php echo esc_attr($this->get_field_id('mouse_drag')); ?>"><?php _e('Mouse Drag', 'chesta-slider'); ?></label>
            </p>

            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['touch_swipe']); ?> id="<?php echo esc_attr($this->get_field_id('touch_swipe')); ?>" name="<?php echo esc_attr($this->get_field_name('touch_swipe')); ?>">
                <label for="<?php echo esc_attr($this->get_field_id('touch_swipe')); ?>"><?php _e('Touch Swipe', 'chesta-slider'); ?></label>
            </p>

            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['keyboard']); ?> id="<?php echo esc_attr($this->get_field_id('keyboard')); ?>" name="<?php echo esc_attr($this->get_field_name('keyboard')); ?>">
                <label for="<?php echo esc_attr($this->get_field_id('keyboard')); ?>"><?php _e('Keyboard Navigation', 'chesta-slider'); ?></label>
            </p>

            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['mouse_wheel']); ?> id="<?php echo esc_attr($this->get_field_id('mouse_wheel')); ?>" name="<?php echo esc_attr($this->get_field_name('mouse_wheel')); ?>">
                <label for="<?php echo esc_attr($this->get_field_id('mouse_wheel')); ?>"><?php _e('Mouse Wheel Navigation', 'chesta-slider'); ?></label>
            </p>

            <!-- Accessibility -->
            <h4><?php _e('Accessibility & Performance', 'chesta-slider'); ?></h4>

            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['accessibility']); ?> id="<?php echo esc_attr($this->get_field_id('accessibility')); ?>" name="<?php echo esc_attr($this->get_field_name('accessibility')); ?>">
                <label for="<?php echo esc_attr($this->get_field_id('accessibility')); ?>"><?php _e('Accessibility Features', 'chesta-slider'); ?></label>
            </p>

            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['lazy_load']); ?> id="<?php echo esc_attr($this->get_field_id('lazy_load')); ?>" name="<?php echo esc_attr($this->get_field_name('lazy_load')); ?>">
                <label for="<?php echo esc_attr($this->get_field_id('lazy_load')); ?>"><?php _e('Lazy Loading', 'chesta-slider'); ?></label>
            </p>

            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['rtl']); ?> id="<?php echo esc_attr($this->get_field_id('rtl')); ?>" name="<?php echo esc_attr($this->get_field_name('rtl')); ?>">
                <label for="<?php echo esc_attr($this->get_field_id('rtl')); ?>"><?php _e('RTL Support', 'chesta-slider'); ?></label>
            </p>

            <!-- Slides Data -->
            <h4><?php _e('Slides Data', 'chesta-slider'); ?></h4>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('slides_json')); ?>"><?php _e('Slides JSON:', 'chesta-slider'); ?></label>
                <textarea class="widefat" rows="8" id="<?php echo esc_attr($this->get_field_id('slides_json')); ?>" name="<?php echo esc_attr($this->get_field_name('slides_json')); ?>" placeholder='[{"title":"Slide 1","description":"Description","image":{"url":"image.jpg"},"button":{"text":"Learn More","url":"#"}}]'><?php echo esc_textarea($instance['slides_json']); ?></textarea>
                <small><?php _e('Enter slides data in JSON format or leave empty for demo slides.', 'chesta-slider'); ?></small>
            </p>

            <!-- Shortcode Generator -->
            <h4><?php _e('Shortcode', 'chesta-slider'); ?></h4>
            <p>
                <strong><?php _e('Use this shortcode in posts/pages:', 'chesta-slider'); ?></strong><br>
                <code id="<?php echo esc_attr($this->get_field_id('shortcode_preview')); ?>" style="background: #f1f1f1; padding: 5px; display: block; margin-top: 5px;">
                    [chesta_<?php echo esc_html($instance['slider_type']); ?> height="<?php echo esc_attr($instance['height']); ?>" autoplay="<?php echo $instance['autoplay'] ? 'true' : 'false'; ?>"]
                </code>
            </p>
        </div>

        <style>
        .chesta-widget-form h4 {
            margin: 20px 0 10px 0;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
            font-weight: 600;
        }
        .chesta-widget-form h4:first-of-type {
            margin-top: 10px;
        }
        .chesta-widget-form small {
            color: #666;
            font-style: italic;
        }
        .chesta-widget-form code {
            font-size: 12px;
            word-break: break-all;
        }
        </style>

        <script>
        jQuery(document).ready(function($) {
            // Update shortcode preview when slider type changes
            $('#<?php echo esc_js($this->get_field_id('slider_type')); ?>').on('change', function() {
                var sliderType = $(this).val();
                var height = $('#<?php echo esc_js($this->get_field_id('height')); ?>').val();
                var autoplay = $('#<?php echo esc_js($this->get_field_id('autoplay')); ?>').is(':checked');
                var shortcode = '[chesta_' + sliderType + ' height="' + height + '" autoplay="' + (autoplay ? 'true' : 'false') + '"]';
                $('#<?php echo esc_js($this->get_field_id('shortcode_preview')); ?>').text(shortcode);
            });
        });
        </script>
        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options.
     * @param array $old_instance The previous options.
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        
        // Text fields
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['slider_type'] = (!empty($new_instance['slider_type'])) ? sanitize_text_field($new_instance['slider_type']) : 'carousel';
        $instance['height'] = (!empty($new_instance['height'])) ? sanitize_text_field($new_instance['height']) : '300px';
        $instance['arrow_type'] = (!empty($new_instance['arrow_type'])) ? sanitize_text_field($new_instance['arrow_type']) : 'default';
        $instance['dots_type'] = (!empty($new_instance['dots_type'])) ? sanitize_text_field($new_instance['dots_type']) : 'dots';
        $instance['transition_mode'] = (!empty($new_instance['transition_mode'])) ? sanitize_text_field($new_instance['transition_mode']) : 'slide';
        $instance['title_animation'] = (!empty($new_instance['title_animation'])) ? sanitize_text_field($new_instance['title_animation']) : 'fadeInUp';
        $instance['slides_json'] = (!empty($new_instance['slides_json'])) ? wp_kses_post($new_instance['slides_json']) : '';

        // Numeric fields
        $instance['slides_to_show'] = (!empty($new_instance['slides_to_show'])) ? absint($new_instance['slides_to_show']) : 1;
        $instance['autoplay_speed'] = (!empty($new_instance['autoplay_speed'])) ? absint($new_instance['autoplay_speed']) : 3000;

        // Boolean fields
        $instance['autoplay'] = !empty($new_instance['autoplay']);
        $instance['arrows'] = !empty($new_instance['arrows']);
        $instance['dots'] = !empty($new_instance['dots']);
        $instance['mouse_drag'] = !empty($new_instance['mouse_drag']);
        $instance['touch_swipe'] = !empty($new_instance['touch_swipe']);
        $instance['keyboard'] = !empty($new_instance['keyboard']);
        $instance['mouse_wheel'] = !empty($new_instance['mouse_wheel']);
        $instance['accessibility'] = !empty($new_instance['accessibility']);
        $instance['lazy_load'] = !empty($new_instance['lazy_load']);
        $instance['rtl'] = !empty($new_instance['rtl']);

        return $instance;
    }

    /**
     * Build slider configuration from widget instance.
     *
     * @param array $instance Widget instance.
     * @return array Slider configuration.
     */
    private function build_slider_config($instance) {
        return array(
            'slidesToShow' => $instance['slides_to_show'],
            'slidesToScroll' => 1,
            'autoplay' => $instance['autoplay'],
            'autoplaySpeed' => $instance['autoplay_speed'],
            'speed' => 500,
            'infinite' => true,
            'arrows' => $instance['arrows'],
            'arrowType' => $instance['arrow_type'],
            'dots' => $instance['dots'],
            'dotsType' => $instance['dots_type'],
            'transitionMode' => $instance['transition_mode'],
            'height' => array(
                'desktop' => $instance['height'],
                'tablet' => $instance['height'],
                'mobile' => $instance['height'],
            ),
            'titleAnimation' => $instance['title_animation'],
            'mouseWheel' => $instance['mouse_wheel'],
            'mouseDrag' => $instance['mouse_drag'],
            'touchSwipe' => $instance['touch_swipe'],
            'keyboard' => $instance['keyboard'],
            'pauseOnHover' => true,
            'lazyLoad' => $instance['lazy_load'],
            'accessibility' => $instance['accessibility'],
            'rtl' => $instance['rtl'],
        );
    }

    /**
     * Parse slides data from widget instance.
     *
     * @param array $instance Widget instance.
     * @return array Slides data.
     */
    private function parse_slides_data($instance) {
        if (!empty($instance['slides_json'])) {
            $slides = json_decode($instance['slides_json'], true);
            if (is_array($slides) && !empty($slides)) {
                return $slides;
            }
        }

        // Return demo slides if no valid data
        return array(
            array(
                'title' => __('Widget Slider Demo', 'chesta-slider'),
                'description' => __('This is a demo slide in your widget area.', 'chesta-slider'),
                'image' => array(
                    'url' => 'https://via.placeholder.com/600x300/007cba/ffffff?text=Widget+Demo',
                    'alt' => __('Demo slide', 'chesta-slider'),
                ),
                'button' => array(
                    'text' => __('Learn More', 'chesta-slider'),
                    'url' => '#',
                    'target' => '_self',
                ),
            ),
            array(
                'title' => __('Customizable Widgets', 'chesta-slider'),
                'description' => __('Easy to customize and configure through the widget settings.', 'chesta-slider'),
                'image' => array(
                    'url' => 'https://via.placeholder.com/600x300/28a745/ffffff?text=Customizable',
                    'alt' => __('Demo slide 2', 'chesta-slider'),
                ),
                'button' => array(
                    'text' => __('Customize', 'chesta-slider'),
                    'url' => '#',
                    'target' => '_self',
                ),
            ),
        );
    }
}
