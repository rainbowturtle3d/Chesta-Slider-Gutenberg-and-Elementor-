<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
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
            <?php _e('This is the legacy admin page. Please use the new "Chesta Sliders" menu for the complete admin interface with all features.', 'chesta-slider'); ?>
        </p>
        <p>
            <a href="<?php echo admin_url('admin.php?page=chesta-sliders'); ?>" class="button button-primary">
                <?php _e('Go to New Admin Dashboard', 'chesta-slider'); ?>
            </a>
        </p>
    </div>

    <div class="chesta-slider-legacy-admin">
        <h2><?php _e('Chesta Slider Plugin', 'chesta-slider'); ?></h2>
        
        <div class="card">
            <h3><?php _e('Quick Start', 'chesta-slider'); ?></h3>
            <p><?php _e('Get started with Chesta Sliders using these methods:', 'chesta-slider'); ?></p>
            
            <h4><?php _e('1. Using Gutenberg Blocks', 'chesta-slider'); ?></h4>
            <p><?php _e('Add any of our 25+ slider blocks directly in the Gutenberg editor. Look for the "Chesta Sliders" category in the block inserter.', 'chesta-slider'); ?></p>
            
            <h4><?php _e('2. Using Shortcodes', 'chesta-slider'); ?></h4>
            <p><?php _e('Use shortcodes in any post, page, or widget:', 'chesta-slider'); ?></p>
            <code>[chesta_slider type="carousel"]</code><br>
            <code>[chesta_hero autoplay="true"]</code><br>
            <code>[chesta_testimonial dots="true"]</code>
            
            <p>
                <a href="<?php echo admin_url('admin.php?page=chesta-sliders-shortcodes'); ?>" class="button">
                    <?php _e('View All Shortcodes', 'chesta-slider'); ?>
                </a>
            </p>
        </div>

        <div class="card">
            <h3><?php _e('Available Slider Types', 'chesta-slider'); ?></h3>
            <div class="slider-types-list">
                <div class="slider-type-category">
                    <h4><?php _e('Basic Sliders', 'chesta-slider'); ?></h4>
                    <ul>
                        <li><?php _e('Carousel - Classic image carousel', 'chesta-slider'); ?></li>
                        <li><?php _e('Fade - Smooth fade transitions', 'chesta-slider'); ?></li>
                        <li><?php _e('Vertical - Vertical sliding', 'chesta-slider'); ?></li>
                        <li><?php _e('Gallery - Image gallery slider', 'chesta-slider'); ?></li>
                    </ul>
                </div>
                
                <div class="slider-type-category">
                    <h4><?php _e('Advanced Sliders', 'chesta-slider'); ?></h4>
                    <ul>
                        <li><?php _e('Hero - Full-width hero banners', 'chesta-slider'); ?></li>
                        <li><?php _e('Parallax - Parallax background effects', 'chesta-slider'); ?></li>
                        <li><?php _e('Thumbnail - Thumbnail navigation', 'chesta-slider'); ?></li>
                        <li><?php _e('Center Mode - Centered slides', 'chesta-slider'); ?></li>
                    </ul>
                </div>
                
                <div class="slider-type-category">
                    <h4><?php _e('Content Sliders', 'chesta-slider'); ?></h4>
                    <ul>
                        <li><?php _e('Testimonial - Customer testimonials', 'chesta-slider'); ?></li>
                        <li><?php _e('Product - E-commerce products', 'chesta-slider'); ?></li>
                        <li><?php _e('Video - Video content slider', 'chesta-slider'); ?></li>
                        <li><?php _e('Post - Blog post slider', 'chesta-slider'); ?></li>
                    </ul>
                </div>
                
                <div class="slider-type-category">
                    <h4><?php _e('Interactive Sliders', 'chesta-slider'); ?></h4>
                    <ul>
                        <li><?php _e('3D Cube - 3D cube transitions', 'chesta-slider'); ?></li>
                        <li><?php _e('Flip - Card flip effects', 'chesta-slider'); ?></li>
                        <li><?php _e('Coverflow - Cover flow style', 'chesta-slider'); ?></li>
                        <li><?php _e('Countdown - Countdown timers', 'chesta-slider'); ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card">
            <h3><?php _e('Documentation & Support', 'chesta-slider'); ?></h3>
            <p><?php _e('Need help? Check out our comprehensive documentation and support resources.', 'chesta-slider'); ?></p>
            
            <p>
                <a href="<?php echo admin_url('admin.php?page=chesta-sliders-docs'); ?>" class="button">
                    <?php _e('Documentation', 'chesta-slider'); ?>
                </a>
                <a href="<?php echo admin_url('admin.php?page=chesta-sliders-tutorials'); ?>" class="button">
                    <?php _e('Tutorials', 'chesta-slider'); ?>
                </a>
                <a href="<?php echo admin_url('admin.php?page=chesta-sliders-support'); ?>" class="button">
                    <?php _e('Support', 'chesta-slider'); ?>
                </a>
            </p>
        </div>
    </div>
</div>

<style>
.chesta-slider-legacy-admin .card {
    background: #fff;
    border: 1px solid #ccd0d4;
    border-radius: 4px;
    padding: 20px;
    margin: 20px 0;
    box-shadow: 0 1px 1px rgba(0,0,0,.04);
}

.chesta-slider-legacy-admin .card h3 {
    margin-top: 0;
    color: #23282d;
}

.chesta-slider-legacy-admin .card h4 {
    color: #23282d;
    margin-bottom: 8px;
}

.chesta-slider-legacy-admin .slider-types-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 15px;
}

.chesta-slider-legacy-admin .slider-type-category {
    background: #f9f9f9;
    padding: 15px;
    border-radius: 4px;
    border-left: 4px solid #0073aa;
}

.chesta-slider-legacy-admin .slider-type-category h4 {
    margin-top: 0;
    color: #0073aa;
}

.chesta-slider-legacy-admin .slider-type-category ul {
    margin: 0;
    padding-left: 20px;
}

.chesta-slider-legacy-admin .slider-type-category li {
    margin-bottom: 5px;
    color: #555;
}

.chesta-slider-legacy-admin code {
    background: #f1f1f1;
    padding: 4px 8px;
    border-radius: 3px;
    font-family: Consolas, Monaco, monospace;
    font-size: 13px;
    color: #d63384;
    margin: 2px;
    display: inline-block;
}
</style>

