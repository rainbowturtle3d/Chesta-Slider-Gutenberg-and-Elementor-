<?php
/**
 * Admin Settings View
 * Settings page for Chesta Slider
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/admin/views
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Handle form submission
if (isset($_POST['submit']) && wp_verify_nonce($_POST['chesta_slider_settings_nonce'], 'chesta_slider_settings')) {
    // Save settings
    $settings = array(
        'enable_lazy_loading' => isset($_POST['enable_lazy_loading']) ? 1 : 0,
        'enable_touch_gestures' => isset($_POST['enable_touch_gestures']) ? 1 : 0,
        'enable_keyboard_navigation' => isset($_POST['enable_keyboard_navigation']) ? 1 : 0,
        'enable_mouse_wheel' => isset($_POST['enable_mouse_wheel']) ? 1 : 0,
        'default_animation_speed' => intval($_POST['default_animation_speed']),
        'default_autoplay_delay' => intval($_POST['default_autoplay_delay']),
        'enable_rtl_support' => isset($_POST['enable_rtl_support']) ? 1 : 0,
        'load_css_frontend' => isset($_POST['load_css_frontend']) ? 1 : 0,
        'load_js_footer' => isset($_POST['load_js_footer']) ? 1 : 0,
        'enable_debug_mode' => isset($_POST['enable_debug_mode']) ? 1 : 0
    );
    
    update_option('chesta_slider_settings', $settings);
    echo '<div class="notice notice-success"><p>' . __('Settings saved successfully!', 'chesta-slider') . '</p></div>';
}

// Get current settings
$settings = get_option('chesta_slider_settings', array(
    'enable_lazy_loading' => 1,
    'enable_touch_gestures' => 1,
    'enable_keyboard_navigation' => 1,
    'enable_mouse_wheel' => 1,
    'default_animation_speed' => 500,
    'default_autoplay_delay' => 3000,
    'enable_rtl_support' => 0,
    'load_css_frontend' => 1,
    'load_js_footer' => 1,
    'enable_debug_mode' => 0
));
?>

<div class="wrap chesta-slider-admin">
    <div class="chesta-slider-header">
        <div class="chesta-slider-header-content">
            <div class="chesta-slider-logo">
                <h1>
                    <span class="dashicons dashicons-admin-settings"></span>
                    <?php _e('Settings', 'chesta-slider'); ?>
                </h1>
                <p class="chesta-slider-tagline">
                    <?php _e('Configure global settings for Chesta Slider', 'chesta-slider'); ?>
                </p>
            </div>
        </div>
    </div>

    <div class="chesta-slider-content">
        <form method="post" action="">
            <?php wp_nonce_field('chesta_slider_settings', 'chesta_slider_settings_nonce'); ?>
            
            <!-- Performance Settings -->
            <div class="settings-section">
                <h2><span class="dashicons dashicons-performance"></span> <?php _e('Performance Settings', 'chesta-slider'); ?></h2>
                <div class="settings-grid">
                    
                    <div class="setting-item">
                        <label class="setting-label">
                            <input type="checkbox" name="enable_lazy_loading" value="1" <?php checked($settings['enable_lazy_loading'], 1); ?>>
                            <span class="setting-title"><?php _e('Enable Lazy Loading', 'chesta-slider'); ?></span>
                        </label>
                        <p class="setting-description"><?php _e('Load images and videos only when they become visible, improving page load speed.', 'chesta-slider'); ?></p>
                    </div>

                    <div class="setting-item">
                        <label class="setting-label">
                            <input type="checkbox" name="load_css_frontend" value="1" <?php checked($settings['load_css_frontend'], 1); ?>>
                            <span class="setting-title"><?php _e('Load CSS on Frontend', 'chesta-slider'); ?></span>
                        </label>
                        <p class="setting-description"><?php _e('Load slider CSS styles on the frontend. Disable if you want to include styles in your theme.', 'chesta-slider'); ?></p>
                    </div>

                    <div class="setting-item">
                        <label class="setting-label">
                            <input type="checkbox" name="load_js_footer" value="1" <?php checked($settings['load_js_footer'], 1); ?>>
                            <span class="setting-title"><?php _e('Load JavaScript in Footer', 'chesta-slider'); ?></span>
                        </label>
                        <p class="setting-description"><?php _e('Load JavaScript files in the footer for better page load performance.', 'chesta-slider'); ?></p>
                    </div>

                </div>
            </div>

            <!-- Navigation Settings -->
            <div class="settings-section">
                <h2><span class="dashicons dashicons-controls-forward"></span> <?php _e('Navigation Settings', 'chesta-slider'); ?></h2>
                <div class="settings-grid">
                    
                    <div class="setting-item">
                        <label class="setting-label">
                            <input type="checkbox" name="enable_touch_gestures" value="1" <?php checked($settings['enable_touch_gestures'], 1); ?>>
                            <span class="setting-title"><?php _e('Enable Touch Gestures', 'chesta-slider'); ?></span>
                        </label>
                        <p class="setting-description"><?php _e('Allow users to swipe through slides on touch devices.', 'chesta-slider'); ?></p>
                    </div>

                    <div class="setting-item">
                        <label class="setting-label">
                            <input type="checkbox" name="enable_keyboard_navigation" value="1" <?php checked($settings['enable_keyboard_navigation'], 1); ?>>
                            <span class="setting-title"><?php _e('Enable Keyboard Navigation', 'chesta-slider'); ?></span>
                        </label>
                        <p class="setting-description"><?php _e('Allow users to navigate slides using arrow keys.', 'chesta-slider'); ?></p>
                    </div>

                    <div class="setting-item">
                        <label class="setting-label">
                            <input type="checkbox" name="enable_mouse_wheel" value="1" <?php checked($settings['enable_mouse_wheel'], 1); ?>>
                            <span class="setting-title"><?php _e('Enable Mouse Wheel Navigation', 'chesta-slider'); ?></span>
                        </label>
                        <p class="setting-description"><?php _e('Allow users to navigate slides using mouse wheel.', 'chesta-slider'); ?></p>
                    </div>

                </div>
            </div>

            <!-- Animation Settings -->
            <div class="settings-section">
                <h2><span class="dashicons dashicons-image-rotate"></span> <?php _e('Animation Settings', 'chesta-slider'); ?></h2>
                <div class="settings-grid">
                    
                    <div class="setting-item">
                        <label class="setting-label">
                            <span class="setting-title"><?php _e('Default Animation Speed (ms)', 'chesta-slider'); ?></span>
                        </label>
                        <input type="number" name="default_animation_speed" value="<?php echo esc_attr($settings['default_animation_speed']); ?>" min="100" max="2000" step="50" class="setting-input">
                        <p class="setting-description"><?php _e('Default transition speed in milliseconds for all sliders.', 'chesta-slider'); ?></p>
                    </div>

                    <div class="setting-item">
                        <label class="setting-label">
                            <span class="setting-title"><?php _e('Default Autoplay Delay (ms)', 'chesta-slider'); ?></span>
                        </label>
                        <input type="number" name="default_autoplay_delay" value="<?php echo esc_attr($settings['default_autoplay_delay']); ?>" min="1000" max="10000" step="500" class="setting-input">
                        <p class="setting-description"><?php _e('Default delay between slides when autoplay is enabled.', 'chesta-slider'); ?></p>
                    </div>

                </div>
            </div>

            <!-- Accessibility Settings -->
            <div class="settings-section">
                <h2><span class="dashicons dashicons-universal-access"></span> <?php _e('Accessibility Settings', 'chesta-slider'); ?></h2>
                <div class="settings-grid">
                    
                    <div class="setting-item">
                        <label class="setting-label">
                            <input type="checkbox" name="enable_rtl_support" value="1" <?php checked($settings['enable_rtl_support'], 1); ?>>
                            <span class="setting-title"><?php _e('Enable RTL Support', 'chesta-slider'); ?></span>
                        </label>
                        <p class="setting-description"><?php _e('Enable Right-to-Left language support for Arabic, Hebrew, and other RTL languages.', 'chesta-slider'); ?></p>
                    </div>

                </div>
            </div>

            <!-- Developer Settings -->
            <div class="settings-section">
                <h2><span class="dashicons dashicons-admin-tools"></span> <?php _e('Developer Settings', 'chesta-slider'); ?></h2>
                <div class="settings-grid">
                    
                    <div class="setting-item">
                        <label class="setting-label">
                            <input type="checkbox" name="enable_debug_mode" value="1" <?php checked($settings['enable_debug_mode'], 1); ?>>
                            <span class="setting-title"><?php _e('Enable Debug Mode', 'chesta-slider'); ?></span>
                        </label>
                        <p class="setting-description"><?php _e('Enable debug mode to show console logs and additional information for troubleshooting.', 'chesta-slider'); ?></p>
                    </div>

                </div>
            </div>

            <!-- System Information -->
            <div class="settings-section">
                <h2><span class="dashicons dashicons-info"></span> <?php _e('System Information', 'chesta-slider'); ?></h2>
                <div class="system-info">
                    <div class="system-info-grid">
                        <div class="system-info-item">
                            <strong><?php _e('WordPress Version:', 'chesta-slider'); ?></strong>
                            <span><?php echo get_bloginfo('version'); ?></span>
                        </div>
                        <div class="system-info-item">
                            <strong><?php _e('PHP Version:', 'chesta-slider'); ?></strong>
                            <span><?php echo PHP_VERSION; ?></span>
                        </div>
                        <div class="system-info-item">
                            <strong><?php _e('Plugin Version:', 'chesta-slider'); ?></strong>
                            <span><?php echo defined('CHESTA_SLIDER_VERSION') ? CHESTA_SLIDER_VERSION : '1.0.0'; ?></span>
                        </div>
                        <div class="system-info-item">
                            <strong><?php _e('Theme:', 'chesta-slider'); ?></strong>
                            <span><?php echo wp_get_theme()->get('Name'); ?></span>
                        </div>
                        <div class="system-info-item">
                            <strong><?php _e('Gutenberg Active:', 'chesta-slider'); ?></strong>
                            <span><?php echo function_exists('register_block_type') ? __('Yes', 'chesta-slider') : __('No', 'chesta-slider'); ?></span>
                        </div>
                        <div class="system-info-item">
                            <strong><?php _e('WooCommerce Active:', 'chesta-slider'); ?></strong>
                            <span><?php echo class_exists('WooCommerce') ? __('Yes', 'chesta-slider') : __('No', 'chesta-slider'); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="settings-actions">
                <?php submit_button(__('Save Settings', 'chesta-slider'), 'primary', 'submit', false, array('class' => 'button-primary button-large')); ?>
                <button type="button" class="button button-secondary button-large" onclick="resetToDefaults()">
                    <?php _e('Reset to Defaults', 'chesta-slider'); ?>
                </button>
            </div>

        </form>
    </div>
</div>

<style>
.chesta-slider-admin .chesta-slider-content {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
}

.settings-section {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 30px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.settings-section h2 {
    background: linear-gradient(135deg, #2271b1, #135e96);
    color: white;
    margin: 0;
    padding: 20px 30px;
    font-size: 18px;
    display: flex;
    align-items: center;
}

.settings-section h2 .dashicons {
    margin-right: 10px;
    font-size: 20px;
}

.settings-grid {
    padding: 30px;
    display: grid;
    gap: 25px;
}

.setting-item {
    border-bottom: 1px solid #f0f0f1;
    padding-bottom: 20px;
}

.setting-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.setting-label {
    display: flex;
    align-items: flex-start;
    cursor: pointer;
    margin-bottom: 8px;
}

.setting-label input[type="checkbox"] {
    margin-right: 12px;
    margin-top: 2px;
}

.setting-title {
    font-weight: 600;
    color: #1d2327;
    font-size: 16px;
}

.setting-description {
    color: #50575e;
    margin: 8px 0 0 0;
    line-height: 1.5;
    font-size: 14px;
}

.setting-input {
    width: 100%;
    max-width: 200px;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    margin-top: 8px;
}

.setting-input:focus {
    border-color: #2271b1;
    box-shadow: 0 0 0 1px #2271b1;
    outline: none;
}

/* System Information */
.system-info {
    padding: 30px;
}

.system-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
}

.system-info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 15px;
    background: #f8f9fa;
    border-radius: 4px;
    border: 1px solid #e9ecef;
}

.system-info-item strong {
    color: #1d2327;
}

.system-info-item span {
    color: #50575e;
    font-weight: 500;
}

/* Settings Actions */
.settings-actions {
    text-align: center;
    padding: 30px;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

.settings-actions .button {
    margin: 0 10px;
    padding: 12px 30px;
    font-size: 16px;
    height: auto;
    line-height: 1.4;
}

/* Responsive Design */
@media (max-width: 768px) {
    .system-info-grid {
        grid-template-columns: 1fr;
    }
    
    .system-info-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .settings-actions .button {
        display: block;
        width: 100%;
        margin: 10px 0;
    }
}
</style>

<script>
function resetToDefaults() {
    if (confirm('<?php _e('Are you sure you want to reset all settings to their default values?', 'chesta-slider'); ?>')) {
        // Reset form to default values
        document.querySelector('input[name="enable_lazy_loading"]').checked = true;
        document.querySelector('input[name="enable_touch_gestures"]').checked = true;
        document.querySelector('input[name="enable_keyboard_navigation"]').checked = true;
        document.querySelector('input[name="enable_mouse_wheel"]').checked = true;
        document.querySelector('input[name="default_animation_speed"]').value = 500;
        document.querySelector('input[name="default_autoplay_delay"]').value = 3000;
        document.querySelector('input[name="enable_rtl_support"]').checked = false;
        document.querySelector('input[name="load_css_frontend"]').checked = true;
        document.querySelector('input[name="load_js_footer"]').checked = true;
        document.querySelector('input[name="enable_debug_mode"]').checked = false;
    }
}
</script>

