<?php
/**
 * Provide a admin area view for the plugin help
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
            <?php _e('This is the legacy help page. Please use the new "Chesta Sliders" → "Support" for comprehensive help and documentation.', 'chesta-slider'); ?>
        </p>
        <p>
            <a href="<?php echo admin_url('admin.php?page=chesta-sliders-support'); ?>" class="button button-primary">
                <?php _e('Go to New Support Page', 'chesta-slider'); ?>
            </a>
        </p>
    </div>

    <div class="chesta-slider-help">
        <h2><?php _e('Help & Documentation', 'chesta-slider'); ?></h2>
        
        <div class="help-section">
            <h3><?php _e('Getting Started', 'chesta-slider'); ?></h3>
            <p><?php _e('Chesta Slider provides 25+ professional slider templates that you can use in two ways:', 'chesta-slider'); ?></p>
            
            <h4><?php _e('Method 1: Gutenberg Blocks', 'chesta-slider'); ?></h4>
            <ol>
                <li><?php _e('Go to any post or page editor', 'chesta-slider'); ?></li>
                <li><?php _e('Click the "+" button to add a new block', 'chesta-slider'); ?></li>
                <li><?php _e('Look for "Chesta Sliders" category', 'chesta-slider'); ?></li>
                <li><?php _e('Choose any slider type and customize it', 'chesta-slider'); ?></li>
            </ol>
            
            <h4><?php _e('Method 2: Shortcodes', 'chesta-slider'); ?></h4>
            <ol>
                <li><?php _e('Copy any shortcode from the shortcodes page', 'chesta-slider'); ?></li>
                <li><?php _e('Paste it in any post, page, or widget', 'chesta-slider'); ?></li>
                <li><?php _e('Customize the parameters as needed', 'chesta-slider'); ?></li>
            </ol>
        </div>
        
        <div class="help-section">
            <h3><?php _e('Common Shortcodes', 'chesta-slider'); ?></h3>
            <div class="shortcode-examples">
                <div class="shortcode-example">
                    <h4><?php _e('Basic Carousel', 'chesta-slider'); ?></h4>
                    <code>[chesta_carousel]</code>
                    <p><?php _e('Creates a basic carousel slider with default settings.', 'chesta-slider'); ?></p>
                </div>
                
                <div class="shortcode-example">
                    <h4><?php _e('Hero Slider with Autoplay', 'chesta-slider'); ?></h4>
                    <code>[chesta_hero autoplay="true" autoplay_speed="5000"]</code>
                    <p><?php _e('Full-width hero slider with 5-second autoplay.', 'chesta-slider'); ?></p>
                </div>
                
                <div class="shortcode-example">
                    <h4><?php _e('Testimonial Slider', 'chesta-slider'); ?></h4>
                    <code>[chesta_testimonial dots="true" arrows="false"]</code>
                    <p><?php _e('Testimonial slider with dots navigation, no arrows.', 'chesta-slider'); ?></p>
                </div>
            </div>
        </div>
        
        <div class="help-section">
            <h3><?php _e('Troubleshooting', 'chesta-slider'); ?></h3>
            
            <h4><?php _e('Slider not showing?', 'chesta-slider'); ?></h4>
            <ul>
                <li><?php _e('Check if the plugin is activated', 'chesta-slider'); ?></li>
                <li><?php _e('Verify the shortcode syntax is correct', 'chesta-slider'); ?></li>
                <li><?php _e('Make sure CSS and JavaScript are enabled in settings', 'chesta-slider'); ?></li>
            </ul>
            
            <h4><?php _e('Gutenberg blocks not appearing?', 'chesta-slider'); ?></h4>
            <ul>
                <li><?php _e('Ensure Gutenberg is enabled on your site', 'chesta-slider'); ?></li>
                <li><?php _e('Check if Gutenberg blocks are enabled in settings', 'chesta-slider'); ?></li>
                <li><?php _e('Try refreshing the page or clearing cache', 'chesta-slider'); ?></li>
            </ul>
            
            <h4><?php _e('Styling issues?', 'chesta-slider'); ?></h4>
            <ul>
                <li><?php _e('Check if your theme conflicts with slider styles', 'chesta-slider'); ?></li>
                <li><?php _e('Try disabling other slider plugins temporarily', 'chesta-slider'); ?></li>
                <li><?php _e('Use browser developer tools to inspect CSS conflicts', 'chesta-slider'); ?></li>
            </ul>
        </div>
        
        <div class="help-section">
            <h3><?php _e('Need More Help?', 'chesta-slider'); ?></h3>
            <p><?php _e('For comprehensive documentation, tutorials, and support:', 'chesta-slider'); ?></p>
            
            <div class="help-links">
                <a href="<?php echo admin_url('admin.php?page=chesta-sliders-docs'); ?>" class="button">
                    <?php _e('Documentation', 'chesta-slider'); ?>
                </a>
                <a href="<?php echo admin_url('admin.php?page=chesta-sliders-tutorials'); ?>" class="button">
                    <?php _e('Video Tutorials', 'chesta-slider'); ?>
                </a>
                <a href="<?php echo admin_url('admin.php?page=chesta-sliders-shortcodes'); ?>" class="button">
                    <?php _e('Shortcode Reference', 'chesta-slider'); ?>
                </a>
                <a href="<?php echo admin_url('admin.php?page=chesta-sliders-support'); ?>" class="button button-primary">
                    <?php _e('Get Support', 'chesta-slider'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.chesta-slider-help .help-section {
    background: #fff;
    border: 1px solid #ccd0d4;
    border-radius: 4px;
    padding: 20px;
    margin: 20px 0;
    box-shadow: 0 1px 1px rgba(0,0,0,.04);
}

.chesta-slider-help .help-section h3 {
    margin-top: 0;
    color: #23282d;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}

.chesta-slider-help .help-section h4 {
    color: #0073aa;
    margin-bottom: 10px;
}

.chesta-slider-help .shortcode-examples {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.chesta-slider-help .shortcode-example {
    background: #f9f9f9;
    padding: 15px;
    border-radius: 4px;
    border-left: 4px solid #0073aa;
}

.chesta-slider-help .shortcode-example h4 {
    margin-top: 0;
    font-size: 14px;
}

.chesta-slider-help .shortcode-example code {
    background: #f1f1f1;
    padding: 6px 12px;
    border-radius: 3px;
    font-family: Consolas, Monaco, monospace;
    font-size: 13px;
    color: #d63384;
    display: block;
    margin: 10px 0;
}

.chesta-slider-help .shortcode-example p {
    margin: 10px 0 0 0;
    color: #555;
    font-size: 13px;
}

.chesta-slider-help .help-links {
    margin-top: 15px;
}

.chesta-slider-help .help-links .button {
    margin-right: 10px;
    margin-bottom: 10px;
}

.chesta-slider-help ul {
    margin-left: 20px;
}

.chesta-slider-help li {
    margin-bottom: 5px;
    color: #555;
}

.chesta-slider-help ol {
    margin-left: 20px;
}

.chesta-slider-help ol li {
    margin-bottom: 8px;
    color: #555;
}
</style>

