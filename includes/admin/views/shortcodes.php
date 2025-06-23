<?php
/**
 * Shortcodes Reference View
 * Complete shortcode documentation for all 25+ slider types
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
            <h1>
                <span class="dashicons dashicons-shortcode"></span>
                <?php _e('Shortcode Reference', 'chesta-slider'); ?>
            </h1>
            <p class="chesta-slider-tagline">
                <?php _e('Complete guide to all Chesta Slider shortcodes and parameters', 'chesta-slider'); ?>
            </p>
        </div>
    </div>

    <div class="chesta-slider-shortcodes-page">
        <!-- Quick Navigation -->
        <div class="shortcode-navigation">
            <h3><?php _e('Quick Navigation', 'chesta-slider'); ?></h3>
            <div class="nav-tabs">
                <button class="nav-tab active" data-tab="basic-usage"><?php _e('Basic Usage', 'chesta-slider'); ?></button>
                <button class="nav-tab" data-tab="all-sliders"><?php _e('All Slider Types', 'chesta-slider'); ?></button>
                <button class="nav-tab" data-tab="parameters"><?php _e('Parameters', 'chesta-slider'); ?></button>
                <button class="nav-tab" data-tab="examples"><?php _e('Examples', 'chesta-slider'); ?></button>
            </div>
        </div>

        <!-- Basic Usage Tab -->
        <div id="basic-usage" class="tab-content active">
            <div class="chesta-slider-card">
                <div class="card-header">
                    <h2><?php _e('Basic Usage', 'chesta-slider'); ?></h2>
                    <p><?php _e('Simple shortcode examples to get you started quickly', 'chesta-slider'); ?></p>
                </div>
                <div class="card-content">
                    <div class="shortcode-examples">
                        <div class="example-item">
                            <h4><?php _e('Basic Carousel Slider', 'chesta-slider'); ?></h4>
                            <div class="shortcode-box">
                                <code>[chesta_slider type="carousel"]</code>
                                <button class="copy-shortcode" data-shortcode='[chesta_slider type="carousel"]'>
                                    <span class="dashicons dashicons-admin-page"></span>
                                    <?php _e('Copy', 'chesta-slider'); ?>
                                </button>
                            </div>
                            <p class="example-description"><?php _e('Creates a basic carousel slider with default settings', 'chesta-slider'); ?></p>
                        </div>

                        <div class="example-item">
                            <h4><?php _e('Hero Slider with Autoplay', 'chesta-slider'); ?></h4>
                            <div class="shortcode-box">
                                <code>[chesta_slider type="hero" autoplay="true" autoplay_speed="5000"]</code>
                                <button class="copy-shortcode" data-shortcode='[chesta_slider type="hero" autoplay="true" autoplay_speed="5000"]'>
                                    <span class="dashicons dashicons-admin-page"></span>
                                    <?php _e('Copy', 'chesta-slider'); ?>
                                </button>
                            </div>
                            <p class="example-description"><?php _e('Full-width hero slider with 5-second autoplay', 'chesta-slider'); ?></p>
                        </div>

                        <div class="example-item">
                            <h4><?php _e('Testimonial Slider', 'chesta-slider'); ?></h4>
                            <div class="shortcode-box">
                                <code>[chesta_slider type="testimonial" dots="true" arrows="false"]</code>
                                <button class="copy-shortcode" data-shortcode='[chesta_slider type="testimonial" dots="true" arrows="false"]'>
                                    <span class="dashicons dashicons-admin-page"></span>
                                    <?php _e('Copy', 'chesta-slider'); ?>
                                </button>
                            </div>
                            <p class="example-description"><?php _e('Testimonial slider with dots navigation, no arrows', 'chesta-slider'); ?></p>
                        </div>

                        <div class="example-item">
                            <h4><?php _e('Custom Slides with Content', 'chesta-slider'); ?></h4>
                            <div class="shortcode-box">
                                <code>[chesta_slider type="fade"]<br>
                                &nbsp;&nbsp;[slide title="Slide 1" image="image1.jpg"]Your content here[/slide]<br>
                                &nbsp;&nbsp;[slide title="Slide 2" image="image2.jpg"]More content[/slide]<br>
                                [/chesta_slider]</code>
                                <button class="copy-shortcode" data-shortcode='[chesta_slider type="fade"][slide title="Slide 1" image="image1.jpg"]Your content here[/slide][slide title="Slide 2" image="image2.jpg"]More content[/slide][/chesta_slider]'>
                                    <span class="dashicons dashicons-admin-page"></span>
                                    <?php _e('Copy', 'chesta-slider'); ?>
                                </button>
                            </div>
                            <p class="example-description"><?php _e('Fade slider with custom slide content', 'chesta-slider'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- All Slider Types Tab -->
        <div id="all-sliders" class="tab-content">
            <div class="chesta-slider-card">
                <div class="card-header">
                    <h2><?php _e('All 25+ Slider Types', 'chesta-slider'); ?></h2>
                    <p><?php _e('Complete list of available slider types with shortcodes', 'chesta-slider'); ?></p>
                </div>
                <div class="card-content">
                    <div class="slider-types-grid">
                        <?php foreach ($templates as $type => $template): ?>
                        <div class="slider-type-card">
                            <div class="slider-type-header">
                                <div class="slider-icon">
                                    <span class="dashicons dashicons-<?php echo esc_attr($template['icon']); ?>"></span>
                                </div>
                                <div class="slider-info">
                                    <h4><?php echo esc_html($template['name']); ?></h4>
                                    <?php if ($template['premium']): ?>
                                    <span class="premium-badge"><?php _e('Premium', 'chesta-slider'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <p class="slider-description"><?php echo esc_html($template['description']); ?></p>
                            
                            <div class="shortcode-examples">
                                <div class="shortcode-item">
                                    <label><?php _e('Basic Shortcode:', 'chesta-slider'); ?></label>
                                    <div class="shortcode-box">
                                        <code>[chesta_slider type="<?php echo esc_attr($type); ?>"]</code>
                                        <button class="copy-shortcode" data-shortcode='[chesta_slider type="<?php echo esc_attr($type); ?>"]'>
                                            <span class="dashicons dashicons-admin-page"></span>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="shortcode-item">
                                    <label><?php _e('Alternative Shortcode:', 'chesta-slider'); ?></label>
                                    <div class="shortcode-box">
                                        <code>[chesta_<?php echo esc_attr($type); ?>]</code>
                                        <button class="copy-shortcode" data-shortcode='[chesta_<?php echo esc_attr($type); ?>]'>
                                            <span class="dashicons dashicons-admin-page"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="slider-category">
                                <span class="category-badge category-<?php echo esc_attr($template['category']); ?>">
                                    <?php echo esc_html(ucfirst($template['category'])); ?>
                                </span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Parameters Tab -->
        <div id="parameters" class="tab-content">
            <div class="chesta-slider-card">
                <div class="card-header">
                    <h2><?php _e('All Available Parameters', 'chesta-slider'); ?></h2>
                    <p><?php _e('Complete reference of all shortcode parameters and their options', 'chesta-slider'); ?></p>
                </div>
                <div class="card-content">
                    <div class="parameters-sections">
                        <!-- Display Settings -->
                        <div class="parameter-section">
                            <h3>
                                <span class="dashicons dashicons-visibility"></span>
                                <?php _e('Display Settings', 'chesta-slider'); ?>
                            </h3>
                            <div class="parameters-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th><?php _e('Parameter', 'chesta-slider'); ?></th>
                                            <th><?php _e('Description', 'chesta-slider'); ?></th>
                                            <th><?php _e('Default', 'chesta-slider'); ?></th>
                                            <th><?php _e('Options', 'chesta-slider'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>type</code></td>
                                            <td><?php _e('Slider type', 'chesta-slider'); ?></td>
                                            <td>carousel</td>
                                            <td><?php _e('See "All Slider Types" tab', 'chesta-slider'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>slides_to_show</code></td>
                                            <td><?php _e('Number of slides to show at once', 'chesta-slider'); ?></td>
                                            <td>1</td>
                                            <td>1-10</td>
                                        </tr>
                                        <tr>
                                            <td><code>slides_to_scroll</code></td>
                                            <td><?php _e('Number of slides to scroll per action', 'chesta-slider'); ?></td>
                                            <td>1</td>
                                            <td>1-10</td>
                                        </tr>
                                        <tr>
                                            <td><code>height</code></td>
                                            <td><?php _e('Slider height for desktop', 'chesta-slider'); ?></td>
                                            <td>400px</td>
                                            <td><?php _e('Any CSS height value', 'chesta-slider'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>height_tablet</code></td>
                                            <td><?php _e('Slider height for tablet', 'chesta-slider'); ?></td>
                                            <td>350px</td>
                                            <td><?php _e('Any CSS height value', 'chesta-slider'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>height_mobile</code></td>
                                            <td><?php _e('Slider height for mobile', 'chesta-slider'); ?></td>
                                            <td>300px</td>
                                            <td><?php _e('Any CSS height value', 'chesta-slider'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Animation Settings -->
                        <div class="parameter-section">
                            <h3>
                                <span class="dashicons dashicons-controls-play"></span>
                                <?php _e('Animation Settings', 'chesta-slider'); ?>
                            </h3>
                            <div class="parameters-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th><?php _e('Parameter', 'chesta-slider'); ?></th>
                                            <th><?php _e('Description', 'chesta-slider'); ?></th>
                                            <th><?php _e('Default', 'chesta-slider'); ?></th>
                                            <th><?php _e('Options', 'chesta-slider'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>autoplay</code></td>
                                            <td><?php _e('Enable autoplay', 'chesta-slider'); ?></td>
                                            <td>false</td>
                                            <td>true, false</td>
                                        </tr>
                                        <tr>
                                            <td><code>autoplay_speed</code></td>
                                            <td><?php _e('Autoplay speed in milliseconds', 'chesta-slider'); ?></td>
                                            <td>3000</td>
                                            <td>1000-10000</td>
                                        </tr>
                                        <tr>
                                            <td><code>speed</code></td>
                                            <td><?php _e('Animation speed in milliseconds', 'chesta-slider'); ?></td>
                                            <td>500</td>
                                            <td>100-2000</td>
                                        </tr>
                                        <tr>
                                            <td><code>infinite</code></td>
                                            <td><?php _e('Enable infinite loop', 'chesta-slider'); ?></td>
                                            <td>true</td>
                                            <td>true, false</td>
                                        </tr>
                                        <tr>
                                            <td><code>transition_mode</code></td>
                                            <td><?php _e('Transition effect', 'chesta-slider'); ?></td>
                                            <td>slide</td>
                                            <td>slide, fade, flip, cube, coverflow</td>
                                        </tr>
                                        <tr>
                                            <td><code>easing</code></td>
                                            <td><?php _e('Animation easing function', 'chesta-slider'); ?></td>
                                            <td>ease</td>
                                            <td>ease, linear, ease-in, ease-out, ease-in-out</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Navigation Settings -->
                        <div class="parameter-section">
                            <h3>
                                <span class="dashicons dashicons-arrow-left-alt2"></span>
                                <?php _e('Navigation Settings', 'chesta-slider'); ?>
                            </h3>
                            <div class="parameters-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th><?php _e('Parameter', 'chesta-slider'); ?></th>
                                            <th><?php _e('Description', 'chesta-slider'); ?></th>
                                            <th><?php _e('Default', 'chesta-slider'); ?></th>
                                            <th><?php _e('Options', 'chesta-slider'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>arrows</code></td>
                                            <td><?php _e('Show navigation arrows', 'chesta-slider'); ?></td>
                                            <td>true</td>
                                            <td>true, false</td>
                                        </tr>
                                        <tr>
                                            <td><code>arrow_type</code></td>
                                            <td><?php _e('Arrow style', 'chesta-slider'); ?></td>
                                            <td>default</td>
                                            <td>default, circle, square, minimal</td>
                                        </tr>
                                        <tr>
                                            <td><code>arrow_size</code></td>
                                            <td><?php _e('Arrow size in pixels', 'chesta-slider'); ?></td>
                                            <td>50</td>
                                            <td>20-100</td>
                                        </tr>
                                        <tr>
                                            <td><code>arrow_color</code></td>
                                            <td><?php _e('Arrow color', 'chesta-slider'); ?></td>
                                            <td>#ffffff</td>
                                            <td><?php _e('Any hex color', 'chesta-slider'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>arrow_position</code></td>
                                            <td><?php _e('Arrow position', 'chesta-slider'); ?></td>
                                            <td>sides</td>
                                            <td>sides, bottom, top, center</td>
                                        </tr>
                                        <tr>
                                            <td><code>dots</code></td>
                                            <td><?php _e('Show dot indicators', 'chesta-slider'); ?></td>
                                            <td>true</td>
                                            <td>true, false</td>
                                        </tr>
                                        <tr>
                                            <td><code>dots_type</code></td>
                                            <td><?php _e('Indicator type', 'chesta-slider'); ?></td>
                                            <td>dots</td>
                                            <td>dots, lines, numbers, thumbnails, progress</td>
                                        </tr>
                                        <tr>
                                            <td><code>dots_position</code></td>
                                            <td><?php _e('Indicator position', 'chesta-slider'); ?></td>
                                            <td>bottom-center</td>
                                            <td>bottom-center, bottom-left, bottom-right, top-center, left, right</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Interaction Settings -->
                        <div class="parameter-section">
                            <h3>
                                <span class="dashicons dashicons-controls-forward"></span>
                                <?php _e('Interaction Settings', 'chesta-slider'); ?>
                            </h3>
                            <div class="parameters-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th><?php _e('Parameter', 'chesta-slider'); ?></th>
                                            <th><?php _e('Description', 'chesta-slider'); ?></th>
                                            <th><?php _e('Default', 'chesta-slider'); ?></th>
                                            <th><?php _e('Options', 'chesta-slider'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>mouse_wheel</code></td>
                                            <td><?php _e('Enable mouse wheel navigation', 'chesta-slider'); ?></td>
                                            <td>false</td>
                                            <td>true, false</td>
                                        </tr>
                                        <tr>
                                            <td><code>mouse_drag</code></td>
                                            <td><?php _e('Enable mouse drag navigation', 'chesta-slider'); ?></td>
                                            <td>true</td>
                                            <td>true, false</td>
                                        </tr>
                                        <tr>
                                            <td><code>touch_swipe</code></td>
                                            <td><?php _e('Enable touch swipe navigation', 'chesta-slider'); ?></td>
                                            <td>true</td>
                                            <td>true, false</td>
                                        </tr>
                                        <tr>
                                            <td><code>keyboard</code></td>
                                            <td><?php _e('Enable keyboard navigation', 'chesta-slider'); ?></td>
                                            <td>true</td>
                                            <td>true, false</td>
                                        </tr>
                                        <tr>
                                            <td><code>pause_on_hover</code></td>
                                            <td><?php _e('Pause autoplay on hover', 'chesta-slider'); ?></td>
                                            <td>true</td>
                                            <td>true, false</td>
                                        </tr>
                                        <tr>
                                            <td><code>pause_on_focus</code></td>
                                            <td><?php _e('Pause autoplay on focus', 'chesta-slider'); ?></td>
                                            <td>true</td>
                                            <td>true, false</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Examples Tab -->
        <div id="examples" class="tab-content">
            <div class="chesta-slider-card">
                <div class="card-header">
                    <h2><?php _e('Advanced Examples', 'chesta-slider'); ?></h2>
                    <p><?php _e('Real-world examples with multiple parameters and custom configurations', 'chesta-slider'); ?></p>
                </div>
                <div class="card-content">
                    <div class="advanced-examples">
                        <div class="example-section">
                            <h3><?php _e('E-commerce Product Slider', 'chesta-slider'); ?></h3>
                            <div class="shortcode-box large">
                                <code>[chesta_slider type="product" 
    slides_to_show="3" 
    slides_to_scroll="1" 
    autoplay="true" 
    autoplay_speed="4000"
    arrows="true" 
    arrow_type="circle" 
    dots="false"
    height="350px" 
    height_tablet="300px" 
    height_mobile="250px"
    center_mode="true" 
    center_padding="60"
    lazy_load="true"]</code>
                                <button class="copy-shortcode" data-shortcode='[chesta_slider type="product" slides_to_show="3" slides_to_scroll="1" autoplay="true" autoplay_speed="4000" arrows="true" arrow_type="circle" dots="false" height="350px" height_tablet="300px" height_mobile="250px" center_mode="true" center_padding="60" lazy_load="true"]'>
                                    <span class="dashicons dashicons-admin-page"></span>
                                    <?php _e('Copy', 'chesta-slider'); ?>
                                </button>
                            </div>
                            <p><?php _e('Perfect for showcasing products with center mode and responsive heights', 'chesta-slider'); ?></p>
                        </div>

                        <div class="example-section">
                            <h3><?php _e('Full-Screen Hero Banner', 'chesta-slider'); ?></h3>
                            <div class="shortcode-box large">
                                <code>[chesta_slider type="hero" 
    autoplay="true" 
    autoplay_speed="6000"
    transition_mode="fade" 
    arrows="false" 
    dots="true"
    dots_type="progress" 
    dots_position="bottom-center"
    height="100vh" 
    height_tablet="80vh" 
    height_mobile="60vh"
    content_position="center-center"
    title_animation="fadeInUp" 
    title_delay="500"
    description_animation="fadeInUp" 
    description_delay="800"
    button_animation="fadeInUp" 
    button_delay="1100"]</code>
                                <button class="copy-shortcode" data-shortcode='[chesta_slider type="hero" autoplay="true" autoplay_speed="6000" transition_mode="fade" arrows="false" dots="true" dots_type="progress" dots_position="bottom-center" height="100vh" height_tablet="80vh" height_mobile="60vh" content_position="center-center" title_animation="fadeInUp" title_delay="500" description_animation="fadeInUp" description_delay="800" button_animation="fadeInUp" button_delay="1100"]'>
                                    <span class="dashicons dashicons-admin-page"></span>
                                    <?php _e('Copy', 'chesta-slider'); ?>
                                </button>
                            </div>
                            <p><?php _e('Stunning full-screen hero with fade transitions and animated content', 'chesta-slider'); ?></p>
                        </div>

                        <div class="example-section">
                            <h3><?php _e('Interactive Testimonial Carousel', 'chesta-slider'); ?></h3>
                            <div class="shortcode-box large">
                                <code>[chesta_slider type="testimonial" 
    slides_to_show="2" 
    slides_to_scroll="1"
    autoplay="false" 
    arrows="true" 
    arrow_type="minimal"
    arrow_position="center" 
    dots="true" 
    dots_type="thumbnails"
    variable_width="false" 
    center_mode="false"
    mouse_wheel="true" 
    keyboard="true"
    show_author_image="true" 
    show_rating="true"
    height="300px"]</code>
                                <button class="copy-shortcode" data-shortcode='[chesta_slider type="testimonial" slides_to_show="2" slides_to_scroll="1" autoplay="false" arrows="true" arrow_type="minimal" arrow_position="center" dots="true" dots_type="thumbnails" variable_width="false" center_mode="false" mouse_wheel="true" keyboard="true" show_author_image="true" show_rating="true" height="300px"]'>
                                    <span class="dashicons dashicons-admin-page"></span>
                                    <?php _e('Copy', 'chesta-slider'); ?>
                                </button>
                            </div>
                            <p><?php _e('Interactive testimonials with thumbnail navigation and multiple interaction methods', 'chesta-slider'); ?></p>
                        </div>

                        <div class="example-section">
                            <h3><?php _e('3D Cube Gallery', 'chesta-slider'); ?></h3>
                            <div class="shortcode-box large">
                                <code>[chesta_slider type="cube" 
    autoplay="true" 
    autoplay_speed="5000"
    transition_mode="cube" 
    speed="800"
    arrows="true" 
    arrow_type="square" 
    arrow_color="#ffffff"
    arrow_background="rgba(0,0,0,0.7)" 
    dots="false"
    height="500px" 
    height_tablet="400px" 
    height_mobile="300px"
    mouse_drag="true" 
    touch_swipe="true"
    accessibility="true" 
    lazy_load="true"]</code>
                                <button class="copy-shortcode" data-shortcode='[chesta_slider type="cube" autoplay="true" autoplay_speed="5000" transition_mode="cube" speed="800" arrows="true" arrow_type="square" arrow_color="#ffffff" arrow_background="rgba(0,0,0,0.7)" dots="false" height="500px" height_tablet="400px" height_mobile="300px" mouse_drag="true" touch_swipe="true" accessibility="true" lazy_load="true"]'>
                                    <span class="dashicons dashicons-admin-page"></span>
                                    <?php _e('Copy', 'chesta-slider'); ?>
                                </button>
                            </div>
                            <p><?php _e('Stunning 3D cube transitions with custom arrow styling and responsive design', 'chesta-slider'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Tab switching
    $('.nav-tab').on('click', function() {
        var tabId = $(this).data('tab');
        
        $('.nav-tab').removeClass('active');
        $(this).addClass('active');
        
        $('.tab-content').removeClass('active');
        $('#' + tabId).addClass('active');
    });
    
    // Copy shortcode functionality
    $('.copy-shortcode').on('click', function() {
        var shortcode = $(this).data('shortcode');
        var $button = $(this);
        
        // Create temporary textarea
        var $temp = $('<textarea>');
        $('body').append($temp);
        $temp.val(shortcode).select();
        document.execCommand('copy');
        $temp.remove();
        
        // Show feedback
        var originalText = $button.html();
        $button.html('<span class="dashicons dashicons-yes"></span> <?php _e('Copied!', 'chesta-slider'); ?>');
        $button.addClass('copied');
        
        setTimeout(function() {
            $button.html(originalText);
            $button.removeClass('copied');
        }, 2000);
    });
});
</script>

