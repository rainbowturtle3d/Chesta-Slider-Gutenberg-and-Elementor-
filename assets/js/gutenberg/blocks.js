(function() {
    'use strict';

    const { registerBlockType } = wp.blocks;
    const { createElement: el, Fragment } = wp.element;
    const { InspectorControls, MediaUpload, MediaUploadCheck } = wp.blockEditor;
    const { 
        PanelBody, 
        PanelRow, 
        ToggleControl, 
        RangeControl, 
        SelectControl, 
        TextControl, 
        ColorPicker, 
        Button,
        ButtonGroup,
        TabPanel,
        Card,
        CardBody,
        CardHeader
    } = wp.components;
    const { __ } = wp.i18n;

    // Get template data from localized script
    const templates = chestaSliderBlocks.templates || {};

    // Register each slider type as a separate block
    Object.keys(templates).forEach(function(sliderType) {
        const template = templates[sliderType];
        
        registerBlockType(`chesta-slider/${sliderType}`, {
            title: template.name,
            description: template.description,
            icon: template.icon || 'slides',
            category: 'chesta-sliders',
            keywords: ['slider', 'carousel', 'chesta', sliderType],
            supports: {
                align: ['wide', 'full'],
                html: false,
            },
            attributes: getBlockAttributes(sliderType),
            
            edit: function(props) {
                const { attributes, setAttributes, className } = props;
                
                return el(Fragment, {},
                    // Inspector Controls (Sidebar)
                    el(InspectorControls, {},
                        // Display Settings Panel
                        el(PanelBody, {
                            title: __('Display Settings', 'chesta-slider'),
                            initialOpen: true
                        },
                            el(RangeControl, {
                                label: __('Slides to Show', 'chesta-slider'),
                                value: attributes.slidesToShow,
                                onChange: function(value) {
                                    setAttributes({ slidesToShow: value });
                                },
                                min: 1,
                                max: 10
                            }),
                            el(RangeControl, {
                                label: __('Slides to Scroll', 'chesta-slider'),
                                value: attributes.slidesToScroll,
                                onChange: function(value) {
                                    setAttributes({ slidesToScroll: value });
                                },
                                min: 1,
                                max: 10
                            }),
                            el(TextControl, {
                                label: __('Height (Desktop)', 'chesta-slider'),
                                value: attributes.height,
                                onChange: function(value) {
                                    setAttributes({ height: value });
                                },
                                help: __('e.g., 400px, 50vh, auto', 'chesta-slider')
                            }),
                            el(TextControl, {
                                label: __('Height (Tablet)', 'chesta-slider'),
                                value: attributes.heightTablet,
                                onChange: function(value) {
                                    setAttributes({ heightTablet: value });
                                }
                            }),
                            el(TextControl, {
                                label: __('Height (Mobile)', 'chesta-slider'),
                                value: attributes.heightMobile,
                                onChange: function(value) {
                                    setAttributes({ heightMobile: value });
                                }
                            })
                        ),

                        // Animation Settings Panel
                        el(PanelBody, {
                            title: __('Animation Settings', 'chesta-slider'),
                            initialOpen: false
                        },
                            el(ToggleControl, {
                                label: __('Autoplay', 'chesta-slider'),
                                checked: attributes.autoplay,
                                onChange: function(value) {
                                    setAttributes({ autoplay: value });
                                }
                            }),
                            attributes.autoplay && el(RangeControl, {
                                label: __('Autoplay Speed (ms)', 'chesta-slider'),
                                value: attributes.autoplaySpeed,
                                onChange: function(value) {
                                    setAttributes({ autoplaySpeed: value });
                                },
                                min: 1000,
                                max: 10000,
                                step: 500
                            }),
                            el(RangeControl, {
                                label: __('Animation Speed (ms)', 'chesta-slider'),
                                value: attributes.speed,
                                onChange: function(value) {
                                    setAttributes({ speed: value });
                                },
                                min: 100,
                                max: 2000,
                                step: 100
                            }),
                            el(ToggleControl, {
                                label: __('Infinite Loop', 'chesta-slider'),
                                checked: attributes.infinite,
                                onChange: function(value) {
                                    setAttributes({ infinite: value });
                                }
                            }),
                            el(SelectControl, {
                                label: __('Transition Mode', 'chesta-slider'),
                                value: attributes.transitionMode,
                                options: [
                                    { label: __('Slide', 'chesta-slider'), value: 'slide' },
                                    { label: __('Fade', 'chesta-slider'), value: 'fade' },
                                    { label: __('Flip', 'chesta-slider'), value: 'flip' },
                                    { label: __('Cube', 'chesta-slider'), value: 'cube' },
                                    { label: __('Coverflow', 'chesta-slider'), value: 'coverflow' }
                                ],
                                onChange: function(value) {
                                    setAttributes({ transitionMode: value });
                                }
                            }),
                            el(SelectControl, {
                                label: __('Easing', 'chesta-slider'),
                                value: attributes.easing,
                                options: [
                                    { label: __('Ease', 'chesta-slider'), value: 'ease' },
                                    { label: __('Linear', 'chesta-slider'), value: 'linear' },
                                    { label: __('Ease In', 'chesta-slider'), value: 'ease-in' },
                                    { label: __('Ease Out', 'chesta-slider'), value: 'ease-out' },
                                    { label: __('Ease In Out', 'chesta-slider'), value: 'ease-in-out' }
                                ],
                                onChange: function(value) {
                                    setAttributes({ easing: value });
                                }
                            })
                        ),

                        // Navigation Settings Panel
                        el(PanelBody, {
                            title: __('Navigation Settings', 'chesta-slider'),
                            initialOpen: false
                        },
                            el(ToggleControl, {
                                label: __('Show Arrows', 'chesta-slider'),
                                checked: attributes.arrows,
                                onChange: function(value) {
                                    setAttributes({ arrows: value });
                                }
                            }),
                            attributes.arrows && el(Fragment, {},
                                el(SelectControl, {
                                    label: __('Arrow Type', 'chesta-slider'),
                                    value: attributes.arrowType,
                                    options: [
                                        { label: __('Default', 'chesta-slider'), value: 'default' },
                                        { label: __('Circle', 'chesta-slider'), value: 'circle' },
                                        { label: __('Square', 'chesta-slider'), value: 'square' },
                                        { label: __('Minimal', 'chesta-slider'), value: 'minimal' }
                                    ],
                                    onChange: function(value) {
                                        setAttributes({ arrowType: value });
                                    }
                                }),
                                el(RangeControl, {
                                    label: __('Arrow Size', 'chesta-slider'),
                                    value: attributes.arrowSize,
                                    onChange: function(value) {
                                        setAttributes({ arrowSize: value });
                                    },
                                    min: 20,
                                    max: 100
                                }),
                                el(PanelRow, {},
                                    el('label', { style: { marginBottom: '8px', display: 'block' } }, __('Arrow Color', 'chesta-slider')),
                                    el(ColorPicker, {
                                        color: attributes.arrowColor,
                                        onChange: function(value) {
                                            setAttributes({ arrowColor: value });
                                        }
                                    })
                                ),
                                el(SelectControl, {
                                    label: __('Arrow Position', 'chesta-slider'),
                                    value: attributes.arrowPosition,
                                    options: [
                                        { label: __('Sides', 'chesta-slider'), value: 'sides' },
                                        { label: __('Bottom', 'chesta-slider'), value: 'bottom' },
                                        { label: __('Top', 'chesta-slider'), value: 'top' },
                                        { label: __('Center', 'chesta-slider'), value: 'center' }
                                    ],
                                    onChange: function(value) {
                                        setAttributes({ arrowPosition: value });
                                    }
                                })
                            ),
                            el(ToggleControl, {
                                label: __('Show Dots', 'chesta-slider'),
                                checked: attributes.dots,
                                onChange: function(value) {
                                    setAttributes({ dots: value });
                                }
                            }),
                            attributes.dots && el(Fragment, {},
                                el(SelectControl, {
                                    label: __('Dots Type', 'chesta-slider'),
                                    value: attributes.dotsType,
                                    options: [
                                        { label: __('Dots', 'chesta-slider'), value: 'dots' },
                                        { label: __('Lines', 'chesta-slider'), value: 'lines' },
                                        { label: __('Numbers', 'chesta-slider'), value: 'numbers' },
                                        { label: __('Thumbnails', 'chesta-slider'), value: 'thumbnails' },
                                        { label: __('Progress', 'chesta-slider'), value: 'progress' }
                                    ],
                                    onChange: function(value) {
                                        setAttributes({ dotsType: value });
                                    }
                                }),
                                el(SelectControl, {
                                    label: __('Dots Position', 'chesta-slider'),
                                    value: attributes.dotsPosition,
                                    options: [
                                        { label: __('Bottom Center', 'chesta-slider'), value: 'bottom-center' },
                                        { label: __('Bottom Left', 'chesta-slider'), value: 'bottom-left' },
                                        { label: __('Bottom Right', 'chesta-slider'), value: 'bottom-right' },
                                        { label: __('Top Center', 'chesta-slider'), value: 'top-center' },
                                        { label: __('Left', 'chesta-slider'), value: 'left' },
                                        { label: __('Right', 'chesta-slider'), value: 'right' }
                                    ],
                                    onChange: function(value) {
                                        setAttributes({ dotsPosition: value });
                                    }
                                }),
                                el(RangeControl, {
                                    label: __('Dots Size', 'chesta-slider'),
                                    value: attributes.dotsSize,
                                    onChange: function(value) {
                                        setAttributes({ dotsSize: value });
                                    },
                                    min: 8,
                                    max: 30
                                })
                            )
                        ),

                        // Interaction Settings Panel
                        el(PanelBody, {
                            title: __('Interaction Settings', 'chesta-slider'),
                            initialOpen: false
                        },
                            el(ToggleControl, {
                                label: __('Mouse Wheel Navigation', 'chesta-slider'),
                                checked: attributes.mouseWheel,
                                onChange: function(value) {
                                    setAttributes({ mouseWheel: value });
                                }
                            }),
                            el(ToggleControl, {
                                label: __('Mouse Drag', 'chesta-slider'),
                                checked: attributes.mouseDrag,
                                onChange: function(value) {
                                    setAttributes({ mouseDrag: value });
                                }
                            }),
                            el(ToggleControl, {
                                label: __('Touch Swipe', 'chesta-slider'),
                                checked: attributes.touchSwipe,
                                onChange: function(value) {
                                    setAttributes({ touchSwipe: value });
                                }
                            }),
                            el(ToggleControl, {
                                label: __('Keyboard Navigation', 'chesta-slider'),
                                checked: attributes.keyboard,
                                onChange: function(value) {
                                    setAttributes({ keyboard: value });
                                }
                            }),
                            el(ToggleControl, {
                                label: __('Pause on Hover', 'chesta-slider'),
                                checked: attributes.pauseOnHover,
                                onChange: function(value) {
                                    setAttributes({ pauseOnHover: value });
                                }
                            }),
                            el(ToggleControl, {
                                label: __('Pause on Focus', 'chesta-slider'),
                                checked: attributes.pauseOnFocus,
                                onChange: function(value) {
                                    setAttributes({ pauseOnFocus: value });
                                }
                            })
                        ),

                        // Advanced Settings Panel
                        el(PanelBody, {
                            title: __('Advanced Settings', 'chesta-slider'),
                            initialOpen: false
                        },
                            el(ToggleControl, {
                                label: __('Center Mode', 'chesta-slider'),
                                checked: attributes.centerMode,
                                onChange: function(value) {
                                    setAttributes({ centerMode: value });
                                }
                            }),
                            attributes.centerMode && el(RangeControl, {
                                label: __('Center Padding', 'chesta-slider'),
                                value: attributes.centerPadding,
                                onChange: function(value) {
                                    setAttributes({ centerPadding: value });
                                },
                                min: 0,
                                max: 200
                            }),
                            el(ToggleControl, {
                                label: __('Variable Width', 'chesta-slider'),
                                checked: attributes.variableWidth,
                                onChange: function(value) {
                                    setAttributes({ variableWidth: value });
                                }
                            }),
                            el(ToggleControl, {
                                label: __('Lazy Load', 'chesta-slider'),
                                checked: attributes.lazyLoad,
                                onChange: function(value) {
                                    setAttributes({ lazyLoad: value });
                                }
                            }),
                            el(ToggleControl, {
                                label: __('Accessibility', 'chesta-slider'),
                                checked: attributes.accessibility,
                                onChange: function(value) {
                                    setAttributes({ accessibility: value });
                                }
                            }),
                            el(ToggleControl, {
                                label: __('RTL Support', 'chesta-slider'),
                                checked: attributes.rtl,
                                onChange: function(value) {
                                    setAttributes({ rtl: value });
                                }
                            })
                        ),

                        // Type-specific settings
                        getTypeSpecificControls(sliderType, attributes, setAttributes)
                    ),

                    // Block Preview
                    el('div', {
                        className: className + ' chesta-slider-block-preview'
                    },
                        el('div', {
                            className: 'chesta-slider-preview-header'
                        },
                            el('h3', {}, template.name),
                            el('p', {}, template.description)
                        ),
                        el('div', {
                            className: 'chesta-slider-preview-content'
                        },
                            el('div', {
                                className: 'chesta-slider-preview-placeholder',
                                style: {
                                    height: attributes.height,
                                    background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                                    display: 'flex',
                                    alignItems: 'center',
                                    justifyContent: 'center',
                                    color: 'white',
                                    fontSize: '18px',
                                    fontWeight: 'bold',
                                    borderRadius: '8px'
                                }
                            },
                                __('Chesta Slider Preview', 'chesta-slider'),
                                el('br'),
                                el('small', { style: { opacity: 0.8 } }, 
                                    __('Configure settings in the sidebar →', 'chesta-slider')
                                )
                            )
                        ),
                        el('div', {
                            className: 'chesta-slider-preview-info'
                        },
                            el('small', {},
                                __('Type: ', 'chesta-slider') + template.name + ' | ' +
                                __('Slides: ', 'chesta-slider') + attributes.slidesToShow + ' | ' +
                                __('Auto: ', 'chesta-slider') + (attributes.autoplay ? __('On', 'chesta-slider') : __('Off', 'chesta-slider'))
                            )
                        )
                    )
                );
            },

            save: function() {
                // Return null since this is a dynamic block
                return null;
            }
        });
    });

    // Helper function to get block attributes
    function getBlockAttributes(sliderType) {
        const commonAttributes = {
            sliderType: { type: 'string', default: sliderType },
            sliderId: { type: 'string', default: '' },
            slides: { type: 'array', default: [] },
            slidesToShow: { type: 'number', default: 1 },
            slidesToScroll: { type: 'number', default: 1 },
            height: { type: 'string', default: '400px' },
            heightTablet: { type: 'string', default: '350px' },
            heightMobile: { type: 'string', default: '300px' },
            autoplay: { type: 'boolean', default: false },
            autoplaySpeed: { type: 'number', default: 3000 },
            speed: { type: 'number', default: 500 },
            infinite: { type: 'boolean', default: true },
            transitionMode: { type: 'string', default: 'slide' },
            easing: { type: 'string', default: 'ease' },
            arrows: { type: 'boolean', default: true },
            arrowType: { type: 'string', default: 'default' },
            arrowSize: { type: 'number', default: 50 },
            arrowColor: { type: 'string', default: '#ffffff' },
            arrowBackground: { type: 'string', default: 'rgba(0,0,0,0.5)' },
            arrowPosition: { type: 'string', default: 'sides' },
            dots: { type: 'boolean', default: true },
            dotsType: { type: 'string', default: 'dots' },
            dotsPosition: { type: 'string', default: 'bottom-center' },
            dotsColor: { type: 'string', default: '#cccccc' },
            dotsActiveColor: { type: 'string', default: '#007cba' },
            dotsSize: { type: 'number', default: 12 },
            dotsGap: { type: 'number', default: 8 },
            margin: { type: 'object', default: { top: '0px', right: '0px', bottom: '20px', left: '0px' } },
            padding: { type: 'object', default: { top: '0px', right: '0px', bottom: '0px', left: '0px' } },
            innerGap: { type: 'number', default: 0 },
            contentPosition: { type: 'string', default: 'bottom-left' },
            titleAnimation: { type: 'string', default: 'fadeInUp' },
            titleDelay: { type: 'number', default: 200 },
            titleDuration: { type: 'number', default: 600 },
            descriptionAnimation: { type: 'string', default: 'fadeInUp' },
            descriptionDelay: { type: 'number', default: 400 },
            descriptionDuration: { type: 'number', default: 600 },
            buttonAnimation: { type: 'string', default: 'fadeInUp' },
            buttonDelay: { type: 'number', default: 600 },
            buttonDuration: { type: 'number', default: 600 },
            mouseWheel: { type: 'boolean', default: false },
            mouseDrag: { type: 'boolean', default: true },
            touchSwipe: { type: 'boolean', default: true },
            keyboard: { type: 'boolean', default: true },
            pauseOnHover: { type: 'boolean', default: true },
            pauseOnFocus: { type: 'boolean', default: true },
            centerMode: { type: 'boolean', default: false },
            centerPadding: { type: 'number', default: 60 },
            variableWidth: { type: 'boolean', default: false },
            lazyLoad: { type: 'boolean', default: true },
            preloadImages: { type: 'number', default: 1 },
            accessibility: { type: 'boolean', default: true },
            rtl: { type: 'boolean', default: false },
            customCSS: { type: 'string', default: '' },
            customJS: { type: 'string', default: '' }
        };

        // Add type-specific attributes
        const typeSpecific = getTypeSpecificAttributes(sliderType);
        return Object.assign({}, commonAttributes, typeSpecific);
    }

    // Helper function to get type-specific attributes
    function getTypeSpecificAttributes(sliderType) {
        const attributes = {};

        switch (sliderType) {
            case 'hero':
                attributes.fullWidth = { type: 'boolean', default: true };
                attributes.overlayOpacity = { type: 'number', default: 0.5 };
                break;
            case 'testimonial':
                attributes.showAuthorImage = { type: 'boolean', default: true };
                attributes.showRating = { type: 'boolean', default: true };
                break;
            case 'product':
                attributes.showPrice = { type: 'boolean', default: true };
                attributes.showAddToCart = { type: 'boolean', default: true };
                break;
            case 'video':
                attributes.videoProvider = { type: 'string', default: 'youtube' };
                attributes.autoplayVideo = { type: 'boolean', default: false };
                break;
            case 'post':
                attributes.postType = { type: 'string', default: 'post' };
                attributes.postsPerSlide = { type: 'number', default: 1 };
                attributes.showExcerpt = { type: 'boolean', default: true };
                attributes.showMeta = { type: 'boolean', default: true };
                break;
            case 'countdown':
                attributes.targetDate = { type: 'string', default: '' };
                attributes.countdownFormat = { type: 'string', default: 'days-hours-minutes-seconds' };
                break;
        }

        return attributes;
    }

    // Helper function to get type-specific controls
    function getTypeSpecificControls(sliderType, attributes, setAttributes) {
        switch (sliderType) {
            case 'hero':
                return el(PanelBody, {
                    title: __('Hero Settings', 'chesta-slider'),
                    initialOpen: false
                },
                    el(ToggleControl, {
                        label: __('Full Width', 'chesta-slider'),
                        checked: attributes.fullWidth,
                        onChange: function(value) {
                            setAttributes({ fullWidth: value });
                        }
                    }),
                    el(RangeControl, {
                        label: __('Overlay Opacity', 'chesta-slider'),
                        value: attributes.overlayOpacity,
                        onChange: function(value) {
                            setAttributes({ overlayOpacity: value });
                        },
                        min: 0,
                        max: 1,
                        step: 0.1
                    })
                );

            case 'testimonial':
                return el(PanelBody, {
                    title: __('Testimonial Settings', 'chesta-slider'),
                    initialOpen: false
                },
                    el(ToggleControl, {
                        label: __('Show Author Image', 'chesta-slider'),
                        checked: attributes.showAuthorImage,
                        onChange: function(value) {
                            setAttributes({ showAuthorImage: value });
                        }
                    }),
                    el(ToggleControl, {
                        label: __('Show Rating', 'chesta-slider'),
                        checked: attributes.showRating,
                        onChange: function(value) {
                            setAttributes({ showRating: value });
                        }
                    })
                );

            case 'video':
                return el(PanelBody, {
                    title: __('Video Settings', 'chesta-slider'),
                    initialOpen: false
                },
                    el(SelectControl, {
                        label: __('Video Provider', 'chesta-slider'),
                        value: attributes.videoProvider,
                        options: [
                            { label: __('YouTube', 'chesta-slider'), value: 'youtube' },
                            { label: __('Vimeo', 'chesta-slider'), value: 'vimeo' },
                            { label: __('Self Hosted', 'chesta-slider'), value: 'self' }
                        ],
                        onChange: function(value) {
                            setAttributes({ videoProvider: value });
                        }
                    }),
                    el(ToggleControl, {
                        label: __('Autoplay Video', 'chesta-slider'),
                        checked: attributes.autoplayVideo,
                        onChange: function(value) {
                            setAttributes({ autoplayVideo: value });
                        }
                    })
                );

            case 'countdown':
                return el(PanelBody, {
                    title: __('Countdown Settings', 'chesta-slider'),
                    initialOpen: false
                },
                    el(TextControl, {
                        label: __('Target Date', 'chesta-slider'),
                        value: attributes.targetDate,
                        onChange: function(value) {
                            setAttributes({ targetDate: value });
                        },
                        help: __('Format: YYYY-MM-DD HH:MM:SS', 'chesta-slider')
                    }),
                    el(SelectControl, {
                        label: __('Countdown Format', 'chesta-slider'),
                        value: attributes.countdownFormat,
                        options: [
                            { label: __('Days, Hours, Minutes, Seconds', 'chesta-slider'), value: 'days-hours-minutes-seconds' },
                            { label: __('Hours, Minutes, Seconds', 'chesta-slider'), value: 'hours-minutes-seconds' },
                            { label: __('Minutes, Seconds', 'chesta-slider'), value: 'minutes-seconds' },
                            { label: __('Seconds Only', 'chesta-slider'), value: 'seconds' }
                        ],
                        onChange: function(value) {
                            setAttributes({ countdownFormat: value });
                        }
                    })
                );

            default:
                return null;
        }
    }

})();

