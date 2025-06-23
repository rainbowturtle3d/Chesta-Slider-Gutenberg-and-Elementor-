/**
 * Chesta Slider Core - Vanilla JavaScript Slider Engine
 * No jQuery dependency, modern ES6+ features
 * 
 * @package ChestaSlider
 * @version 1.0.0
 */

class ChestaSliderCore {
    constructor(element, options = {}) {
        this.element = typeof element === 'string' ? document.querySelector(element) : element;
        
        if (!this.element) {
            console.error('Chesta Slider: Element not found');
            return;
        }

        // Default options
        this.defaults = {
            type: 'carousel',
            autoplay: false,
            autoplaySpeed: 3000,
            speed: 500,
            infinite: true,
            arrows: true,
            dots: true,
            fade: false,
            vertical: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [],
            lazyLoad: true,
            pauseOnHover: true,
            pauseOnFocus: true,
            accessibility: true,
            swipe: true,
            touchThreshold: 5,
            useCSS: true,
            useTransform: true,
            rtl: false,
            centerMode: false,
            variableWidth: false,
            rows: 1,
            slidesPerRow: 1,
            focusOnSelect: false,
            asNavFor: null,
            appendArrows: null,
            appendDots: null,
            prevArrow: '<button type="button" class="chesta-prev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="chesta-next" aria-label="Next"><i class="fas fa-chevron-right"></i></button>',
            customPaging: null,
            draggable: true,
            edgeFriction: 0.35,
            mobileFirst: false,
            pauseOnDotsHover: false,
            respondTo: 'window',
            waitForAnimate: true,
            zIndex: 1000
        };

        this.options = { ...this.defaults, ...options };
        this.currentSlide = 0;
        this.slideCount = 0;
        this.animating = false;
        this.autoplayTimer = null;
        this.touchStartX = 0;
        this.touchStartY = 0;
        this.touchEndX = 0;
        this.touchEndY = 0;
        this.isDragging = false;
        this.dragStartX = 0;
        this.dragDistance = 0;
        this.breakpoints = [];
        this.activeBreakpoint = null;
        this.originalSettings = { ...this.options };

        this.init();
    }

    init() {
        this.setupSlider();
        this.buildArrows();
        this.buildDots();
        this.setupResponsive();
        this.bindEvents();
        this.setupAccessibility();
        this.setupLazyLoading();
        
        if (this.options.autoplay) {
            this.autoPlay();
        }

        // Trigger initialized event
        this.triggerEvent('init', { slider: this });
    }

    setupSlider() {
        this.slides = this.element.querySelectorAll('.chesta-slide');
        this.slideCount = this.slides.length;

        if (this.slideCount === 0) {
            console.warn('Chesta Slider: No slides found');
            return;
        }

        // Create slider track
        this.track = document.createElement('div');
        this.track.className = 'chesta-track';
        
        // Move slides to track
        while (this.element.firstChild) {
            this.track.appendChild(this.element.firstChild);
        }
        
        this.element.appendChild(this.track);
        this.element.classList.add('chesta-slider', `chesta-${this.options.type}`);

        // Set initial slide positions
        this.setSlidePositions();
        this.goToSlide(0, false);
    }

    setSlidePositions() {
        const slideWidth = 100 / this.options.slidesToShow;
        
        this.slides.forEach((slide, index) => {
            slide.style.width = `${slideWidth}%`;
            slide.style.position = 'relative';
            slide.style.left = `${slideWidth * index}%`;
            slide.setAttribute('data-slide-index', index);
        });

        if (this.options.vertical) {
            this.track.style.height = `${this.slideCount * 100}%`;
        }
    }

    buildArrows() {
        if (!this.options.arrows || this.slideCount <= this.options.slidesToShow) {
            return;
        }

        const prevArrow = this.createArrowElement(this.options.prevArrow, 'prev');
        const nextArrow = this.createArrowElement(this.options.nextArrow, 'next');

        if (this.options.appendArrows) {
            const appendTarget = document.querySelector(this.options.appendArrows);
            if (appendTarget) {
                appendTarget.appendChild(prevArrow);
                appendTarget.appendChild(nextArrow);
            }
        } else {
            this.element.appendChild(prevArrow);
            this.element.appendChild(nextArrow);
        }

        this.prevArrow = prevArrow;
        this.nextArrow = nextArrow;
    }

    createArrowElement(html, direction) {
        const wrapper = document.createElement('div');
        wrapper.innerHTML = html;
        const arrow = wrapper.firstElementChild;
        
        arrow.classList.add('chesta-arrow', `chesta-${direction}`);
        arrow.addEventListener('click', (e) => {
            e.preventDefault();
            if (direction === 'prev') {
                this.slideHandler(this.currentSlide - this.options.slidesToScroll);
            } else {
                this.slideHandler(this.currentSlide + this.options.slidesToScroll);
            }
        });

        return arrow;
    }

    buildDots() {
        if (!this.options.dots || this.slideCount <= this.options.slidesToShow) {
            return;
        }

        const dotsContainer = document.createElement('ul');
        dotsContainer.className = 'chesta-dots';

        const dotCount = Math.ceil(this.slideCount / this.options.slidesToScroll);
        
        for (let i = 0; i < dotCount; i++) {
            const dot = document.createElement('li');
            const button = document.createElement('button');
            
            button.type = 'button';
            button.setAttribute('data-slide', i * this.options.slidesToScroll);
            button.textContent = i + 1;
            button.setAttribute('aria-label', `Go to slide ${i + 1}`);
            
            if (this.options.customPaging) {
                button.innerHTML = this.options.customPaging.call(this, this, i);
            }

            button.addEventListener('click', (e) => {
                e.preventDefault();
                this.slideHandler(parseInt(e.target.getAttribute('data-slide')));
            });

            dot.appendChild(button);
            dotsContainer.appendChild(dot);
        }

        if (this.options.appendDots) {
            const appendTarget = document.querySelector(this.options.appendDots);
            if (appendTarget) {
                appendTarget.appendChild(dotsContainer);
            }
        } else {
            this.element.appendChild(dotsContainer);
        }

        this.dots = dotsContainer;
        this.updateDots();
    }

    updateDots() {
        if (!this.dots) return;

        const dots = this.dots.querySelectorAll('li');
        dots.forEach((dot, index) => {
            const button = dot.querySelector('button');
            const slideIndex = parseInt(button.getAttribute('data-slide'));
            
            if (slideIndex === this.currentSlide) {
                dot.classList.add('chesta-active');
                button.setAttribute('aria-selected', 'true');
            } else {
                dot.classList.remove('chesta-active');
                button.setAttribute('aria-selected', 'false');
            }
        });
    }

    bindEvents() {
        // Window resize
        window.addEventListener('resize', this.debounce(() => {
            this.checkResponsive();
            this.setSlidePositions();
        }, 250));

        // Touch events
        if (this.options.swipe) {
            this.track.addEventListener('touchstart', this.handleTouchStart.bind(this), { passive: false });
            this.track.addEventListener('touchmove', this.handleTouchMove.bind(this), { passive: false });
            this.track.addEventListener('touchend', this.handleTouchEnd.bind(this), { passive: false });
        }

        // Mouse events for dragging
        if (this.options.draggable) {
            this.track.addEventListener('mousedown', this.handleMouseDown.bind(this));
            document.addEventListener('mousemove', this.handleMouseMove.bind(this));
            document.addEventListener('mouseup', this.handleMouseUp.bind(this));
        }

        // Keyboard navigation
        if (this.options.accessibility) {
            this.element.addEventListener('keydown', this.handleKeyDown.bind(this));
        }

        // Pause on hover
        if (this.options.pauseOnHover && this.options.autoplay) {
            this.element.addEventListener('mouseenter', () => this.pause());
            this.element.addEventListener('mouseleave', () => this.autoPlay());
        }

        // Focus events
        if (this.options.pauseOnFocus && this.options.autoplay) {
            this.element.addEventListener('focusin', () => this.pause());
            this.element.addEventListener('focusout', () => this.autoPlay());
        }
    }

    handleTouchStart(e) {
        this.touchStartX = e.touches[0].clientX;
        this.touchStartY = e.touches[0].clientY;
        this.pause();
    }

    handleTouchMove(e) {
        if (!this.touchStartX) return;

        this.touchEndX = e.touches[0].clientX;
        this.touchEndY = e.touches[0].clientY;

        const deltaX = this.touchStartX - this.touchEndX;
        const deltaY = this.touchStartY - this.touchEndY;

        if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > this.options.touchThreshold) {
            e.preventDefault();
        }
    }

    handleTouchEnd(e) {
        if (!this.touchStartX || !this.touchEndX) return;

        const deltaX = this.touchStartX - this.touchEndX;
        const deltaY = this.touchStartY - this.touchEndY;

        if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > this.options.touchThreshold) {
            if (deltaX > 0) {
                this.slideHandler(this.currentSlide + this.options.slidesToScroll);
            } else {
                this.slideHandler(this.currentSlide - this.options.slidesToScroll);
            }
        }

        this.touchStartX = 0;
        this.touchEndX = 0;
        this.touchStartY = 0;
        this.touchEndY = 0;

        if (this.options.autoplay) {
            this.autoPlay();
        }
    }

    handleMouseDown(e) {
        if (!this.options.draggable) return;
        
        e.preventDefault();
        this.isDragging = true;
        this.dragStartX = e.clientX;
        this.element.style.cursor = 'grabbing';
        this.pause();
    }

    handleMouseMove(e) {
        if (!this.isDragging) return;
        
        e.preventDefault();
        this.dragDistance = e.clientX - this.dragStartX;
    }

    handleMouseUp(e) {
        if (!this.isDragging) return;
        
        this.isDragging = false;
        this.element.style.cursor = '';

        if (Math.abs(this.dragDistance) > this.options.touchThreshold) {
            if (this.dragDistance < 0) {
                this.slideHandler(this.currentSlide + this.options.slidesToScroll);
            } else {
                this.slideHandler(this.currentSlide - this.options.slidesToScroll);
            }
        }

        this.dragDistance = 0;
        
        if (this.options.autoplay) {
            this.autoPlay();
        }
    }

    handleKeyDown(e) {
        switch (e.key) {
            case 'ArrowLeft':
                e.preventDefault();
                this.slideHandler(this.currentSlide - this.options.slidesToScroll);
                break;
            case 'ArrowRight':
                e.preventDefault();
                this.slideHandler(this.currentSlide + this.options.slidesToScroll);
                break;
            case 'ArrowUp':
                if (this.options.vertical) {
                    e.preventDefault();
                    this.slideHandler(this.currentSlide - this.options.slidesToScroll);
                }
                break;
            case 'ArrowDown':
                if (this.options.vertical) {
                    e.preventDefault();
                    this.slideHandler(this.currentSlide + this.options.slidesToScroll);
                }
                break;
        }
    }

    slideHandler(index, dontAnimate = false) {
        if (this.animating && this.options.waitForAnimate) {
            return;
        }

        let targetSlide = index;

        // Handle infinite loop
        if (this.options.infinite) {
            if (targetSlide < 0) {
                targetSlide = this.slideCount - this.options.slidesToShow;
            } else if (targetSlide >= this.slideCount) {
                targetSlide = 0;
            }
        } else {
            targetSlide = Math.max(0, Math.min(targetSlide, this.slideCount - this.options.slidesToShow));
        }

        if (targetSlide === this.currentSlide && !dontAnimate) {
            return;
        }

        this.goToSlide(targetSlide, !dontAnimate);
    }

    goToSlide(slideIndex, animate = true) {
        if (this.animating && animate) {
            return;
        }

        const previousSlide = this.currentSlide;
        this.currentSlide = slideIndex;

        if (animate) {
            this.animating = true;
        }

        // Calculate transform
        let transformValue;
        if (this.options.vertical) {
            transformValue = `translateY(-${slideIndex * (100 / this.options.slidesToShow)}%)`;
        } else {
            transformValue = `translateX(-${slideIndex * (100 / this.options.slidesToShow)}%)`;
        }

        // Apply transform
        if (this.options.useCSS && this.options.useTransform) {
            this.track.style.transform = transformValue;
            this.track.style.transition = animate ? `transform ${this.options.speed}ms ease` : 'none';
        }

        // Update active states
        this.updateSlideStates();
        this.updateDots();
        this.updateArrows();

        // Handle animation end
        if (animate) {
            setTimeout(() => {
                this.animating = false;
                this.triggerEvent('afterChange', { 
                    slider: this, 
                    currentSlide: this.currentSlide,
                    previousSlide: previousSlide
                });
            }, this.options.speed);

            this.triggerEvent('beforeChange', { 
                slider: this, 
                currentSlide: this.currentSlide,
                nextSlide: slideIndex
            });
        }

        // Lazy load images
        if (this.options.lazyLoad) {
            this.lazyLoadSlide(slideIndex);
        }
    }

    updateSlideStates() {
        this.slides.forEach((slide, index) => {
            slide.classList.remove('chesta-active', 'chesta-current');
            slide.setAttribute('aria-hidden', 'true');
            slide.setAttribute('tabindex', '-1');

            if (index >= this.currentSlide && index < this.currentSlide + this.options.slidesToShow) {
                slide.classList.add('chesta-active');
                slide.setAttribute('aria-hidden', 'false');
                slide.setAttribute('tabindex', '0');

                if (index === this.currentSlide) {
                    slide.classList.add('chesta-current');
                }
            }
        });
    }

    updateArrows() {
        if (!this.options.arrows) return;

        if (this.prevArrow) {
            this.prevArrow.classList.toggle('chesta-disabled', 
                !this.options.infinite && this.currentSlide === 0);
        }

        if (this.nextArrow) {
            this.nextArrow.classList.toggle('chesta-disabled', 
                !this.options.infinite && this.currentSlide >= this.slideCount - this.options.slidesToShow);
        }
    }

    autoPlay() {
        if (!this.options.autoplay || this.slideCount <= this.options.slidesToShow) {
            return;
        }

        this.pause();
        this.autoplayTimer = setInterval(() => {
            this.slideHandler(this.currentSlide + this.options.slidesToScroll);
        }, this.options.autoplaySpeed);
    }

    pause() {
        if (this.autoplayTimer) {
            clearInterval(this.autoplayTimer);
            this.autoplayTimer = null;
        }
    }

    setupAccessibility() {
        if (!this.options.accessibility) return;

        this.element.setAttribute('role', 'region');
        this.element.setAttribute('aria-label', 'Image slider');
        this.element.setAttribute('tabindex', '0');

        this.track.setAttribute('role', 'listbox');

        this.slides.forEach((slide, index) => {
            slide.setAttribute('role', 'option');
            slide.setAttribute('aria-label', `${index + 1} of ${this.slideCount}`);
        });
    }

    setupLazyLoading() {
        if (!this.options.lazyLoad) return;

        this.slides.forEach((slide) => {
            const images = slide.querySelectorAll('img[data-lazy]');
            images.forEach((img) => {
                img.style.opacity = '0';
            });
        });

        // Load initial slides
        this.lazyLoadSlide(this.currentSlide);
    }

    lazyLoadSlide(slideIndex) {
        if (!this.options.lazyLoad) return;

        const loadRange = 1; // Load current + 1 slide ahead/behind
        const startIndex = Math.max(0, slideIndex - loadRange);
        const endIndex = Math.min(this.slideCount - 1, slideIndex + this.options.slidesToShow + loadRange);

        for (let i = startIndex; i <= endIndex; i++) {
            const slide = this.slides[i];
            if (!slide) continue;

            const images = slide.querySelectorAll('img[data-lazy]');
            images.forEach((img) => {
                if (!img.getAttribute('data-loaded')) {
                    const src = img.getAttribute('data-lazy');
                    if (src) {
                        img.onload = () => {
                            img.style.opacity = '1';
                            img.style.transition = 'opacity 0.3s ease';
                        };
                        img.src = src;
                        img.removeAttribute('data-lazy');
                        img.setAttribute('data-loaded', 'true');
                    }
                }
            });
        }
    }

    setupResponsive() {
        if (!this.options.responsive || this.options.responsive.length === 0) {
            return;
        }

        // Sort breakpoints
        this.breakpoints = this.options.responsive.sort((a, b) => b.breakpoint - a.breakpoint);
        this.checkResponsive();
    }

    checkResponsive() {
        if (!this.breakpoints.length) return;

        const windowWidth = window.innerWidth;
        let targetBreakpoint = null;

        for (const breakpoint of this.breakpoints) {
            if (windowWidth <= breakpoint.breakpoint) {
                targetBreakpoint = breakpoint;
            }
        }

        if (targetBreakpoint !== this.activeBreakpoint) {
            this.activeBreakpoint = targetBreakpoint;
            
            if (targetBreakpoint) {
                this.options = { ...this.originalSettings, ...targetBreakpoint.settings };
            } else {
                this.options = { ...this.originalSettings };
            }

            this.refresh();
        }
    }

    refresh() {
        this.setSlidePositions();
        this.updateSlideStates();
        this.updateDots();
        this.updateArrows();
        
        if (this.options.autoplay) {
            this.autoPlay();
        } else {
            this.pause();
        }
    }

    // Public API methods
    slickNext() {
        this.slideHandler(this.currentSlide + this.options.slidesToScroll);
    }

    slickPrev() {
        this.slideHandler(this.currentSlide - this.options.slidesToScroll);
    }

    slickGoTo(slideIndex, dontAnimate = false) {
        this.slideHandler(slideIndex, dontAnimate);
    }

    slickPlay() {
        this.options.autoplay = true;
        this.autoPlay();
    }

    slickPause() {
        this.options.autoplay = false;
        this.pause();
    }

    slickCurrentSlide() {
        return this.currentSlide;
    }

    slickSlideCount() {
        return this.slideCount;
    }

    destroy() {
        this.pause();
        
        // Remove event listeners
        window.removeEventListener('resize', this.checkResponsive);
        
        // Remove elements
        if (this.prevArrow) this.prevArrow.remove();
        if (this.nextArrow) this.nextArrow.remove();
        if (this.dots) this.dots.remove();
        
        // Reset styles
        this.slides.forEach((slide) => {
            slide.style.cssText = '';
            slide.classList.remove('chesta-active', 'chesta-current');
        });
        
        this.track.style.cssText = '';
        this.element.classList.remove('chesta-slider', `chesta-${this.options.type}`);
        
        this.triggerEvent('destroy', { slider: this });
    }

    // Utility methods
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    triggerEvent(eventName, data) {
        const event = new CustomEvent(`chesta:${eventName}`, {
            detail: data,
            bubbles: true
        });
        this.element.dispatchEvent(event);
    }
}

// Auto-initialize sliders with data attributes
document.addEventListener('DOMContentLoaded', () => {
    const sliders = document.querySelectorAll('[data-chesta-slider]');
    sliders.forEach((slider) => {
        const options = slider.getAttribute('data-chesta-options');
        const config = options ? JSON.parse(options) : {};
        new ChestaSliderCore(slider, config);
    });
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ChestaSliderCore;
}

// Global assignment
window.ChestaSliderCore = ChestaSliderCore;

