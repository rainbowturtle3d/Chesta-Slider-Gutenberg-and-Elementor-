<?php
/**
 * Template Manager for Chesta Slider
 * Handles loading and rendering of all 25+ slider templates
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes
 */

/**
 * Template Manager class.
 *
 * Manages all slider templates, their configurations, and rendering.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes
 */
class Chesta_Slider_Template_Manager {

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
     * Available slider templates.
     *
     * @access private
     * @var array $templates Available templates.
     */
    private $templates;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->ensure_directories();
        $this->load_templates();
    }

    /**
     * Check and create required directories.
     */
    private function ensure_directories() {
        $required_dirs = array(
            CHESTA_SLIDER_PLUGIN_DIR . 'templates',
            CHESTA_SLIDER_PLUGIN_DIR . 'includes',
            CHESTA_SLIDER_PLUGIN_DIR . 'includes/widgets',
            CHESTA_SLIDER_PLUGIN_DIR . 'includes/admin',
            CHESTA_SLIDER_PLUGIN_DIR . 'includes/public',
            CHESTA_SLIDER_PLUGIN_DIR . 'includes/gutenberg',
            CHESTA_SLIDER_PLUGIN_DIR . 'includes/elementor',
        );

        foreach ($required_dirs as $dir) {
            if (!file_exists($dir)) {
                wp_mkdir_p($dir);
            }
        }
    }

    /**
     * Load all available templates.
     */
    private function load_templates() {
        $this->templates = array(
            // Basic Sliders
            'carousel' => array(
                'name' => __('Carousel', 'chesta-slider'),
                'description' => __('Classic horizontal carousel with smooth transitions', 'chesta-slider'),
                'category' => 'basic',
                'icon' => 'slides',
                'premium' => false,
            ),
            'fade' => array(
                'name' => __('Fade', 'chesta-slider'),
                'description' => __('Elegant fade transitions between slides', 'chesta-slider'),
                'category' => 'basic',
                'icon' => 'image-filter',
                'premium' => false,
            ),
            'vertical' => array(
                'name' => __('Vertical', 'chesta-slider'),
                'description' => __('Vertical sliding direction for unique layouts', 'chesta-slider'),
                'category' => 'basic',
                'icon' => 'sort',
                'premium' => false,
            ),
            'gallery' => array(
                'name' => __('Image Gallery', 'chesta-slider'),
                'description' => __('Beautiful image gallery with lightbox support', 'chesta-slider'),
                'category' => 'basic',
                'icon' => 'format-gallery',
                'premium' => false,
            ),

            // Advanced Sliders
            'hero' => array(
                'name' => __('Hero Slider', 'chesta-slider'),
                'description' => __('Full-width hero banner with stunning visual impact', 'chesta-slider'),
                'category' => 'advanced',
                'icon' => 'cover-image',
                'premium' => true,
            ),
            'parallax' => array(
                'name' => __('Parallax', 'chesta-slider'),
                'description' => __('Stunning parallax background effects', 'chesta-slider'),
                'category' => 'advanced',
                'icon' => 'admin-page',
                'premium' => true,
            ),
            'thumbnail' => array(
                'name' => __('Thumbnail Navigation', 'chesta-slider'),
                'description' => __('Slider with thumbnail navigation preview', 'chesta-slider'),
                'category' => 'advanced',
                'icon' => 'grid-view',
                'premium' => true,
            ),
            'center' => array(
                'name' => __('Center Mode', 'chesta-slider'),
                'description' => __('Center active slide with partial view of others', 'chesta-slider'),
                'category' => 'advanced',
                'icon' => 'align-center',
                'premium' => true,
            ),
            'multirow' => array(
                'name' => __('Multi-row', 'chesta-slider'),
                'description' => __('Multiple rows of slides for grid-like layouts', 'chesta-slider'),
                'category' => 'advanced',
                'icon' => 'grid-view',
                'premium' => true,
            ),
            'variable' => array(
                'name' => __('Variable Width', 'chesta-slider'),
                'description' => __('Slides with different widths for dynamic layouts', 'chesta-slider'),
                'category' => 'advanced',
                'icon' => 'editor-expand',
                'premium' => true,
            ),

            // Content-Specific Sliders
            'testimonial' => array(
                'name' => __('Testimonial', 'chesta-slider'),
                'description' => __('Customer testimonials with author information', 'chesta-slider'),
                'category' => 'content',
                'icon' => 'format-quote',
                'premium' => true,
            ),
            'logo' => array(
                'name' => __('Logo Carousel', 'chesta-slider'),
                'description' => __('Client and partner logo showcase', 'chesta-slider'),
                'category' => 'content',
                'icon' => 'admin-users',
                'premium' => true,
            ),
            'product' => array(
                'name' => __('Product Slider', 'chesta-slider'),
                'description' => __('E-commerce product showcase with pricing', 'chesta-slider'),
                'category' => 'content',
                'icon' => 'products',
                'premium' => true,
            ),
            'video' => array(
                'name' => __('Video Slider', 'chesta-slider'),
                'description' => __('Video content with YouTube/Vimeo support', 'chesta-slider'),
                'category' => 'content',
                'icon' => 'video-alt3',
                'premium' => true,
            ),
            'post' => array(
                'name' => __('Post Slider', 'chesta-slider'),
                'description' => __('WordPress posts with excerpts and metadata', 'chesta-slider'),
                'category' => 'content',
                'icon' => 'admin-post',
                'premium' => true,
            ),
            'portfolio' => array(
                'name' => __('Portfolio', 'chesta-slider'),
                'description' => __('Creative portfolio with filtering options', 'chesta-slider'),
                'category' => 'content',
                'icon' => 'portfolio',
                'premium' => true,
            ),

            // Interactive Sliders
            'cube' => array(
                'name' => __('3D Cube', 'chesta-slider'),
                'description' => __('Stunning 3D cube transitions with perspective', 'chesta-slider'),
                'category' => 'interactive',
                'icon' => 'admin-page',
                'premium' => true,
            ),
            'flip' => array(
                'name' => __('Flip', 'chesta-slider'),
                'description' => __('Card flip effects with 3D transformations', 'chesta-slider'),
                'category' => 'interactive',
                'icon' => 'image-flip-horizontal',
                'premium' => true,
            ),
            'coverflow' => array(
                'name' => __('Coverflow', 'chesta-slider'),
                'description' => __('iTunes-style coverflow with reflection effects', 'chesta-slider'),
                'category' => 'interactive',
                'icon' => 'images-alt2',
                'premium' => true,
            ),
            'cards' => array(
                'name' => __('Cards', 'chesta-slider'),
                'description' => __('Card-based layout with stacking effects', 'chesta-slider'),
                'category' => 'interactive',
                'icon' => 'admin-page',
                'premium' => true,
            ),
            'countdown' => array(
                'name' => __('Countdown', 'chesta-slider'),
                'description' => __('Slides with integrated countdown timers', 'chesta-slider'),
                'category' => 'interactive',
                'icon' => 'clock',
                'premium' => true,
            ),
            'cta' => array(
                'name' => __('CTA Slider', 'chesta-slider'),
                'description' => __('Call-to-action focused with conversion optimization', 'chesta-slider'),
                'category' => 'interactive',
                'icon' => 'megaphone',
                'premium' => true,
            ),

            // Specialized Sliders
            'timeline' => array(
                'name' => __('Timeline', 'chesta-slider'),
                'description' => __('Chronological timeline with date markers', 'chesta-slider'),
                'category' => 'specialized',
                'icon' => 'backup',
                'premium' => true,
            ),
            'comparison' => array(
                'name' => __('Before/After', 'chesta-slider'),
                'description' => __('Before and after image comparison slider', 'chesta-slider'),
                'category' => 'specialized',
                'icon' => 'image-flip-horizontal',
                'premium' => true,
            ),
            'pricing' => array(
                'name' => __('Pricing Table', 'chesta-slider'),
                'description' => __('Pricing plans with feature comparisons', 'chesta-slider'),
                'category' => 'specialized',
                'icon' => 'money-alt',
                'premium' => true,
            ),
            'team' => array(
                'name' => __('Team Members', 'chesta-slider'),
                'description' => __('Team member profiles with social links', 'chesta-slider'),
                'category' => 'specialized',
                'icon' => 'groups',
                'premium' => true,
            ),
            'news' => array(
                'name' => __('News Ticker', 'chesta-slider'),
                'description' => __('Breaking news and announcements ticker', 'chesta-slider'),
                'category' => 'specialized',
                'icon' => 'megaphone',
                'premium' => true,
            ),
        );

        // Allow themes and plugins to add custom templates
        $this->templates = apply_filters('chesta_slider_templates', $this->templates);
    }

    /**
     * Get all available templates.
     *
     * @return array Available templates.
     */
    public function get_templates() {
        return $this->templates;
    }

    /**
     * Get templates by category.
     *
     * @param string $category Template category.
     * @return array Templates in category.
     */
    public function get_templates_by_category($category) {
        return array_filter($this->templates, function($template) use ($category) {
            return $template['category'] === $category;
        });
    }

    /**
     * Get template configuration.
     *
     * @param string $template_type Template type.
     * @return array|false Template configuration or false if not found.
     */
    public function get_template_config($template_type) {
        $config_file = CHESTA_SLIDER_PLUGIN_DIR . "templates/{$template_type}/config.json";
        
        if (!file_exists($config_file)) {
            return false;
        }

        $config = file_get_contents($config_file);
        return json_decode($config, true);
    }

    /**
     * Render template.
     *
     * @param string $template_type Template type.
     * @param array $args Template arguments.
     * @return string Rendered template HTML.
     */
    public function render_template($template_type, $args = array()) {
        $template_file = CHESTA_SLIDER_PLUGIN_DIR . "templates/{$template_type}/template.php";
        
        // Check if template directory exists
        $template_dir = dirname($template_file);
        if (!file_exists($template_dir)) {
            wp_mkdir_p($template_dir);
        }
        
        if (!file_exists($template_file)) {
            return $this->render_fallback_template($args);
        }

        // Enqueue template-specific styles
        $this->enqueue_template_styles($template_type);

        // Start output buffering
        ob_start();
        
        // Include template file with error handling
        try {
            include $template_file;
        } catch (Exception $e) {
            ob_end_clean();
            return $this->render_fallback_template($args);
        }
        
        // Get output and clean buffer
        $output = ob_get_clean();
        
        return $output;
    }

    /**
     * Enqueue template-specific styles.
     *
     * @param string $template_type Template type.
     */
    private function enqueue_template_styles($template_type) {
        $style_file = CHESTA_SLIDER_PLUGIN_URL . "templates/{$template_type}/style.css";
        $style_path = CHESTA_SLIDER_PLUGIN_DIR . "templates/{$template_type}/style.css";
        
        if (file_exists($style_path)) {
            wp_enqueue_style(
                "chesta-slider-{$template_type}",
                $style_file,
                array('chesta-slider'),
                $this->version
            );
        }
    }

    /**
     * Render fallback template for unknown types.
     *
     * @param array $args Template arguments.
     * @return string Fallback template HTML.
     */
    private function render_fallback_template($args) {
        // Simple fallback HTML to prevent infinite recursion
        $slider_id = $args['slider_id'] ?? 'chesta-fallback-' . wp_rand();
        $slides = $args['slides'] ?? $this->get_default_demo_data()['slides'];
        
        $html = '<div id="' . esc_attr($slider_id) . '" class="chesta-slider chesta-fallback">';
        $html .= '<div class="chesta-fallback-message">';
        $html .= '<p>' . __('Slider template not found. Please check your slider configuration.', 'chesta-slider') . '</p>';
        $html .= '</div>';
        
        if (!empty($slides)) {
            $html .= '<div class="chesta-fallback-slides">';
            foreach ($slides as $index => $slide) {
                $html .= '<div class="chesta-fallback-slide">';
                if (!empty($slide['image']['url'])) {
                    $html .= '<img src="' . esc_url($slide['image']['url']) . '" alt="' . esc_attr($slide['title'] ?? '') . '">';
                }
                if (!empty($slide['title'])) {
                    $html .= '<h3>' . esc_html($slide['title']) . '</h3>';
                }
                if (!empty($slide['description'])) {
                    $html .= '<p>' . esc_html($slide['description']) . '</p>';
                }
                $html .= '</div>';
            }
            $html .= '</div>';
        }
        
        $html .= '</div>';
        
        return $html;
    }

    /**
     * Get template demo data.
     *
     * @param string $template_type Template type.
     * @return array Demo data.
     */
    public function get_template_demo($template_type) {
        $config = $this->get_template_config($template_type);
        
        if (!$config || !isset($config['demo'])) {
            return $this->get_default_demo_data();
        }

        return $config['demo'];
    }

    /**
     * Get default demo data.
     *
     * @return array Default demo data.
     */
    private function get_default_demo_data() {
        return array(
            'slides' => array(
                array(
                    'title' => __('Demo Slide 1', 'chesta-slider'),
                    'description' => __('This is a demo slide with sample content.', 'chesta-slider'),
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
                    'title' => __('Demo Slide 2', 'chesta-slider'),
                    'description' => __('Another demo slide with different content.', 'chesta-slider'),
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
                    'title' => __('Demo Slide 3', 'chesta-slider'),
                    'description' => __('The third demo slide completes the set.', 'chesta-slider'),
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
            ),
        );
    }

    /**
     * Validate template data.
     *
     * @param string $template_type Template type.
     * @param array $data Template data.
     * @return array Validated data.
     */
    public function validate_template_data($template_type, $data) {
        $config = $this->get_template_config($template_type);
        
        if (!$config) {
            return $data;
        }

        // Apply validation rules from config
        if (isset($config['validation'])) {
            foreach ($config['validation'] as $field => $rules) {
                if (isset($data[$field])) {
                    $data[$field] = $this->apply_validation_rules($data[$field], $rules);
                }
            }
        }

        return $data;
    }

    /**
     * Apply validation rules to field.
     *
     * @param mixed $value Field value.
     * @param array $rules Validation rules.
     * @return mixed Validated value.
     */
    private function apply_validation_rules($value, $rules) {
        // Sanitize based on type
        if (isset($rules['type'])) {
            switch ($rules['type']) {
                case 'string':
                    $value = sanitize_text_field($value);
                    break;
                case 'textarea':
                    $value = sanitize_textarea_field($value);
                    break;
                case 'url':
                    $value = esc_url_raw($value);
                    break;
                case 'email':
                    $value = sanitize_email($value);
                    break;
                case 'number':
                    $value = intval($value);
                    break;
                case 'boolean':
                    $value = (bool) $value;
                    break;
            }
        }

        // Apply min/max constraints
        if (isset($rules['min']) && is_numeric($value)) {
            $value = max($value, $rules['min']);
        }
        
        if (isset($rules['max']) && is_numeric($value)) {
            $value = min($value, $rules['max']);
        }

        return $value;
    }

    /**
     * Get template categories.
     *
     * @return array Template categories.
     */
    public function get_template_categories() {
        return array(
            'basic' => __('Basic Sliders', 'chesta-slider'),
            'advanced' => __('Advanced Sliders', 'chesta-slider'),
            'content' => __('Content-Specific', 'chesta-slider'),
            'interactive' => __('Interactive Sliders', 'chesta-slider'),
            'specialized' => __('Specialized Sliders', 'chesta-slider'),
        );
    }

    /**
     * Check if template exists.
     *
     * @param string $template_type Template type.
     * @return bool True if template exists.
     */
    public function template_exists($template_type) {
        return isset($this->templates[$template_type]);
    }

    /**
     * Get template features.
     *
     * @param string $template_type Template type.
     * @return array Template features.
     */
    public function get_template_features($template_type) {
        $config = $this->get_template_config($template_type);
        
        if (!$config || !isset($config['features'])) {
            return array();
        }

        return $config['features'];
    }

    /**
     * Get template compatibility info.
     *
     * @param string $template_type Template type.
     * @return array Compatibility information.
     */
    public function get_template_compatibility($template_type) {
        $config = $this->get_template_config($template_type);
        
        if (!$config || !isset($config['compatibility'])) {
            return array(
                'gutenberg' => true,
                'elementor' => true,
                'shortcode' => true,
                'widget' => true,
            );
        }

        return $config['compatibility'];
    }
}
