<?php
/**
 * Provide a admin area view for the plugin settings
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
            <?php _e('This is the legacy settings page. Please use the new "Chesta Sliders" → "Settings" for the complete settings interface.', 'chesta-slider'); ?>
        </p>
        <p>
            <a href="<?php echo admin_url('admin.php?page=chesta-sliders-settings'); ?>" class="button button-primary">
                <?php _e('Go to New Settings Page', 'chesta-slider'); ?>
            </a>
        </p>
    </div>

    <form method="post" action="options.php">
        <?php
        settings_fields('chesta_slider_options_group');
        do_settings_sections('chesta_slider_options_group');
        $options = get_option('chesta_slider_options');
        ?>
        
        <table class="form-table">
            <tr>
                <th scope="row"><?php _e('Enable Gutenberg Blocks', 'chesta-slider'); ?></th>
                <td>
                    <input type="checkbox" name="chesta_slider_options[enable_gutenberg]" value="1" <?php checked(isset($options['enable_gutenberg']) ? $options['enable_gutenberg'] : 1, 1); ?> />
                    <label><?php _e('Enable Chesta Slider Gutenberg blocks', 'chesta-slider'); ?></label>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('Enable Shortcodes', 'chesta-slider'); ?></th>
                <td>
                    <input type="checkbox" name="chesta_slider_options[enable_shortcodes]" value="1" <?php checked(isset($options['enable_shortcodes']) ? $options['enable_shortcodes'] : 1, 1); ?> />
                    <label><?php _e('Enable Chesta Slider shortcodes', 'chesta-slider'); ?></label>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('Load CSS', 'chesta-slider'); ?></th>
                <td>
                    <input type="checkbox" name="chesta_slider_options[load_css]" value="1" <?php checked(isset($options['load_css']) ? $options['load_css'] : 1, 1); ?> />
                    <label><?php _e('Load Chesta Slider CSS files', 'chesta-slider'); ?></label>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('Load JavaScript', 'chesta-slider'); ?></th>
                <td>
                    <input type="checkbox" name="chesta_slider_options[load_js]" value="1" <?php checked(isset($options['load_js']) ? $options['load_js'] : 1, 1); ?> />
                    <label><?php _e('Load Chesta Slider JavaScript files', 'chesta-slider'); ?></label>
                </td>
            </tr>
        </table>
        
        <?php submit_button(); ?>
    </form>
</div>

