<!-- Sidebar Wrapper -->
@php
    $authUser = auth()->user();
    $roleId = $authUser->role_id;
    $permissions = [
        'roles' => $authUser->HasPermission('Roles', 'Is_Read'),
        'blogs' => $authUser->HasPermission('Blogs', 'Is_Read'),
        'users' => $authUser->HasPermission('Users', 'Is_Read'),
        'seo_pages' => $authUser->HasPermission('Seo_Pages', 'Is_Read'),
        'pages' => $authUser->HasPermission('Pages', 'Is_Read'),
        'sliders' => $authUser->HasPermission('Sliders', 'Is_Read'),
        'clients' => $authUser->HasPermission('Clients', 'Is_Read'),
        'reviews' => $authUser->HasPermission('Reviews', 'Is_Read'),
        'products' => $authUser->HasPermission('Products', 'Is_Read'),
        'services' => $authUser->HasPermission('Services', 'Is_Read'),
        'enquiries' => $authUser->HasPermission('Enquiries', 'Is_Read'),
        'settings' => $authUser->HasPermission('Settings', 'Is_Read'),
        'activities' => $authUser->HasPermission('Activities', 'Is_Read'),
        'testimonials' => $authUser->HasPermission('Testimonials', 'Is_Read'),
        'blog_categories' => $authUser->HasPermission('Blog_Categories', 'Is_Read'),
        'service_categories' => $authUser->HasPermission('Service_Categories', 'Is_Read'),
        'product_categories' => $authUser->HasPermission('Product_Categories', 'Is_Read'),
        'featured_services' => $authUser->HasPermission('Featured_Services', 'Is_Read'),
        'departments' => $authUser->HasPermission('Departments', 'Is_Read'),
        'specializations' => $authUser->HasPermission('Specializations', 'Is_Read'),
    ];
    $siteSetting = Get_Site_Setting();
    $logoUrl = getDynamicImage($siteSetting['Site_Logo'], 'Uploads/Settings');
@endphp

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ $logoUrl }}" class="logo-icon" alt="Site Logo" />
        </div>
        <div class="toggle-icon ms-auto">
            <i class="bx bx-arrow-back"></i>
        </div>
    </div>
    <!-- Navigation -->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><i class="bx bx-home-alt"></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        @if($permissions['users'])
            <li class="menu-label">Users</li>
            <li>
                <a href="{{ route('user.index') }}">
                    <div class="parent-icon"><i class="bx bx-user"></i></div>
                    <div class="menu-title">Users</div>
                </a>
            </li>
        @endif

        @if($permissions['featured_services'])
            <li class="menu-label">CMS</li>
            <li>
                <a href="{{ route('featured-services.index') }}">
                    <div class="parent-icon"><i class="bx bx-star"></i></div>
                    <div class="menu-title">Featured Services</div>
                </a>
            </li>
        @endif

        @if($permissions['seo_pages'])
            <li class="menu-label">SEO Pages</li>
            <li>
                <a href="{{ route('seo_page.index') }}">
                    <div class="parent-icon"><i class="bx bx-file"></i></div>
                    <div class="menu-title">SEO Pages</div>
                </a>
            </li>
        @endif

        @if($permissions['roles'])
            <li class="menu-label">Roles &amp; Permission</li>
            <li>
                <a href="{{ route('role.index') }}">
                    <div class="parent-icon"><i class="bx bx-hotel"></i></div>
                    <div class="menu-title">Roles</div>
                </a>
            </li>
        @endif

        @if($permissions['products'] || $permissions['product_categories'])
            <li class="menu-label">Product &amp; Category</li>
            @if($permissions['products'])
                <li>
                    <a href="{{ route('product.index') }}">
                        <div class="parent-icon"><i class="bx bx-basket"></i></div>
                        <div class="menu-title">Products</div>
                    </a>
                </li>
            @endif
            @if($permissions['product_categories'])
                <li>
                    <a href="{{ route('product_category.index') }}">
                        <div class="parent-icon"><i class="bx bx-category"></i></div>
                        <div class="menu-title">Product Category</div>
                    </a>
                </li>
            @endif
        @endif

        @if($permissions['services'] || $permissions['service_categories'])
            <li class="menu-label">Service &amp; Category</li>
            @if($permissions['services'])
                <li>
                    <a href="{{ route('service.index') }}">
                        <div class="parent-icon"><i class="bx bx-support"></i></div>
                        <div class="menu-title">Service</div>
                    </a>
                </li>
            @endif
            @if($permissions['service_categories'])
                <li>
                    <a href="{{ route('service_category.index') }}">
                        <div class="parent-icon"><i class="bx bx-category"></i></div>
                        <div class="menu-title">Service Category</div>
                    </a>
                </li>
            @endif
        @endif

        @if($permissions['blogs'] || $permissions['blog_categories'])
            <li class="menu-label">Blog &amp; Category</li>
            @if($permissions['blogs'])
                <li>
                    <a href="{{ route('blog.index') }}">
                        <div class="parent-icon"><i class="bx bx-news"></i></div>
                        <div class="menu-title">Blogs</div>
                    </a>
                </li>
            @endif
            @if($permissions['blog_categories'])
                <li>
                    <a href="{{ route('blog_category.index') }}">
                        <div class="parent-icon"><i class="bx bx-category"></i></div>
                        <div class="menu-title">Blog Category</div>
                    </a>
                </li>
            @endif
        @endif

        @if($permissions['departments'])
            <li>
                <a href="{{ route('departments.index') }}">
                    <div class="parent-icon"><i class="bx bx-building"></i></div>
                    <div class="menu-title">Departments</div>
                </a>
            </li>
        @endif

        @if($permissions['specializations'])
            <li>
                <a href="{{ route('specializations.index') }}">
                    <div class="parent-icon"><i class="bx bx-star"></i></div>
                    <div class="menu-title">Specializations</div>
                </a>
            </li>
        @endif

        @if($permissions['testimonials'])
            <li class="menu-label">Testimonial</li>
            <li>
                <a href="{{ route('testimonial.index') }}">
                    <div class="parent-icon"><i class="bx bx-group"></i></div>
                    <div class="menu-title">Testimonial</div>
                </a>
            </li>
        @endif

        @if($permissions['pages'])
            <li class="menu-label">Pages</li>
            <li>
                <a href="{{ route('page.index') }}">
                    <div class="parent-icon"><i class="bx bx-file"></i></div>
                    <div class="menu-title">Pages</div>
                </a>
            </li>
        @endif

        @if($permissions['clients'])
            <li class="menu-label">Clients</li>
            <li>
                <a href="{{ route('client.index') }}">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i></div>
                    <div class="menu-title">Clients</div>
                </a>
            </li>
        @endif

        @if($permissions['reviews'])
            <li class="menu-label">Reviews</li>
            <li>
                <a href="{{ route('review.index') }}">
                    <div class="parent-icon"><i class="bx bx-comment"></i></div>
                    <div class="menu-title">Reviews</div>
                </a>
            </li>
        @endif

        @if($permissions['sliders'])
            <li class="menu-label">Sliders</li>
            <li>
                <a href="{{ route('slider.index') }}">
                    <div class="parent-icon"><i class="bx bx-slider"></i></div>
                    <div class="menu-title">Sliders</div>
                </a>
            </li>
        @endif

        @if($permissions['enquiries'])
            <li class="menu-label">Enquiries</li>
            <li>
                <a href="{{ route('enquiry.index') }}">
                    <div class="parent-icon"><i class="bx bx-mail-send"></i></div>
                    <div class="menu-title">Enquiries</div>
                </a>
            </li>
        @endif

        @if($permissions['settings'])
            <li class="menu-label">Settings</li>
            <li>
                <a href="{{ route('setting.index') }}">
                    <div class="parent-icon"><i class="bx bx-wrench"></i></div>
                    <div class="menu-title">Settings</div>
                </a>
            </li>
        @endif
    </ul>
    <!-- End Navigation -->
</div>
<!-- End Sidebar Wrapper -->
