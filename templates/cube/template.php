<?php
/**
 * 3D Cube Slider Template
 * Stunning 3D cube transitions with perspective effects
 *
 * @package ChestaSlider
 * @subpackage Templates/Cube
 */

if (!defined('ABSPATH')) {
    exit;
}

$slider_id = $args['slider_id'] ?? 'chesta-cube-' . wp_rand();
$slides = $args['slides'] ?? [];
$settings = $args['settings'] ?? [];

// Default settings for 3D cube slider
$defaults = [
    'slidesToShow' => 1,
    'slidesToScroll' => 1,
    'autoplay' => false,
    'autoplaySpeed' => 4000,
    'speed' => 800,
    'infinite' => true,
    'arrows' => true,
    'dots' => true,
    'effect' => 'cube',
    'cubeEffect' => [
        'shadow' => true,
        'slideShadows' => true,
        'shadowOffset' => 20,
        'shadowScale' => 0.94
    ],
    'pauseOnHover' => true,
    'height' => '500px',
    'responsive' => [
        ['breakpoint' => 768, 'settings' => ['height' => '400px']],
        ['breakpoint' => 480, 'settings' => ['height' => '300px', 'arrows' => false]]
    ]
];

$config = array_merge($defaults, $settings);
$height = $config['height'] ?? '500px';
?>

<div 
    id="<?php echo esc_attr($slider_id); ?>" 
    class="chesta-slider chesta-cube" 
    data-chesta-slider
    data-chesta-config="<?php echo esc_attr(wp_json_encode($config)); ?>"
    style="height: <?php echo esc_attr($height); ?>;"
>
    <div class="chesta-cube-container">
        <div class="chesta-cube-wrapper">
            <?php foreach ($slides as $index => $slide) : ?>
                <div class="chesta-slide chesta-cube-slide" data-slide="<?php echo esc_attr($index); ?>">
                    <div class="chesta-cube-face">
                        <?php if (!empty($slide['image'])) : ?>
                            <div class="chesta-cube-image">
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
                            <div class="chesta-cube-content">
                                <div class="chesta-cube-text">
                                    <?php if (!empty($slide['title'])) : ?>
                                        <h3 class="chesta-cube-title"><?php echo wp_kses_post($slide['title']); ?></h3>
                                    <?php endif; ?>

                                    <?php if (!empty($slide['description'])) : ?>
                                        <div class="chesta-cube-description">
                                            <?php echo wp_kses_post($slide['description']); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($slide['button']['text']) && !empty($slide['button']['url'])) : ?>
                                        <div class="chesta-cube-actions">
                                            <a 
                                                href="<?php echo esc_url($slide['button']['url']); ?>" 
                                                class="chesta-cube-button chesta-btn chesta-btn-primary"
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

                        <?php if (!empty($slide['badge'])) : ?>
                            <div class="chesta-cube-badge">
                                <?php echo esc_html($slide['badge']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <?php if ($config['cubeEffect']['shadow']) : ?>
            <div class="chesta-cube-shadow"></div>
        <?php endif; ?>
    </div>
</div>
