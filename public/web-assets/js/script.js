    // Professional mobile menu and UI functionality using normal functions

    // Mobile Menu Toggle
    document.addEventListener('DOMContentLoaded', function() 
    {
        // Elements
        var mobileMenuToggle = document.getElementById('mobileMenuToggle');
        var mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        var mobileMenuContainer = document.getElementById('mobileMenuContainer');
        var mobileMenuClose = document.getElementById('mobileMenuClose');

        function setupDropdown(triggerId, menuId) {
            var trigger = document.getElementById(triggerId);
            var menu = document.getElementById(menuId);
            if (!trigger || !menu) return;

            var timeout;
            trigger.addEventListener('mouseenter', function() {
                clearTimeout(timeout);
                menu.classList.add('show');
            });
            trigger.addEventListener('mouseleave', function() {
                timeout = setTimeout(function() { menu.classList.remove('show'); }, 150);
            });
            menu.addEventListener('mouseenter', function() { clearTimeout(timeout); });
            menu.addEventListener('mouseleave', function() {
                timeout = setTimeout(function() { menu.classList.remove('show'); }, 150);
            });
        }

        function setupMegamenu(triggerId, menuId) {
            // Same as setupDropdown for now, can be extended for megamenu-specific logic
            setupDropdown(triggerId, menuId);
        }

        // Search functionality
        function initializeSearch() {
            var searchBtn = document.getElementById('searchBtn');
            var searchInput = document.getElementById('searchInput');
            var searchClose = document.getElementById('searchClose');
            var searchToggle = document.getElementById('searchToggle');
            var mobileSearchToggle = document.getElementById('mobileSearchToggle');
            var searchBarContainer = document.getElementById('searchBarContainer');

            function openSearch() {
                searchBarContainer.classList.add('show');
                setTimeout(function() { if (searchInput) searchInput.focus(); }, 300);
            }

            function closeSearch() {
                searchBarContainer.classList.remove('show');
            }

            if (searchToggle) searchToggle.addEventListener('click', openSearch);
            if (mobileSearchToggle) mobileSearchToggle.addEventListener('click', openSearch);
            if (searchClose) searchClose.addEventListener('click', closeSearch);

            if (searchBtn && searchInput) {
                searchBtn.addEventListener('click', function() {
                    var query = searchInput.value.trim();
                    if (query) {
                        // Replace with actual search logic
                        alert('Searching for: ' + query);
                    }
                });

                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') searchBtn.click();
                });
            }

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && searchBarContainer.classList.contains('show')) {
                    closeSearch();
                }
            });
        }

        // Dropdown functionality
        function initializeDropdowns() {
            var isDesktop = window.innerWidth >= 992;
            if (isDesktop) {
                setupDropdown('aboutDropdown', 'aboutDropdownMenu');
                setupMegamenu('servicesDropdown', 'servicesDropdownMenu');
                setupDropdown('patientDropdown', 'patientDropdownMenu');
            }
        }

        // Services hover effect
        function initializeServicesHover() {
            var categoryItems = document.querySelectorAll('.category-item');
            var subcategoryContents = document.querySelectorAll('.subcategory-content');

            categoryItems.forEach(function(item) {
                item.addEventListener('mouseenter', function () {
                    var category = this.getAttribute('data-category');
                    categoryItems.forEach(function(cat) { cat.classList.remove('active'); });
                    subcategoryContents.forEach(function(content) { content.classList.remove('active'); });
                    this.classList.add('active');
                    var targetContent = document.getElementById(category + '-content');
                    if (targetContent) targetContent.classList.add('active');
                });
            });
        }

        // Mobile screens functionality
        function initializeMobileScreens() {
            // About
            var mobileAboutToggle = document.getElementById('mobileAboutToggle');
            var mobileAboutScreen = document.getElementById('mobileAboutScreen');
            var mobileAboutBack = document.getElementById('mobileAboutBack');
            if (mobileAboutToggle) {
                mobileAboutToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (mobileAboutScreen) mobileAboutScreen.classList.add('show');
                });
            }
            if (mobileAboutBack) {
                mobileAboutBack.addEventListener('click', function() {
                    if (mobileAboutScreen) mobileAboutScreen.classList.remove('show');
                });
            }

            // Services
            var mobileServicesToggle = document.getElementById('mobileServicesToggle');
            var mobileServicesScreen = document.getElementById('mobileServicesScreen');
            var mobileServicesBack = document.getElementById('mobileServicesBack');
            if (mobileServicesToggle) {
                mobileServicesToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (mobileServicesScreen) mobileServicesScreen.classList.add('show');
                });
            }
            if (mobileServicesBack) {
                mobileServicesBack.addEventListener('click', function() {
                    if (mobileServicesScreen) mobileServicesScreen.classList.remove('show');
                });
            }

            // Patient
            var mobilePatientToggle = document.getElementById('mobilePatientToggle');
            var mobilePatientScreen = document.getElementById('mobilePatientScreen');
            var mobilePatientBack = document.getElementById('mobilePatientBack');
            if (mobilePatientToggle) {
                mobilePatientToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (mobilePatientScreen) mobilePatientScreen.classList.add('show');
                });
            }
            if (mobilePatientBack) {
                mobilePatientBack.addEventListener('click', function() {
                    if (mobilePatientScreen) mobilePatientScreen.classList.remove('show');
                });
            }

            // Mobile submenu accordion
            var mobileSubmenuHeaders = document.querySelectorAll('.mobile-submenu-header');
            mobileSubmenuHeaders.forEach(function(header) {
                header.addEventListener('click', function () {
                    var category = this.getAttribute('data-category');
                    var content = document.getElementById('mobile-' + category + '-content');
                    if (content) {
                        this.classList.toggle('active');
                        content.classList.toggle('show');
                        mobileSubmenuHeaders.forEach(function(otherHeader) {
                            if (otherHeader !== header) {
                                otherHeader.classList.remove('active');
                                var otherCategory = otherHeader.getAttribute('data-category');
                                var otherContent = document.getElementById('mobile-' + otherCategory + '-content');
                                if (otherContent) otherContent.classList.remove('show');
                            }
                        });
                    }
                });
            });
        }

        // Toggle mobile menu
        function toggleMobileMenu() {
            var isOpen = mobileMenuContainer.classList.contains('show');
            mobileMenuOverlay.classList.toggle('show', !isOpen);
            mobileMenuContainer.classList.toggle('show', !isOpen);
            document.body.style.overflow = isOpen ? '' : 'hidden';
        }

        // Event listeners
        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                toggleMobileMenu();
            });
        }

        if (mobileMenuClose) {
            mobileMenuClose.addEventListener('click', function(e) {
                e.preventDefault();
                mobileMenuOverlay.classList.remove('show');
                mobileMenuContainer.classList.remove('show');
                document.body.style.overflow = '';
            });
        }

        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', function() {
                mobileMenuOverlay.classList.remove('show');
                mobileMenuContainer.classList.remove('show');
                document.body.style.overflow = '';
            });
        }

        // Initialize UI features
        initializeSearch();
        initializeDropdowns();
        initializeServicesHover();
        initializeMobileScreens();
    });

    

    

    
    var totalItems = 13;
    // Slider functionality
    document.addEventListener('DOMContentLoaded', function() {
        var slides = document.querySelectorAll('.slide');
        var bullets = document.querySelectorAll('.bullet');
        var prevBtn = document.getElementById('prevBtn');
        var nextBtn = document.getElementById('nextBtn');
        var currentSlide = 0;
        var totalSlides = slides.length;
        var autoSlideInterval;

        function showSlide(index) {
            slides.forEach(function(slide) { slide.classList.remove('active'); });
            bullets.forEach(function(bullet) { bullet.classList.remove('active'); });
            if (slides[index]) {
                slides[index].classList.add('active');
            }
            if (bullets[index]) {
                bullets[index].classList.add('active');
            }
            currentSlide = index;
        }

        function nextSlide() { showSlide((currentSlide + 1) % totalSlides); }
        function prevSlide() { showSlide((currentSlide - 1 + totalSlides) % totalSlides); }

        function startAutoSlide() {
            autoSlideInterval = setInterval(nextSlide, 5000);
        }
        function stopAutoSlide() { clearInterval(autoSlideInterval); }

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                stopAutoSlide();
                nextSlide();
                startAutoSlide();
            });
        }
        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                stopAutoSlide();
                prevSlide();
                startAutoSlide();
            });
        }

        bullets.forEach(function(bullet, index) {
            bullet.addEventListener('click', function() {
                stopAutoSlide();
                showSlide(index);
                startAutoSlide();
            });
        });

        var sliderContainer = document.querySelector('.slider-container');
        if (sliderContainer) {
            sliderContainer.addEventListener('mouseenter', stopAutoSlide);
            sliderContainer.addEventListener('mouseleave', startAutoSlide);
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                stopAutoSlide();
                prevSlide();
                startAutoSlide();
            } else if (e.key === 'ArrowRight') {
                stopAutoSlide();
                nextSlide();
                startAutoSlide();
            }
        });

        // Touch/Swipe support
        var touchStartX = 0, touchEndX = 0;
        if (sliderContainer) {
            sliderContainer.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            });
            sliderContainer.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                var swipeThreshold = 50;
                var diff = touchStartX - touchEndX;
                if (Math.abs(diff) > swipeThreshold) {
                    stopAutoSlide();
                    if (diff > 0) nextSlide(); else prevSlide();
                    startAutoSlide();
                }
            });
        }

        // Service item click
        document.querySelectorAll('.service-flat-item').forEach(function(item) {
            item.addEventListener('click', function () {
                var title = this.querySelector('.service-flat-title') ? this.querySelector('.service-flat-title').textContent : undefined;
                // Add navigation logic here
            });
        });

        startAutoSlide();
    });

    // Footer Functionality
    document.addEventListener('DOMContentLoaded', function() {
        var backToTopBtn = document.getElementById('backToTop');
        function toggleBackToTop() {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        }
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        window.addEventListener('scroll', toggleBackToTop);
        if (backToTopBtn) backToTopBtn.addEventListener('click', scrollToTop);

        // Smooth scrolling for footer links
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                var target = document.querySelector(anchor.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        // Contact item hover
        document.querySelectorAll('.contact-item').forEach(function(item) {
            item.addEventListener('mouseenter', function () {
                this.querySelector('.contact-icon').style.transform = 'scale(1.1) rotate(5deg)';
            });
            item.addEventListener('mouseleave', function () {
                this.querySelector('.contact-icon').style.transform = 'scale(1) rotate(0deg)';
            });
        });

        // Footer button click
        document.querySelectorAll('.footer-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var btnText = btn.textContent.trim();
                // Navigation logic here
            });
        });

        // Animate footer widgets
        var observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.footer-widget').forEach(function(widget) {
            widget.style.opacity = '0';
            widget.style.transform = 'translateY(30px)';
            widget.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(widget);
        });
    });

    // Services Functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Navigation function
        window.navigateTo = function(url) {
            // Replace with actual navigation logic
            alert('Navigating to: ' + url);
        };

        // Slider class
        function Slider(sliderId, leftBtnId, rightBtnId) {
            this.slider = document.getElementById(sliderId);
            this.leftBtn = document.getElementById(leftBtnId);
            this.rightBtn = document.getElementById(rightBtnId);
            this.currentIndex = 0;
            this.itemsToShow = 4;
            this.totalItems = this.slider ? this.slider.children.length : 0;
            this.maxIndex = Math.max(0, this.totalItems - this.itemsToShow);

            var self = this;

            this.updateItemsToShow = function() {
                if (window.innerWidth <= 576) self.itemsToShow = 1;
                else if (window.innerWidth <= 768) self.itemsToShow = 2;
                else if (window.innerWidth <= 992) self.itemsToShow = 3;
                else self.itemsToShow = 4;
                self.maxIndex = Math.max(0, self.totalItems - self.itemsToShow);
            };

            this.bindEvents = function() {
                if (self.leftBtn) {
                    self.leftBtn.addEventListener('click', function() { self.prev(); });
                }
                if (self.rightBtn) {
                    self.rightBtn.addEventListener('click', function() { self.next(); });
                }
                window.addEventListener('resize', function() {
                    self.updateItemsToShow();
                    self.currentIndex = Math.min(self.currentIndex, self.maxIndex);
                    self.updateSlider();
                });
            };

            this.next = function() {
                self.currentIndex = self.currentIndex < self.maxIndex ? self.currentIndex + 1 : 0;
                self.updateSlider();
            };

            this.prev = function() {
                self.currentIndex = self.currentIndex > 0 ? self.currentIndex - 1 : self.maxIndex;
                self.updateSlider();
            };

            this.updateSlider = function() {
                var itemWidth = 100 / self.itemsToShow;
                var translateX = -self.currentIndex * itemWidth;
                if (self.slider) {
                    self.slider.style.transform = 'translateX(' + translateX + '%)';
                }
            };

            this.updateItemsToShow();
            this.bindEvents();
            this.updateSlider();
        }

        // Initialize sliders
        new Slider('servicesSlider', 'servicesLeft', 'servicesRight');
        new Slider('caseStudiesSlider', 'caseStudiesLeft', 'caseStudiesRight');
        new Slider('teamSlider', 'teamLeft', 'teamRight');

        // Statistics counter animation
        function animateCounter(element, target, duration) {
            if (duration === undefined) duration = 2500;
            var start = 0;
            var increment = target / (duration / 16);
            function updateCounter() {
                start += increment;
                if (start < target) {
                    element.textContent = Math.floor(start).toLocaleString();
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target.toLocaleString();
                }
            }
            updateCounter();
        }

        // Intersection Observer for statistics
        var statsObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var statNumbers = entry.target.querySelectorAll('.stat-number');
                    statNumbers.forEach(function(stat, index) {
                        var target = parseInt(stat.dataset.count);
                        setTimeout(function() { animateCounter(stat, target); }, index * 200);
                    });
                    statsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        var statsSection = document.querySelector('.statistics-section');
        if (statsSection) statsObserver.observe(statsSection);
    });

    // Testimonial functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Play testimonial
        window.playTestimonial = function(testimonialId) {
            // Replace with actual video/image modal logic
            alert('Playing testimonial: ' + testimonialId);
        };

        // Testimonial slider
        function TestimonialSlider() {
            this.slider = document.getElementById('testimonialsSlider');
            this.leftBtn = document.getElementById('testimonialsLeft');
            this.rightBtn = document.getElementById('testimonialsRight');
            this.currentIndex = 0;
            this.itemsToShow = 3;
            this.totalItems = this.slider ? this.slider.children.length : 0;
            this.maxIndex = Math.max(0, this.totalItems - this.itemsToShow);

            var self = this;

            this.updateItemsToShow = function() {
                var width = window.innerWidth;
                if (width <= 768) self.itemsToShow = 1;
                else if (width <= 1200) self.itemsToShow = 2;
                else self.itemsToShow = 3;
                self.maxIndex = Math.max(0, self.totalItems - self.itemsToShow);
                if (self.slider && self.slider.children) {
                    Array.prototype.forEach.call(self.slider.children, function(item) {
                        item.style.width = (100 / self.itemsToShow) + '%';
                    });
                }
            };

            this.bindEvents = function() {
                if (self.leftBtn) {
                    self.leftBtn.addEventListener('click', function() {
                        self.stopAutoPlay();
                        self.prev();
                        self.startAutoPlay();
                    });
                }
                if (self.rightBtn) {
                    self.rightBtn.addEventListener('click', function() {
                        self.stopAutoPlay();
                        self.next();
                        self.startAutoPlay();
                    });
                }
                window.addEventListener('resize', function() {
                    self.updateItemsToShow();
                    self.currentIndex = Math.min(self.currentIndex, self.maxIndex);
                    self.updateSlider();
                });
                if (self.slider) {
                    self.slider.addEventListener('mouseenter', function() { self.stopAutoPlay(); });
                    self.slider.addEventListener('mouseleave', function() { self.startAutoPlay(); });
                }
            };

            this.next = function() {
                self.currentIndex = self.currentIndex < self.maxIndex ? self.currentIndex + 1 : 0;
                self.updateSlider();
            };

            this.prev = function() {
                self.currentIndex = self.currentIndex > 0 ? self.currentIndex - 1 : self.maxIndex;
                self.updateSlider();
            };

            this.updateSlider = function() {
                var itemWidth = 100 / self.itemsToShow;
                var translateX = -self.currentIndex * itemWidth;
                if (self.slider) {
                    self.slider.style.transform = 'translateX(' + translateX + '%)';
                }
            };

            this.startAutoPlay = function() {
                self.autoPlayInterval = setInterval(function() { self.next(); }, 5000);
            };

            this.stopAutoPlay = function() {
                if (self.autoPlayInterval) clearInterval(self.autoPlayInterval);
            };

            this.updateItemsToShow();
            this.bindEvents();
            this.updateSlider();
            this.startAutoPlay();
        }

        var testimonialSlider = new TestimonialSlider();

        // Touch/Swipe support
        var touchStartX = 0, touchEndX = 0;
        if (testimonialSlider.slider) {
            testimonialSlider.slider.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            });
            testimonialSlider.slider.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                var swipeThreshold = 50;
                var diff = touchStartX - touchEndX;
                if (Math.abs(diff) > swipeThreshold) {
                    testimonialSlider.stopAutoPlay();
                    if (diff > 0) testimonialSlider.next(); else testimonialSlider.prev();
                    testimonialSlider.startAutoPlay();
                }
            });
        }

        // Animate stats on scroll
        var statsObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var statNumbers = entry.target.querySelectorAll('.stat-number');
                    statNumbers.forEach(function(stat, index) {
                        setTimeout(function() {
                            stat.style.transform = 'scale(1.1)';
                            setTimeout(function() {
                                stat.style.transform = 'scale(1)';
                            }, 200);
                        }, index * 100);
                    });
                    statsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        var testimonialStats = document.querySelector('.testimonial-stats');
        if (testimonialStats) statsObserver.observe(testimonialStats);
    });

    // Contact Us Section Functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Contact action
        window.contactAction = function(action) {
            switch (action) {
                case 'emergency':
                    if (confirm('Call Emergency Services?')) window.location.href = 'tel:+919876543210';
                    break;
                case 'appointment':
                    alert('Redirecting to appointment booking system...');
                    // window.location.href = '/book-appointment';
                    break;
                case 'call':
                    if (confirm('Call +91 98765-43210?')) window.location.href = 'tel:+919876543210';
                    break;
                case 'whatsapp':
                    window.open('https://wa.me/919876543210?text=Hello, I need assistance with healthcare services.', '_blank');
                    break;
                case 'email':
                    window.location.href = 'mailto:info@aasthamultispecialityhospital.in?subject=Healthcare Inquiry&body=Hello, I would like to inquire about your healthcare services.';
                    break;
                case 'visit':
                    window.open('https://maps.app.goo.gl/cciW7W3HNSpiUAms6', '_blank');
                    break;
                default:
                    alert('Contact method not available');
            }
        };

        // Button feedback and keyboard support
        var contactBtns = document.querySelectorAll('.contact-btn');
        contactBtns.forEach(function(btn) {
            btn.addEventListener('click', function () {
                this.style.transform = 'scale(0.98)';
                setTimeout(function() { btn.style.transform = ''; }, 150);
            });
            btn.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    btn.click();
                }
            });
        });

        // Intersection Observer for animations
        var observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Animate contact buttons
        contactBtns.forEach(function(btn, index) {
            btn.style.opacity = '0';
            btn.style.transform = 'translateY(20px)';
            btn.style.transition = 'all 0.6s ease ' + (index * 0.1) + 's';
            observer.observe(btn);
        });

        // Animate feature items
        var featureItems = document.querySelectorAll('.feature-item');
        featureItems.forEach(function(item, index) {
            item.style.opacity = '0';
            item.style.transform = 'translateX(-20px)';
            item.style.transition = 'all 0.6s ease ' + (index * 0.2) + 's';
            observer.observe(item);
        });

        // Error handling for contact methods
        window.addEventListener('error', function(e) {
            // Optionally handle contact errors
        });
    });

    // Contact Form Validation
    var contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var form = e.target;
            var requiredFields = form.querySelectorAll('[required]');
            var isValid = true;
            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                    field.classList.add('is-valid');
                }
            });
            if (isValid) {
                alert('Thank you for your enquiry! We will get back to you soon.');
                form.reset();
                requiredFields.forEach(function(field) {
                    field.classList.remove('is-valid', 'is-invalid');
                });
            } else {
                alert('Please fill in all required fields.');
            }
        });
    }

    // Real-time validation
    document.querySelectorAll('.form-control').forEach(function(input) {
        input.addEventListener('blur', function () {
            if (this.hasAttribute('required')) {
                if (!this.value.trim()) {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                } else {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            }
        });
    });

    // Mission Vision and Values Section Functionality
    // Smooth scroll to section
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            var target = document.querySelector(anchor.getAttribute('href'));
            if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    // Auto-close navbar on mobile after clicking a link
    document.querySelectorAll('.navbar-nav .nav-link').forEach(function(link) {
        link.addEventListener('click', function() {
            var navbarCollapse = document.getElementById('navbarNav');
            if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                var bsCollapse = new bootstrap.Collapse(navbarCollapse);
                bsCollapse.hide();
            }
        });
    });

    // News & media section functionality
    var currentlyShown = 10;
    

    function loadMoreNews() {
        var hiddenItems = document.querySelectorAll('.news-item.hidden');
        var itemsToShow = Math.min(5, hiddenItems.length);
        for (var i = 0; i < itemsToShow; i++) {
            hiddenItems[i].classList.remove('hidden');
            hiddenItems[i].classList.add('fade-in');
            (function(item) {
                setTimeout(function() {
                    item.classList.remove('fade-in');
                }, 600);
            })(hiddenItems[i]);
        }
        currentlyShown += itemsToShow;
        document.getElementById('currentCount').textContent = currentlyShown;
        if (currentlyShown >= totalItems) {
            document.getElementById('loadMoreSection').classList.add('d-none');
            document.getElementById('noMoreContent').classList.remove('d-none');
        }
        if (itemsToShow > 0) {
            setTimeout(function() {
                hiddenItems[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 300);
        }
    }

    // Smooth scroll for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            var target = document.querySelector(anchor.getAttribute('href'));
            if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    // Our Team Section Functionality
    // Add scroll animation for team cards
    var observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.team-card').forEach(function(card) {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
