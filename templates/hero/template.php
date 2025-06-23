<?php
/**
 * Hero Slider Template
 * Full-width hero banner slider with stunning visual impact
 *
 * @package ChestaSlider
 * @subpackage Templates/Hero
 */

if (!defined('ABSPATH')) {
    exit;
}

$slider_id = $args['slider_id'] ?? 'chesta-hero-' . wp_rand();
$slides = $args['slides'] ?? [];
$settings = $args['settings'] ?? [];

// Default settings for hero slider
$defaults = [
    'slidesToShow' => 1,
    'slidesToScroll' => 1,
    'autoplay' => true,
    'autoplaySpeed' => 5000,
    'speed' => 1000,
    'infinite' => true,
    'arrows' => true,
    'dots' => true,
    'fade' => true,
    'pauseOnHover' => true,
    'height' => '100vh',
    'overlay' => true,
    'overlayOpacity' => 0.4,
    'textAlign' => 'center',
    'responsive' => [
        ['breakpoint' => 768, 'settings' => ['height' => '70vh']],
        ['breakpoint' => 480, 'settings' => ['height' => '60vh', 'arrows' => false]]
    ]
];

$config = array_merge($defaults, $settings);
$height = $config['height'] ?? '100vh';
?>

<div 
    id="<?php echo esc_attr($slider_id); ?>" 
    class="chesta-slider chesta-hero" 
    data-chesta-slider
    data-chesta-config="<?php echo esc_attr(wp_json_encode($config)); ?>"
    style="height: <?php echo esc_attr($height); ?>;"
>
    <?php foreach ($slides as $index => $slide) : ?>
        <div class="chesta-slide chesta-hero-slide" data-slide="<?php echo esc_attr($index); ?>">
            <div class="chesta-hero-background">
                <?php if (!empty($slide['image'])) : ?>
                    <div class="chesta-hero-image">
                        <img 
                            src="<?php echo esc_url($slide['image']['url']); ?>" 
                            alt="<?php echo esc_attr($slide['image']['alt'] ?? $slide['title'] ?? ''); ?>"
                            <?php if (!empty($slide['image']['srcset'])) : ?>
                                srcset="<?php echo esc_attr($slide['image']['srcset']); ?>"
                            <?php endif; ?>
                            loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
                        >
                    </div>
                <?php endif; ?>

                <?php if (!empty($slide['video'])) : ?>
                    <div class="chesta-hero-video">
                        <video 
                            autoplay 
                            muted 
                            loop 
                            playsinline
                            <?php if ($index !== 0) : ?>preload="none"<?php endif; ?>
                        >
                            <source src="<?php echo esc_url($slide['video']['url']); ?>" type="video/mp4">
                            <?php if (!empty($slide['video']['webm'])) : ?>
                                <source src="<?php echo esc_url($slide['video']['webm']); ?>" type="video/webm">
                            <?php endif; ?>
                        </video>
                    </div>
                <?php endif; ?>

                <?php if ($config['overlay']) : ?>
                    <div 
                        class="chesta-hero-overlay" 
                        style="opacity: <?php echo esc_attr($config['overlayOpacity']); ?>;"
                    ></div>
                <?php endif; ?>
            </div>

            <div class="chesta-hero-content">
                <div class="chesta-hero-container">
                    <div class="chesta-hero-text" style="text-align: <?php echo esc_attr($config['textAlign']); ?>;">
                        <?php if (!empty($slide['subtitle'])) : ?>
                            <div class="chesta-hero-subtitle" data-aos="fade-up" data-aos-delay="100">
                                <?php echo wp_kses_post($slide['subtitle']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($slide['title'])) : ?>
                            <h1 class="chesta-hero-title" data-aos="fade-up" data-aos-delay="200">
                                <?php echo wp_kses_post($slide['title']); ?>
                            </h1>
                        <?php endif; ?>

                        <?php if (!empty($slide['description'])) : ?>
                            <div class="chesta-hero-description" data-aos="fade-up" data-aos-delay="300">
                                <?php echo wp_kses_post($slide['description']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($slide['buttons'])) : ?>
                            <div class="chesta-hero-actions" data-aos="fade-up" data-aos-delay="400">
                                <?php foreach ($slide['buttons'] as $button_index => $button) : ?>
                                    <?php if (!empty($button['text']) && !empty($button['url'])) : ?>
                                        <a 
                                            href="<?php echo esc_url($button['url']); ?>" 
                                            class="chesta-hero-button chesta-btn <?php echo esc_attr($button['style'] ?? 'chesta-btn-primary'); ?>"
                                            <?php if (!empty($button['target'])) : ?>
                                                target="<?php echo esc_attr($button['target']); ?>"
                                            <?php endif; ?>
                                            <?php if (!empty($button['rel'])) : ?>
                                                rel="<?php echo esc_attr($button['rel']); ?>"
                                            <?php endif; ?>
                                        >
                                            <?php if (!empty($button['icon'])) : ?>
                                                <i class="<?php echo esc_attr($button['icon']); ?>"></i>
                                            <?php endif; ?>
                                            <?php echo esc_html($button['text']); ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($slide['features'])) : ?>
                            <div class="chesta-hero-features" data-aos="fade-up" data-aos-delay="500">
                                <?php foreach ($slide['features'] as $feature) : ?>
                                    <div class="chesta-hero-feature">
                                        <?php if (!empty($feature['icon'])) : ?>
                                            <i class="<?php echo esc_attr($feature['icon']); ?>"></i>
                                        <?php endif; ?>
                                        <span><?php echo esc_html($feature['text']); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if (!empty($slide['scroll_indicator'])) : ?>
                <div class="chesta-hero-scroll">
                    <div class="chesta-scroll-indicator">
                        <span><?php echo esc_html($slide['scroll_indicator']); ?></span>
                        <div class="chesta-scroll-arrow"></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
