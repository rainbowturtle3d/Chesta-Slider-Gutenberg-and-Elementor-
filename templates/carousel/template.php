<?php
/**
 * Carousel Slider Template
 * Classic horizontal carousel with smooth transitions and premium customization
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
    'arrowType' => 'default',
    'arrowSize' => 50,
    'arrowColor' => '#ffffff',
    'arrowBackground' => 'rgba(0,0,0,0.5)',
    'arrowPosition' => 'sides',
    'arrowFollowMouse' => false,
    'dots' => true,
    'dotsType' => 'dots',
    'dotsPosition' => 'bottom-center',
    'dotsColor' => '#cccccc',
    'dotsActiveColor' => '#007cba',
    'dotsSize' => 12,
    'dotsGap' => 8,
    'transitionMode' => 'slide',
    'easing' => 'ease',
    'height' => ['desktop' => '400px', 'tablet' => '350px', 'mobile' => '300px'],
    'margin' => ['top' => '0px', 'right' => '0px', 'bottom' => '20px', 'left' => '0px'],
    'padding' => ['top' => '0px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px'],
    'innerGap' => 0,
    'contentPosition' => 'bottom-left',
    'titleAnimation' => 'fadeInUp',
    'titleDelay' => 200,
    'titleDuration' => 600,
    'descriptionAnimation' => 'fadeInUp',
    'descriptionDelay' => 400,
    'descriptionDuration' => 600,
    'buttonAnimation' => 'fadeInUp',
    'buttonDelay' => 600,
    'buttonDuration' => 600,
    'mouseWheel' => false,
    'mouseDrag' => true,
    'touchSwipe' => true,
    'keyboard' => true,
    'pauseOnHover' => true,
    'pauseOnFocus' => true,
    'centerMode' => false,
    'centerPadding' => 60,
    'variableWidth' => false,
    'lazyLoad' => true,
    'preloadImages' => 1,
    'accessibility' => true,
    'rtl' => false,
    'responsive' => [
        ['breakpoint' => 768, 'settings' => ['slidesToShow' => 1]],
        ['breakpoint' => 480, 'settings' => ['slidesToShow' => 1]]
    ]
];

$config = array_merge($defaults, $settings);

// Generate dynamic CSS variables
$css_vars = [
    '--chesta-arrow-size' => $config['arrowSize'] . 'px',
    '--chesta-arrow-color' => $config['arrowColor'],
    '--chesta-arrow-background' => $config['arrowBackground'],
    '--chesta-dots-color' => $config['dotsColor'],
    '--chesta-dots-active-color' => $config['dotsActiveColor'],
    '--chesta-dots-size' => $config['dotsSize'] . 'px',
    '--chesta-dots-gap' => $config['dotsGap'] . 'px',
    '--chesta-inner-gap' => $config['innerGap'] . 'px',
    '--chesta-height-desktop' => $config['height']['desktop'],
    '--chesta-height-tablet' => $config['height']['tablet'],
    '--chesta-height-mobile' => $config['height']['mobile'],
    '--chesta-margin-top' => $config['margin']['top'],
    '--chesta-margin-right' => $config['margin']['right'],
    '--chesta-margin-bottom' => $config['margin']['bottom'],
    '--chesta-margin-left' => $config['margin']['left'],
    '--chesta-padding-top' => $config['padding']['top'],
    '--chesta-padding-right' => $config['padding']['right'],
    '--chesta-padding-bottom' => $config['padding']['bottom'],
    '--chesta-padding-left' => $config['padding']['left'],
    '--chesta-title-delay' => $config['titleDelay'] . 'ms',
    '--chesta-title-duration' => $config['titleDuration'] . 'ms',
    '--chesta-description-delay' => $config['descriptionDelay'] . 'ms',
    '--chesta-description-duration' => $config['descriptionDuration'] . 'ms',
    '--chesta-button-delay' => $config['buttonDelay'] . 'ms',
    '--chesta-button-duration' => $config['buttonDuration'] . 'ms',
];

$css_vars_string = '';
foreach ($css_vars as $var => $value) {
    $css_vars_string .= $var . ': ' . $value . '; ';
}
?>

<div 
    id="<?php echo esc_attr($slider_id); ?>" 
    class="chesta-slider chesta-carousel chesta-<?php echo esc_attr($config['arrowType']); ?>-arrows chesta-<?php echo esc_attr($config['dotsType']); ?>-dots chesta-<?php echo esc_attr($config['dotsPosition']); ?> chesta-content-<?php echo esc_attr($config['contentPosition']); ?> <?php echo $config['rtl'] ? 'chesta-rtl' : ''; ?> <?php echo $config['centerMode'] ? 'chesta-center-mode' : ''; ?> <?php echo $config['variableWidth'] ? 'chesta-variable-width' : ''; ?>"
    data-chesta-slider
    data-chesta-config="<?php echo esc_attr(wp_json_encode($config)); ?>"
    style="<?php echo esc_attr($css_vars_string); ?>"
    <?php if ($config['accessibility']) : ?>
        role="region" 
        aria-label="<?php esc_attr_e('Image carousel', 'chesta-slider'); ?>"
        aria-roledescription="carousel"
    <?php endif; ?>
>
    <div class="chesta-carousel-container">
        <?php foreach ($slides as $index => $slide) : ?>
            <div 
                class="chesta-slide chesta-carousel-slide" 
                data-slide="<?php echo esc_attr($index); ?>"
                <?php if ($config['accessibility']) : ?>
                    role="group" 
                    aria-roledescription="slide"
                    aria-label="<?php echo esc_attr(sprintf(__('Slide %d of %d', 'chesta-slider'), $index + 1, count($slides))); ?>"
                <?php endif; ?>
            >
                <div class="chesta-slide-content">
                    <?php if (!empty($slide['image'])) : ?>
                        <div class="chesta-slide-image">
                            <img 
                                src="<?php echo esc_url($slide['image']['url']); ?>" 
                                alt="<?php echo esc_attr($slide['image']['alt'] ?? $slide['title'] ?? ''); ?>"
                                <?php if (!empty($slide['image']['srcset'])) : ?>
                                    srcset="<?php echo esc_attr($slide['image']['srcset']); ?>"
                                <?php endif; ?>
                                loading="<?php echo $index === 0 && !$config['lazyLoad'] ? 'eager' : 'lazy'; ?>"
                                <?php if ($config['lazyLoad'] && $index > $config['preloadImages']) : ?>
                                    data-src="<?php echo esc_url($slide['image']['url']); ?>"
                                    class="chesta-lazy"
                                <?php endif; ?>
                            >
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($slide['video'])) : ?>
                        <div class="chesta-slide-video">
                            <?php if (strpos($slide['video']['url'], 'youtube.com') !== false || strpos($slide['video']['url'], 'youtu.be') !== false) : ?>
                                <iframe 
                                    src="<?php echo esc_url($slide['video']['url']); ?>" 
                                    frameborder="0" 
                                    allowfullscreen
                                    loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
                                ></iframe>
                            <?php elseif (strpos($slide['video']['url'], 'vimeo.com') !== false) : ?>
                                <iframe 
                                    src="<?php echo esc_url($slide['video']['url']); ?>" 
                                    frameborder="0" 
                                    allowfullscreen
                                    loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
                                ></iframe>
                            <?php else : ?>
                                <video 
                                    controls 
                                    <?php if ($index !== 0) : ?>preload="none"<?php endif; ?>
                                >
                                    <source src="<?php echo esc_url($slide['video']['url']); ?>" type="video/mp4">
                                    <?php _e('Your browser does not support the video tag.', 'chesta-slider'); ?>
                                </video>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($slide['title']) || !empty($slide['description']) || !empty($slide['button'])) : ?>
                        <div class="chesta-slide-overlay">
                            <div class="chesta-slide-text">
                                <?php if (!empty($slide['title'])) : ?>
                                    <h3 
                                        class="chesta-slide-title chesta-animate-<?php echo esc_attr($config['titleAnimation']); ?>" 
                                        data-animation="<?php echo esc_attr($config['titleAnimation']); ?>"
                                        data-delay="<?php echo esc_attr($config['titleDelay']); ?>"
                                        data-duration="<?php echo esc_attr($config['titleDuration']); ?>"
                                    >
                                        <?php echo wp_kses_post($slide['title']); ?>
                                    </h3>
                                <?php endif; ?>

                                <?php if (!empty($slide['description'])) : ?>
                                    <div 
                                        class="chesta-slide-description chesta-animate-<?php echo esc_attr($config['descriptionAnimation']); ?>"
                                        data-animation="<?php echo esc_attr($config['descriptionAnimation']); ?>"
                                        data-delay="<?php echo esc_attr($config['descriptionDelay']); ?>"
                                        data-duration="<?php echo esc_attr($config['descriptionDuration']); ?>"
                                    >
                                        <?php echo wp_kses_post($slide['description']); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($slide['button']['text']) && !empty($slide['button']['url'])) : ?>
                                    <div 
                                        class="chesta-slide-actions chesta-animate-<?php echo esc_attr($config['buttonAnimation']); ?>"
                                        data-animation="<?php echo esc_attr($config['buttonAnimation']); ?>"
                                        data-delay="<?php echo esc_attr($config['buttonDelay']); ?>"
                                        data-duration="<?php echo esc_attr($config['buttonDuration']); ?>"
                                    >
                                        <a 
                                            href="<?php echo esc_url($slide['button']['url']); ?>" 
                                            class="chesta-slide-button chesta-btn chesta-btn-primary"
                                            <?php if (!empty($slide['button']['target'])) : ?>
                                                target="<?php echo esc_attr($slide['button']['target']); ?>"
                                            <?php endif; ?>
                                            <?php if (!empty($slide['button']['rel'])) : ?>
                                                rel="<?php echo esc_attr($slide['button']['rel']); ?>"
                                            <?php endif; ?>
                                            <?php if ($config['accessibility']) : ?>
                                                aria-label="<?php echo esc_attr($slide['button']['text'] . ' - ' . $slide['title']); ?>"
                                            <?php endif; ?>
                                        >
                                            <?php if (!empty($slide['button']['icon'])) : ?>
                                                <i class="<?php echo esc_attr($slide['button']['icon']); ?>" aria-hidden="true"></i>
                                            <?php endif; ?>
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

                    <?php if (!empty($slide['badge'])) : ?>
                        <div class="chesta-slide-badge">
                            <?php echo esc_html($slide['badge']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($config['arrows'] && count($slides) > 1) : ?>
        <div class="chesta-carousel-navigation">
            <button 
                type="button" 
                class="chesta-arrow chesta-prev chesta-arrow-<?php echo esc_attr($config['arrowType']); ?>"
                <?php if ($config['accessibility']) : ?>
                    aria-label="<?php esc_attr_e('Previous slide', 'chesta-slider'); ?>"
                <?php endif; ?>
                <?php if ($config['arrowFollowMouse']) : ?>
                    data-follow-mouse="true"
                <?php endif; ?>
            >
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                </svg>
            </button>
            <button 
                type="button" 
                class="chesta-arrow chesta-next chesta-arrow-<?php echo esc_attr($config['arrowType']); ?>"
                <?php if ($config['accessibility']) : ?>
                    aria-label="<?php esc_attr_e('Next slide', 'chesta-slider'); ?>"
                <?php endif; ?>
                <?php if ($config['arrowFollowMouse']) : ?>
                    data-follow-mouse="true"
                <?php endif; ?>
            >
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                </svg>
            </button>
        </div>
    <?php endif; ?>

    <?php if ($config['dots'] && count($slides) > 1) : ?>
        <div class="chesta-carousel-indicators chesta-<?php echo esc_attr($config['dotsType']); ?>-indicators">
            <?php if ($config['dotsType'] === 'progress') : ?>
                <div class="chesta-progress-bar">
                    <div class="chesta-progress-fill"></div>
                </div>
            <?php else : ?>
                <ul class="chesta-dots" <?php if ($config['accessibility']) : ?>role="tablist"<?php endif; ?>>
                    <?php foreach ($slides as $index => $slide) : ?>
                        <li>
                            <button 
                                type="button" 
                                class="chesta-dot <?php echo $index === 0 ? 'chesta-active' : ''; ?>"
                                data-slide="<?php echo esc_attr($index); ?>"
                                <?php if ($config['accessibility']) : ?>
                                    role="tab"
                                    aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                                    aria-label="<?php echo esc_attr(sprintf(__('Go to slide %d', 'chesta-slider'), $index + 1)); ?>"
                                    aria-controls="<?php echo esc_attr($slider_id . '-slide-' . $index); ?>"
                                <?php endif; ?>
                            >
                                <?php if ($config['dotsType'] === 'numbers') : ?>
                                    <?php echo $index + 1; ?>
                                <?php elseif ($config['dotsType'] === 'thumbnails' && !empty($slide['image'])) : ?>
                                    <img src="<?php echo esc_url($slide['image']['url']); ?>" alt="<?php echo esc_attr($slide['title'] ?? ''); ?>">
                                <?php else : ?>
                                    <span class="screen-reader-text"><?php echo esc_html(sprintf(__('Slide %d', 'chesta-slider'), $index + 1)); ?></span>
                                <?php endif; ?>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
