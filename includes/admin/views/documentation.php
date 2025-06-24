<?php
/**
 * Admin Documentation View
 * Documentation page for Chesta Slider
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/admin/views
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap chesta-slider-admin">
    <div class="chesta-slider-header">
        <div class="chesta-slider-header-content">
            <div class="chesta-slider-logo">
                <h1>
                    <span class="dashicons dashicons-book-alt"></span>
                    <?php _e('Documentation', 'chesta-slider'); ?>
                </h1>
                <p class="chesta-slider-tagline">
                    <?php _e('Complete guide to using Chesta Slider', 'chesta-slider'); ?>
                </p>
            </div>
        </div>
    </div>

    <div class="chesta-slider-content">
        <div class="documentation-container">
            
            <!-- Quick Start Guide -->
            <div class="doc-section">
                <h2><span class="dashicons dashicons-rocket"></span> <?php _e('Quick Start Guide', 'chesta-slider'); ?></h2>
                <div class="doc-content">
                    <ol>
                        <li><strong><?php _e('Installation:', 'chesta-slider'); ?></strong> <?php _e('Upload and activate the Chesta Slider plugin', 'chesta-slider'); ?></li>
                        <li><strong><?php _e('Create Slider:', 'chesta-slider'); ?></strong> <?php _e('Go to any post/page and add a Chesta Slider block', 'chesta-slider'); ?></li>
                        <li><strong><?php _e('Choose Type:', 'chesta-slider'); ?></strong> <?php _e('Select from 25+ available slider types', 'chesta-slider'); ?></li>
                        <li><strong><?php _e('Customize:', 'chesta-slider'); ?></strong> <?php _e('Configure settings, add content, and style your slider', 'chesta-slider'); ?></li>
                        <li><strong><?php _e('Publish:', 'chesta-slider'); ?></strong> <?php _e('Save and view your responsive slider', 'chesta-slider'); ?></li>
                    </ol>
                </div>
            </div>

            <!-- Installation Guide -->
            <div class="doc-section">
                <h2><span class="dashicons dashicons-download"></span> <?php _e('Installation', 'chesta-slider'); ?></h2>
                <div class="doc-content">
                    <h3><?php _e('Automatic Installation', 'chesta-slider'); ?></h3>
                    <ol>
                        <li><?php _e('Log in to your WordPress admin dashboard', 'chesta-slider'); ?></li>
                        <li><?php _e('Navigate to Plugins → Add New', 'chesta-slider'); ?></li>
                        <li><?php _e('Search for "Chesta Slider"', 'chesta-slider'); ?></li>
                        <li><?php _e('Click "Install Now" and then "Activate"', 'chesta-slider'); ?></li>
                    </ol>

                    <h3><?php _e('Manual Installation', 'chesta-slider'); ?></h3>
                    <ol>
                        <li><?php _e('Download the plugin zip file', 'chesta-slider'); ?></li>
                        <li><?php _e('Go to Plugins → Add New → Upload Plugin', 'chesta-slider'); ?></li>
                        <li><?php _e('Choose the zip file and click "Install Now"', 'chesta-slider'); ?></li>
                        <li><?php _e('Activate the plugin', 'chesta-slider'); ?></li>
                    </ol>
                </div>
            </div>

            <!-- Using Gutenberg Blocks -->
            <div class="doc-section">
                <h2><span class="dashicons dashicons-editor-table"></span> <?php _e('Using Gutenberg Blocks', 'chesta-slider'); ?></h2>
                <div class="doc-content">
                    <h3><?php _e('Adding a Slider Block', 'chesta-slider'); ?></h3>
                    <ol>
                        <li><?php _e('Edit any post or page', 'chesta-slider'); ?></li>
                        <li><?php _e('Click the "+" button to add a new block', 'chesta-slider'); ?></li>
                        <li><?php _e('Search for "Chesta Slider" or find it in the Media category', 'chesta-slider'); ?></li>
                        <li><?php _e('Select your desired slider type', 'chesta-slider'); ?></li>
                        <li><?php _e('Configure settings in the sidebar', 'chesta-slider'); ?></li>
                    </ol>

                    <h3><?php _e('Block Settings', 'chesta-slider'); ?></h3>
                    <ul>
                        <li><strong><?php _e('Slider Type:', 'chesta-slider'); ?></strong> <?php _e('Choose from 25+ available types', 'chesta-slider'); ?></li>
                        <li><strong><?php _e('Dimensions:', 'chesta-slider'); ?></strong> <?php _e('Set height, width, margin, padding', 'chesta-slider'); ?></li>
                        <li><strong><?php _e('Animation:', 'chesta-slider'); ?></strong> <?php _e('Configure transition effects and timing', 'chesta-slider'); ?></li>
                        <li><strong><?php _e('Navigation:', 'chesta-slider'); ?></strong> <?php _e('Enable/disable arrows, dots, keyboard controls', 'chesta-slider'); ?></li>
                        <li><strong><?php _e('Autoplay:', 'chesta-slider'); ?></strong> <?php _e('Set automatic sliding with pause on hover', 'chesta-slider'); ?></li>
                    </ul>
                </div>
            </div>

            <!-- Elementor Integration -->
            <div class="doc-section">
                <h2><span class="dashicons dashicons-layout"></span> <?php _e('Elementor Integration', 'chesta-slider'); ?></h2>
                <div class="doc-content">
                    <p><?php _e('Chesta Slider seamlessly integrates with Elementor themes and inherits your theme styles automatically.', 'chesta-slider'); ?></p>
                    
                    <h3><?php _e('Using with Elementor', 'chesta-slider'); ?></h3>
                    <ol>
                        <li><?php _e('Edit your page with Elementor', 'chesta-slider'); ?></li>
                        <li><?php _e('Add a Shortcode widget', 'chesta-slider'); ?></li>
                        <li><?php _e('Use Chesta Slider shortcodes (see Shortcodes page)', 'chesta-slider'); ?></li>
                        <li><?php _e('Or add HTML widget and insert Gutenberg block', 'chesta-slider'); ?></li>
                    </ol>

                    <h3><?php _e('Theme Compatibility', 'chesta-slider'); ?></h3>
                    <ul>
                        <li><?php _e('Automatically inherits theme fonts and colors', 'chesta-slider'); ?></li>
                        <li><?php _e('Responsive design matches your theme breakpoints', 'chesta-slider'); ?></li>
                        <li><?php _e('No additional styling required', 'chesta-slider'); ?></li>
                    </ul>
                </div>
            </div>

            <!-- Customization -->
            <div class="doc-section">
                <h2><span class="dashicons dashicons-admin-customizer"></span> <?php _e('Customization', 'chesta-slider'); ?></h2>
                <div class="doc-content">
                    <h3><?php _e('Styling Options', 'chesta-slider'); ?></h3>
                    <ul>
                        <li><strong><?php _e('Custom CSS Classes:', 'chesta-slider'); ?></strong> <?php _e('Add your own CSS classes for advanced styling', 'chesta-slider'); ?></li>
                        <li><strong><?php _e('Color Schemes:', 'chesta-slider'); ?></strong> <?php _e('Customize arrow, dot, and overlay colors', 'chesta-slider'); ?></li>
                        <li><strong><?php _e('Typography:', 'chesta-slider'); ?></strong> <?php _e('Control text styles for titles and descriptions', 'chesta-slider'); ?></li>
                        <li><strong><?php _e('Spacing:', 'chesta-slider'); ?></strong> <?php _e('Adjust margins, padding, and gaps', 'chesta-slider'); ?></li>
                    </ul>

                    <h3><?php _e('Advanced Features', 'chesta-slider'); ?></h3>
                    <ul>
                        <li><?php _e('Lazy loading for improved performance', 'chesta-slider'); ?></li>
                        <li><?php _e('Touch and swipe support for mobile devices', 'chesta-slider'); ?></li>
                        <li><?php _e('Keyboard navigation (arrow keys)', 'chesta-slider'); ?></li>
                        <li><?php _e('Mouse wheel navigation', 'chesta-slider'); ?></li>
                        <li><?php _e('RTL (Right-to-Left) language support', 'chesta-slider'); ?></li>
                        <li><?php _e('Full accessibility with ARIA roles', 'chesta-slider'); ?></li>
                    </ul>
                </div>
            </div>

            <!-- Troubleshooting -->
            <div class="doc-section">
                <h2><span class="dashicons dashicons-sos"></span> <?php _e('Troubleshooting', 'chesta-slider'); ?></h2>
                <div class="doc-content">
                    <h3><?php _e('Common Issues', 'chesta-slider'); ?></h3>
                    
                    <div class="troubleshoot-item">
                        <h4><?php _e('Slider not displaying', 'chesta-slider'); ?></h4>
                        <ul>
                            <li><?php _e('Check if the plugin is activated', 'chesta-slider'); ?></li>
                            <li><?php _e('Verify block settings are configured', 'chesta-slider'); ?></li>
                            <li><?php _e('Clear any caching plugins', 'chesta-slider'); ?></li>
                        </ul>
                    </div>

                    <div class="troubleshoot-item">
                        <h4><?php _e('Images not loading', 'chesta-slider'); ?></h4>
                        <ul>
                            <li><?php _e('Check image file paths and permissions', 'chesta-slider'); ?></li>
                            <li><?php _e('Verify images are properly uploaded to media library', 'chesta-slider'); ?></li>
                            <li><?php _e('Test with different image formats (JPG, PNG, WebP)', 'chesta-slider'); ?></li>
                        </ul>
                    </div>

                    <div class="troubleshoot-item">
                        <h4><?php _e('Responsive issues', 'chesta-slider'); ?></h4>
                        <ul>
                            <li><?php _e('Check theme CSS conflicts', 'chesta-slider'); ?></li>
                            <li><?php _e('Verify container width settings', 'chesta-slider'); ?></li>
                            <li><?php _e('Test on different devices and screen sizes', 'chesta-slider'); ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- System Requirements -->
            <div class="doc-section">
                <h2><span class="dashicons dashicons-admin-tools"></span> <?php _e('System Requirements', 'chesta-slider'); ?></h2>
                <div class="doc-content">
                    <ul>
                        <li><strong><?php _e('WordPress:', 'chesta-slider'); ?></strong> <?php _e('5.0 or higher', 'chesta-slider'); ?></li>
                        <li><strong><?php _e('PHP:', 'chesta-slider'); ?></strong> <?php _e('7.4 or higher', 'chesta-slider'); ?></li>
                        <li><strong><?php _e('Gutenberg:', 'chesta-slider'); ?></strong> <?php _e('Block editor enabled', 'chesta-slider'); ?></li>
                        <li><strong><?php _e('Browser Support:', 'chesta-slider'); ?></strong> <?php _e('Modern browsers (Chrome, Firefox, Safari, Edge)', 'chesta-slider'); ?></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
.chesta-slider-admin .documentation-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.doc-section {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 30px;
    padding: 30px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.doc-section h2 {
    color: #2271b1;
    border-bottom: 2px solid #f0f0f1;
    padding-bottom: 15px;
    margin-bottom: 25px;
    font-size: 24px;
}

.doc-section h2 .dashicons {
    margin-right: 10px;
    font-size: 24px;
    vertical-align: middle;
}

.doc-section h3 {
    color: #1d2327;
    margin-top: 25px;
    margin-bottom: 15px;
    font-size: 18px;
}

.doc-section h4 {
    color: #2c3338;
    margin-top: 20px;
    margin-bottom: 10px;
    font-size: 16px;
}

.doc-content ol, .doc-content ul {
    margin-left: 20px;
    line-height: 1.6;
}

.doc-content li {
    margin-bottom: 8px;
}

.troubleshoot-item {
    background: #f8f9fa;
    border-left: 4px solid #2271b1;
    padding: 15px 20px;
    margin-bottom: 20px;
}

.troubleshoot-item h4 {
    margin-top: 0;
    color: #2271b1;
}
</style>

