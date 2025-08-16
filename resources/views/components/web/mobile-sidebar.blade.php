<div class="mobile-sidebar" id="mobileSidebar">
    <!-- Mobile Sidebar Header -->
    <div class="mobile-sidebar-header">
        <div class="mobile-sidebar-logo">
            <img src="img/logos/logo.png" alt="Unisafe Securities Logo" />
        </div>
        <button class="mobile-sidebar-close" id="mobileSidebarClose">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Mobile Navigation -->
    <nav class="mobile-nav">
        <!-- Company -->
        <div class="mobile-nav-item mobile-nav-expandable">
            <a href="#" class="mobile-nav-link" onclick="toggleMobileSubmenu(event, 'company-submenu')">
                <i class="fas fa-building"></i>
                Company
            </a>
            <button class="mobile-nav-toggle" onclick="toggleMobileSubmenu(event, 'company-submenu')">
                <i class="fas fa-chevron-right"></i>
            </button>
            <div class="mobile-submenu" id="company-submenu">
                @foreach ($headerPages as $page)   
                    <a href="{{ route('web.page.index',['slug'=>$page->Slug]) }}" class="mobile-submenu-item">
                        <i class="fas fa-info-circle"></i>
                        {{ $page->Title }}
                    </a>
                @endforeach
                <a href="{{ route('web.contact.index') }}" class="mobile-submenu-item">
                    <i class="fas fa-phone"></i>
                    Contact Us
                </a>
            </div>
        </div>
        @if($product_categories->isNotEmpty())
        <!-- Products -->
        <div class="mobile-nav-item mobile-nav-expandable">
            <a href="#" class="mobile-nav-link" onclick="toggleMobileSubmenu(event, 'products-submenu')">
                <i class="fas fa-shield-alt"></i>
                Products
                <span class="nav-badge ms-auto">New</span>
            </a>
            <button class="mobile-nav-toggle" onclick="toggleMobileSubmenu(event, 'products-submenu')">
                <i class="fas fa-chevron-right"></i>
            </button>
            <div class="mobile-submenu" id="products-submenu">
                @foreach ($product_categories as $category)
                    <a href="{{ route('web.product.index',['slug'=>$category->Slug]) }}" class="mobile-submenu-item">
                        <i class="{{ $category->Icon ?? '' }}"></i>
                        {{ $category->Title }}
                    </a>
                @endforeach
            </div>
        </div>
        @endif
        @if($service_categories->isNotEmpty())
        <!-- Services -->
        <div class="mobile-nav-item mobile-nav-expandable">
            <a href="#" class="mobile-nav-link" onclick="toggleMobileSubmenu(event, 'services-submenu')">
                <i class="fas fa-cogs"></i>
                Services
            </a>
            <button class="mobile-nav-toggle" onclick="toggleMobileSubmenu(event, 'services-submenu')">
                <i class="fas fa-chevron-right"></i>
            </button>
            <div class="mobile-submenu" id="services-submenu">
                <!-- CCTV Solutions -->
                @foreach ($service_categories as $category)
                <div class="mobile-nav-expandable">
                    
                    <a href="cctv.php" class="mobile-submenu-item" onclick="toggleMobileSubmenu(event, 'cctv-sub-submenu')">
                        <i class="fas fa-video"></i>
                        {{ $category->Title }}
                    </a>
                    <button class="mobile-nav-toggle" onclick="toggleMobileSubmenu(event, 'cctv-sub-submenu')">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    @if(!empty($category->Children) && count($category->Children) > 0)
                    <div class="mobile-sub-submenu" id="cctv-sub-submenu">
                        @foreach ($category->Children as $subcategory)
                            <a href="{{ route('services.index',$subcategory->Slug) }}" class="mobile-sub-submenu-item">
                                <i class="{{ $subcategory->Icon ?? '' }}"></i>
                                {{ $subcategory->Title }}
                            </a>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Projects -->
        {{-- <div class="mobile-nav-item">
            <a href="projects.php" class="mobile-nav-link">
                <i class="fas fa-project-diagram"></i>
                Projects
            </a>
        </div> --}}

        <!-- Blog -->
        <div class="mobile-nav-item">
            <a href="{{ route('blogs.index') }}" class="mobile-nav-link">
                <i class="fas fa-blog"></i>
                Blogs
            </a>
        </div>

        <!-- Clients -->
        <div class="mobile-nav-item">
            <a href="{{ route('clients.index') }}" class="mobile-nav-link">
                <i class="fas fa-users"></i>
                Clients
            </a>
        </div>

        <!-- Get Quote -->
        <div class="mobile-nav-item">
            <a href="{{ route('web.enquiry.index') }}" class="mobile-nav-link">
                <i class="fas fa-calculator"></i>
                Get Quote
            </a>
        </div>
    </nav>

    <!-- Mobile Contact Info -->
    <div class="mobile-contact-info">
        <div class="mobile-contact-title">
            <i class="fas fa-address-book"></i>
            Contact Information
        </div>

        <div class="mobile-contact-item">
            <i class="fas fa-phone-alt"></i>
            <a href="tel:{{ $settings['Sales_Mobile_Number'] }}">{{ $settings['Sales_Mobile_Number'] }}</a>
        </div>

        <div class="mobile-contact-item">
            <i class="fab fa-whatsapp"></i>
            <a href="https://wa.me/{{ ltrim($settings['Sales_Mobile_Number'], '+') }}">{{ $settings['Sales_Mobile_Number'] }}</a>
        </div>

        <div class="mobile-contact-item">
            <i class="fas fa-envelope"></i>
            <a href="mailto:{{ $settings['Sales_Email'] }}">{{ $settings['Sales_Email'] }}</a>
        </div>

        <div class="mobile-contact-item">
            <i class="fas fa-map-marker-alt"></i>
            <span>{!! $settings['Address'] !!}</span>
        </div>
    </div>

    <!-- Mobile Social Links -->
    <div class="mobile-social-links">
        <div class="mobile-social-title">Follow Us</div>
        <div class="mobile-social-icons">
            <a href="{{ $settings['Facebook_Link'] ?? '' }}" alt="{{ $settings['Facebook_Link'] ?? '' }}" title="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="{{ $settings['Twitter_Link'] ?? '' }}" alt="{{ $settings['Twitter_Link'] ?? '' }}" title="Twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="{{ $settings['Linkedin_Link'] ?? '' }}" alt="{{ $settings['Linkedin_Link'] ?? '' }}" title="LinkedIn">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="{{ $settings['Instagram_Link'] ?? '' }}" alt="{{ $settings['Instagram_Link'] ?? '' }}" title="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
    </div>
</div>