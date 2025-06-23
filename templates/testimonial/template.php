<?php
/**
 * Testimonial Slider Template
 * Customer testimonials with author information and ratings
 *
 * @package ChestaSlider
 * @subpackage Templates/Testimonial
 */

if (!defined('ABSPATH')) {
    exit;
}

$slider_id = $args['slider_id'] ?? 'chesta-testimonial-' . wp_rand();
$slides = $args['slides'] ?? [];
$settings = $args['settings'] ?? [];

// Default settings for testimonial slider
$defaults = [
    'slidesToShow' => 1,
    'slidesToScroll' => 1,
    'autoplay' => true,
    'autoplaySpeed' => 5000,
    'speed' => 600,
    'infinite' => true,
    'arrows' => false,
    'dots' => true,
    'fade' => false,
    'centerMode' => true,
    'centerPadding' => '60px',
    'pauseOnHover' => true,
    'responsive' => [
        ['breakpoint' => 768, 'settings' => ['centerPadding' => '40px']],
        ['breakpoint' => 480, 'settings' => ['centerMode' => false, 'centerPadding' => '0px']]
    ]
];

$config = array_merge($defaults, $settings);
?>

<div 
    id="<?php echo esc_attr($slider_id); ?>" 
    class="chesta-slider chesta-testimonial" 
    data-chesta-slider
    data-chesta-config="<?php echo esc_attr(wp_json_encode($config)); ?>"
>
    <?php foreach ($slides as $index => $slide) : ?>
        <div class="chesta-slide chesta-testimonial-slide" data-slide="<?php echo esc_attr($index); ?>">
            <div class="chesta-testimonial-card">
                <?php if (!empty($slide['quote'])) : ?>
                    <div class="chesta-testimonial-quote">
                        <div class="chesta-quote-icon">
                            <svg width="40" height="30" viewBox="0 0 40 30" fill="currentColor">
                                <path d="M0 15.5C0 7.5 4.5 0 12.5 0v5c-4.5 0-7.5 3-7.5 7.5 0 2.5 1.5 4.5 4 5.5v12H0V15.5zm20 0C20 7.5 24.5 0 32.5 0v5c-4.5 0-7.5 3-7.5 7.5 0 2.5 1.5 4.5 4 5.5v12H20V15.5z"/>
                            </svg>
                        </div>
                        <blockquote class="chesta-quote-text">
                            <?php echo wp_kses_post($slide['quote']); ?>
                        </blockquote>
                    </div>
                <?php endif; ?>

                <?php if (!empty($slide['rating'])) : ?>
                    <div class="chesta-testimonial-rating">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <span class="chesta-star <?php echo $i <= $slide['rating'] ? 'chesta-star-filled' : 'chesta-star-empty'; ?>">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </span>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>

                <div class="chesta-testimonial-author">
                    <?php if (!empty($slide['author']['photo'])) : ?>
                        <div class="chesta-author-photo">
                            <img 
                                src="<?php echo esc_url($slide['author']['photo']['url']); ?>" 
                                alt="<?php echo esc_attr($slide['author']['name'] ?? ''); ?>"
                                loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
                            >
                        </div>
                    <?php endif; ?>

                    <div class="chesta-author-info">
                        <?php if (!empty($slide['author']['name'])) : ?>
                            <h4 class="chesta-author-name"><?php echo esc_html($slide['author']['name']); ?></h4>
                        <?php endif; ?>

                        <?php if (!empty($slide['author']['title'])) : ?>
                            <p class="chesta-author-title"><?php echo esc_html($slide['author']['title']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($slide['author']['company'])) : ?>
                            <p class="chesta-author-company">
                                <?php if (!empty($slide['author']['company_url'])) : ?>
                                    <a href="<?php echo esc_url($slide['author']['company_url']); ?>" target="_blank" rel="noopener">
                                        <?php echo esc_html($slide['author']['company']); ?>
                                    </a>
                                <?php else : ?>
                                    <?php echo esc_html($slide['author']['company']); ?>
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>

                        <?php if (!empty($slide['author']['social'])) : ?>
                            <div class="chesta-author-social">
                                <?php foreach ($slide['author']['social'] as $platform => $url) : ?>
                                    <?php if (!empty($url)) : ?>
                                        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" class="chesta-social-link chesta-social-<?php echo esc_attr($platform); ?>">
                                            <span class="screen-reader-text"><?php echo esc_html(ucfirst($platform)); ?></span>
                                            <?php echo $this->get_social_icon($platform); ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (!empty($slide['date'])) : ?>
                    <div class="chesta-testimonial-date">
                        <time datetime="<?php echo esc_attr($slide['date']); ?>">
                            <?php echo esc_html(date_i18n(get_option('date_format'), strtotime($slide['date']))); ?>
                        </time>
                    </div>
                <?php endif; ?>

                <?php if (!empty($slide['verified'])) : ?>
                    <div class="chesta-testimonial-verified">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 6.5V4.5C15 3.4 14.6 2.4 13.9 1.7L12 0L10.1 1.7C9.4 2.4 9 3.4 9 4.5V6.5L3 7V9L9 9.5V11.5C9 12.6 9.4 13.6 10.1 14.3L12 16L13.9 14.3C14.6 13.6 15 12.6 15 11.5V9.5L21 9ZM12 8L15.5 11.5L12 15L8.5 11.5L12 8Z"/>
                        </svg>
                        <span><?php _e('Verified Customer', 'chesta-slider'); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
