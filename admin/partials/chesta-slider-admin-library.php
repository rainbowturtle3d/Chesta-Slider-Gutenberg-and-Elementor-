<?php
/**
 * Provide a admin area view for the plugin slider library
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/admin/partials
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    
    <div class="notice notice-info">
        <p>
            <strong><?php _e('Notice:', 'chesta-slider'); ?></strong>
            <?php _e('This is the legacy library page. Please use the new "Chesta Sliders" dashboard for the complete slider library with all 25+ templates.', 'chesta-slider'); ?>
        </p>
        <p>
            <a href="<?php echo admin_url('admin.php?page=chesta-sliders'); ?>" class="button button-primary">
                <?php _e('Go to New Slider Library', 'chesta-slider'); ?>
            </a>
        </p>
    </div>

    <div class="chesta-slider-library">
        <h2><?php _e('Slider Library', 'chesta-slider'); ?></h2>
        <p><?php _e('Browse through our collection of 25+ professional slider templates.', 'chesta-slider'); ?></p>
        
        <div class="slider-library-grid">
            <div class="slider-template-card">
                <h3><?php _e('Carousel Slider', 'chesta-slider'); ?></h3>
                <p><?php _e('Classic image carousel with navigation arrows and dots.', 'chesta-slider'); ?></p>
                <code>[chesta_carousel]</code>
            </div>
            
            <div class="slider-template-card">
                <h3><?php _e('Hero Slider', 'chesta-slider'); ?></h3>
                <p><?php _e('Full-width hero banner with overlay content.', 'chesta-slider'); ?></p>
                <code>[chesta_hero]</code>
            </div>
            
            <div class="slider-template-card">
                <h3><?php _e('Testimonial Slider', 'chesta-slider'); ?></h3>
                <p><?php _e('Customer testimonials with author information.', 'chesta-slider'); ?></p>
                <code>[chesta_testimonial]</code>
            </div>
            
            <div class="slider-template-card">
                <h3><?php _e('Product Slider', 'chesta-slider'); ?></h3>
                <p><?php _e('E-commerce product showcase with pricing.', 'chesta-slider'); ?></p>
                <code>[chesta_product]</code>
            </div>
            
            <div class="slider-template-card">
                <h3><?php _e('Video Slider', 'chesta-slider'); ?></h3>
                <p><?php _e('Video content slider with play controls.', 'chesta-slider'); ?></p>
                <code>[chesta_video]</code>
            </div>
            
            <div class="slider-template-card">
                <h3><?php _e('3D Cube Slider', 'chesta-slider'); ?></h3>
                <p><?php _e('Interactive 3D cube transitions.', 'chesta-slider'); ?></p>
                <code>[chesta_cube]</code>
            </div>
        </div>
        
        <div class="library-actions">
            <a href="<?php echo admin_url('admin.php?page=chesta-sliders-shortcodes'); ?>" class="button button-primary">
                <?php _e('View All Shortcodes', 'chesta-slider'); ?>
            </a>
            <a href="<?php echo admin_url('admin.php?page=chesta-sliders-docs'); ?>" class="button">
                <?php _e('Documentation', 'chesta-slider'); ?>
            </a>
        </div>
    </div>
</div>

<style>
.chesta-slider-library .slider-library-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

.chesta-slider-library .slider-template-card {
    background: #fff;
    border: 1px solid #ccd0d4;
    border-radius: 4px;
    padding: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,.04);
    transition: box-shadow 0.2s ease;
}

.chesta-slider-library .slider-template-card:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,.1);
}

.chesta-slider-library .slider-template-card h3 {
    margin-top: 0;
    color: #23282d;
    font-size: 16px;
}

.chesta-slider-library .slider-template-card p {
    color: #555;
    margin-bottom: 15px;
}

.chesta-slider-library .slider-template-card code {
    background: #f1f1f1;
    padding: 6px 12px;
    border-radius: 3px;
    font-family: Consolas, Monaco, monospace;
    font-size: 13px;
    color: #d63384;
    display: block;
    text-align: center;
}

.chesta-slider-library .library-actions {
    text-align: center;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #ccd0d4;
}

.chesta-slider-library .library-actions .button {
    margin: 0 10px;
}
</style>

