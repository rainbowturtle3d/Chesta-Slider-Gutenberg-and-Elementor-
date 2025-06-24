<?php
/**
 * Admin Dashboard View
 * Main dashboard page for Chesta Slider
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/admin/views
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$stats = $this->get_plugin_stats();
$quick_start = $this->get_quick_start_guide();
$features = $this->get_feature_highlights();
?>

<div class="wrap chesta-slider-admin">
    <div class="chesta-slider-header">
        <div class="chesta-slider-header-content">
            <div class="chesta-slider-logo">
                <h1>
                    <span class="dashicons dashicons-slides"></span>
                    <?php _e('Chesta Sliders', 'chesta-slider'); ?>
                </h1>
                <p class="chesta-slider-tagline">
                    <?php _e('Create stunning, responsive sliders with 25+ premium templates', 'chesta-slider'); ?>
                </p>
            </div>
            <div class="chesta-slider-version">
                <span class="version-badge">v<?php echo esc_html($this->version); ?></span>
            </div>
        </div>
    </div>

    <div class="chesta-slider-dashboard">
        <!-- Statistics Cards -->
        <div class="chesta-slider-stats">
            <div class="stat-card">
                <div class="stat-icon">
                    <span class="dashicons dashicons-slides"></span>
                </div>
                <div class="stat-content">
                    <h3><?php echo esc_html($stats['total_sliders']); ?></h3>
                    <p><?php _e('Total Slider Types', 'chesta-slider'); ?></p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <span class="dashicons dashicons-star-filled"></span>
                </div>
                <div class="stat-content">
                    <h3><?php echo esc_html($stats['premium_sliders']); ?></h3>
                    <p><?php _e('Premium Templates', 'chesta-slider'); ?></p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <span class="dashicons dashicons-editor-table"></span>
                </div>
                <div class="stat-content">
                    <h3><?php echo esc_html($stats['total_sliders']); ?></h3>
                    <p><?php _e('Gutenberg Blocks', 'chesta-slider'); ?></p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <span class="dashicons dashicons-shortcode"></span>
                </div>
                <div class="stat-content">
                    <h3><?php echo esc_html($stats['total_sliders'] + 1); ?></h3>
                    <p><?php _e('Available Shortcodes', 'chesta-slider'); ?></p>
                </div>
            </div>
        </div>

        <div class="chesta-slider-main-content">
            <!-- Quick Start Guide -->
            <div class="chesta-slider-card">
                <div class="card-header">
                    <h2>
                        <span class="dashicons dashicons-lightbulb"></span>
                        <?php _e('Quick Start Guide', 'chesta-slider'); ?>
                    </h2>
                    <p><?php _e('Get started with Chesta Sliders in just a few simple steps', 'chesta-slider'); ?></p>
                </div>
                <div class="card-content">
                    <div class="quick-start-steps">
                        <?php foreach ($quick_start as $index => $step): ?>
                        <div class="quick-start-step">
                            <div class="step-number"><?php echo $index + 1; ?></div>
                            <div class="step-icon">
                                <span class="dashicons <?php echo esc_attr($step['icon']); ?>"></span>
                            </div>
                            <div class="step-content">
                                <h4><?php echo esc_html($step['title']); ?></h4>
                                <p><?php echo esc_html($step['description']); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Slider Categories -->
            <div class="chesta-slider-card">
                <div class="card-header">
                    <h2>
                        <span class="dashicons dashicons-category"></span>
                        <?php _e('Slider Categories', 'chesta-slider'); ?>
                    </h2>
                    <p><?php _e('Explore our comprehensive collection of slider types', 'chesta-slider'); ?></p>
                </div>
                <div class="card-content">
                    <div class="slider-categories">
                        <div class="category-card">
                            <div class="category-icon">
                                <span class="dashicons dashicons-images-alt"></span>
                            </div>
                            <h4><?php _e('Basic Sliders', 'chesta-slider'); ?></h4>
                            <p class="category-count"><?php echo esc_html($stats['basic_sliders']); ?> <?php _e('types', 'chesta-slider'); ?></p>
                            <p><?php _e('Essential slider types for everyday use', 'chesta-slider'); ?></p>
                            <ul>
                                <li><?php _e('Carousel', 'chesta-slider'); ?></li>
                                <li><?php _e('Fade', 'chesta-slider'); ?></li>
                                <li><?php _e('Vertical', 'chesta-slider'); ?></li>
                                <li><?php _e('Gallery', 'chesta-slider'); ?></li>
                            </ul>
                        </div>

                        <div class="category-card">
                            <div class="category-icon">
                                <span class="dashicons dashicons-admin-customizer"></span>
                            </div>
                            <h4><?php _e('Advanced Sliders', 'chesta-slider'); ?></h4>
                            <p class="category-count"><?php echo esc_html($stats['advanced_sliders']); ?> <?php _e('types', 'chesta-slider'); ?></p>
                            <p><?php _e('Professional sliders with advanced features', 'chesta-slider'); ?></p>
                            <ul>
                                <li><?php _e('Hero Slider', 'chesta-slider'); ?></li>
                                <li><?php _e('Parallax', 'chesta-slider'); ?></li>
                                <li><?php _e('Thumbnail Navigation', 'chesta-slider'); ?></li>
                                <li><?php _e('Center Mode', 'chesta-slider'); ?></li>
                            </ul>
                        </div>

                        <div class="category-card">
                            <div class="category-icon">
                                <span class="dashicons dashicons-admin-post"></span>
                            </div>
                            <h4><?php _e('Content Sliders', 'chesta-slider'); ?></h4>
                            <p class="category-count"><?php echo esc_html($stats['content_sliders']); ?> <?php _e('types', 'chesta-slider'); ?></p>
                            <p><?php _e('Specialized sliders for different content types', 'chesta-slider'); ?></p>
                            <ul>
                                <li><?php _e('Testimonial', 'chesta-slider'); ?></li>
                                <li><?php _e('Product Slider', 'chesta-slider'); ?></li>
                                <li><?php _e('Video Slider', 'chesta-slider'); ?></li>
                                <li><?php _e('Post Slider', 'chesta-slider'); ?></li>
                            </ul>
                        </div>

                        <div class="category-card">
                            <div class="category-icon">
                                <span class="dashicons dashicons-controls-play"></span>
                            </div>
                            <h4><?php _e('Interactive Sliders', 'chesta-slider'); ?></h4>
                            <p class="category-count"><?php echo esc_html($stats['interactive_sliders']); ?> <?php _e('types', 'chesta-slider'); ?></p>
                            <p><?php _e('Engaging sliders with interactive elements', 'chesta-slider'); ?></p>
                            <ul>
                                <li><?php _e('3D Cube', 'chesta-slider'); ?></li>
                                <li><?php _e('Flip Cards', 'chesta-slider'); ?></li>
                                <li><?php _e('Coverflow', 'chesta-slider'); ?></li>
                                <li><?php _e('Countdown', 'chesta-slider'); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feature Highlights -->
            <div class="chesta-slider-card">
                <div class="card-header">
                    <h2>
                        <span class="dashicons dashicons-star-filled"></span>
                        <?php _e('Key Features', 'chesta-slider'); ?>
                    </h2>
                    <p><?php _e('Why Chesta Sliders is the perfect choice for your website', 'chesta-slider'); ?></p>
                </div>
                <div class="card-content">
                    <div class="feature-grid">
                        <?php foreach ($features as $feature): ?>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <span class="dashicons <?php echo esc_attr($feature['icon']); ?>"></span>
                            </div>
                            <h4><?php echo esc_html($feature['title']); ?></h4>
                            <p><?php echo esc_html($feature['description']); ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="chesta-slider-card">
                <div class="card-header">
                    <h2>
                        <span class="dashicons dashicons-admin-tools"></span>
                        <?php _e('Quick Actions', 'chesta-slider'); ?>
                    </h2>
                    <p><?php _e('Common tasks and helpful resources', 'chesta-slider'); ?></p>
                </div>
                <div class="card-content">
                    <div class="quick-actions">
                        <a href="<?php echo admin_url('admin.php?page=chesta-sliders-docs'); ?>" class="action-button primary">
                            <span class="dashicons dashicons-book"></span>
                            <?php _e('View Documentation', 'chesta-slider'); ?>
                        </a>
                        <a href="<?php echo admin_url('admin.php?page=chesta-sliders-tutorials'); ?>" class="action-button">
                            <span class="dashicons dashicons-slides"></span>
                            <?php _e('View Features & Sliders', 'chesta-slider'); ?>
                        </a>
                        <a href="<?php echo admin_url('admin.php?page=chesta-sliders-shortcodes'); ?>" class="action-button">
                            <span class="dashicons dashicons-shortcode"></span>
                            <?php _e('Shortcode Reference', 'chesta-slider'); ?>
                        </a>
                        <a href="<?php echo admin_url('post-new.php'); ?>" class="action-button">
                            <span class="dashicons dashicons-plus-alt2"></span>
                            <?php _e('Create New Post', 'chesta-slider'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="chesta-slider-sidebar">
            <!-- System Info -->
            <div class="chesta-slider-card">
                <div class="card-header">
                    <h3>
                        <span class="dashicons dashicons-info"></span>
                        <?php _e('System Info', 'chesta-slider'); ?>
                    </h3>
                </div>
                <div class="card-content">
                    <div class="system-info">
                        <div class="info-item">
                            <strong><?php _e('Plugin Version:', 'chesta-slider'); ?></strong>
                            <span><?php echo esc_html($this->version); ?></span>
                        </div>
                        <div class="info-item">
                            <strong><?php _e('WordPress Version:', 'chesta-slider'); ?></strong>
                            <span><?php echo esc_html(get_bloginfo('version')); ?></span>
                        </div>
                        <div class="info-item">
                            <strong><?php _e('PHP Version:', 'chesta-slider'); ?></strong>
                            <span><?php echo esc_html(PHP_VERSION); ?></span>
                        </div>
                        <div class="info-item">
                            <strong><?php _e('Gutenberg:', 'chesta-slider'); ?></strong>
                            <span class="status-<?php echo function_exists('register_block_type') ? 'active' : 'inactive'; ?>">
                                <?php echo function_exists('register_block_type') ? __('Active', 'chesta-slider') : __('Inactive', 'chesta-slider'); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Updates -->
            <div class="chesta-slider-card">
                <div class="card-header">
                    <h3>
                        <span class="dashicons dashicons-update"></span>
                        <?php _e('What\'s New', 'chesta-slider'); ?>
                    </h3>
                </div>
                <div class="card-content">
                    <div class="updates-list">
                        <div class="update-item">
                            <div class="update-version">v<?php echo esc_html($this->version); ?></div>
                            <div class="update-content">
                                <h4><?php _e('Complete Plugin Launch', 'chesta-slider'); ?></h4>
                                <ul>
                                    <li><?php _e('25+ Premium Slider Templates', 'chesta-slider'); ?></li>
                                    <li><?php _e('Full Gutenberg Integration', 'chesta-slider'); ?></li>
                                    <li><?php _e('Comprehensive Documentation', 'chesta-slider'); ?></li>
                                    <li><?php _e('50+ Customization Options', 'chesta-slider'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Support -->
            <div class="chesta-slider-card">
                <div class="card-header">
                    <h3>
                        <span class="dashicons dashicons-sos"></span>
                        <?php _e('Need Help?', 'chesta-slider'); ?>
                    </h3>
                </div>
                <div class="card-content">
                    <div class="support-links">
                        <a href="<?php echo admin_url('admin.php?page=chesta-sliders-support'); ?>" class="support-link">
                            <span class="dashicons dashicons-editor-help"></span>
                            <?php _e('Get Support', 'chesta-slider'); ?>
                        </a>
                        <a href="<?php echo admin_url('admin.php?page=chesta-sliders-docs'); ?>" class="support-link">
                            <span class="dashicons dashicons-book-alt"></span>
                            <?php _e('Documentation', 'chesta-slider'); ?>
                        </a>
                        <a href="<?php echo admin_url('admin.php?page=chesta-sliders-tutorials'); ?>" class="support-link">
                            <span class="dashicons dashicons-slides"></span>
                            <?php _e('Features & Sliders', 'chesta-slider'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
