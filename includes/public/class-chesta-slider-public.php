<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks for public-facing functionality.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/public
 */
class Chesta_Slider_Public {

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
     * Plugin options.
     *
     * @access private
     * @var array $options Plugin options.
     */
    private $options;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->options = get_option('chesta_slider_options', array());
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     */
    public function enqueue_styles() {
        // Main slider styles
        wp_enqueue_style(
            $this->plugin_name,
            CHESTA_SLIDER_ASSETS_URL . 'css/chesta-slider.css',
            array(),
            $this->version,
            'all'
        );

        // Load Font Awesome if enabled
        if (isset($this->options['load_fontawesome']) && $this->options['load_fontawesome']) {
            wp_enqueue_style(
                'chesta-slider-fontawesome',
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
                array(),
                '6.4.0',
                'all'
            );
        }

        // Add custom CSS if provided
        if (!empty($this->options['custom_css'])) {
            wp_add_inline_style($this->plugin_name, $this->options['custom_css']);
        }

        // Add RTL styles if enabled
        if (isset($this->options['enable_rtl_support']) && $this->options['enable_rtl_support'] && is_rtl()) {
            wp_enqueue_style(
                $this->plugin_name . '-rtl',
                CHESTA_SLIDER_ASSETS_URL . 'css/chesta-slider-rtl.css',
                array($this->plugin_name),
                $this->version,
                'all'
            );
        }
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     */
    public function enqueue_scripts() {
        // Main slider script
        wp_enqueue_script(
            $this->plugin_name,
            CHESTA_SLIDER_ASSETS_URL . 'js/chesta-slider-core.js',
            array(),
            $this->version,
            true
        );

        // Localize script with options and data
        wp_localize_script(
            $this->plugin_name,
            'chestaSliderPublic',
            array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('chesta_slider_public_nonce'),
                'options' => array(
                    'lazyLoad' => isset($this->options['enable_lazy_loading']) ? $this->options['enable_lazy_loading'] : true,
                    'touchSwipe' => isset($this->options['enable_touch_swipe']) ? $this->options['enable_touch_swipe'] : true,
                    'keyboardNav' => isset($this->options['enable_keyboard_navigation']) ? $this->options['enable_keyboard_navigation'] : true,
                    'rtlSupport' => isset($this->options['enable_rtl_support']) ? $this->options['enable_rtl_support'] : false,
                    'preloader' => isset($this->options['enable_preloader']) ? $this->options['enable_preloader'] : true,
                    'accessibility' => isset($this->options['accessibility_mode']) ? $this->options['accessibility_mode'] : true,
                ),
                'defaults' => array(
                    'autoplay' => isset($this->options['default_autoplay']) ? $this->options['default_autoplay'] : false,
                    'autoplaySpeed' => isset($this->options['default_autoplay_speed']) ? $this->options['default_autoplay_speed'] : 3000,
                    'speed' => isset($this->options['default_animation_speed']) ? $this->options['default_animation_speed'] : 500,
                ),
                'strings' => array(
                    'loading' => __('Loading...', 'chesta-slider'),
                    'previous' => __('Previous', 'chesta-slider'),
                    'next' => __('Next', 'chesta-slider'),
                    'play' => __('Play', 'chesta-slider'),
                    'pause' => __('Pause', 'chesta-slider'),
                    'slideOf' => __('Slide %1$d of %2$d', 'chesta-slider'),
                ),
            )
        );

        // Add custom JavaScript if provided
        if (!empty($this->options['custom_js'])) {
            wp_add_inline_script($this->plugin_name, $this->options['custom_js']);
        }
    }

    /**
     * Add slider shortcode support.
     */
    public function init_shortcodes() {
        add_shortcode('chesta_slider', array($this, 'render_slider_shortcode'));
    }

    /**
     * Render slider shortcode.
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
            'autoplay' => false,
            'autoplay_speed' => 3000,
            'speed' => 500,
            'infinite' => true,
            'arrows' => true,
            'dots' => true,
            'fade' => false,
            'vertical' => false,
            'center_mode' => false,
            'variable_width' => false,
            'lazy_load' => true,
            'pause_on_hover' => true,
            'pause_on_focus' => true,
            'accessibility' => true,
            'swipe' => true,
            'draggable' => true,
            'rtl' => false,
            'height' => '',
            'width' => '',
            'class' => '',
        );

        $atts = shortcode_atts($default_atts, $atts, 'chesta_slider');

        // Generate unique ID if not provided
        if (empty($atts['id'])) {
            $atts['id'] = 'chesta-slider-' . wp_generate_uuid4();
        }

        // Prepare slider options
        $slider_options = array(
            'type' => $atts['type'],
            'slidesToShow' => intval($atts['slides_to_show']),
            'slidesToScroll' => intval($atts['slides_to_scroll']),
            'autoplay' => filter_var($atts['autoplay'], FILTER_VALIDATE_BOOLEAN),
            'autoplaySpeed' => intval($atts['autoplay_speed']),
            'speed' => intval($atts['speed']),
            'infinite' => filter_var($atts['infinite'], FILTER_VALIDATE_BOOLEAN),
            'arrows' => filter_var($atts['arrows'], FILTER_VALIDATE_BOOLEAN),
            'dots' => filter_var($atts['dots'], FILTER_VALIDATE_BOOLEAN),
            'fade' => filter_var($atts['fade'], FILTER_VALIDATE_BOOLEAN),
            'vertical' => filter_var($atts['vertical'], FILTER_VALIDATE_BOOLEAN),
            'centerMode' => filter_var($atts['center_mode'], FILTER_VALIDATE_BOOLEAN),
            'variableWidth' => filter_var($atts['variable_width'], FILTER_VALIDATE_BOOLEAN),
            'lazyLoad' => filter_var($atts['lazy_load'], FILTER_VALIDATE_BOOLEAN),
            'pauseOnHover' => filter_var($atts['pause_on_hover'], FILTER_VALIDATE_BOOLEAN),
            'pauseOnFocus' => filter_var($atts['pause_on_focus'], FILTER_VALIDATE_BOOLEAN),
            'accessibility' => filter_var($atts['accessibility'], FILTER_VALIDATE_BOOLEAN),
            'swipe' => filter_var($atts['swipe'], FILTER_VALIDATE_BOOLEAN),
            'draggable' => filter_var($atts['draggable'], FILTER_VALIDATE_BOOLEAN),
            'rtl' => filter_var($atts['rtl'], FILTER_VALIDATE_BOOLEAN),
        );

        // Build CSS classes
        $css_classes = array('chesta-slider-wrapper');
        $css_classes[] = 'chesta-' . $atts['type'];
        
        if (!empty($atts['class'])) {
            $css_classes[] = sanitize_html_class($atts['class']);
        }

        // Build inline styles
        $inline_styles = array();
        
        if (!empty($atts['height'])) {
            $inline_styles[] = 'height: ' . esc_attr($atts['height']);
        }
        
        if (!empty($atts['width'])) {
            $inline_styles[] = 'width: ' . esc_attr($atts['width']);
        }

        // Start output buffering
        ob_start();
        ?>
        
        <div 
            id="<?php echo esc_attr($atts['id']); ?>" 
            class="<?php echo esc_attr(implode(' ', $css_classes)); ?>"
            <?php if (!empty($inline_styles)): ?>
                style="<?php echo esc_attr(implode('; ', $inline_styles)); ?>"
            <?php endif; ?>
            data-chesta-slider
            data-chesta-options="<?php echo esc_attr(wp_json_encode($slider_options)); ?>"
        >
            <?php echo do_shortcode($content); ?>
        </div>

        <?php
        return ob_get_clean();
    }

    /**
     * Add body classes for slider pages.
     *
     * @param array $classes Existing body classes.
     * @return array Modified body classes.
     */
    public function add_body_classes($classes) {
        global $post;

        if (is_singular() && has_blocks($post->post_content)) {
            if (has_block('chesta-slider/slider', $post)) {
                $classes[] = 'has-chesta-slider';
            }
        }

        return $classes;
    }

    /**
     * Optimize slider images.
     *
     * @param string $html Image HTML.
     * @param int $attachment_id Attachment ID.
     * @param string $size Image size.
     * @param bool $icon Whether to use icon.
     * @param array $attr Image attributes.
     * @return string Modified image HTML.
     */
    public function optimize_slider_images($html, $attachment_id, $size, $icon, $attr) {
        // Only optimize images within slider context
        if (!$this->is_slider_context()) {
            return $html;
        }

        // Add lazy loading attributes if enabled
        if (isset($this->options['enable_lazy_loading']) && $this->options['enable_lazy_loading']) {
            $html = str_replace('<img ', '<img loading="lazy" ', $html);
        }

        // Add responsive image attributes
        if (strpos($html, 'srcset') === false) {
            $srcset = wp_get_attachment_image_srcset($attachment_id, $size);
            $sizes = wp_get_attachment_image_sizes($attachment_id, $size);
            
            if ($srcset && $sizes) {
                $html = str_replace('<img ', '<img srcset="' . esc_attr($srcset) . '" sizes="' . esc_attr($sizes) . '" ', $html);
            }
        }

        return $html;
    }

    /**
     * Check if we're in a slider context.
     *
     * @return bool True if in slider context.
     */
    private function is_slider_context() {
        // Check if current post has slider blocks
        global $post;
        
        if (!$post || !has_blocks($post->post_content)) {
            return false;
        }

        return has_block('chesta-slider/slider', $post);
    }

    /**
     * Add structured data for sliders.
     */
    public function add_structured_data() {
        if (!$this->is_slider_context()) {
            return;
        }

        $structured_data = array(
            '@context' => 'https://schema.org',
            '@type' => 'ImageGallery',
            'name' => get_the_title(),
            'description' => get_the_excerpt(),
            'url' => get_permalink(),
        );

        echo '<script type="application/ld+json">' . wp_json_encode($structured_data) . '</script>';
    }

    /**
     * Handle AJAX requests for slider data.
     */
    public function handle_ajax_slider_data() {
        // Verify nonce
        if (!wp_verify_nonce($_POST['nonce'], 'chesta_slider_public_nonce')) {
            wp_die(__('Security check failed.', 'chesta-slider'));
        }

        $slider_id = sanitize_text_field($_POST['slider_id']);
        $action_type = sanitize_text_field($_POST['action_type']);

        switch ($action_type) {
            case 'get_slides':
                $this->get_slider_slides($slider_id);
                break;
            
            case 'track_interaction':
                $this->track_slider_interaction($slider_id, $_POST);
                break;
            
            default:
                wp_die(__('Invalid action.', 'chesta-slider'));
        }
    }

    /**
     * Get slider slides via AJAX.
     *
     * @param string $slider_id Slider ID.
     */
    private function get_slider_slides($slider_id) {
        // Implementation for dynamic slide loading
        $slides = array(); // Get slides from database or cache
        
        wp_send_json_success($slides);
    }

    /**
     * Track slider interactions for analytics.
     *
     * @param string $slider_id Slider ID.
     * @param array $data Interaction data.
     */
    private function track_slider_interaction($slider_id, $data) {
        // Only track if analytics is enabled
        if (!isset($this->options['enable_analytics']) || !$this->options['enable_analytics']) {
            wp_send_json_success();
            return;
        }

        global $wpdb;
        
        $table_name = $wpdb->prefix . 'chesta_slider_analytics';
        
        $wpdb->insert(
            $table_name,
            array(
                'slider_id' => sanitize_text_field($slider_id),
                'event_type' => sanitize_text_field($data['event_type']),
                'event_data' => wp_json_encode($data),
                'user_agent' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '',
                'ip_address' => $this->get_client_ip(),
                'created_at' => current_time('mysql'),
            ),
            array('%s', '%s', '%s', '%s', '%s', '%s')
        );

        wp_send_json_success();
    }

    /**
     * Get client IP address.
     *
     * @return string Client IP address.
     */
    private function get_client_ip() {
        $ip_keys = array(
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        );

        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }

        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
    }
}

