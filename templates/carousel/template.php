<?php
/**
 * Carousel Slider Template
 * Classic horizontal carousel with smooth transitions
 *
 * @package ChestaSlider
 * @subpackage Templates/Carousel
 */

if (!defined('ABSPATH')) {
    exit;
}

$slider_id = $args['slider_id'] ?? 'chesta-carousel-' . wp_rand();
$slides = $args['slides'] ?? [];
$settings = $args['settings'] ?? [];

// Default settings for carousel
$defaults = [
    'slidesToShow' => 1,
    'slidesToScroll' => 1,
    'autoplay' => false,
    'autoplaySpeed' => 3000,
    'speed' => 500,
    'infinite' => true,
    'arrows' => true,
    'dots' => true,
    'fade' => false,
    'pauseOnHover' => true,
    'responsive' => [
        ['breakpoint' => 768, 'settings' => ['slidesToShow' => 1]],
        ['breakpoint' => 480, 'settings' => ['slidesToShow' => 1]]
    ]
];

$config = array_merge($defaults, $settings);
?>

<div 
    id="<?php echo esc_attr($slider_id); ?>" 
    class="chesta-slider chesta-carousel" 
    data-chesta-slider
    data-chesta-config="<?php echo esc_attr(wp_json_encode($config)); ?>"
>
    <?php foreach ($slides as $index => $slide) : ?>
        <div class="chesta-slide chesta-carousel-slide" data-slide="<?php echo esc_attr($index); ?>">
            <div class="chesta-slide-content">
                <?php if (!empty($slide['image'])) : ?>
                    <div class="chesta-slide-image">
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

                <?php if (!empty($slide['title']) || !empty($slide['description']) || !empty($slide['button'])) : ?>
                    <div class="chesta-slide-overlay">
                        <div class="chesta-slide-text">
                            <?php if (!empty($slide['title'])) : ?>
                                <h3 class="chesta-slide-title"><?php echo wp_kses_post($slide['title']); ?></h3>
                            <?php endif; ?>

                            <?php if (!empty($slide['description'])) : ?>
                                <div class="chesta-slide-description">
                                    <?php echo wp_kses_post($slide['description']); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($slide['button']['text']) && !empty($slide['button']['url'])) : ?>
                                <div class="chesta-slide-actions">
                                    <a 
                                        href="<?php echo esc_url($slide['button']['url']); ?>" 
                                        class="chesta-slide-button chesta-btn chesta-btn-primary"
                                        <?php if (!empty($slide['button']['target'])) : ?>
                                            target="<?php echo esc_attr($slide['button']['target']); ?>"
                                        <?php endif; ?>
                                        <?php if (!empty($slide['button']['rel'])) : ?>
                                            rel="<?php echo esc_attr($slide['button']['rel']); ?>"
                                        <?php endif; ?>
                                    >
                                        <?php echo esc_html($slide['button']['text']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($slide['custom_content'])) : ?>
                    <div class="chesta-slide-custom">
                        <?php echo wp_kses_post($slide['custom_content']); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
