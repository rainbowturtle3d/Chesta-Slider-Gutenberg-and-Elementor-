# 📦 Installation Guide

This guide will walk you through installing and setting up Chesta Slider on your WordPress website.

## 🔧 System Requirements

Before installing Chesta Slider, ensure your system meets these requirements:

### **Minimum Requirements**
- **WordPress**: 5.0 or higher
- **PHP**: 7.4 or higher
- **MySQL**: 5.6 or higher (or MariaDB 10.1+)
- **Memory**: 128MB RAM minimum (256MB recommended)
- **Disk Space**: 10MB free space

### **Recommended Requirements**
- **WordPress**: 6.0 or higher
- **PHP**: 8.0 or higher
- **MySQL**: 8.0 or higher
- **Memory**: 512MB RAM or more
- **Disk Space**: 50MB free space

### **Browser Support**
- **Chrome**: 70+
- **Firefox**: 65+
- **Safari**: 12+
- **Edge**: 79+
- **Internet Explorer**: Not supported

## 🚀 Installation Methods

### Method 1: WordPress Plugin Directory (Recommended)

1. **Access WordPress Admin**
   - Log in to your WordPress admin dashboard
   - Navigate to **Plugins > Add New**

2. **Search for Plugin**
   - In the search box, type "Chesta Slider"
   - Look for the plugin by Tarul Ahsan

3. **Install Plugin**
   - Click **Install Now** button
   - Wait for the installation to complete
   - Click **Activate** to enable the plugin

### Method 2: Manual Upload

1. **Download Plugin**
   - Download the latest version from [WordPress.org](https://wordpress.org/plugins/chesta-slider/)
   - Save the ZIP file to your computer

2. **Upload via WordPress Admin**
   - Go to **Plugins > Add New**
   - Click **Upload Plugin** button
   - Choose the downloaded ZIP file
   - Click **Install Now**
   - Activate the plugin after installation

3. **Upload via FTP (Advanced)**
   ```bash
   # Extract the ZIP file
   unzip chesta-slider.zip
   
   # Upload to your server
   scp -r chesta-slider/ user@yourserver.com:/path/to/wordpress/wp-content/plugins/
   ```

### Method 3: GitHub Installation (Developers)

1. **Clone Repository**
   ```bash
   cd /path/to/wordpress/wp-content/plugins/
   git clone https://github.com/tarulahsan/Chesta-Slider-Gutenberg-and-Elementor-.git chesta-slider
   ```

2. **Install Dependencies**
   ```bash
   cd chesta-slider
   npm install
   ```

3. **Build Assets**
   ```bash
   # For development
   npm run dev
   
   # For production
   npm run build
   ```

4. **Activate Plugin**
   - Go to **Plugins** in WordPress admin
   - Find "Chesta Slider" and click **Activate**

## ⚙️ Initial Setup

### 1. Plugin Activation

After activation, you'll see:
- ✅ Success message confirming activation
- 🎯 New "Chesta Slider" menu in admin sidebar
- 📦 New block category "Chesta Slider" in Gutenberg
- 🎨 New widget category in Elementor (if installed)

### 2. Configure Global Settings

1. **Navigate to Settings**
   - Go to **Chesta Slider > Settings** in admin menu

2. **General Settings**
   ```
   ✅ Enable Lazy Loading (Recommended)
   ✅ Enable Touch/Swipe Navigation
   ✅ Enable Keyboard Navigation
   ✅ Load Font Awesome Icons
   ⬜ Enable RTL Support (if needed)
   ```

3. **Performance Settings**
   ```
   ✅ Optimize Images
   ✅ Enable Preloader
   Cache Duration: 3600 seconds (1 hour)
   ```

4. **Default Settings**
   ```
   Autoplay: Disabled (recommended)
   Autoplay Speed: 3000ms
   Animation Speed: 500ms
   ```

### 3. Test Installation

1. **Create Test Page**
   - Go to **Pages > Add New**
   - Add title "Slider Test"

2. **Add Slider Block**
   - Click **+** to add block
   - Search for "Chesta Slider"
   - Add the block

3. **Configure Test Slider**
   - Add 3 sample slides
   - Upload test images
   - Add titles and descriptions
   - Preview the page

4. **Verify Functionality**
   - ✅ Slider displays correctly
   - ✅ Navigation arrows work
   - ✅ Dot indicators work
   - ✅ Touch/swipe works on mobile
   - ✅ Responsive behavior works

## 🔧 Configuration Options

### Global Plugin Settings

Access via **Chesta Slider > Settings**:

#### **General Tab**
| Setting | Description | Default |
|---------|-------------|---------|
| Lazy Loading | Load images only when needed | Enabled |
| Touch/Swipe | Enable mobile touch navigation | Enabled |
| Keyboard Navigation | Arrow key navigation | Enabled |
| RTL Support | Right-to-left language support | Disabled |
| Font Awesome | Load icon font for arrows | Enabled |

#### **Performance Tab**
| Setting | Description | Default |
|---------|-------------|---------|
| Image Optimization | Automatic image optimization | Enabled |
| Preloader | Show loading animation | Enabled |
| Cache Duration | How long to cache data | 3600 seconds |

#### **Defaults Tab**
| Setting | Description | Default |
|---------|-------------|---------|
| Autoplay | Default autoplay setting | Disabled |
| Autoplay Speed | Default autoplay interval | 3000ms |
| Animation Speed | Default transition speed | 500ms |
| Custom CSS | Global custom styles | Empty |
| Custom JS | Global custom scripts | Empty |

### Block-Specific Settings

Each slider block has its own settings:

#### **Slider Settings**
- **Type**: Choose from 25+ slider types
- **Slides to Show**: Number of visible slides
- **Slides to Scroll**: Number of slides to move
- **Autoplay**: Enable/disable automatic sliding
- **Speed**: Animation duration
- **Navigation**: Arrows and dots visibility

#### **Responsive Settings**
- **Desktop**: Full control (default)
- **Tablet**: Customizable breakpoint settings
- **Mobile**: Mobile-specific optimizations

#### **Style Settings**
- **Colors**: Arrows, dots, backgrounds
- **Typography**: Fonts and text styling
- **Spacing**: Margins and padding
- **Effects**: Shadows and borders

## 🎨 Theme Integration

### Automatic Integration

Chesta Slider automatically integrates with your theme:

1. **Style Inheritance**
   - Inherits theme colors and fonts
   - Matches theme button styles
   - Adapts to theme spacing

2. **Responsive Behavior**
   - Uses theme breakpoints
   - Follows theme grid system
   - Maintains theme proportions

### Manual Integration

For advanced customization:

1. **Theme CSS File**
   ```css
   /* Add to your theme's style.css */
   .chesta-slider-wrapper {
     /* Custom slider styles */
   }
   ```

2. **Theme Functions**
   ```php
   // Add to your theme's functions.php
   function my_theme_chesta_slider_styles() {
     wp_enqueue_style(
       'my-theme-chesta-slider',
       get_template_directory_uri() . '/css/chesta-slider.css',
       array('chesta-slider'),
       '1.0.0'
     );
   }
   add_action('wp_enqueue_scripts', 'my_theme_chesta_slider_styles');
   ```

## 🔍 Verification Checklist

After installation, verify everything works:

### ✅ **Basic Functionality**
- [ ] Plugin activates without errors
- [ ] Admin menu appears
- [ ] Settings page loads
- [ ] Gutenberg block appears
- [ ] Elementor widget appears (if applicable)

### ✅ **Frontend Display**
- [ ] Slider renders on frontend
- [ ] Images load correctly
- [ ] Navigation works (arrows/dots)
- [ ] Touch/swipe works on mobile
- [ ] Responsive behavior works

### ✅ **Performance**
- [ ] Page load speed acceptable
- [ ] No JavaScript errors in console
- [ ] No PHP errors in logs
- [ ] Images lazy load properly

### ✅ **Compatibility**
- [ ] Works with active theme
- [ ] Compatible with other plugins
- [ ] No conflicts with page builders
- [ ] Accessibility features work

## 🚨 Troubleshooting Installation

### Common Issues

#### **Plugin Won't Activate**
```
Error: Plugin could not be activated because it triggered a fatal error.
```

**Solutions:**
1. Check PHP version (must be 7.4+)
2. Increase memory limit in wp-config.php:
   ```php
   ini_set('memory_limit', '256M');
   ```
3. Check for plugin conflicts
4. Contact hosting provider

#### **Missing Dependencies**
```
Error: Required WordPress version not met.
```

**Solutions:**
1. Update WordPress to 5.0+
2. Check hosting compatibility
3. Use manual installation method

#### **File Permissions**
```
Error: Could not create directory.
```

**Solutions:**
1. Set correct file permissions:
   ```bash
   chmod 755 wp-content/plugins/
   chmod 644 wp-content/plugins/chesta-slider/*
   ```
2. Contact hosting provider
3. Use FTP upload method

#### **JavaScript Errors**
```
Error: ChestaSliderCore is not defined
```

**Solutions:**
1. Clear browser cache
2. Check for JavaScript conflicts
3. Disable other slider plugins
4. Enable WordPress debug mode

### Debug Mode

Enable debug mode for troubleshooting:

1. **WordPress Debug**
   ```php
   // Add to wp-config.php
   define('WP_DEBUG', true);
   define('WP_DEBUG_LOG', true);
   define('WP_DEBUG_DISPLAY', false);
   ```

2. **Plugin Debug**
   ```php
   // Add to wp-config.php
   define('CHESTA_SLIDER_DEBUG', true);
   ```

3. **Check Logs**
   - WordPress logs: `/wp-content/debug.log`
   - Server logs: Check hosting control panel
   - Browser console: F12 > Console tab

## 📞 Getting Help

If you encounter issues during installation:

1. **Check Documentation**
   - Read the [FAQ](faq.md)
   - Review [troubleshooting guide](troubleshooting.md)
   - Check [compatibility list](compatibility.md)

2. **Community Support**
   - [WordPress.org Support Forum](https://wordpress.org/support/plugin/chesta-slider/)
   - [GitHub Issues](https://github.com/tarulahsan/Chesta-Slider-Gutenberg-and-Elementor-/issues)
   - [GitHub Discussions](https://github.com/tarulahsan/Chesta-Slider-Gutenberg-and-Elementor-/discussions)

3. **Contact Support**
   - Email: tarulahsan@gmail.com
   - Include: WordPress version, PHP version, error messages, screenshots

---

**Next Steps**: Once installed, check out our [Quick Start Guide](quick-start.md) to create your first slider!

