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

<div class="wrap chesta-slider-admin modern-dashboard">
    <div class="chesta-slider-header modern-header">
        <div class="header-background">
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
            </div>
        </div>
        <div class="chesta-slider-header-content">
            <div class="chesta-slider-logo modern-logo">
                <div class="logo-icon">
                    <span class="dashicons dashicons-slides"></span>
                </div>
                <div class="logo-text">
                    <h1><?php _e('Chesta Sliders', 'chesta-slider'); ?></h1>
                    <p class="chesta-slider-tagline">
                        <?php _e('Create stunning, responsive sliders with 25+ premium templates', 'chesta-slider'); ?>
                    </p>
                </div>
            </div>
            <div class="chesta-slider-version modern-version">
                <span class="version-badge">v<?php echo esc_html($this->version); ?></span>
                <div class="status-indicator">
                    <span class="status-dot"></span>
                    <span class="status-text"><?php _e('Active', 'chesta-slider'); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="chesta-slider-dashboard">
        <!-- Statistics Section - Beautiful Designs -->
        <div class="chesta-stats-showcase">
            <!-- Circular Progress Stats -->
            <div class="stat-circle-container">
                <div class="stat-circle purple-gradient">
                    <div class="circle-progress" data-percent="100">
                        <div class="circle-inner">
                            <span class="circle-number"><?php echo esc_html($stats['total_sliders']); ?></span>
                            <span class="circle-label"><?php _e('Slider Types', 'chesta-slider'); ?></span>
                        </div>
                    </div>
                    <div class="circle-icon">
                        <span class="dashicons dashicons-slides"></span>
                    </div>
                </div>
            </div>

            <!-- Hexagon Stats -->
            <div class="stat-hexagon-container">
                <div class="stat-hexagon blue-gradient">
                    <div class="hexagon-content">
                        <span class="hex-number"><?php echo esc_html($stats['premium_sliders']); ?></span>
                        <span class="hex-label"><?php _e('Premium Templates', 'chesta-slider'); ?></span>
                    </div>
                    <div class="hex-icon">
                        <span class="dashicons dashicons-star-filled"></span>
                    </div>
                </div>
            </div>

            <!-- Diamond Stats -->
            <div class="stat-diamond-container">
                <div class="stat-diamond green-gradient">
                    <div class="diamond-content">
                        <span class="diamond-number"><?php echo esc_html($stats['total_sliders']); ?></span>
                        <span class="diamond-label"><?php _e('Gutenberg Blocks', 'chesta-slider'); ?></span>
                    </div>
                    <div class="diamond-icon">
                        <span class="dashicons dashicons-editor-table"></span>
                    </div>
                </div>
            </div>

            <!-- Wave Stats -->
            <div class="stat-wave-container">
                <div class="stat-wave orange-gradient">
                    <div class="wave-bg">
                        <svg viewBox="0 0 200 60" class="wave-svg">
                            <path d="M0,30 Q50,10 100,30 T200,30 L200,60 L0,60 Z" fill="rgba(255,255,255,0.2)"/>
                        </svg>
                    </div>
                    <div class="wave-content">
                        <span class="wave-number"><?php echo esc_html($stats['total_sliders'] + 1); ?></span>
                        <span class="wave-label"><?php _e('Shortcodes', 'chesta-slider'); ?></span>
                    </div>
                    <div class="wave-icon">
                        <span class="dashicons dashicons-shortcode"></span>
                    </div>
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

            <!-- Slider Categories - Beautiful Showcase -->
            <div class="categories-showcase">
                <div class="showcase-header">
                    <h2 class="showcase-title">
                        <span class="title-icon">🎨</span>
                        <?php _e('Slider Categories', 'chesta-slider'); ?>
                    </h2>
                    <p class="showcase-subtitle"><?php _e('Explore our comprehensive collection of 25+ slider types', 'chesta-slider'); ?></p>
                </div>

                <div class="categories-grid">
                    <!-- Image Sliders -->
                    <div class="category-showcase image-category">
                        <div class="category-background">
                            <div class="bg-pattern"></div>
                        </div>
                        <div class="category-content">
                            <div class="category-emoji">🖼️</div>
                            <h3 class="category-title"><?php _e('Image Sliders', 'chesta-slider'); ?></h3>
                            <div class="category-count">5 <?php _e('Types', 'chesta-slider'); ?></div>
                            <div class="category-features">
                                <span class="feature-tag"><?php _e('Gallery', 'chesta-slider'); ?></span>
                                <span class="feature-tag"><?php _e('Carousel', 'chesta-slider'); ?></span>
                                <span class="feature-tag"><?php _e('Fade', 'chesta-slider'); ?></span>
                            </div>
                        </div>
                        <div class="category-glow"></div>
                    </div>

                    <!-- Content Sliders -->
                    <div class="category-showcase content-category">
                        <div class="category-background">
                            <div class="bg-pattern"></div>
                        </div>
                        <div class="category-content">
                            <div class="category-emoji">📝</div>
                            <h3 class="category-title"><?php _e('Content Sliders', 'chesta-slider'); ?></h3>
                            <div class="category-count">4 <?php _e('Types', 'chesta-slider'); ?></div>
                            <div class="category-features">
                                <span class="feature-tag"><?php _e('Posts', 'chesta-slider'); ?></span>
                                <span class="feature-tag"><?php _e('Testimonials', 'chesta-slider'); ?></span>
                                <span class="feature-tag"><?php _e('Text', 'chesta-slider'); ?></span>
                            </div>
                        </div>
                        <div class="category-glow"></div>
                    </div>

                    <!-- Media Sliders -->
                    <div class="category-showcase media-category">
                        <div class="category-background">
                            <div class="bg-pattern"></div>
                        </div>
                        <div class="category-content">
                            <div class="category-emoji">🎬</div>
                            <h3 class="category-title"><?php _e('Media Sliders', 'chesta-slider'); ?></h3>
                            <div class="category-count">4 <?php _e('Types', 'chesta-slider'); ?></div>
                            <div class="category-features">
                                <span class="feature-tag"><?php _e('Video', 'chesta-slider'); ?></span>
                                <span class="feature-tag"><?php _e('YouTube', 'chesta-slider'); ?></span>
                                <span class="feature-tag"><?php _e('Vimeo', 'chesta-slider'); ?></span>
                            </div>
                        </div>
                        <div class="category-glow"></div>
                    </div>

                    <!-- Layout Sliders -->
                    <div class="category-showcase layout-category">
                        <div class="category-background">
                            <div class="bg-pattern"></div>
                        </div>
                        <div class="category-content">
                            <div class="category-emoji">📐</div>
                            <h3 class="category-title"><?php _e('Layout Sliders', 'chesta-slider'); ?></h3>
                            <div class="category-count">4 <?php _e('Types', 'chesta-slider'); ?></div>
                            <div class="category-features">
                                <span class="feature-tag"><?php _e('Hero', 'chesta-slider'); ?></span>
                                <span class="feature-tag"><?php _e('Vertical', 'chesta-slider'); ?></span>
                                <span class="feature-tag"><?php _e('Multi-row', 'chesta-slider'); ?></span>
                            </div>
                        </div>
                        <div class="category-glow"></div>
                    </div>

                    <!-- Interactive Sliders -->
                    <div class="category-showcase interactive-category">
                        <div class="category-background">
                            <div class="bg-pattern"></div>
                        </div>
                        <div class="category-content">
                            <div class="category-emoji">⚡</div>
                            <h3 class="category-title"><?php _e('Interactive Sliders', 'chesta-slider'); ?></h3>
                            <div class="category-count">4 <?php _e('Types', 'chesta-slider'); ?></div>
                            <div class="category-features">
                                <span class="feature-tag"><?php _e('3D Cube', 'chesta-slider'); ?></span>
                                <span class="feature-tag"><?php _e('Parallax', 'chesta-slider'); ?></span>
                                <span class="feature-tag"><?php _e('Flip', 'chesta-slider'); ?></span>
                            </div>
                        </div>
                        <div class="category-glow"></div>
                    </div>

                    <!-- E-commerce Sliders -->
                    <div class="category-showcase ecommerce-category">
                        <div class="category-background">
                            <div class="bg-pattern"></div>
                        </div>
                        <div class="category-content">
                            <div class="category-emoji">🛒</div>
                            <h3 class="category-title"><?php _e('E-commerce Sliders', 'chesta-slider'); ?></h3>
                            <div class="category-count">4 <?php _e('Types', 'chesta-slider'); ?></div>
                            <div class="category-features">
                                <span class="feature-tag"><?php _e('Products', 'chesta-slider'); ?></span>
                                <span class="feature-tag"><?php _e('WooCommerce', 'chesta-slider'); ?></span>
                                <span class="feature-tag"><?php _e('Shop', 'chesta-slider'); ?></span>
                            </div>
                        </div>
                        <div class="category-glow"></div>
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

<style>
/* Beautiful Stats Showcase */
.chesta-stats-showcase {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
    margin: 30px 0;
    padding: 20px 0;
}

/* Circular Progress Stats */
.stat-circle-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.stat-circle {
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.purple-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.circle-inner {
    text-align: center;
    color: white;
    z-index: 2;
}

.circle-number {
    display: block;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 5px;
}

.circle-label {
    font-size: 12px;
    opacity: 0.9;
}

.circle-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    color: rgba(255,255,255,0.7);
    font-size: 20px;
}

/* Hexagon Stats */
.stat-hexagon-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.stat-hexagon {
    width: 140px;
    height: 120px;
    position: relative;
    clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.blue-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.hexagon-content {
    text-align: center;
    color: white;
    z-index: 2;
}

.hex-number {
    display: block;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 5px;
}

.hex-label {
    font-size: 11px;
    opacity: 0.9;
}

.hex-icon {
    position: absolute;
    top: 15px;
    right: 20px;
    color: rgba(255,255,255,0.7);
    font-size: 16px;
}

/* Diamond Stats */
.stat-diamond-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.stat-diamond {
    width: 120px;
    height: 120px;
    position: relative;
    transform: rotate(45deg);
    display: flex;
    align-items: center;
    justify-content: center;
}

.green-gradient {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    box-shadow: 0 10px 30px rgba(17, 153, 142, 0.3);
}

.diamond-content {
    text-align: center;
    color: white;
    transform: rotate(-45deg);
    z-index: 2;
}

.diamond-number {
    display: block;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 5px;
}

.diamond-label {
    font-size: 10px;
    opacity: 0.9;
}

.diamond-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    color: rgba(255,255,255,0.7);
    font-size: 16px;
    transform: rotate(-45deg);
}

/* Wave Stats */
.stat-wave-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.stat-wave {
    width: 160px;
    height: 100px;
    position: relative;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.orange-gradient {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    box-shadow: 0 10px 30px rgba(240, 147, 251, 0.3);
}

.wave-bg {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 60px;
}

.wave-svg {
    width: 100%;
    height: 100%;
}

.wave-content {
    text-align: center;
    color: white;
    z-index: 2;
}

.wave-number {
    display: block;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 5px;
}

.wave-label {
    font-size: 11px;
    opacity: 0.9;
}

.wave-icon {
    position: absolute;
    top: 10px;
    right: 15px;
    color: rgba(255,255,255,0.7);
    font-size: 18px;
}

/* Categories Showcase */
.categories-showcase {
    margin: 40px 0;
    padding: 30px 0;
}

.showcase-header {
    text-align: center;
    margin-bottom: 40px;
}

.showcase-title {
    font-size: 32px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
}

.title-icon {
    font-size: 36px;
    margin-right: 10px;
}

.showcase-subtitle {
    font-size: 16px;
    color: #7f8c8d;
    margin: 0;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    max-width: 1200px;
    margin: 0 auto;
}

.category-showcase {
    position: relative;
    height: 200px;
    border-radius: 20px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
}

.category-showcase:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.category-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0.9;
}

.image-category .category-background {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.content-category .category-background {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.media-category .category-background {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.layout-category .category-background {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
}

.interactive-category .category-background {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
}

.ecommerce-category .category-background {
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
}

.bg-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%);
}

.category-content {
    position: relative;
    z-index: 2;
    padding: 25px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    color: white;
}

.category-emoji {
    font-size: 40px;
    margin-bottom: 10px;
}

.category-title {
    font-size: 20px;
    font-weight: 600;
    margin: 0 0 8px 0;
}

.category-count {
    font-size: 14px;
    opacity: 0.9;
    margin-bottom: 15px;
    font-weight: 500;
}

.category-features {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.feature-tag {
    background: rgba(255,255,255,0.2);
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
    backdrop-filter: blur(10px);
}

.category-glow {
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.category-showcase:hover .category-glow {
    opacity: 1;
}

/* Responsive Design */
@media (max-width: 768px) {
    .chesta-stats-showcase {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .categories-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .showcase-title {
        font-size: 24px;
    }
    
    .category-showcase {
        height: 160px;
    }
    
    .category-content {
        padding: 20px;
    }
    
    .category-emoji {
        font-size: 30px;
    }
    
    .category-title {
        font-size: 18px;
    }
}

@media (max-width: 480px) {
    .chesta-stats-showcase {
        grid-template-columns: 1fr;
    }
    
    .stat-circle, .stat-hexagon, .stat-diamond, .stat-wave {
        transform: scale(0.8);
    }
}
</style>
