# 🎠 Chesta Slider - Gutenberg & Elementor

[![WordPress Plugin Version](https://img.shields.io/badge/WordPress-5.0%2B-blue.svg)](https://wordpress.org/)
[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-purple.svg)](https://php.net/)
[![License](https://img.shields.io/badge/License-Proprietary-red.svg)](https://chesta-slider.com/license)
[![Gutenberg Compatible](https://img.shields.io/badge/Gutenberg-Compatible-brightgreen.svg)](https://wordpress.org/gutenberg/)
[![Elementor Compatible](https://img.shields.io/badge/Elementor-Compatible-pink.svg)](https://elementor.com/)

> **A powerful, lightweight, and fully customizable slider plugin for WordPress with 25+ slider types, modern React-based Gutenberg blocks, and seamless Elementor integration. No jQuery dependency!**

## 🚀 Why Chesta Slider Will Dominate the Market

### ✨ **Revolutionary Features**
- 🎯 **25+ Slider Types** - From simple carousels to complex parallax sliders
- ⚡ **No jQuery Dependency** - Pure vanilla JavaScript for lightning-fast performance
- 🎨 **Dual Platform Support** - Native Gutenberg blocks + Elementor widgets
- 📱 **Mobile-First Responsive** - Perfect on all devices and screen sizes
- ♿ **Accessibility Ready** - WCAG compliant with full keyboard navigation
- 🔧 **Live Preview** - See changes instantly in the block editor
- 🎭 **Theme Integration** - Automatically inherits your theme's styles

### 🏆 **Competitive Advantages**
| Feature | Revolution Slider | LayerSlider | Smart Slider | **Chesta Slider** |
|---------|------------------|-------------|--------------|------------------|
| **Price** | $59+ | $30+ | $35+ | **FREE** ✅ |
| **Gutenberg Native** | ❌ | ❌ | ❌ | **✅** |
| **Elementor Integration** | Limited | Limited | Limited | **Native ✅** |
| **No jQuery** | ❌ | ❌ | ❌ | **✅** |
| **Any Block Support** | ❌ | ❌ | ❌ | **✅** |
| **Learning Curve** | High | High | Medium | **Low ✅** |

## 📦 Installation

### Automatic Installation (Recommended)
1. Go to **Plugins > Add New** in your WordPress admin
2. Search for "Chesta Slider"
3. Click **Install Now** and then **Activate**

### Manual Installation
1. Download the plugin ZIP file
2. Go to **Plugins > Add New > Upload Plugin**
3. Choose the ZIP file and click **Install Now**
4. Activate the plugin

### GitHub Installation (Developers)
```bash
cd wp-content/plugins/
git clone https://github.com/tarulahsan/Chesta-Slider-Gutenberg-and-Elementor-.git chesta-slider
cd chesta-slider
npm install
npm run build
```

## 🎯 Quick Start Guide

### Using Gutenberg Blocks

1. **Add a Slider Block**
   - In the block editor, click the **+** button
   - Search for "Chesta Slider"
   - Add the block to your page

2. **Configure Your Slider**
   - Choose from 25+ slider types in the sidebar
   - Adjust settings like autoplay, speed, and navigation
   - Add slides using the **+** button

3. **Customize Each Slide**
   - Add any Gutenberg blocks inside slides
   - Set background images, colors, and overlays
   - Configure animations and transitions

### Using Elementor Widgets

1. **Add Chesta Slider Widget**
   - Drag the "Chesta Slider" widget from the Chesta Slider category
   - Drop it into your desired section

2. **Add Your Content**
   - Use the repeater to add multiple slides
   - Upload images, add text, and configure buttons
   - Set up video slides with YouTube/Vimeo URLs

3. **Style Your Slider**
   - Customize colors, typography, and spacing
   - Configure responsive settings for different devices
   - Add custom CSS for advanced styling

## 🎨 25+ Slider Types

### **Basic Sliders**
- 🎠 **Carousel** - Classic horizontal sliding
- 🌅 **Fade** - Smooth fade transitions
- ↕️ **Vertical** - Vertical sliding direction
- 🖼️ **Image Gallery** - Simple image showcase

### **Advanced Sliders**
- 🦸 **Hero Slider** - Full-width hero banners
- 🎭 **Parallax** - Stunning parallax effects
- 📱 **Thumbnail Navigation** - Thumbnail-based navigation
- 🎯 **Center Mode** - Highlight center slide
- 📐 **Multi-row** - Multiple rows of slides
- 🔄 **Variable Width** - Different slide widths

### **Content-Specific Sliders**
- 💬 **Testimonial** - Customer testimonials
- 🏢 **Logo Carousel** - Client/partner logos
- 🛍️ **Product Slider** - E-commerce products
- 🎬 **Video Slider** - YouTube/Vimeo videos
- 📝 **Post Slider** - WordPress posts
- 📁 **Portfolio** - Creative portfolios

### **Interactive Sliders**
- 🎮 **3D Cube** - 3D cube transitions
- 🔄 **Flip** - Card flip effects
- 🎪 **Coverflow** - iTunes-style coverflow
- 🃏 **Cards** - Card-based layout
- ⏰ **Countdown** - With countdown timers
- 🎯 **CTA Slider** - Call-to-action focused

## ⚙️ Configuration Options

### **General Settings**
```javascript
{
  type: 'carousel',           // Slider type
  slidesToShow: 1,           // Slides visible at once
  slidesToScroll: 1,         // Slides to scroll per action
  autoplay: false,           // Enable autoplay
  autoplaySpeed: 3000,       // Autoplay interval (ms)
  speed: 500,                // Animation speed (ms)
  infinite: true,            // Infinite loop
  arrows: true,              // Show navigation arrows
  dots: true,                // Show dot indicators
  fade: false,               // Use fade transition
  vertical: false,           // Vertical direction
  centerMode: false,         // Center active slide
  variableWidth: false,      // Variable slide widths
  lazyLoad: true,            // Lazy load images
  pauseOnHover: true,        // Pause on hover
  accessibility: true,       // Accessibility features
  swipe: true,               // Touch/swipe support
  draggable: true,           // Mouse dragging
  rtl: false                 // Right-to-left support
}
```

### **Responsive Breakpoints**
```javascript
responsive: [
  {
    breakpoint: 768,
    settings: {
      slidesToShow: 2,
      arrows: false
    }
  },
  {
    breakpoint: 480,
    settings: {
      slidesToShow: 1,
      dots: false
    }
  }
]
```

## 🎨 Styling & Customization

### **CSS Custom Properties**
```css
:root {
  --chesta-arrow-color: #333;
  --chesta-arrow-hover-color: #000;
  --chesta-dot-color: rgba(255,255,255,0.5);
  --chesta-dot-active-color: #fff;
  --chesta-transition-speed: 0.5s;
}
```

### **Custom CSS Classes**
```css
/* Custom arrow styling */
.chesta-arrow {
  background: linear-gradient(45deg, #ff6b6b, #ee5a24);
  border-radius: 50%;
  box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

/* Custom dot styling */
.chesta-dots li button {
  background: transparent;
  border: 2px solid #fff;
  border-radius: 50%;
}

/* Slide animations */
.chesta-slide {
  transition: transform 0.3s ease;
}

.chesta-slide:hover {
  transform: scale(1.05);
}
```

## 🔧 Developer API

### **JavaScript Events**
```javascript
// Listen for slider events
document.addEventListener('chesta:init', function(e) {
  console.log('Slider initialized:', e.detail.slider);
});

document.addEventListener('chesta:beforeChange', function(e) {
  console.log('Before slide change:', e.detail);
});

document.addEventListener('chesta:afterChange', function(e) {
  console.log('After slide change:', e.detail);
});
```

### **Programmatic Control**
```javascript
// Get slider instance
const slider = document.querySelector('#my-slider').chestaSlider;

// Control methods
slider.slickNext();        // Go to next slide
slider.slickPrev();        // Go to previous slide
slider.slickGoTo(2);       // Go to specific slide
slider.slickPlay();        // Start autoplay
slider.slickPause();       // Pause autoplay
slider.destroy();          // Destroy slider
```

### **PHP Hooks & Filters**
```php
// Modify default options
add_filter('chesta_slider_default_options', function($options) {
  $options['autoplay'] = true;
  $options['autoplaySpeed'] = 5000;
  return $options;
});

// Add custom slider type
add_filter('chesta_slider_types', function($types) {
  $types['custom'] = 'Custom Slider';
  return $types;
});

// Modify slider output
add_filter('chesta_slider_output', function($html, $attributes) {
  // Modify HTML output
  return $html;
}, 10, 2);
```

## 🔌 Shortcode Usage

### **Basic Shortcode**
```php
[chesta_slider type="carousel" autoplay="true" dots="true"]
  [chesta_slide]
    <img src="image1.jpg" alt="Slide 1">
    <h3>Slide Title</h3>
    <p>Slide description</p>
  [/chesta_slide]
  [chesta_slide]
    <img src="image2.jpg" alt="Slide 2">
    <h3>Another Slide</h3>
    <p>Another description</p>
  [/chesta_slide]
[/chesta_slider]
```

### **Advanced Shortcode**
```php
[chesta_slider 
  type="hero" 
  autoplay="true" 
  autoplay_speed="4000"
  height="100vh"
  arrows="false"
  dots="true"
  fade="true"
]
  <!-- Slide content -->
[/chesta_slider]
```

## 🌐 Internationalization

Chesta Slider is fully translation-ready and includes:

- **POT file** for translators
- **RTL support** for right-to-left languages
- **Accessibility labels** in multiple languages
- **Date/time formatting** based on locale

### **Available Languages**
- English (default)
- Spanish (es_ES)
- French (fr_FR)
- German (de_DE)
- Italian (it_IT)
- Portuguese (pt_BR)
- Dutch (nl_NL)
- Russian (ru_RU)
- Japanese (ja)
- Chinese Simplified (zh_CN)

## 🚀 Performance Optimization

### **Built-in Optimizations**
- ⚡ **Lazy Loading** - Images load only when needed
- 🗜️ **Minified Assets** - Compressed CSS and JS files
- 📱 **Responsive Images** - Automatic srcset generation
- 🎯 **Conditional Loading** - Load only required assets
- 💾 **Caching** - Smart caching for better performance
- 🔧 **No jQuery** - Smaller bundle size

### **Performance Tips**
1. **Optimize Images** - Use WebP format when possible
2. **Limit Slides** - Keep slide count reasonable (< 20)
3. **Use Lazy Loading** - Enable for image-heavy sliders
4. **Choose Appropriate Type** - Simple types perform better
5. **Minimize Custom CSS** - Use built-in styling options

## 🛠️ Troubleshooting

### **Common Issues**

#### **Slider Not Appearing**
```javascript
// Check if scripts are loaded
console.log(window.ChestaSliderCore);

// Verify slider initialization
document.addEventListener('DOMContentLoaded', function() {
  const sliders = document.querySelectorAll('[data-chesta-slider]');
  console.log('Found sliders:', sliders.length);
});
```

#### **Images Not Loading**
- Check image URLs and permissions
- Verify lazy loading settings
- Ensure proper image sizes are generated

#### **Responsive Issues**
- Check responsive breakpoint settings
- Verify CSS media queries
- Test on actual devices

#### **Performance Issues**
- Reduce number of slides
- Optimize image sizes
- Disable unnecessary features
- Check for JavaScript conflicts

### **Debug Mode**
```php
// Enable debug mode in wp-config.php
define('CHESTA_SLIDER_DEBUG', true);

// This will:
// - Load unminified assets
// - Enable console logging
// - Show performance metrics
// - Display error messages
```

## 🤝 Contributing

We welcome contributions! Here's how you can help:

### **Development Setup**
```bash
# Clone the repository
git clone https://github.com/tarulahsan/Chesta-Slider-Gutenberg-and-Elementor-.git

# Install dependencies
cd Chesta-Slider-Gutenberg-and-Elementor-
npm install

# Start development
npm run dev

# Build for production
npm run build
```

### **Contribution Guidelines**
1. **Fork** the repository
2. **Create** a feature branch (`git checkout -b feature/amazing-feature`)
3. **Commit** your changes (`git commit -m 'Add amazing feature'`)
4. **Push** to the branch (`git push origin feature/amazing-feature`)
5. **Open** a Pull Request

### **Code Standards**
- Follow WordPress coding standards
- Use ESLint for JavaScript
- Write PHPDoc comments
- Include unit tests for new features
- Update documentation

## 📄 License

This project is proprietary software. All rights reserved. See the [LICENSE](https://chesta-slider.com/license) for details.

**Important:** This is not free software. Commercial use requires a valid license.

## 🙏 Acknowledgments

- **WordPress Community** - For the amazing platform
- **Gutenberg Team** - For the block editor
- **Elementor Team** - For the page builder
- **Contributors** - Everyone who helps improve this plugin

## 📞 Support

- **Documentation**: [Full Documentation](docs/)
- **Issues**: [GitHub Issues](https://github.com/tarulahsan/Chesta-Slider-Gutenberg-and-Elementor-/issues)
- **Discussions**: [GitHub Discussions](https://github.com/tarulahsan/Chesta-Slider-Gutenberg-and-Elementor-/discussions)
- **Email**: tarulahsan@gmail.com

---

**Made with ❤️ by [Tarul Ahsan](https://github.com/tarulahsan)**

*Chesta Slider - Making WordPress sliders simple, powerful, and accessible for everyone.*
