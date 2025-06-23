/**
 * Admin JavaScript for Chesta Slider
 * Handles admin interface interactions
 */

(function($) {
    'use strict';

    // Initialize when document is ready
    $(document).ready(function() {
        initTabSwitching();
        initCopyShortcode();
        initShortcodeGenerator();
        initTooltips();
        initAnimations();
    });

    /**
     * Initialize tab switching functionality
     */
    function initTabSwitching() {
        $('.nav-tab').on('click', function(e) {
            e.preventDefault();
            
            var tabId = $(this).data('tab');
            var $tabContainer = $(this).closest('.chesta-slider-shortcodes-page, .chesta-slider-admin');
            
            // Update tab buttons
            $tabContainer.find('.nav-tab').removeClass('active');
            $(this).addClass('active');
            
            // Update tab content
            $tabContainer.find('.tab-content').removeClass('active');
            $tabContainer.find('#' + tabId).addClass('active');
            
            // Smooth scroll to content
            $('html, body').animate({
                scrollTop: $tabContainer.find('#' + tabId).offset().top - 100
            }, 300);
        });
    }

    /**
     * Initialize copy shortcode functionality
     */
    function initCopyShortcode() {
        $(document).on('click', '.copy-shortcode', function(e) {
            e.preventDefault();
            
            var shortcode = $(this).data('shortcode');
            var $button = $(this);
            
            // Copy to clipboard
            copyToClipboard(shortcode).then(function() {
                showCopyFeedback($button, true);
            }).catch(function() {
                showCopyFeedback($button, false);
            });
        });
    }

    /**
     * Copy text to clipboard
     */
    function copyToClipboard(text) {
        return new Promise(function(resolve, reject) {
            if (navigator.clipboard && window.isSecureContext) {
                // Use modern clipboard API
                navigator.clipboard.writeText(text).then(resolve).catch(reject);
            } else {
                // Fallback for older browsers
                var $temp = $('<textarea>');
                $('body').append($temp);
                $temp.val(text).select();
                
                try {
                    var successful = document.execCommand('copy');
                    $temp.remove();
                    
                    if (successful) {
                        resolve();
                    } else {
                        reject();
                    }
                } catch (err) {
                    $temp.remove();
                    reject(err);
                }
            }
        });
    }

    /**
     * Show copy feedback
     */
    function showCopyFeedback($button, success) {
        var originalHtml = $button.html();
        var originalClass = $button.attr('class');
        
        if (success) {
            $button.html('<span class="dashicons dashicons-yes"></span> Copied!');
            $button.addClass('copied');
        } else {
            $button.html('<span class="dashicons dashicons-no"></span> Failed');
            $button.addClass('error');
        }
        
        setTimeout(function() {
            $button.html(originalHtml);
            $button.attr('class', originalClass);
        }, 2000);
    }

    /**
     * Initialize shortcode generator
     */
    function initShortcodeGenerator() {
        $('.generate-shortcode').on('click', function(e) {
            e.preventDefault();
            
            var sliderType = $(this).data('slider-type');
            var $button = $(this);
            
            // Show loading state
            $button.prop('disabled', true);
            $button.html('<span class="dashicons dashicons-update spin"></span> Generating...');
            
            // AJAX request to get shortcode
            $.ajax({
                url: chestaSliderAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'chesta_slider_get_shortcode',
                    slider_type: sliderType,
                    nonce: chestaSliderAdmin.nonce
                },
                success: function(response) {
                    if (response.success) {
                        showShortcodeModal(response.data);
                    } else {
                        showNotification('Error generating shortcode', 'error');
                    }
                },
                error: function() {
                    showNotification('Network error occurred', 'error');
                },
                complete: function() {
                    // Reset button
                    $button.prop('disabled', false);
                    $button.html('<span class="dashicons dashicons-shortcode"></span> Generate Shortcode');
                }
            });
        });
    }

    /**
     * Show shortcode modal
     */
    function showShortcodeModal(data) {
        var modalHtml = `
            <div class="chesta-shortcode-modal-overlay">
                <div class="chesta-shortcode-modal">
                    <div class="modal-header">
                        <h3>${data.template.name} Shortcode</h3>
                        <button class="modal-close">&times;</button>
                    </div>
                    <div class="modal-content">
                        <div class="shortcode-section">
                            <h4>Basic Shortcode:</h4>
                            <div class="shortcode-box">
                                <code>${data.basic_shortcode}</code>
                                <button class="copy-shortcode" data-shortcode="${data.basic_shortcode}">
                                    <span class="dashicons dashicons-admin-page"></span> Copy
                                </button>
                            </div>
                        </div>
                        <div class="shortcode-section">
                            <h4>Example with Options:</h4>
                            <div class="shortcode-box">
                                <code>${data.example_shortcode}</code>
                                <button class="copy-shortcode" data-shortcode="${data.example_shortcode}">
                                    <span class="dashicons dashicons-admin-page"></span> Copy
                                </button>
                            </div>
                        </div>
                        <div class="template-info">
                            <p><strong>Description:</strong> ${data.template.description}</p>
                            <p><strong>Category:</strong> ${data.template.category}</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('body').append(modalHtml);
        
        // Close modal handlers
        $('.modal-close, .chesta-shortcode-modal-overlay').on('click', function(e) {
            if (e.target === this) {
                $('.chesta-shortcode-modal-overlay').remove();
            }
        });
        
        // Prevent modal content clicks from closing modal
        $('.chesta-shortcode-modal').on('click', function(e) {
            e.stopPropagation();
        });
    }

    /**
     * Initialize tooltips
     */
    function initTooltips() {
        $('[data-tooltip]').each(function() {
            var $element = $(this);
            var tooltipText = $element.data('tooltip');
            
            $element.on('mouseenter', function() {
                var $tooltip = $('<div class="chesta-tooltip">' + tooltipText + '</div>');
                $('body').append($tooltip);
                
                var elementOffset = $element.offset();
                var elementWidth = $element.outerWidth();
                var elementHeight = $element.outerHeight();
                var tooltipWidth = $tooltip.outerWidth();
                var tooltipHeight = $tooltip.outerHeight();
                
                $tooltip.css({
                    top: elementOffset.top - tooltipHeight - 10,
                    left: elementOffset.left + (elementWidth / 2) - (tooltipWidth / 2)
                });
                
                $tooltip.fadeIn(200);
            });
            
            $element.on('mouseleave', function() {
                $('.chesta-tooltip').fadeOut(200, function() {
                    $(this).remove();
                });
            });
        });
    }

    /**
     * Initialize animations
     */
    function initAnimations() {
        // Animate cards on scroll
        if (typeof IntersectionObserver !== 'undefined') {
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, {
                threshold: 0.1
            });
            
            $('.chesta-slider-card, .stat-card, .category-card').each(function() {
                observer.observe(this);
            });
        }
        
        // Add hover effects
        $('.stat-card, .category-card, .feature-item').on('mouseenter', function() {
            $(this).addClass('hover-effect');
        }).on('mouseleave', function() {
            $(this).removeClass('hover-effect');
        });
    }

    /**
     * Show notification
     */
    function showNotification(message, type) {
        var notificationClass = 'chesta-notification';
        if (type) {
            notificationClass += ' ' + type;
        }
        
        var $notification = $('<div class="' + notificationClass + '">' + message + '</div>');
        $('body').append($notification);
        
        $notification.fadeIn(300);
        
        setTimeout(function() {
            $notification.fadeOut(300, function() {
                $(this).remove();
            });
        }, 3000);
    }

    /**
     * Initialize search functionality
     */
    function initSearch() {
        $('.chesta-search-input').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            var $searchableItems = $('.slider-type-card, .example-item');
            
            $searchableItems.each(function() {
                var $item = $(this);
                var itemText = $item.text().toLowerCase();
                
                if (itemText.includes(searchTerm)) {
                    $item.show();
                } else {
                    $item.hide();
                }
            });
            
            // Show "no results" message if needed
            var visibleItems = $searchableItems.filter(':visible').length;
            $('.no-results-message').toggle(visibleItems === 0 && searchTerm.length > 0);
        });
    }

    /**
     * Initialize filter functionality
     */
    function initFilters() {
        $('.filter-button').on('click', function() {
            var filter = $(this).data('filter');
            var $filterableItems = $('.slider-type-card');
            
            // Update active filter button
            $('.filter-button').removeClass('active');
            $(this).addClass('active');
            
            if (filter === 'all') {
                $filterableItems.show();
            } else {
                $filterableItems.each(function() {
                    var $item = $(this);
                    var itemCategory = $item.data('category');
                    
                    if (itemCategory === filter) {
                        $item.show();
                    } else {
                        $item.hide();
                    }
                });
            }
        });
    }

    /**
     * Initialize accordion functionality
     */
    function initAccordions() {
        $('.accordion-header').on('click', function() {
            var $header = $(this);
            var $content = $header.next('.accordion-content');
            var $accordion = $header.closest('.accordion-item');
            
            // Toggle current accordion
            $accordion.toggleClass('active');
            $content.slideToggle(300);
            
            // Close other accordions in the same group
            $accordion.siblings('.accordion-item').removeClass('active')
                .find('.accordion-content').slideUp(300);
        });
    }

    // Initialize additional features
    initSearch();
    initFilters();
    initAccordions();

})(jQuery);

// CSS for dynamic elements
var dynamicCSS = `
<style>
.chesta-shortcode-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    z-index: 100000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chesta-shortcode-modal {
    background: white;
    border-radius: 12px;
    max-width: 600px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.modal-header {
    padding: 20px 25px;
    border-bottom: 1px solid #e0e0e0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    margin: 0;
    color: #1e1e1e;
}

.modal-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #666;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-close:hover {
    color: #333;
}

.modal-content {
    padding: 25px;
}

.shortcode-section {
    margin-bottom: 25px;
}

.shortcode-section h4 {
    margin: 0 0 10px 0;
    color: #1e1e1e;
}

.template-info {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 6px;
    border-left: 4px solid #667eea;
}

.template-info p {
    margin: 0 0 8px 0;
    color: #666;
    font-size: 0.9rem;
}

.template-info p:last-child {
    margin-bottom: 0;
}

.chesta-tooltip {
    position: absolute;
    background: #333;
    color: white;
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 0.8rem;
    z-index: 10000;
    max-width: 200px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.chesta-tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 5px solid transparent;
    border-top-color: #333;
}

.chesta-notification {
    position: fixed;
    top: 32px;
    right: 20px;
    background: #007cba;
    color: white;
    padding: 12px 20px;
    border-radius: 6px;
    z-index: 100000;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    display: none;
}

.chesta-notification.error {
    background: #dc3545;
}

.chesta-notification.success {
    background: #28a745;
}

.animate-in {
    animation: slideInUp 0.6s ease-out;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hover-effect {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.spin {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.no-results-message {
    text-align: center;
    padding: 40px 20px;
    color: #666;
    font-style: italic;
    display: none;
}

.filter-button {
    padding: 8px 16px;
    border: 1px solid #e0e0e0;
    background: white;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 8px;
    margin-bottom: 8px;
    transition: all 0.2s ease;
}

.filter-button:hover {
    border-color: #667eea;
    color: #667eea;
}

.filter-button.active {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

.accordion-item {
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    margin-bottom: 10px;
    overflow: hidden;
}

.accordion-header {
    padding: 15px 20px;
    background: #f8f9fa;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: background 0.2s ease;
}

.accordion-header:hover {
    background: #e9ecef;
}

.accordion-header::after {
    content: '+';
    font-size: 18px;
    font-weight: bold;
    color: #667eea;
    transition: transform 0.2s ease;
}

.accordion-item.active .accordion-header::after {
    transform: rotate(45deg);
}

.accordion-content {
    padding: 20px;
    display: none;
    border-top: 1px solid #e0e0e0;
}
</style>
`;

// Inject dynamic CSS
document.head.insertAdjacentHTML('beforeend', dynamicCSS);

