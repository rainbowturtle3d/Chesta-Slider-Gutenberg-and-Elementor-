# ❓ Frequently Asked Questions (FAQ)

Get quick answers to the most common questions about Chesta Slider.

## 📚 Table of Contents

1. [General Questions](#general-questions)
2. [Installation & Setup](#installation--setup)
3. [Features & Functionality](#features--functionality)
4. [Customization](#customization)
5. [Performance](#performance)
6. [Compatibility](#compatibility)
7. [Troubleshooting](#troubleshooting)
8. [Licensing & Support](#licensing--support)

## 🌟 General Questions

### **Q: What makes Chesta Slider different from other slider plugins?**

**A:** Chesta Slider stands out with several unique features:

- ✅ **No jQuery Dependency** - Pure vanilla JavaScript for better performance
- ✅ **Native Gutenberg Integration** - Built specifically for the block editor
- ✅ **Elementor Compatibility** - Works seamlessly with Elementor
- ✅ **25+ Slider Types** - More variety than any other free plugin
- ✅ **Any Block Support** - Use any Gutenberg blocks inside slides
- ✅ **Modern Architecture** - Built with latest WordPress standards
- ✅ **Completely Free** - No premium upsells or limitations

### **Q: Is Chesta Slider really free?**

**A:** Yes! Chesta Slider is 100% free and open-source under GPL v2+ license. There are no:
- Premium versions
- Feature limitations
- Usage restrictions
- Hidden costs
- Subscription fees

All 25+ slider types and features are included for free.

### **Q: How many slider types are included?**

**A:** Chesta Slider includes 25+ different slider types:

**Basic Types:**
- Carousel, Fade, Vertical, Image Gallery

**Advanced Types:**
- Hero Slider, Parallax, Thumbnail Navigation, Center Mode, Multi-row

**Content-Specific:**
- Testimonial, Logo Carousel, Product Slider, Video Slider, Post Slider, Portfolio

**Interactive:**
- 3D Cube, Flip, Coverflow, Cards, Countdown, CTA Slider

And more types are added regularly!

### **Q: Can I use any content in slides?**

**A:** Absolutely! Unlike other sliders that only support images, Chesta Slider lets you add:
- Any Gutenberg blocks (images, text, videos, buttons, etc.)
- Custom HTML content
- WordPress posts and pages
- WooCommerce products
- Custom post types
- Embedded content (YouTube, Vimeo, etc.)
- Forms and interactive elements

## 🔧 Installation & Setup

### **Q: What are the system requirements?**

**A:** Minimum requirements:
- **WordPress:** 5.0 or higher
- **PHP:** 7.4 or higher
- **MySQL:** 5.6 or higher
- **Memory:** 128MB RAM (256MB recommended)

Recommended:
- **WordPress:** 6.0+
- **PHP:** 8.0+
- **Memory:** 512MB RAM

### **Q: How do I install Chesta Slider?**

**A:** Three installation methods:

1. **WordPress Admin (Easiest):**
   - Go to Plugins > Add New
   - Search "Chesta Slider"
   - Install and activate

2. **Manual Upload:**
   - Download from WordPress.org
   - Upload via Plugins > Add New > Upload

3. **GitHub (Developers):**
   ```bash
   git clone https://github.com/rainbowturtle3d/Chesta-Slider-Gutenberg-and-Elementor-.git
   ```

### **Q: Do I need to configure anything after installation?**

**A:** Chesta Slider works out-of-the-box with sensible defaults. Optional configuration:

1. **Global Settings:** Go to Chesta Slider > Settings
2. **Performance:** Enable lazy loading and optimization
3. **Defaults:** Set preferred autoplay and animation speeds
4. **Styling:** Add custom CSS if needed

### **Q: How do I create my first slider?**

**A:** Quick start:

1. **Edit any page/post**
2. **Add Chesta Slider block** (click + and search)
3. **Choose slider type** (carousel is default)
4. **Add content to slides** (images, text, etc.)
5. **Customize settings** in sidebar
6. **Publish and view**

## 🎯 Features & Functionality

### **Q: Does it work with Gutenberg?**

**A:** Yes! Chesta Slider is built specifically for Gutenberg with:
- Native block integration
- Live preview in editor
- Full block editor support
- Nested block capability
- Block patterns and templates
- Modern React architecture

### **Q: Does it work with Elementor?**

**A:** Absolutely! Chesta Slider includes:
- Native Elementor widgets
- Custom widget category
- Elementor-specific controls
- Visual drag-and-drop interface
- Template library integration
- Dynamic content support

### **Q: Can I use it with other page builders?**

**A:** Yes, through shortcodes:

```php
[chesta_slider type="carousel" autoplay="true"]
  [chesta_slide]Your content here[/chesta_slide]
  [chesta_slide]More content[/chesta_slide]
[/chesta_slider]
```

Supported page builders:
- Divi
- Beaver Builder
- Visual Composer
- Oxygen
- Bricks
- Any builder that supports shortcodes

### **Q: Is it mobile-friendly?**

**A:** Extremely mobile-friendly:
- ✅ Responsive design
- ✅ Touch/swipe navigation
- ✅ Mobile-specific settings
- ✅ Optimized performance
- ✅ Accessibility features
- ✅ Progressive loading

### **Q: Does it support lazy loading?**

**A:** Yes! Advanced lazy loading features:
- Images load only when needed
- Progressive slide loading
- Intersection Observer API
- Configurable load distance
- Performance optimization
- Bandwidth saving

### **Q: Can I add videos to slides?**

**A:** Absolutely! Video support includes:
- YouTube videos
- Vimeo videos
- Self-hosted videos (MP4, WebM)
- Video backgrounds
- Autoplay controls
- Mobile optimization
- Accessibility features

## 🎨 Customization

### **Q: How do I customize the appearance?**

**A:** Multiple customization options:

1. **Built-in Settings:**
   - Colors (arrows, dots, backgrounds)
   - Typography (fonts, sizes, weights)
   - Spacing (margins, padding)
   - Effects (shadows, borders)

2. **Custom CSS:**
   - Global custom CSS in settings
   - Per-slider custom CSS
   - Theme integration

3. **Theme Integration:**
   - Automatically inherits theme styles
   - Respects theme colors and fonts
   - Follows theme responsive breakpoints

### **Q: Can I change the arrow and dot styles?**

**A:** Yes! Multiple ways to customize:

1. **Built-in Options:**
   - Color picker for arrows and dots
   - Size and positioning controls
   - Show/hide options

2. **Custom CSS:**
   ```css
   .chesta-arrow {
     background: linear-gradient(45deg, #ff6b6b, #ee5a24);
     border-radius: 50%;
   }
   
   .chesta-dots li button {
     background: transparent;
     border: 2px solid #fff;
   }
   ```

3. **Custom HTML:**
   - Replace with custom icons
   - Use Font Awesome icons
   - Add custom markup

### **Q: How do I make slides different heights?**

**A:** Several approaches:

1. **Variable Height Mode:**
   - Enable in slider settings
   - Each slide adapts to content height

2. **CSS Flexbox:**
   ```css
   .chesta-slide {
     display: flex;
     align-items: center; /* or flex-start, flex-end */
   }
   ```

3. **Min-Height:**
   ```css
   .chesta-slide {
     min-height: 400px;
   }
   ```

### **Q: Can I add custom animations?**

**A:** Yes! Multiple animation options:

1. **Built-in Transitions:**
   - Slide, Fade, Cube, Flip, Coverflow

2. **CSS Animations:**
   ```css
   .chesta-slide {
     transition: transform 0.3s ease;
   }
   
   .chesta-slide:hover {
     transform: scale(1.05);
   }
   ```

3. **JavaScript Hooks:**
   ```javascript
   document.addEventListener('chesta:beforeChange', function(e) {
     // Custom animation code
   });
   ```

## ⚡ Performance

### **Q: Will it slow down my website?**

**A:** No! Chesta Slider is optimized for performance:

- ✅ **No jQuery** - Smaller bundle size
- ✅ **Lazy Loading** - Images load when needed
- ✅ **Minified Assets** - Compressed CSS/JS
- ✅ **Conditional Loading** - Only loads when needed
- ✅ **Optimized Code** - Modern, efficient JavaScript
- ✅ **Caching Support** - Works with all caching plugins

### **Q: How many slides can I add?**

**A:** Technical limits:
- **Recommended:** 5-10 slides for best performance
- **Maximum:** No hard limit, but consider:
  - Page load time
  - User experience
  - Mobile performance
  - SEO impact

**Best Practices:**
- Use lazy loading for many slides
- Optimize images
- Consider pagination for large galleries
- Test on mobile devices

### **Q: Does it work with caching plugins?**

**A:** Yes! Compatible with all major caching plugins:
- WP Rocket
- W3 Total Cache
- WP Super Cache
- LiteSpeed Cache
- Cloudflare
- And more

**Optimization Tips:**
- Enable lazy loading
- Optimize images
- Use CDN for assets
- Enable browser caching

## 🔌 Compatibility

### **Q: Which themes does it work with?**

**A:** Chesta Slider works with virtually all WordPress themes:

**Tested Themes:**
- Twenty Twenty-Three
- Astra
- GeneratePress
- OceanWP
- Kadence
- Neve
- Blocksy
- And hundreds more

**Theme Integration:**
- Automatically inherits theme styles
- Respects theme breakpoints
- Follows theme color schemes
- Adapts to theme typography

### **Q: Does it work with WooCommerce?**

**A:** Absolutely! WooCommerce integration includes:
- Product slider type
- Product image galleries
- Category showcases
- Featured products
- Sale items
- Custom product layouts

### **Q: Is it compatible with multilingual plugins?**

**A:** Yes! Works with:
- **WPML** - Full translation support
- **Polylang** - String translation
- **TranslatePress** - Visual translation
- **Weglot** - Automatic translation

**Translation Features:**
- All strings are translatable
- RTL language support
- Locale-specific settings
- Multi-language content

### **Q: Does it work with membership plugins?**

**A:** Yes! Compatible with:
- MemberPress
- Restrict Content Pro
- Paid Memberships Pro
- Ultimate Member
- And more

**Features:**
- Content restriction per slide
- Member-only sliders
- Role-based access
- Dynamic content based on membership

## 🐛 Troubleshooting

### **Q: The slider isn't showing up. What should I check?**

**A:** Troubleshooting checklist:

1. **Plugin Status:**
   - ✅ Plugin activated
   - ✅ No error messages
   - ✅ WordPress requirements met

2. **Block Setup:**
   - ✅ Slider block added to page
   - ✅ Slides contain content
   - ✅ Page published/updated

3. **Browser Issues:**
   - ✅ JavaScript enabled
   - ✅ No console errors
   - ✅ Cache cleared

4. **Theme Conflicts:**
   - ✅ Test with default theme
   - ✅ Check for CSS conflicts
   - ✅ Verify theme compatibility

### **Q: Images aren't loading in the slider. Why?**

**A:** Common image issues:

1. **File Problems:**
   - Check image URLs
   - Verify file permissions
   - Ensure images exist
   - Test with different images

2. **Lazy Loading:**
   - Disable lazy loading temporarily
   - Check intersection observer support
   - Verify loading settings

3. **Server Issues:**
   - Check server response
   - Verify image optimization
   - Test with CDN disabled

### **Q: The slider looks broken on mobile. How do I fix it?**

**A:** Mobile troubleshooting:

1. **Responsive Settings:**
   - Check mobile slide count
   - Verify touch/swipe enabled
   - Test responsive breakpoints

2. **CSS Issues:**
   - Check for mobile-specific CSS
   - Verify viewport meta tag
   - Test on actual devices

3. **Performance:**
   - Optimize images for mobile
   - Check loading speed
   - Verify touch events work

### **Q: Autoplay isn't working. What's wrong?**

**A:** Autoplay troubleshooting:

1. **Settings Check:**
   - ✅ Autoplay enabled in settings
   - ✅ Autoplay speed configured
   - ✅ Sufficient slides for autoplay

2. **Browser Policies:**
   - Modern browsers restrict autoplay
   - User interaction may be required
   - Check browser console for warnings

3. **Conflicts:**
   - Check for JavaScript errors
   - Test with other plugins disabled
   - Verify no theme conflicts

## 📄 Licensing & Support

### **Q: What license is Chesta Slider under?**

**A:** Chesta Slider is licensed under **GPL v2 or later**, which means:
- ✅ Free to use commercially
- ✅ Free to modify
- ✅ Free to redistribute
- ✅ Open source code
- ✅ No usage restrictions

### **Q: How do I get support?**

**A:** Multiple support channels:

1. **Documentation:**
   - [Installation Guide](installation.md)
   - [Tutorials](tutorials/)
   - [Developer Guide](developer-guide.md)

2. **Community Support:**
   - [WordPress.org Forum](https://wordpress.org/support/plugin/chesta-slider/)
   - [GitHub Issues](https://github.com/rainbowturtle3d/Chesta-Slider-Gutenberg-and-Elementor-/issues)
   - [GitHub Discussions](https://github.com/rainbowturtle3d/Chesta-Slider-Gutenberg-and-Elementor-/discussions)

3. **Direct Support:**
   - Email: support@chestaslider.com
   - Response time: 24-48 hours
   - Include: WordPress version, PHP version, error messages

### **Q: Can I contribute to the plugin?**

**A:** Absolutely! We welcome contributions:

1. **Code Contributions:**
   - Fork on GitHub
   - Submit pull requests
   - Follow coding standards
   - Include tests

2. **Other Contributions:**
   - Report bugs
   - Suggest features
   - Improve documentation
   - Translate to other languages
   - Share usage examples

3. **Getting Started:**
   ```bash
   git clone https://github.com/rainbowturtle3d/Chesta-Slider-Gutenberg-and-Elementor-.git
   cd Chesta-Slider-Gutenberg-and-Elementor-
   npm install
   npm run dev
   ```

### **Q: How often is the plugin updated?**

**A:** Regular update schedule:
- **Security Updates:** Immediate
- **Bug Fixes:** Weekly
- **Feature Updates:** Monthly
- **Major Releases:** Quarterly

**Update Process:**
- Automatic updates via WordPress
- Backward compatibility maintained
- Changelog provided for all updates
- Beta testing available

### **Q: Is my data safe with Chesta Slider?**

**A:** Yes! Security measures include:
- ✅ No external data collection
- ✅ Secure coding practices
- ✅ Regular security audits
- ✅ Input sanitization
- ✅ Output escaping
- ✅ Nonce verification
- ✅ Capability checks

**Privacy:**
- No tracking or analytics
- No external API calls
- All data stays on your server
- GDPR compliant

## 🔍 Still Have Questions?

If you can't find the answer you're looking for:

1. **Search Documentation:** Use the search function in our docs
2. **Check GitHub:** Look through existing issues and discussions
3. **Ask Community:** Post in WordPress.org support forum
4. **Contact Us:** Email support@chestaslider.com

**When contacting support, please include:**
- WordPress version
- PHP version
- Plugin version
- Theme name
- Error messages (if any)
- Screenshots (if applicable)
- Steps to reproduce the issue

---

**Last Updated:** December 2024 | **Plugin Version:** 1.0.0

