<?php
/**
 * Admin Support View
 * Support page for Chesta Slider
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
                    <span class="dashicons dashicons-sos"></span>
                    <?php _e('Support', 'chesta-slider'); ?>
                </h1>
                <p class="chesta-slider-tagline">
                    <?php _e('Get help and support for Chesta Slider', 'chesta-slider'); ?>
                </p>
            </div>
        </div>
    </div>

    <div class="chesta-slider-content">
        
        <!-- Quick Help Section -->
        <div class="support-section">
            <h2><span class="dashicons dashicons-lightbulb"></span> <?php _e('Quick Help', 'chesta-slider'); ?></h2>
            <div class="quick-help-grid">
                
                <div class="help-card">
                    <div class="help-icon">
                        <span class="dashicons dashicons-book-alt"></span>
                    </div>
                    <h3><?php _e('Documentation', 'chesta-slider'); ?></h3>
                    <p><?php _e('Complete guides and tutorials for using Chesta Slider', 'chesta-slider'); ?></p>
                    <a href="<?php echo admin_url('admin.php?page=chesta-sliders-documentation'); ?>" class="button button-primary">
                        <?php _e('View Documentation', 'chesta-slider'); ?>
                    </a>
                </div>

                <div class="help-card">
                    <div class="help-icon">
                        <span class="dashicons dashicons-slides"></span>
                    </div>
                    <h3><?php _e('Features & Sliders', 'chesta-slider'); ?></h3>
                    <p><?php _e('Explore all 25+ slider types and their features', 'chesta-slider'); ?></p>
                    <a href="<?php echo admin_url('admin.php?page=chesta-sliders-tutorials'); ?>" class="button button-primary">
                        <?php _e('View Features', 'chesta-slider'); ?>
                    </a>
                </div>

                <div class="help-card">
                    <div class="help-icon">
                        <span class="dashicons dashicons-shortcode"></span>
                    </div>
                    <h3><?php _e('Shortcodes', 'chesta-slider'); ?></h3>
                    <p><?php _e('Learn how to use shortcodes for advanced implementations', 'chesta-slider'); ?></p>
                    <a href="<?php echo admin_url('admin.php?page=chesta-sliders-shortcodes'); ?>" class="button button-primary">
                        <?php _e('View Shortcodes', 'chesta-slider'); ?>
                    </a>
                </div>

            </div>
        </div>

        <!-- FAQ Section -->
        <div class="support-section">
            <h2><span class="dashicons dashicons-editor-help"></span> <?php _e('Frequently Asked Questions', 'chesta-slider'); ?></h2>
            <div class="faq-container">
                
                <div class="faq-item">
                    <h3 class="faq-question">
                        <span class="dashicons dashicons-arrow-right-alt2"></span>
                        <?php _e('How do I create my first slider?', 'chesta-slider'); ?>
                    </h3>
                    <div class="faq-answer">
                        <p><?php _e('Creating a slider is easy:', 'chesta-slider'); ?></p>
                        <ol>
                            <li><?php _e('Edit any post or page', 'chesta-slider'); ?></li>
                            <li><?php _e('Click the "+" button to add a new block', 'chesta-slider'); ?></li>
                            <li><?php _e('Search for "Chesta Slider" or find it in the Media category', 'chesta-slider'); ?></li>
                            <li><?php _e('Select your desired slider type from 25+ options', 'chesta-slider'); ?></li>
                            <li><?php _e('Configure settings and add your content', 'chesta-slider'); ?></li>
                            <li><?php _e('Publish and enjoy your responsive slider!', 'chesta-slider'); ?></li>
                        </ol>
                    </div>
                </div>

                <div class="faq-item">
                    <h3 class="faq-question">
                        <span class="dashicons dashicons-arrow-right-alt2"></span>
                        <?php _e('Can I use Chesta Slider with Elementor?', 'chesta-slider'); ?>
                    </h3>
                    <div class="faq-answer">
                        <p><?php _e('Yes! Chesta Slider works perfectly with Elementor themes and automatically inherits your theme styles. You can use it in two ways:', 'chesta-slider'); ?></p>
                        <ul>
                            <li><?php _e('Add a Shortcode widget in Elementor and use our shortcodes', 'chesta-slider'); ?></li>
                            <li><?php _e('Add an HTML widget and insert the Gutenberg block code', 'chesta-slider'); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item">
                    <h3 class="faq-question">
                        <span class="dashicons dashicons-arrow-right-alt2"></span>
                        <?php _e('Why is my slider not displaying?', 'chesta-slider'); ?>
                    </h3>
                    <div class="faq-answer">
                        <p><?php _e('If your slider is not displaying, check these common issues:', 'chesta-slider'); ?></p>
                        <ul>
                            <li><?php _e('Make sure the Chesta Slider plugin is activated', 'chesta-slider'); ?></li>
                            <li><?php _e('Verify that you have added content to your slider', 'chesta-slider'); ?></li>
                            <li><?php _e('Check if there are any JavaScript errors in your browser console', 'chesta-slider'); ?></li>
                            <li><?php _e('Clear any caching plugins and refresh the page', 'chesta-slider'); ?></li>
                            <li><?php _e('Ensure your theme is compatible with Gutenberg blocks', 'chesta-slider'); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item">
                    <h3 class="faq-question">
                        <span class="dashicons dashicons-arrow-right-alt2"></span>
                        <?php _e('How do I customize the slider appearance?', 'chesta-slider'); ?>
                    </h3>
                    <div class="faq-answer">
                        <p><?php _e('Chesta Slider offers extensive customization options:', 'chesta-slider'); ?></p>
                        <ul>
                            <li><?php _e('Use the block settings panel in Gutenberg to adjust dimensions, animations, and navigation', 'chesta-slider'); ?></li>
                            <li><?php _e('Add custom CSS classes for advanced styling', 'chesta-slider'); ?></li>
                            <li><?php _e('The slider automatically inherits your theme fonts and colors', 'chesta-slider'); ?></li>
                            <li><?php _e('Configure global settings in the Settings page', 'chesta-slider'); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item">
                    <h3 class="faq-question">
                        <span class="dashicons dashicons-arrow-right-alt2"></span>
                        <?php _e('Is Chesta Slider mobile-friendly?', 'chesta-slider'); ?>
                    </h3>
                    <div class="faq-answer">
                        <p><?php _e('Absolutely! Chesta Slider is fully responsive and mobile-optimized:', 'chesta-slider'); ?></p>
                        <ul>
                            <li><?php _e('Touch and swipe gestures for mobile navigation', 'chesta-slider'); ?></li>
                            <li><?php _e('Responsive design that adapts to all screen sizes', 'chesta-slider'); ?></li>
                            <li><?php _e('Optimized performance for mobile devices', 'chesta-slider'); ?></li>
                            <li><?php _e('Hardware acceleration support for smooth animations', 'chesta-slider'); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item">
                    <h3 class="faq-question">
                        <span class="dashicons dashicons-arrow-right-alt2"></span>
                        <?php _e('Can I use videos in my sliders?', 'chesta-slider'); ?>
                    </h3>
                    <div class="faq-answer">
                        <p><?php _e('Yes! Chesta Slider supports multiple video formats:', 'chesta-slider'); ?></p>
                        <ul>
                            <li><?php _e('YouTube videos with automatic embedding', 'chesta-slider'); ?></li>
                            <li><?php _e('Vimeo videos with custom player options', 'chesta-slider'); ?></li>
                            <li><?php _e('Self-hosted videos (MP4, WebM, OGV)', 'chesta-slider'); ?></li>
                            <li><?php _e('Video thumbnails and autoplay controls', 'chesta-slider'); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item">
                    <h3 class="faq-question">
                        <span class="dashicons dashicons-arrow-right-alt2"></span>
                        <?php _e('Why is my slider not displaying correctly?', 'chesta-slider'); ?>
                    </h3>
                    <div class="faq-answer">
                        <p><?php _e('Common display issues and solutions:', 'chesta-slider'); ?></p>
                        <ul>
                            <li><?php _e('Check if your theme has CSS conflicts - try switching to a default theme temporarily', 'chesta-slider'); ?></li>
                            <li><?php _e('Ensure the container has sufficient width and height', 'chesta-slider'); ?></li>
                            <li><?php _e('Verify that JavaScript is enabled in your browser', 'chesta-slider'); ?></li>
                            <li><?php _e('Clear your browser cache and any caching plugins', 'chesta-slider'); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item">
                    <h3 class="faq-question">
                        <span class="dashicons dashicons-arrow-right-alt2"></span>
                        <?php _e('How do I fix slow loading sliders?', 'chesta-slider'); ?>
                    </h3>
                    <div class="faq-answer">
                        <p><?php _e('Performance optimization tips:', 'chesta-slider'); ?></p>
                        <ul>
                            <li><?php _e('Enable lazy loading in the slider settings', 'chesta-slider'); ?></li>
                            <li><?php _e('Compress and optimize your images before uploading', 'chesta-slider'); ?></li>
                            <li><?php _e('Use WebP format for better compression and faster loading', 'chesta-slider'); ?></li>
                            <li><?php _e('Limit the number of slides to 10-15 for optimal performance', 'chesta-slider'); ?></li>
                            <li><?php _e('Use a CDN for hosting images if possible', 'chesta-slider'); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item">
                    <h3 class="faq-question">
                        <span class="dashicons dashicons-arrow-right-alt2"></span>
                        <?php _e('The slider is not responsive on mobile devices', 'chesta-slider'); ?>
                    </h3>
                    <div class="faq-answer">
                        <p><?php _e('Mobile responsiveness solutions:', 'chesta-slider'); ?></p>
                        <ul>
                            <li><?php _e('Ensure your theme is mobile-responsive', 'chesta-slider'); ?></li>
                            <li><?php _e('Check the slider width settings - use percentage instead of fixed pixels', 'chesta-slider'); ?></li>
                            <li><?php _e('Enable touch/swipe navigation in slider settings', 'chesta-slider'); ?></li>
                            <li><?php _e('Test different breakpoint settings for mobile devices', 'chesta-slider'); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item">
                    <h3 class="faq-question">
                        <span class="dashicons dashicons-arrow-right-alt2"></span>
                        <?php _e('How do I troubleshoot JavaScript errors?', 'chesta-slider'); ?>
                    </h3>
                    <div class="faq-answer">
                        <p><?php _e('JavaScript troubleshooting steps:', 'chesta-slider'); ?></p>
                        <ul>
                            <li><?php _e('Open browser developer tools (F12) and check the Console tab for errors', 'chesta-slider'); ?></li>
                            <li><?php _e('Deactivate other plugins temporarily to check for conflicts', 'chesta-slider'); ?></li>
                            <li><?php _e('Ensure jQuery is properly loaded by your theme', 'chesta-slider'); ?></li>
                            <li><?php _e('Check if multiple slider plugins are conflicting with each other', 'chesta-slider'); ?></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <!-- Troubleshooting Section -->
        <div class="support-section">
            <h2><span class="dashicons dashicons-admin-tools"></span> <?php _e('Troubleshooting', 'chesta-slider'); ?></h2>
            <div class="troubleshooting-grid">
                
                <div class="troubleshoot-card">
                    <h3><?php _e('Performance Issues', 'chesta-slider'); ?></h3>
                    <ul>
                        <li><?php _e('Enable lazy loading in Settings', 'chesta-slider'); ?></li>
                        <li><?php _e('Optimize image sizes before uploading', 'chesta-slider'); ?></li>
                        <li><?php _e('Use WebP format for better compression', 'chesta-slider'); ?></li>
                        <li><?php _e('Enable caching plugins', 'chesta-slider'); ?></li>
                    </ul>
                </div>

                <div class="troubleshoot-card">
                    <h3><?php _e('Styling Issues', 'chesta-slider'); ?></h3>
                    <ul>
                        <li><?php _e('Check for theme CSS conflicts', 'chesta-slider'); ?></li>
                        <li><?php _e('Verify container width settings', 'chesta-slider'); ?></li>
                        <li><?php _e('Use browser developer tools to inspect elements', 'chesta-slider'); ?></li>
                        <li><?php _e('Add custom CSS classes if needed', 'chesta-slider'); ?></li>
                    </ul>
                </div>

                <div class="troubleshoot-card">
                    <h3><?php _e('JavaScript Errors', 'chesta-slider'); ?></h3>
                    <ul>
                        <li><?php _e('Check browser console for error messages', 'chesta-slider'); ?></li>
                        <li><?php _e('Disable other plugins temporarily to test', 'chesta-slider'); ?></li>
                        <li><?php _e('Enable debug mode in Settings', 'chesta-slider'); ?></li>
                        <li><?php _e('Clear browser cache and cookies', 'chesta-slider'); ?></li>
                    </ul>
                </div>

                <div class="troubleshoot-card">
                    <h3><?php _e('Content Not Loading', 'chesta-slider'); ?></h3>
                    <ul>
                        <li><?php _e('Verify image file paths and permissions', 'chesta-slider'); ?></li>
                        <li><?php _e('Check media library for missing files', 'chesta-slider'); ?></li>
                        <li><?php _e('Test with different content types', 'chesta-slider'); ?></li>
                        <li><?php _e('Ensure proper file formats are used', 'chesta-slider'); ?></li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- System Requirements -->
        <div class="support-section">
            <h2><span class="dashicons dashicons-admin-generic"></span> <?php _e('System Requirements', 'chesta-slider'); ?></h2>
            <div class="requirements-grid">
                
                <div class="requirement-item">
                    <div class="requirement-icon">
                        <span class="dashicons dashicons-wordpress"></span>
                    </div>
                    <div class="requirement-content">
                        <h3><?php _e('WordPress', 'chesta-slider'); ?></h3>
                        <p><?php _e('Version 5.0 or higher', 'chesta-slider'); ?></p>
                        <span class="requirement-status <?php echo version_compare(get_bloginfo('version'), '5.0', '>=') ? 'status-good' : 'status-warning'; ?>">
                            <?php echo version_compare(get_bloginfo('version'), '5.0', '>=') ? __('✓ Compatible', 'chesta-slider') : __('⚠ Update Required', 'chesta-slider'); ?>
                        </span>
                    </div>
                </div>

                <div class="requirement-item">
                    <div class="requirement-icon">
                        <span class="dashicons dashicons-admin-tools"></span>
                    </div>
                    <div class="requirement-content">
                        <h3><?php _e('PHP', 'chesta-slider'); ?></h3>
                        <p><?php _e('Version 7.4 or higher', 'chesta-slider'); ?></p>
                        <span class="requirement-status <?php echo version_compare(PHP_VERSION, '7.4', '>=') ? 'status-good' : 'status-warning'; ?>">
                            <?php echo version_compare(PHP_VERSION, '7.4', '>=') ? __('✓ Compatible', 'chesta-slider') : __('⚠ Update Required', 'chesta-slider'); ?>
                        </span>
                    </div>
                </div>

                <div class="requirement-item">
                    <div class="requirement-icon">
                        <span class="dashicons dashicons-editor-table"></span>
                    </div>
                    <div class="requirement-content">
                        <h3><?php _e('Gutenberg', 'chesta-slider'); ?></h3>
                        <p><?php _e('Block editor enabled', 'chesta-slider'); ?></p>
                        <span class="requirement-status <?php echo function_exists('register_block_type') ? 'status-good' : 'status-warning'; ?>">
                            <?php echo function_exists('register_block_type') ? __('✓ Available', 'chesta-slider') : __('⚠ Not Available', 'chesta-slider'); ?>
                        </span>
                    </div>
                </div>

                <div class="requirement-item">
                    <div class="requirement-icon">
                        <span class="dashicons dashicons-admin-appearance"></span>
                    </div>
                    <div class="requirement-content">
                        <h3><?php _e('Browser Support', 'chesta-slider'); ?></h3>
                        <p><?php _e('Modern browsers (Chrome, Firefox, Safari, Edge)', 'chesta-slider'); ?></p>
                        <span class="requirement-status status-good">
                            <?php _e('✓ Supported', 'chesta-slider'); ?>
                        </span>
                    </div>
                </div>

            </div>
        </div>

        <!-- Contact Support -->
        <div class="support-section contact-support">
            <h2><span class="dashicons dashicons-admin-tools"></span> <?php _e('Additional Resources', 'chesta-slider'); ?></h2>
            <div class="contact-content">
                <p><?php _e('For additional support and resources, please check our documentation and tutorials above.', 'chesta-slider'); ?></p>
                
                <div class="contact-methods">
                    <div class="contact-method">
                        <div class="contact-icon">
                            <span class="dashicons dashicons-book"></span>
                        </div>
                        <div class="contact-info">
                            <h3><?php _e('Documentation', 'chesta-slider'); ?></h3>
                            <p><?php _e('Comprehensive guides and tutorials to help you get the most out of Chesta Slider.', 'chesta-slider'); ?></p>
                            <a href="<?php echo admin_url('admin.php?page=chesta-slider-tutorials'); ?>" class="button button-primary">
                                <?php _e('View Documentation', 'chesta-slider'); ?>
                            </a>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="contact-icon">
                            <span class="dashicons dashicons-admin-generic"></span>
                        </div>
                        <div class="contact-info">
                            <h3><?php _e('Plugin Settings', 'chesta-slider'); ?></h3>
                            <p><?php _e('Configure and customize your slider settings to match your needs.', 'chesta-slider'); ?></p>
                            <a href="<?php echo admin_url('admin.php?page=chesta-slider-settings'); ?>" class="button button-secondary">
                                <?php _e('Go to Settings', 'chesta-slider'); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="support-tips">
                    <h3><?php _e('When contacting support, please include:', 'chesta-slider'); ?></h3>
                    <ul>
                        <li><?php _e('WordPress version and theme name', 'chesta-slider'); ?></li>
                        <li><?php _e('Chesta Slider plugin version', 'chesta-slider'); ?></li>
                        <li><?php _e('Description of the issue you are experiencing', 'chesta-slider'); ?></li>
                        <li><?php _e('Steps to reproduce the problem', 'chesta-slider'); ?></li>
                        <li><?php _e('Screenshots or screen recordings if applicable', 'chesta-slider'); ?></li>
                        <li><?php _e('Any error messages from browser console', 'chesta-slider'); ?></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
.chesta-slider-admin .chesta-slider-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.support-section {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 30px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.support-section h2 {
    background: linear-gradient(135deg, #2271b1, #135e96);
    color: white;
    margin: 0;
    padding: 20px 30px;
    font-size: 20px;
    display: flex;
    align-items: center;
}

.support-section h2 .dashicons {
    margin-right: 12px;
    font-size: 22px;
}

/* Quick Help */
.quick-help-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    padding: 30px;
}

.help-card {
    text-align: center;
    padding: 30px 25px;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    background: #f8f9fa;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.help-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.help-icon {
    margin-bottom: 20px;
}

.help-icon .dashicons {
    font-size: 48px;
    color: #2271b1;
    width: 48px;
    height: 48px;
}

.help-card h3 {
    color: #1d2327;
    margin-bottom: 15px;
    font-size: 18px;
}

.help-card p {
    color: #50575e;
    margin-bottom: 20px;
    line-height: 1.5;
}

/* FAQ */
.faq-container {
    padding: 30px;
}

.faq-item {
    border-bottom: 1px solid #f0f0f1;
    margin-bottom: 25px;
    padding-bottom: 25px;
}

.faq-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.faq-question {
    color: #2271b1;
    cursor: pointer;
    margin-bottom: 15px;
    font-size: 16px;
    display: flex;
    align-items: center;
    transition: color 0.3s ease;
}

.faq-question:hover {
    color: #135e96;
}

.faq-question .dashicons {
    margin-right: 10px;
    font-size: 18px;
    transition: transform 0.3s ease;
}

.faq-answer {
    color: #50575e;
    line-height: 1.6;
    margin-left: 28px;
}

.faq-answer ol, .faq-answer ul {
    margin-left: 20px;
}

.faq-answer li {
    margin-bottom: 8px;
}

/* Troubleshooting */
.troubleshooting-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    padding: 30px;
}

.troubleshoot-card {
    padding: 25px;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    background: #f8f9fa;
}

.troubleshoot-card h3 {
    color: #2271b1;
    margin-bottom: 15px;
    font-size: 16px;
}

.troubleshoot-card ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.troubleshoot-card li {
    color: #50575e;
    margin-bottom: 10px;
    padding-left: 20px;
    position: relative;
    line-height: 1.4;
}

.troubleshoot-card li:before {
    content: "→";
    color: #2271b1;
    position: absolute;
    left: 0;
    font-weight: bold;
}

/* System Requirements */
.requirements-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 30px;
}

.requirement-item {
    display: flex;
    align-items: center;
    padding: 20px;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    background: #f8f9fa;
}

.requirement-icon {
    margin-right: 15px;
}

.requirement-icon .dashicons {
    font-size: 32px;
    color: #2271b1;
    width: 32px;
    height: 32px;
}

.requirement-content h3 {
    color: #1d2327;
    margin: 0 0 5px 0;
    font-size: 16px;
}

.requirement-content p {
    color: #50575e;
    margin: 0 0 8px 0;
    font-size: 14px;
}

.requirement-status {
    font-size: 12px;
    font-weight: 600;
    padding: 4px 8px;
    border-radius: 4px;
}

.status-good {
    background: #d1e7dd;
    color: #0f5132;
}

.status-warning {
    background: #fff3cd;
    color: #664d03;
}

/* Contact Support */
.contact-support {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

.contact-content {
    padding: 30px;
}

.contact-content > p {
    text-align: center;
    font-size: 16px;
    color: #50575e;
    margin-bottom: 30px;
}

.contact-methods {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.contact-method {
    display: flex;
    align-items: flex-start;
    padding: 25px;
    background: #fff;
    border-radius: 8px;
    border: 1px solid #ddd;
}

.contact-icon {
    margin-right: 20px;
}

.contact-icon .dashicons {
    font-size: 32px;
    color: #2271b1;
    width: 32px;
    height: 32px;
}

.contact-info h3 {
    color: #1d2327;
    margin: 0 0 10px 0;
    font-size: 18px;
}

.contact-info p {
    color: #50575e;
    margin-bottom: 15px;
    line-height: 1.5;
}

.support-tips {
    background: #fff;
    padding: 25px;
    border-radius: 8px;
    border: 1px solid #ddd;
}

.support-tips h3 {
    color: #2271b1;
    margin-bottom: 15px;
    font-size: 16px;
}

.support-tips ul {
    margin-left: 20px;
    color: #50575e;
}

.support-tips li {
    margin-bottom: 8px;
    line-height: 1.4;
}

/* Responsive Design */
@media (max-width: 768px) {
    .quick-help-grid,
    .troubleshooting-grid,
    .requirements-grid,
    .contact-methods {
        grid-template-columns: 1fr;
    }
    
    .contact-method {
        flex-direction: column;
        text-align: center;
    }
    
    .contact-icon {
        margin-right: 0;
        margin-bottom: 15px;
    }
}
</style>

<script>
// FAQ Toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    faqQuestions.forEach(function(question) {
        question.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            const arrow = this.querySelector('.dashicons');
            
            if (answer.style.display === 'none' || answer.style.display === '') {
                answer.style.display = 'block';
                arrow.style.transform = 'rotate(90deg)';
            } else {
                answer.style.display = 'none';
                arrow.style.transform = 'rotate(0deg)';
            }
        });
    });
    
    // Initially hide all answers
    const faqAnswers = document.querySelectorAll('.faq-answer');
    faqAnswers.forEach(function(answer) {
        answer.style.display = 'none';
    });
});
</script>
