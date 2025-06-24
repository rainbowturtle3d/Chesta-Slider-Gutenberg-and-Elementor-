<?php
/**
 * Admin Features & Sliders View
 * Features and slider types showcase for Chesta Slider
 *
 * @package ChestaSlider
 * @subpackage ChestaSlider/includes/admin/views
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define all slider types with their features
$slider_types = array(
    'image_sliders' => array(
        'title' => __('Image Sliders', 'chesta-slider'),
        'icon' => 'dashicons-format-image',
        'sliders' => array(
            array(
                'name' => __('Classic Carousel', 'chesta-slider'),
                'description' => __('Traditional horizontal sliding with smooth transitions', 'chesta-slider'),
                'features' => array('Infinite loop', 'Auto-play', 'Navigation arrows', 'Dot indicators')
            ),
            array(
                'name' => __('Fade Slider', 'chesta-slider'),
                'description' => __('Elegant fade in/out transitions between images', 'chesta-slider'),
                'features' => array('Smooth fading', 'Customizable duration', 'Overlay support', 'Lazy loading')
            ),
            array(
                'name' => __('Cube Slider', 'chesta-slider'),
                'description' => __('3D cube rotation effect for modern presentations', 'chesta-slider'),
                'features' => array('3D transitions', 'Touch gestures', 'Hardware acceleration', 'Mobile optimized')
            ),
            array(
                'name' => __('Flip Slider', 'chesta-slider'),
                'description' => __('Dynamic flip animations with depth effects', 'chesta-slider'),
                'features' => array('Flip animations', 'Perspective effects', 'Responsive design', 'Custom timing')
            ),
            array(
                'name' => __('Coverflow Slider', 'chesta-slider'),
                'description' => __('Apple-style coverflow effect with 3D perspective', 'chesta-slider'),
                'features' => array('3D coverflow', 'Center focus', 'Smooth transitions', 'Touch navigation')
            )
        )
    ),
    'content_sliders' => array(
        'title' => __('Content Sliders', 'chesta-slider'),
        'icon' => 'dashicons-admin-post',
        'sliders' => array(
            array(
                'name' => __('Post Slider', 'chesta-slider'),
                'description' => __('Display blog posts with images, titles, and excerpts', 'chesta-slider'),
                'features' => array('Featured images', 'Post titles', 'Excerpts', 'Read more links', 'Category filtering')
            ),
            array(
                'name' => __('Portfolio Slider', 'chesta-slider'),
                'description' => __('Showcase portfolio items with custom post types', 'chesta-slider'),
                'features' => array('Custom post types', 'Project details', 'Image galleries', 'Filter options')
            ),
            array(
                'name' => __('Mixed Content Slider', 'chesta-slider'),
                'description' => __('Combine any Gutenberg blocks in sliding format', 'chesta-slider'),
                'features' => array('Any block support', 'Rich content', 'Flexible layouts', 'Custom styling')
            ),
            array(
                'name' => __('Testimonial Slider', 'chesta-slider'),
                'description' => __('Customer testimonials with photos and ratings', 'chesta-slider'),
                'features' => array('Customer photos', 'Star ratings', 'Quote styling', 'Company logos')
            )
        )
    ),
    'media_sliders' => array(
        'title' => __('Media Sliders', 'chesta-slider'),
        'icon' => 'dashicons-video-alt3',
        'sliders' => array(
            array(
                'name' => __('Video Slider', 'chesta-slider'),
                'description' => __('YouTube, Vimeo, and self-hosted video presentations', 'chesta-slider'),
                'features' => array('YouTube integration', 'Vimeo support', 'Self-hosted videos', 'Autoplay controls', 'Thumbnail previews')
            ),
            array(
                'name' => __('Gallery Slider', 'chesta-slider'),
                'description' => __('Image galleries with thumbnail navigation', 'chesta-slider'),
                'features' => array('Thumbnail navigation', 'Lightbox integration', 'Zoom functionality', 'Bulk upload')
            ),
            array(
                'name' => __('Logo Carousel', 'chesta-slider'),
                'description' => __('Client logos and brand showcases', 'chesta-slider'),
                'features' => array('Brand logos', 'Hover effects', 'Link integration', 'Grayscale options')
            ),
            array(
                'name' => __('Audio Slider', 'chesta-slider'),
                'description' => __('Music and podcast sliders with audio controls', 'chesta-slider'),
                'features' => array('Audio playback', 'Playlist support', 'Waveform display', 'Volume controls')
            )
        )
    ),
    'layout_sliders' => array(
        'title' => __('Layout Sliders', 'chesta-slider'),
        'icon' => 'dashicons-layout',
        'sliders' => array(
            array(
                'name' => __('Full-Width Hero Slider', 'chesta-slider'),
                'description' => __('Large hero sections with call-to-action buttons', 'chesta-slider'),
                'features' => array('Full viewport width', 'CTA buttons', 'Text overlays', 'Background videos')
            ),
            array(
                'name' => __('Vertical Slider', 'chesta-slider'),
                'description' => __('Unique vertical sliding animations', 'chesta-slider'),
                'features' => array('Vertical transitions', 'Space efficient', 'Touch gestures', 'Scroll integration')
            ),
            array(
                'name' => __('Multi-Row Slider', 'chesta-slider'),
                'description' => __('Display multiple items per slide', 'chesta-slider'),
                'features' => array('Multiple rows', 'Grid layouts', 'Responsive columns', 'Item spacing')
            ),
            array(
                'name' => __('Thumbnail Navigation Slider', 'chesta-slider'),
                'description' => __('Main slider with thumbnail preview navigation', 'chesta-slider'),
                'features' => array('Thumbnail previews', 'Sync navigation', 'Custom positioning', 'Hover effects')
            )
        )
    ),
    'interactive_sliders' => array(
        'title' => __('Interactive Sliders', 'chesta-slider'),
        'icon' => 'dashicons-controls-play',
        'sliders' => array(
            array(
                'name' => __('CTA Button Slider', 'chesta-slider'),
                'description' => __('Slides with prominent call-to-action buttons', 'chesta-slider'),
                'features' => array('Custom buttons', 'Link destinations', 'Button styling', 'Conversion tracking')
            ),
            array(
                'name' => __('Countdown Timer Slider', 'chesta-slider'),
                'description' => __('Promotional slides with countdown timers', 'chesta-slider'),
                'features' => array('Live countdowns', 'Event timers', 'Urgency creation', 'Custom styling')
            ),
            array(
                'name' => __('Parallax Slider', 'chesta-slider'),
                'description' => __('Background parallax effects during transitions', 'chesta-slider'),
                'features' => array('Parallax backgrounds', 'Depth effects', 'Smooth scrolling', 'Performance optimized')
            ),
            array(
                'name' => __('Animated Text Overlay Slider', 'chesta-slider'),
                'description' => __('Dynamic text animations over images', 'chesta-slider'),
                'features' => array('Text animations', 'Custom fonts', 'Overlay positioning', 'Animation timing')
            )
        )
    ),
    'ecommerce_sliders' => array(
        'title' => __('E-commerce Sliders', 'chesta-slider'),
        'icon' => 'dashicons-cart',
        'sliders' => array(
            array(
                'name' => __('Product Slider', 'chesta-slider'),
                'description' => __('WooCommerce product showcases with pricing', 'chesta-slider'),
                'features' => array('WooCommerce integration', 'Product images', 'Pricing display', 'Add to cart', 'Sale badges')
            ),
            array(
                'name' => __('Category Slider', 'chesta-slider'),
                'description' => __('Product categories with featured images', 'chesta-slider'),
                'features' => array('Category images', 'Product counts', 'Category links', 'Custom layouts')
            ),
            array(
                'name' => __('Featured Products Slider', 'chesta-slider'),
                'description' => __('Highlight special offers and featured items', 'chesta-slider'),
                'features' => array('Featured products', 'Special offers', 'Discount badges', 'Quick view')
            ),
            array(
                'name' => __('Shopping Cart Slider', 'chesta-slider'),
                'description' => __('Recently viewed and recommended products', 'chesta-slider'),
                'features' => array('Recently viewed', 'Recommendations', 'Quick add to cart', 'Price comparison')
            )
        )
    )
);

$key_features = array(
    array(
        'icon' => 'dashicons-smartphone',
        'title' => __('Fully Responsive', 'chesta-slider'),
        'description' => __('Perfect display on all devices and screen sizes')
    ),
    array(
        'icon' => 'dashicons-performance',
        'title' => __('Lightweight & Fast', 'chesta-slider'),
        'description' => __('Minimal dependencies, no jQuery, optimized performance')
    ),
    array(
        'icon' => 'dashicons-admin-customizer',
        'title' => __('Highly Customizable', 'chesta-slider'),
        'description' => __('Granular control over every aspect of your sliders')
    ),
    array(
        'icon' => 'dashicons-universal-access-alt',
        'title' => __('Accessibility Ready', 'chesta-slider'),
        'description' => __('Full ARIA support and keyboard navigation')
    ),
    array(
        'icon' => 'dashicons-editor-table',
        'title' => __('Gutenberg Native', 'chesta-slider'),
        'description' => __('Built specifically for the WordPress block editor')
    ),
    array(
        'icon' => 'dashicons-layout',
        'title' => __('Elementor Compatible', 'chesta-slider'),
        'description' => __('Seamless integration with Elementor themes')
    )
);
?>

<div class="wrap chesta-slider-admin">
    <div class="chesta-slider-header">
        <div class="chesta-slider-header-content">
            <div class="chesta-slider-logo">
                <h1>
                    <span class="dashicons dashicons-slides"></span>
                    <?php _e('Features & Sliders', 'chesta-slider'); ?>
                </h1>
                <p class="chesta-slider-tagline">
                    <?php _e('Discover 25+ premium slider types and powerful features', 'chesta-slider'); ?>
                </p>
            </div>
        </div>
    </div>

    <div class="chesta-slider-content">
        
        <!-- Key Features Section -->
        <div class="features-overview">
            <h2><?php _e('Why Choose Chesta Slider?', 'chesta-slider'); ?></h2>
            <div class="features-grid">
                <?php foreach ($key_features as $feature): ?>
                <div class="feature-card">
                    <div class="feature-icon">
                        <span class="dashicons <?php echo esc_attr($feature['icon']); ?>"></span>
                    </div>
                    <h3><?php echo esc_html($feature['title']); ?></h3>
                    <p><?php echo esc_html($feature['description']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Slider Types Section -->
        <div class="slider-types-container">
            <h2><?php _e('25+ Premium Slider Types', 'chesta-slider'); ?></h2>
            <p class="section-description"><?php _e('Choose from our comprehensive collection of professionally designed slider types, each optimized for specific use cases and content types.', 'chesta-slider'); ?></p>

            <?php foreach ($slider_types as $category_key => $category): ?>
            <div class="slider-category">
                <div class="category-header">
                    <h3>
                        <span class="dashicons <?php echo esc_attr($category['icon']); ?>"></span>
                        <?php echo esc_html($category['title']); ?>
                    </h3>
                </div>
                
                <div class="sliders-grid">
                    <?php foreach ($category['sliders'] as $slider): ?>
                    <div class="slider-card">
                        <div class="slider-header">
                            <h4><?php echo esc_html($slider['name']); ?></h4>
                        </div>
                        <div class="slider-description">
                            <p><?php echo esc_html($slider['description']); ?></p>
                        </div>
                        <div class="slider-features">
                            <h5><?php _e('Key Features:', 'chesta-slider'); ?></h5>
                            <ul>
                                <?php foreach ($slider['features'] as $feature): ?>
                                <li><span class="dashicons dashicons-yes-alt"></span> <?php echo esc_html($feature); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="slider-actions">
                            <button class="button button-primary" onclick="showSliderDemo('<?php echo esc_js($category_key . '_' . sanitize_title($slider['name'])); ?>')">
                                <?php _e('View Demo', 'chesta-slider'); ?>
                            </button>
                            <button class="button button-secondary" onclick="createSlider('<?php echo esc_js(sanitize_title($slider['name'])); ?>')">
                                <?php _e('Create Now', 'chesta-slider'); ?>
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Advanced Features Section -->
        <div class="advanced-features">
            <h2><?php _e('Advanced Features & Controls', 'chesta-slider'); ?></h2>
            <div class="advanced-features-grid">
                
                <div class="advanced-feature">
                    <h3><span class="dashicons dashicons-admin-settings"></span> <?php _e('Granular Controls', 'chesta-slider'); ?></h3>
                    <ul>
                        <li><?php _e('Height, width, margin, padding adjustments', 'chesta-slider'); ?></li>
                        <li><?php _e('Animation types and timing controls', 'chesta-slider'); ?></li>
                        <li><?php _e('Autoplay with pause on hover', 'chesta-slider'); ?></li>
                        <li><?php _e('Custom CSS classes for advanced styling', 'chesta-slider'); ?></li>
                    </ul>
                </div>

                <div class="advanced-feature">
                    <h3><span class="dashicons dashicons-controls-forward"></span> <?php _e('Navigation Options', 'chesta-slider'); ?></h3>
                    <ul>
                        <li><?php _e('Customizable arrows and dots', 'chesta-slider'); ?></li>
                        <li><?php _e('Keyboard navigation (arrow keys)', 'chesta-slider'); ?></li>
                        <li><?php _e('Mouse wheel navigation', 'chesta-slider'); ?></li>
                        <li><?php _e('Touch and swipe support', 'chesta-slider'); ?></li>
                    </ul>
                </div>

                <div class="advanced-feature">
                    <h3><span class="dashicons dashicons-performance"></span> <?php _e('Performance Features', 'chesta-slider'); ?></h3>
                    <ul>
                        <li><?php _e('Lazy loading for images and videos', 'chesta-slider'); ?></li>
                        <li><?php _e('Hardware acceleration support', 'chesta-slider'); ?></li>
                        <li><?php _e('Minimal JavaScript footprint', 'chesta-slider'); ?></li>
                        <li><?php _e('Optimized for Core Web Vitals', 'chesta-slider'); ?></li>
                    </ul>
                </div>

                <div class="advanced-feature">
                    <h3><span class="dashicons dashicons-universal-access"></span> <?php _e('Accessibility & Standards', 'chesta-slider'); ?></h3>
                    <ul>
                        <li><?php _e('Full ARIA roles and labels', 'chesta-slider'); ?></li>
                        <li><?php _e('RTL (Right-to-Left) language support', 'chesta-slider'); ?></li>
                        <li><?php _e('Screen reader compatibility', 'chesta-slider'); ?></li>
                        <li><?php _e('WCAG 2.1 compliance', 'chesta-slider'); ?></li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- Getting Started Section -->
        <div class="getting-started">
            <h2><?php _e('Ready to Get Started?', 'chesta-slider'); ?></h2>
            <div class="getting-started-content">
                <div class="getting-started-steps">
                    <div class="step">
                        <div class="step-number">1</div>
                        <h3><?php _e('Choose Your Slider', 'chesta-slider'); ?></h3>
                        <p><?php _e('Select from 25+ slider types above', 'chesta-slider'); ?></p>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <h3><?php _e('Add to Your Page', 'chesta-slider'); ?></h3>
                        <p><?php _e('Use Gutenberg blocks or shortcodes', 'chesta-slider'); ?></p>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <h3><?php _e('Customize & Publish', 'chesta-slider'); ?></h3>
                        <p><?php _e('Configure settings and go live', 'chesta-slider'); ?></p>
                    </div>
                </div>
                <div class="getting-started-actions">
                    <a href="<?php echo admin_url('admin.php?page=chesta-sliders-documentation'); ?>" class="button button-primary button-large">
                        <?php _e('View Documentation', 'chesta-slider'); ?>
                    </a>
                    <a href="<?php echo admin_url('post-new.php'); ?>" class="button button-secondary button-large">
                        <?php _e('Create Your First Slider', 'chesta-slider'); ?>
                    </a>
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

/* Features Overview */
.features-overview {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.features-overview h2 {
    text-align: center;
    color: #2271b1;
    margin-bottom: 30px;
    font-size: 28px;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.feature-card {
    text-align: center;
    padding: 25px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.feature-icon {
    margin-bottom: 15px;
}

.feature-icon .dashicons {
    font-size: 48px;
    color: #2271b1;
    width: 48px;
    height: 48px;
}

.feature-card h3 {
    color: #1d2327;
    margin-bottom: 10px;
    font-size: 18px;
}

.feature-card p {
    color: #50575e;
    line-height: 1.5;
}

/* Slider Types */
.slider-types-container {
    margin-bottom: 40px;
}

.slider-types-container > h2 {
    text-align: center;
    color: #2271b1;
    margin-bottom: 15px;
    font-size: 28px;
}

.section-description {
    text-align: center;
    color: #50575e;
    font-size: 16px;
    margin-bottom: 40px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.slider-category {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 30px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.category-header {
    background: linear-gradient(135deg, #2271b1, #135e96);
    color: white;
    padding: 20px 30px;
}

.category-header h3 {
    margin: 0;
    font-size: 22px;
    display: flex;
    align-items: center;
}

.category-header .dashicons {
    margin-right: 12px;
    font-size: 24px;
}

.sliders-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 25px;
    padding: 30px;
}

.slider-card {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 25px;
    background: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.slider-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.slider-header h4 {
    color: #2271b1;
    margin: 0 0 15px 0;
    font-size: 18px;
    font-weight: 600;
}

.slider-description p {
    color: #50575e;
    line-height: 1.5;
    margin-bottom: 20px;
}

.slider-features h5 {
    color: #1d2327;
    margin: 0 0 10px 0;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
}

.slider-features ul {
    list-style: none;
    margin: 0 0 20px 0;
    padding: 0;
}

.slider-features li {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    color: #50575e;
    font-size: 14px;
}

.slider-features .dashicons {
    color: #00a32a;
    margin-right: 8px;
    font-size: 16px;
    width: 16px;
    height: 16px;
}

.slider-actions {
    display: flex;
    gap: 10px;
}

.slider-actions .button {
    flex: 1;
    text-align: center;
    justify-content: center;
}

/* Advanced Features */
.advanced-features {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.advanced-features h2 {
    text-align: center;
    color: #2271b1;
    margin-bottom: 30px;
    font-size: 28px;
}

.advanced-features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}

.advanced-feature {
    padding: 25px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.advanced-feature h3 {
    color: #2271b1;
    margin-bottom: 15px;
    font-size: 16px;
    display: flex;
    align-items: center;
}

.advanced-feature .dashicons {
    margin-right: 10px;
    font-size: 20px;
}

.advanced-feature ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.advanced-feature li {
    color: #50575e;
    margin-bottom: 8px;
    padding-left: 15px;
    position: relative;
    line-height: 1.4;
}

.advanced-feature li:before {
    content: "•";
    color: #2271b1;
    position: absolute;
    left: 0;
    font-weight: bold;
}

/* Getting Started */
.getting-started {
    background: linear-gradient(135deg, #2271b1, #135e96);
    color: white;
    border-radius: 8px;
    padding: 40px;
    text-align: center;
}

.getting-started h2 {
    margin-bottom: 30px;
    font-size: 28px;
}

.getting-started-steps {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.step {
    text-align: center;
}

.step-number {
    width: 50px;
    height: 50px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: bold;
    margin: 0 auto 15px;
}

.step h3 {
    margin-bottom: 10px;
    font-size: 18px;
}

.step p {
    opacity: 0.9;
    line-height: 1.4;
}

.getting-started-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.getting-started-actions .button {
    padding: 12px 30px;
    font-size: 16px;
    height: auto;
    line-height: 1.4;
}

/* Responsive Design */
@media (max-width: 768px) {
    .features-grid,
    .sliders-grid,
    .advanced-features-grid {
        grid-template-columns: 1fr;
    }
    
    .getting-started-steps {
        grid-template-columns: 1fr;
    }
    
    .getting-started-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .getting-started-actions .button {
        width: 100%;
        max-width: 300px;
    }
}
</style>

<script>
function showSliderDemo(sliderId) {
    // Placeholder for demo functionality
    alert('Demo functionality will be implemented in future updates. For now, please check the documentation for examples.');
}

function createSlider(sliderType) {
    // Redirect to post editor to create new slider
    window.open('<?php echo admin_url('post-new.php'); ?>', '_blank');
}
</script>
