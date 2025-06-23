/**
 * WordPress dependencies
 */
import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

export default function Save({ attributes }) {
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

    // Prepare slider options for JavaScript
    const sliderOptions = {
        type: sliderType,
        slidesToShow: parseInt(slidesToShow),
        slidesToScroll: parseInt(slidesToScroll),
        autoplay: autoplay,
        autoplaySpeed: parseInt(autoplaySpeed),
        speed: parseInt(speed),
        infinite: infinite,
        arrows: arrows,
        dots: dots,
        fade: fade,
        vertical: vertical,
        centerMode: centerMode,
        variableWidth: variableWidth,
        lazyLoad: lazyLoad,
        pauseOnHover: pauseOnHover,
        pauseOnFocus: pauseOnFocus,
        accessibility: accessibility,
        swipe: swipe,
        draggable: draggable,
        rtl: rtl,
        responsive: responsive,
    };

    // Build CSS classes
    const cssClasses = [
        'chesta-slider-wrapper',
        `chesta-${sliderType}`,
    ];

    // Build inline styles
    const inlineStyles = {};
    
    if (sliderHeight) inlineStyles.height = sliderHeight;
    if (sliderWidth) inlineStyles.width = sliderWidth;
    if (backgroundColor) inlineStyles.backgroundColor = backgroundColor;
    if (textColor) inlineStyles.color = textColor;
    if (borderRadius) inlineStyles.borderRadius = borderRadius;
    if (boxShadow) inlineStyles.boxShadow = boxShadow;
    if (margin) inlineStyles.margin = margin;
    if (padding) inlineStyles.padding = padding;

    const blockProps = useBlockProps.save({
        className: cssClasses.join(' '),
        style: inlineStyles,
        'data-chesta-slider': true,
        'data-chesta-options': JSON.stringify(sliderOptions),
    });

    // Generate custom CSS for arrows and dots
    let customCSSOutput = '';
    if (arrowColor) {
        customCSSOutput += `.chesta-arrow { background-color: ${arrowColor} !important; }`;
    }
    if (dotColor) {
        customCSSOutput += `.chesta-dots li button { background-color: ${dotColor} !important; }`;
    }
    if (customCSS) {
        customCSSOutput += customCSS;
    }

    return (
        <>
            <div {...blockProps}>
                <InnerBlocks.Content />
            </div>
            
            {customCSSOutput && (
                <style dangerouslySetInnerHTML={{ __html: customCSSOutput }} />
            )}
        </>
    );
}

