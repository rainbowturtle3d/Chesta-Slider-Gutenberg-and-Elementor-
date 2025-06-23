<?php
/**
 * Security functionality for the plugin.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes
 */

/**
 * Security functionality for the plugin.
 *
 * This class defines all security-related functionality including
 * input sanitization, nonce verification, and capability checks.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes
 */
class Chesta_Slider_Security {

    /**
     * Initialize the security features.
     */
    public function __construct() {
        add_action('init', array($this, 'security_headers'));
        add_action('wp_ajax_chesta_slider_save_settings', array($this, 'verify_ajax_request'));
        add_action('wp_ajax_chesta_slider_delete_slider', array($this, 'verify_ajax_request'));
        add_filter('chesta_slider_sanitize_input', array($this, 'sanitize_input'), 10, 2);
    }

    /**
     * Add security headers.
     */
    public function security_headers() {
        // Only add headers in admin area
        if (!is_admin()) {
            return;
        }

        // Prevent clickjacking
        if (!headers_sent()) {
            header('X-Frame-Options: SAMEORIGIN');
            header('X-Content-Type-Options: nosniff');
            header('X-XSS-Protection: 1; mode=block');
        }
    }

    /**
     * Verify AJAX requests.
     */
    public function verify_ajax_request() {
        // Check if user is logged in
        if (!is_user_logged_in()) {
            wp_die(__('You must be logged in to perform this action.', 'chesta-slider'));
        }

        // Check user capabilities
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have permission to perform this action.', 'chesta-slider'));
        }

        // Verify nonce
        if (!wp_verify_nonce($_POST['nonce'], 'chesta_slider_admin_nonce')) {
            wp_die(__('Security check failed. Please refresh the page and try again.', 'chesta-slider'));
        }
    }

    /**
     * Sanitize input data based on type.
     *
     * @param mixed $input The input to sanitize.
     * @param string $type The type of sanitization to apply.
     * @return mixed Sanitized input.
     */
    public function sanitize_input($input, $type = 'text') {
        switch ($type) {
            case 'text':
                return sanitize_text_field($input);
            
            case 'textarea':
                return sanitize_textarea_field($input);
            
            case 'email':
                return sanitize_email($input);
            
            case 'url':
                return esc_url_raw($input);
            
            case 'html':
                return wp_kses_post($input);
            
            case 'css':
                return $this->sanitize_css($input);
            
            case 'js':
                return $this->sanitize_javascript($input);
            
            case 'int':
                return intval($input);
            
            case 'float':
                return floatval($input);
            
            case 'bool':
                return (bool) $input;
            
            case 'array':
                return $this->sanitize_array($input);
            
            case 'json':
                return $this->sanitize_json($input);
            
            default:
                return sanitize_text_field($input);
        }
    }

    /**
     * Sanitize CSS input.
     *
     * @param string $css CSS input.
     * @return string Sanitized CSS.
     */
    private function sanitize_css($css) {
        // Remove potentially dangerous CSS
        $dangerous_patterns = array(
            '/javascript\s*:/i',
            '/expression\s*\(/i',
            '/behavior\s*:/i',
            '/binding\s*:/i',
            '/@import/i',
            '/url\s*\(\s*["\']?\s*javascript\s*:/i',
        );

        $css = preg_replace($dangerous_patterns, '', $css);
        
        // Basic CSS validation - allow only safe properties
        $allowed_properties = array(
            'color', 'background', 'background-color', 'background-image', 'background-position',
            'background-repeat', 'background-size', 'border', 'border-color', 'border-style',
            'border-width', 'border-radius', 'margin', 'padding', 'width', 'height',
            'max-width', 'max-height', 'min-width', 'min-height', 'font', 'font-family',
            'font-size', 'font-weight', 'font-style', 'text-align', 'text-decoration',
            'text-transform', 'line-height', 'letter-spacing', 'word-spacing',
            'display', 'position', 'top', 'right', 'bottom', 'left', 'z-index',
            'float', 'clear', 'overflow', 'visibility', 'opacity', 'transform',
            'transition', 'animation', 'box-shadow', 'text-shadow'
        );

        return wp_strip_all_tags($css);
    }

    /**
     * Sanitize JavaScript input.
     *
     * @param string $js JavaScript input.
     * @return string Sanitized JavaScript.
     */
    private function sanitize_javascript($js) {
        // For security, we'll be very restrictive with JavaScript
        // Only allow basic jQuery/JavaScript patterns for slider customization
        
        $dangerous_patterns = array(
            '/eval\s*\(/i',
            '/function\s*\(/i',
            '/new\s+Function/i',
            '/setTimeout\s*\(/i',
            '/setInterval\s*\(/i',
            '/document\.write/i',
            '/innerHTML/i',
            '/outerHTML/i',
            '/script/i',
            '/iframe/i',
            '/object/i',
            '/embed/i',
            '/form/i',
            '/input/i',
            '/ajax/i',
            '/\$\.get/i',
            '/\$\.post/i',
            '/XMLHttpRequest/i',
            '/fetch\s*\(/i',
        );

        $js = preg_replace($dangerous_patterns, '', $js);
        
        return wp_strip_all_tags($js);
    }

    /**
     * Sanitize array input.
     *
     * @param array $array Array input.
     * @return array Sanitized array.
     */
    private function sanitize_array($array) {
        if (!is_array($array)) {
            return array();
        }

        $sanitized = array();
        foreach ($array as $key => $value) {
            $key = sanitize_key($key);
            
            if (is_array($value)) {
                $sanitized[$key] = $this->sanitize_array($value);
            } else {
                $sanitized[$key] = sanitize_text_field($value);
            }
        }

        return $sanitized;
    }

    /**
     * Sanitize JSON input.
     *
     * @param string $json JSON input.
     * @return string Sanitized JSON.
     */
    private function sanitize_json($json) {
        $decoded = json_decode($json, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return '{}';
        }

        $sanitized = $this->sanitize_array($decoded);
        return wp_json_encode($sanitized);
    }

    /**
     * Validate slider configuration.
     *
     * @param array $config Slider configuration.
     * @return array Validated configuration.
     */
    public function validate_slider_config($config) {
        $defaults = array(
            'type' => 'carousel',
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
        );

        $validated = wp_parse_args($config, $defaults);

        // Validate specific values
        $validated['type'] = in_array($validated['type'], array(
            'carousel', 'fade', 'hero', 'vertical', 'thumbnail', 'testimonial',
            'logo', 'product', 'video', 'parallax', 'multirow', 'center'
        )) ? $validated['type'] : 'carousel';

        $validated['slidesToShow'] = max(1, min(6, intval($validated['slidesToShow'])));
        $validated['slidesToScroll'] = max(1, min(6, intval($validated['slidesToScroll'])));
        $validated['autoplaySpeed'] = max(1000, min(10000, intval($validated['autoplaySpeed'])));
        $validated['speed'] = max(100, min(2000, intval($validated['speed'])));

        // Ensure boolean values
        $boolean_fields = array(
            'autoplay', 'infinite', 'arrows', 'dots', 'fade', 'vertical',
            'centerMode', 'variableWidth', 'lazyLoad', 'pauseOnHover',
            'pauseOnFocus', 'accessibility', 'swipe', 'draggable', 'rtl'
        );

        foreach ($boolean_fields as $field) {
            $validated[$field] = (bool) $validated[$field];
        }

        return $validated;
    }

    /**
     * Check if user can edit sliders.
     *
     * @return bool True if user can edit sliders.
     */
    public function can_edit_sliders() {
        return current_user_can('edit_posts') || current_user_can('manage_options');
    }

    /**
     * Check if user can manage slider settings.
     *
     * @return bool True if user can manage settings.
     */
    public function can_manage_settings() {
        return current_user_can('manage_options');
    }

    /**
     * Generate secure nonce for slider operations.
     *
     * @param string $action Action name.
     * @return string Nonce.
     */
    public function generate_nonce($action = 'chesta_slider_action') {
        return wp_create_nonce($action);
    }

    /**
     * Verify nonce for slider operations.
     *
     * @param string $nonce Nonce to verify.
     * @param string $action Action name.
     * @return bool True if nonce is valid.
     */
    public function verify_nonce($nonce, $action = 'chesta_slider_action') {
        return wp_verify_nonce($nonce, $action);
    }

    /**
     * Log security events.
     *
     * @param string $event Event description.
     * @param array $data Additional data.
     */
    public function log_security_event($event, $data = array()) {
        if (!defined('WP_DEBUG') || !WP_DEBUG) {
            return;
        }

        $log_data = array(
            'timestamp' => current_time('mysql'),
            'user_id' => get_current_user_id(),
            'ip_address' => $this->get_client_ip(),
            'user_agent' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '',
            'event' => $event,
            'data' => $data,
        );

        error_log('Chesta Slider Security Event: ' . wp_json_encode($log_data));
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

