<?php
/**
 * Chesta Slider Elementor Widget.
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/elementor/widgets
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Chesta Slider Widget.
 *
 * Elementor widget for Chesta Slider.
 */
class Chesta_Slider_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'chesta-slider';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Chesta Slider', 'chesta-slider');
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-slides';
    }

    /**
     * Get widget categories.
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return array('chesta-slider');
    }

    /**
     * Get widget keywords.
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return array('slider', 'carousel', 'gallery', 'slideshow', 'chesta');
    }

    /**
     * Register widget controls.
     */
    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            array(
                'label' => __('Slides', 'chesta-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'slide_type',
            array(
                'label' => __('Slide Type', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => array(
                    'image' => __('Image', 'chesta-slider'),
                    'video' => __('Video', 'chesta-slider'),
                    'content' => __('Custom Content', 'chesta-slider'),
                ),
            )
        );

        $repeater->add_control(
            'image',
            array(
                'label' => __('Choose Image', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ),
                'condition' => array(
                    'slide_type' => 'image',
                ),
            )
        );

        $repeater->add_control(
            'video_url',
            array(
                'label' => __('Video URL', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-video-url.com', 'chesta-slider'),
                'condition' => array(
                    'slide_type' => 'video',
                ),
            )
        );

        $repeater->add_control(
            'title',
            array(
                'label' => __('Title', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Slide Title', 'chesta-slider'),
                'placeholder' => __('Type your title here', 'chesta-slider'),
            )
        );

        $repeater->add_control(
            'description',
            array(
                'label' => __('Description', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Slide description goes here.', 'chesta-slider'),
                'placeholder' => __('Type your description here', 'chesta-slider'),
            )
        );

        $repeater->add_control(
            'button_text',
            array(
                'label' => __('Button Text', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Learn More', 'chesta-slider'),
                'placeholder' => __('Type button text here', 'chesta-slider'),
            )
        );

        $repeater->add_control(
            'button_url',
            array(
                'label' => __('Button URL', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'chesta-slider'),
                'show_external' => true,
                'default' => array(
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ),
            )
        );

        $repeater->add_control(
            'custom_content',
            array(
                'label' => __('Custom Content', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Add your custom content here.', 'chesta-slider'),
                'condition' => array(
                    'slide_type' => 'content',
                ),
            )
        );

        $this->add_control(
            'slides',
            array(
                'label' => __('Slides', 'chesta-slider'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => array(
                    array(
                        'title' => __('Slide #1', 'chesta-slider'),
                        'description' => __('Click edit button to change this text.', 'chesta-slider'),
                    ),
                    array(
                        'title' => __('Slide #2', 'chesta-slider'),
                        'description' => __('Click edit button to change this text.', 'chesta-slider'),
                    ),
                    array(
                        'title' => __('Slide #3', 'chesta-slider'),
                        'description' => __('Click edit button to change this text.', 'chesta-slider'),
                    ),
                ),
                'title_field' => '{{{ title }}}',
            )
        );

        $this->end_controls_section();

        // Slider Settings Section
        $this->start_controls_section(
            'slider_settings_section',
            array(
                'label' => __('Slider Settings', 'chesta-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        // Add common slider controls
        $common_controls = Chesta_Slider_Elementor::get_common_slider_controls();
        foreach ($common_controls as $control_id => $control_args) {
            $this->add_control($control_id, $control_args);
        }

        $this->end_controls_section();

        // Responsive Settings Section
        $this->start_controls_section(
            'responsive_settings_section',
            array(
                'label' => __('Responsive Settings', 'chesta-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        // Add responsive controls
        $responsive_controls = Chesta_Slider_Elementor::get_responsive_controls();
        foreach ($responsive_controls as $control_id => $control_args) {
            $this->add_control($control_id, $control_args);
        }

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            array(
                'label' => __('Style', 'chesta-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        // Add style controls
        $style_controls = Chesta_Slider_Elementor::get_style_controls();
        foreach ($style_controls as $control_id => $control_args) {
            $this->add_control($control_id, $control_args);
        }

        $this->end_controls_section();

        // Typography Section
        $this->start_controls_section(
            'typography_section',
            array(
                'label' => __('Typography', 'chesta-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'name' => 'title_typography',
                'label' => __('Title Typography', 'chesta-slider'),
                'selector' => '{{WRAPPER}} .chesta-slide-title',
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'name' => 'description_typography',
                'label' => __('Description Typography', 'chesta-slider'),
                'selector' => '{{WRAPPER}} .chesta-slide-description',
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'name' => 'button_typography',
                'label' => __('Button Typography', 'chesta-slider'),
                'selector' => '{{WRAPPER}} .chesta-slide-button',
            )
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['slides'])) {
            return;
        }

        // Prepare slider options
        $slider_options = array(
            'type' => $settings['slider_type'],
            'slidesToShow' => intval($settings['slides_to_show']),
            'slidesToScroll' => intval($settings['slides_to_scroll']),
            'autoplay' => $settings['autoplay'] === 'yes',
            'autoplaySpeed' => intval($settings['autoplay_speed']),
            'speed' => intval($settings['speed']),
            'infinite' => $settings['infinite'] === 'yes',
            'arrows' => $settings['arrows'] === 'yes',
            'dots' => $settings['dots'] === 'yes',
            'pauseOnHover' => $settings['pause_on_hover'] === 'yes',
            'centerMode' => $settings['center_mode'] === 'yes',
            'lazyLoad' => $settings['lazy_load'] === 'yes',
            'responsive' => array(
                array(
                    'breakpoint' => 768,
                    'settings' => array(
                        'slidesToShow' => intval($settings['slides_to_show_tablet']),
                        'arrows' => $settings['arrows_tablet'] === 'yes',
                        'dots' => $settings['dots_tablet'] === 'yes',
                    ),
                ),
                array(
                    'breakpoint' => 480,
                    'settings' => array(
                        'slidesToShow' => intval($settings['slides_to_show_mobile']),
                        'arrows' => $settings['arrows_mobile'] === 'yes',
                        'dots' => $settings['dots_mobile'] === 'yes',
                    ),
                ),
            ),
        );

        $slider_id = 'chesta-slider-' . $this->get_id();
        ?>

        <div 
            id="<?php echo esc_attr($slider_id); ?>" 
            class="chesta-slider-wrapper chesta-<?php echo esc_attr($settings['slider_type']); ?>"
            data-chesta-slider
            data-chesta-options="<?php echo esc_attr(wp_json_encode($slider_options)); ?>"
        >
            <?php foreach ($settings['slides'] as $index => $slide) : ?>
                <div class="chesta-slide">
                    <?php $this->render_slide($slide, $index); ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php
    }

    /**
     * Render individual slide.
     *
     * @param array $slide Slide data.
     * @param int $index Slide index.
     */
    private function render_slide($slide, $index) {
        ?>
        <div class="chesta-slide-content">
            <?php if ($slide['slide_type'] === 'image' && !empty($slide['image']['url'])) : ?>
                <div class="chesta-slide-image">
                    <img src="<?php echo esc_url($slide['image']['url']); ?>" alt="<?php echo esc_attr($slide['title']); ?>">
                </div>
            <?php elseif ($slide['slide_type'] === 'video' && !empty($slide['video_url']['url'])) : ?>
                <div class="chesta-slide-video">
                    <?php echo wp_oembed_get($slide['video_url']['url']); ?>
                </div>
            <?php elseif ($slide['slide_type'] === 'content' && !empty($slide['custom_content'])) : ?>
                <div class="chesta-slide-custom-content">
                    <?php echo wp_kses_post($slide['custom_content']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($slide['title']) || !empty($slide['description']) || !empty($slide['button_text'])) : ?>
                <div class="chesta-slide-overlay">
                    <div class="chesta-slide-text">
                        <?php if (!empty($slide['title'])) : ?>
                            <h3 class="chesta-slide-title"><?php echo esc_html($slide['title']); ?></h3>
                        <?php endif; ?>

                        <?php if (!empty($slide['description'])) : ?>
                            <p class="chesta-slide-description"><?php echo esc_html($slide['description']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($slide['button_text']) && !empty($slide['button_url']['url'])) : ?>
                            <a 
                                href="<?php echo esc_url($slide['button_url']['url']); ?>" 
                                class="chesta-slide-button"
                                <?php if ($slide['button_url']['is_external']) : ?>target="_blank"<?php endif; ?>
                                <?php if ($slide['button_url']['nofollow']) : ?>rel="nofollow"<?php endif; ?>
                            >
                                <?php echo esc_html($slide['button_text']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Render widget output in the editor.
     */
    protected function content_template() {
        ?>
        <#
        if ( settings.slides.length ) {
            var sliderOptions = {
                type: settings.slider_type,
                slidesToShow: parseInt(settings.slides_to_show),
                slidesToScroll: parseInt(settings.slides_to_scroll),
                autoplay: settings.autoplay === 'yes',
                autoplaySpeed: parseInt(settings.autoplay_speed),
                speed: parseInt(settings.speed),
                infinite: settings.infinite === 'yes',
                arrows: settings.arrows === 'yes',
                dots: settings.dots === 'yes',
                pauseOnHover: settings.pause_on_hover === 'yes',
                centerMode: settings.center_mode === 'yes',
                lazyLoad: settings.lazy_load === 'yes'
            };

            var sliderId = 'chesta-slider-' + view.getID();
        #>
        
        <div 
            id="{{ sliderId }}" 
            class="chesta-slider-wrapper chesta-{{ settings.slider_type }}"
            data-chesta-slider
            data-chesta-options="{{ JSON.stringify(sliderOptions) }}"
        >
            <# _.each( settings.slides, function( slide, index ) { #>
                <div class="chesta-slide">
                    <div class="chesta-slide-content">
                        <# if ( slide.slide_type === 'image' && slide.image.url ) { #>
                            <div class="chesta-slide-image">
                                <img src="{{ slide.image.url }}" alt="{{ slide.title }}">
                            </div>
                        <# } else if ( slide.slide_type === 'content' && slide.custom_content ) { #>
                            <div class="chesta-slide-custom-content">
                                {{{ slide.custom_content }}}
                            </div>
                        <# } #>

                        <# if ( slide.title || slide.description || slide.button_text ) { #>
                            <div class="chesta-slide-overlay">
                                <div class="chesta-slide-text">
                                    <# if ( slide.title ) { #>
                                        <h3 class="chesta-slide-title">{{{ slide.title }}}</h3>
                                    <# } #>

                                    <# if ( slide.description ) { #>
                                        <p class="chesta-slide-description">{{{ slide.description }}}</p>
                                    <# } #>

                                    <# if ( slide.button_text && slide.button_url.url ) { #>
                                        <a href="{{ slide.button_url.url }}" class="chesta-slide-button">
                                            {{{ slide.button_text }}}
                                        </a>
                                    <# } #>
                                </div>
                            </div>
                        <# } #>
                    </div>
                </div>
            <# }); #>
        </div>
        
        <# } #>
        <?php
    }
}

