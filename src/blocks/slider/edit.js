/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
    InspectorControls,
    InnerBlocks,
    useBlockProps,
    BlockControls,
    AlignmentToolbar,
} from '@wordpress/block-editor';
import {
    PanelBody,
    SelectControl,
    RangeControl,
    ToggleControl,
    TextControl,
    ColorPicker,
    TabPanel,
    Button,
    ButtonGroup,
    Card,
    CardBody,
    CardHeader,
    Flex,
    FlexItem,
    __experimentalSpacer as Spacer,
} from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';
import { useSelect } from '@wordpress/data';

/**
 * Internal dependencies
 */
import SliderPreview from './preview';

const ALLOWED_BLOCKS = ['chesta-slider/slide'];

const SLIDER_TYPES = [
    { label: __('Carousel', 'chesta-slider'), value: 'carousel' },
    { label: __('Fade', 'chesta-slider'), value: 'fade' },
    { label: __('Hero Slider', 'chesta-slider'), value: 'hero' },
    { label: __('Vertical', 'chesta-slider'), value: 'vertical' },
    { label: __('Thumbnail Navigation', 'chesta-slider'), value: 'thumbnail' },
    { label: __('Testimonial', 'chesta-slider'), value: 'testimonial' },
    { label: __('Logo Carousel', 'chesta-slider'), value: 'logo' },
    { label: __('Product Slider', 'chesta-slider'), value: 'product' },
    { label: __('Video Slider', 'chesta-slider'), value: 'video' },
    { label: __('Parallax', 'chesta-slider'), value: 'parallax' },
    { label: __('Multi-row', 'chesta-slider'), value: 'multirow' },
    { label: __('Center Mode', 'chesta-slider'), value: 'center' },
];

const RESPONSIVE_BREAKPOINTS = [
    { label: __('Desktop', 'chesta-slider'), value: 1200 },
    { label: __('Tablet', 'chesta-slider'), value: 768 },
    { label: __('Mobile', 'chesta-slider'), value: 480 },
];

export default function Edit({ attributes, setAttributes, clientId }) {
    const {
        sliderType,
        slidesToShow,
        slidesToScroll,
        autoplay,
        autoplaySpeed,
        speed,
        infinite,
        arrows,
        dots,
        fade,
        vertical,
        centerMode,
        variableWidth,
        lazyLoad,
        pauseOnHover,
        pauseOnFocus,
        accessibility,
        swipe,
        draggable,
        rtl,
        responsive,
        customCSS,
        sliderHeight,
        sliderWidth,
        backgroundColor,
        textColor,
        arrowColor,
        dotColor,
        borderRadius,
        boxShadow,
        margin,
        padding,
    } = attributes;

    const [activeTab, setActiveTab] = useState('general');
    const [previewMode, setPreviewMode] = useState(false);

    const blockProps = useBlockProps({
        className: `chesta-slider-editor chesta-${sliderType}`,
        style: {
            height: sliderHeight || 'auto',
            width: sliderWidth || '100%',
            backgroundColor: backgroundColor || 'transparent',
            color: textColor || 'inherit',
            borderRadius: borderRadius || '0',
            boxShadow: boxShadow || 'none',
            margin: margin || '0',
            padding: padding || '0',
        },
    });

    const hasInnerBlocks = useSelect(
        (select) => {
            const { getBlock } = select('core/block-editor');
            const block = getBlock(clientId);
            return !!(block && block.innerBlocks.length);
        },
        [clientId]
    );

    const template = [
        ['chesta-slider/slide', {}],
        ['chesta-slider/slide', {}],
        ['chesta-slider/slide', {}],
    ];

    const updateResponsiveSettings = (breakpoint, setting, value) => {
        const newResponsive = [...responsive];
        const existingIndex = newResponsive.findIndex(item => item.breakpoint === breakpoint);
        
        if (existingIndex >= 0) {
            newResponsive[existingIndex].settings[setting] = value;
        } else {
            newResponsive.push({
                breakpoint,
                settings: { [setting]: value }
            });
        }
        
        setAttributes({ responsive: newResponsive });
    };

    const getResponsiveValue = (breakpoint, setting) => {
        const responsiveItem = responsive.find(item => item.breakpoint === breakpoint);
        return responsiveItem?.settings?.[setting] || attributes[setting];
    };

    const renderGeneralSettings = () => (
        <>
            <PanelBody title={__('Slider Type', 'chesta-slider')} initialOpen={true}>
                <SelectControl
                    label={__('Slider Type', 'chesta-slider')}
                    value={sliderType}
                    options={SLIDER_TYPES}
                    onChange={(value) => setAttributes({ sliderType: value })}
                    help={__('Choose the type of slider animation and layout.', 'chesta-slider')}
                />
            </PanelBody>

            <PanelBody title={__('Display Settings', 'chesta-slider')} initialOpen={true}>
                <RangeControl
                    label={__('Slides to Show', 'chesta-slider')}
                    value={slidesToShow}
                    onChange={(value) => setAttributes({ slidesToShow: value })}
                    min={1}
                    max={6}
                    help={__('Number of slides visible at once.', 'chesta-slider')}
                />
                
                <RangeControl
                    label={__('Slides to Scroll', 'chesta-slider')}
                    value={slidesToScroll}
                    onChange={(value) => setAttributes({ slidesToScroll: value })}
                    min={1}
                    max={slidesToShow}
                    help={__('Number of slides to scroll at once.', 'chesta-slider')}
                />

                <Spacer marginY={3} />

                <ToggleControl
                    label={__('Infinite Loop', 'chesta-slider')}
                    checked={infinite}
                    onChange={(value) => setAttributes({ infinite: value })}
                    help={__('Enable infinite scrolling.', 'chesta-slider')}
                />

                <ToggleControl
                    label={__('Center Mode', 'chesta-slider')}
                    checked={centerMode}
                    onChange={(value) => setAttributes({ centerMode: value })}
                    help={__('Center the active slide with partial view of others.', 'chesta-slider')}
                />

                <ToggleControl
                    label={__('Variable Width', 'chesta-slider')}
                    checked={variableWidth}
                    onChange={(value) => setAttributes({ variableWidth: value })}
                    help={__('Allow slides to have different widths.', 'chesta-slider')}
                />
            </PanelBody>

            <PanelBody title={__('Animation Settings', 'chesta-slider')} initialOpen={false}>
                <RangeControl
                    label={__('Animation Speed (ms)', 'chesta-slider')}
                    value={speed}
                    onChange={(value) => setAttributes({ speed: value })}
                    min={100}
                    max={2000}
                    step={100}
                />

                <ToggleControl
                    label={__('Fade Effect', 'chesta-slider')}
                    checked={fade}
                    onChange={(value) => setAttributes({ fade: value })}
                    help={__('Use fade transition instead of slide.', 'chesta-slider')}
                />

                <ToggleControl
                    label={__('Vertical Direction', 'chesta-slider')}
                    checked={vertical}
                    onChange={(value) => setAttributes({ vertical: value })}
                    help={__('Slide vertically instead of horizontally.', 'chesta-slider')}
                />
            </PanelBody>
        </>
    );

    const renderAutoplaySettings = () => (
        <>
            <PanelBody title={__('Autoplay Settings', 'chesta-slider')} initialOpen={true}>
                <ToggleControl
                    label={__('Enable Autoplay', 'chesta-slider')}
                    checked={autoplay}
                    onChange={(value) => setAttributes({ autoplay: value })}
                />

                {autoplay && (
                    <>
                        <RangeControl
                            label={__('Autoplay Speed (ms)', 'chesta-slider')}
                            value={autoplaySpeed}
                            onChange={(value) => setAttributes({ autoplaySpeed: value })}
                            min={1000}
                            max={10000}
                            step={500}
                        />

                        <ToggleControl
                            label={__('Pause on Hover', 'chesta-slider')}
                            checked={pauseOnHover}
                            onChange={(value) => setAttributes({ pauseOnHover: value })}
                        />

                        <ToggleControl
                            label={__('Pause on Focus', 'chesta-slider')}
                            checked={pauseOnFocus}
                            onChange={(value) => setAttributes({ pauseOnFocus: value })}
                        />
                    </>
                )}
            </PanelBody>
        </>
    );

    const renderNavigationSettings = () => (
        <>
            <PanelBody title={__('Navigation', 'chesta-slider')} initialOpen={true}>
                <ToggleControl
                    label={__('Show Arrows', 'chesta-slider')}
                    checked={arrows}
                    onChange={(value) => setAttributes({ arrows: value })}
                />

                <ToggleControl
                    label={__('Show Dots', 'chesta-slider')}
                    checked={dots}
                    onChange={(value) => setAttributes({ dots: value })}
                />

                <Spacer marginY={3} />

                <ToggleControl
                    label={__('Touch/Swipe', 'chesta-slider')}
                    checked={swipe}
                    onChange={(value) => setAttributes({ swipe: value })}
                    help={__('Enable touch/swipe navigation on mobile.', 'chesta-slider')}
                />

                <ToggleControl
                    label={__('Mouse Dragging', 'chesta-slider')}
                    checked={draggable}
                    onChange={(value) => setAttributes({ draggable: value })}
                    help={__('Enable mouse dragging on desktop.', 'chesta-slider')}
                />
            </PanelBody>
        </>
    );

    const renderStyleSettings = () => (
        <>
            <PanelBody title={__('Dimensions', 'chesta-slider')} initialOpen={true}>
                <TextControl
                    label={__('Height', 'chesta-slider')}
                    value={sliderHeight}
                    onChange={(value) => setAttributes({ sliderHeight: value })}
                    placeholder="auto"
                    help={__('CSS height value (e.g., 400px, 50vh)', 'chesta-slider')}
                />

                <TextControl
                    label={__('Width', 'chesta-slider')}
                    value={sliderWidth}
                    onChange={(value) => setAttributes({ sliderWidth: value })}
                    placeholder="100%"
                    help={__('CSS width value (e.g., 800px, 100%)', 'chesta-slider')}
                />
            </PanelBody>

            <PanelBody title={__('Colors', 'chesta-slider')} initialOpen={false}>
                <div style={{ marginBottom: '16px' }}>
                    <label>{__('Background Color', 'chesta-slider')}</label>
                    <ColorPicker
                        color={backgroundColor}
                        onChange={(value) => setAttributes({ backgroundColor: value })}
                        disableAlpha={false}
                    />
                </div>

                <div style={{ marginBottom: '16px' }}>
                    <label>{__('Text Color', 'chesta-slider')}</label>
                    <ColorPicker
                        color={textColor}
                        onChange={(value) => setAttributes({ textColor: value })}
                        disableAlpha={false}
                    />
                </div>

                <div style={{ marginBottom: '16px' }}>
                    <label>{__('Arrow Color', 'chesta-slider')}</label>
                    <ColorPicker
                        color={arrowColor}
                        onChange={(value) => setAttributes({ arrowColor: value })}
                        disableAlpha={false}
                    />
                </div>

                <div style={{ marginBottom: '16px' }}>
                    <label>{__('Dot Color', 'chesta-slider')}</label>
                    <ColorPicker
                        color={dotColor}
                        onChange={(value) => setAttributes({ dotColor: value })}
                        disableAlpha={false}
                    />
                </div>
            </PanelBody>

            <PanelBody title={__('Spacing & Effects', 'chesta-slider')} initialOpen={false}>
                <TextControl
                    label={__('Margin', 'chesta-slider')}
                    value={margin}
                    onChange={(value) => setAttributes({ margin: value })}
                    placeholder="0"
                    help={__('CSS margin (e.g., 20px, 1rem 2rem)', 'chesta-slider')}
                />

                <TextControl
                    label={__('Padding', 'chesta-slider')}
                    value={padding}
                    onChange={(value) => setAttributes({ padding: value })}
                    placeholder="0"
                    help={__('CSS padding (e.g., 20px, 1rem 2rem)', 'chesta-slider')}
                />

                <TextControl
                    label={__('Border Radius', 'chesta-slider')}
                    value={borderRadius}
                    onChange={(value) => setAttributes({ borderRadius: value })}
                    placeholder="0"
                    help={__('CSS border-radius (e.g., 8px, 50%)', 'chesta-slider')}
                />

                <TextControl
                    label={__('Box Shadow', 'chesta-slider')}
                    value={boxShadow}
                    onChange={(value) => setAttributes({ boxShadow: value })}
                    placeholder="none"
                    help={__('CSS box-shadow (e.g., 0 4px 8px rgba(0,0,0,0.1))', 'chesta-slider')}
                />
            </PanelBody>
        </>
    );

    const renderResponsiveSettings = () => (
        <>
            <PanelBody title={__('Responsive Settings', 'chesta-slider')} initialOpen={true}>
                <p>{__('Configure different settings for different screen sizes.', 'chesta-slider')}</p>
                
                {RESPONSIVE_BREAKPOINTS.map((breakpoint) => (
                    <Card key={breakpoint.value} style={{ marginBottom: '16px' }}>
                        <CardHeader>
                            <strong>{breakpoint.label} ({breakpoint.value}px and below)</strong>
                        </CardHeader>
                        <CardBody>
                            <RangeControl
                                label={__('Slides to Show', 'chesta-slider')}
                                value={getResponsiveValue(breakpoint.value, 'slidesToShow')}
                                onChange={(value) => updateResponsiveSettings(breakpoint.value, 'slidesToShow', value)}
                                min={1}
                                max={6}
                            />
                            
                            <RangeControl
                                label={__('Slides to Scroll', 'chesta-slider')}
                                value={getResponsiveValue(breakpoint.value, 'slidesToScroll')}
                                onChange={(value) => updateResponsiveSettings(breakpoint.value, 'slidesToScroll', value)}
                                min={1}
                                max={6}
                            />

                            <ToggleControl
                                label={__('Show Arrows', 'chesta-slider')}
                                checked={getResponsiveValue(breakpoint.value, 'arrows')}
                                onChange={(value) => updateResponsiveSettings(breakpoint.value, 'arrows', value)}
                            />

                            <ToggleControl
                                label={__('Show Dots', 'chesta-slider')}
                                checked={getResponsiveValue(breakpoint.value, 'dots')}
                                onChange={(value) => updateResponsiveSettings(breakpoint.value, 'dots', value)}
                            />
                        </CardBody>
                    </Card>
                ))}
            </PanelBody>
        </>
    );

    const renderAdvancedSettings = () => (
        <>
            <PanelBody title={__('Accessibility & Performance', 'chesta-slider')} initialOpen={true}>
                <ToggleControl
                    label={__('Accessibility Features', 'chesta-slider')}
                    checked={accessibility}
                    onChange={(value) => setAttributes({ accessibility: value })}
                    help={__('Enable ARIA labels and keyboard navigation.', 'chesta-slider')}
                />

                <ToggleControl
                    label={__('Lazy Loading', 'chesta-slider')}
                    checked={lazyLoad}
                    onChange={(value) => setAttributes({ lazyLoad: value })}
                    help={__('Load images only when needed for better performance.', 'chesta-slider')}
                />

                <ToggleControl
                    label={__('RTL Support', 'chesta-slider')}
                    checked={rtl}
                    onChange={(value) => setAttributes({ rtl: value })}
                    help={__('Enable right-to-left language support.', 'chesta-slider')}
                />
            </PanelBody>

            <PanelBody title={__('Custom CSS', 'chesta-slider')} initialOpen={false}>
                <TextControl
                    label={__('Custom CSS', 'chesta-slider')}
                    value={customCSS}
                    onChange={(value) => setAttributes({ customCSS: value })}
                    help={__('Add custom CSS for advanced styling.', 'chesta-slider')}
                    rows={6}
                    component="textarea"
                />
            </PanelBody>
        </>
    );

    return (
        <>
            <BlockControls>
                <ButtonGroup>
                    <Button
                        isPressed={!previewMode}
                        onClick={() => setPreviewMode(false)}
                    >
                        {__('Edit', 'chesta-slider')}
                    </Button>
                    <Button
                        isPressed={previewMode}
                        onClick={() => setPreviewMode(true)}
                    >
                        {__('Preview', 'chesta-slider')}
                    </Button>
                </ButtonGroup>
            </BlockControls>

            <InspectorControls>
                <TabPanel
                    className="chesta-slider-tabs"
                    activeClass="active-tab"
                    tabs={[
                        {
                            name: 'general',
                            title: __('General', 'chesta-slider'),
                            className: 'tab-general',
                        },
                        {
                            name: 'autoplay',
                            title: __('Autoplay', 'chesta-slider'),
                            className: 'tab-autoplay',
                        },
                        {
                            name: 'navigation',
                            title: __('Navigation', 'chesta-slider'),
                            className: 'tab-navigation',
                        },
                        {
                            name: 'style',
                            title: __('Style', 'chesta-slider'),
                            className: 'tab-style',
                        },
                        {
                            name: 'responsive',
                            title: __('Responsive', 'chesta-slider'),
                            className: 'tab-responsive',
                        },
                        {
                            name: 'advanced',
                            title: __('Advanced', 'chesta-slider'),
                            className: 'tab-advanced',
                        },
                    ]}
                >
                    {(tab) => {
                        switch (tab.name) {
                            case 'general':
                                return renderGeneralSettings();
                            case 'autoplay':
                                return renderAutoplaySettings();
                            case 'navigation':
                                return renderNavigationSettings();
                            case 'style':
                                return renderStyleSettings();
                            case 'responsive':
                                return renderResponsiveSettings();
                            case 'advanced':
                                return renderAdvancedSettings();
                            default:
                                return null;
                        }
                    }}
                </TabPanel>
            </InspectorControls>

            <div {...blockProps}>
                {previewMode && hasInnerBlocks ? (
                    <SliderPreview attributes={attributes} clientId={clientId} />
                ) : (
                    <div className="chesta-slider-editor-content">
                        <InnerBlocks
                            allowedBlocks={ALLOWED_BLOCKS}
                            template={template}
                            templateLock={false}
                            renderAppender={InnerBlocks.ButtonBlockAppender}
                        />
                        
                        {!hasInnerBlocks && (
                            <div className="chesta-slider-placeholder">
                                <div className="chesta-slider-placeholder-content">
                                    <h3>{__('Chesta Slider', 'chesta-slider')}</h3>
                                    <p>{__('Add slides to get started. Each slide can contain any content blocks.', 'chesta-slider')}</p>
                                </div>
                            </div>
                        )}
                    </div>
                )}
            </div>
        </>
    );
}

