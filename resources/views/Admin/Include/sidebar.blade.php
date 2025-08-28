<!-- Sidebar Wrapper -->
@php
    $authUser = auth()->user();
    $roleId = $authUser->role_id;
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

        <li class="menu-label">Users</li>
        <li>
            <a href="{{ route('user.index') }}">
                <div class="parent-icon"><i class="bx bx-user"></i></div>
                <div class="menu-title">Users</div>
            </a>
        </li>

        <li class="menu-label">Doctors</li>
        <li>
            <a href="{{ route('doctors.index') }}">
                <div class="parent-icon"><i class="bx bx-user"></i></div>
                <div class="menu-title">Doctors</div>
            </a>
        </li>

        <li class="menu-label">Service &amp; Category</li>
        <li>
            <a href="{{ route('services.index') }}">
                <div class="parent-icon"><i class="bx bx-support"></i></div>
                <div class="menu-title">Service</div>
            </a>
        </li>
        <li>
            <a href="{{ route('service_category.index') }}">
                <div class="parent-icon"><i class="bx bx-category"></i></div>
                <div class="menu-title">Service Category</div>
            </a>
        </li>

        <li class="menu-label">Blog &amp; Category</li>
        <li>
            <a href="{{ route('blog.index') }}">
                <div class="parent-icon"><i class="bx bx-news"></i></div>
                <div class="menu-title">Blogs</div>
            </a>
        </li>
        <li>
            <a href="{{ route('blog_category.index') }}">
                <div class="parent-icon"><i class="bx bx-category"></i></div>
                <div class="menu-title">Blog Category</div>
            </a>
        </li>

        <li>
            <a href="{{ route('departments.index') }}">
                <div class="parent-icon"><i class="bx bx-building"></i></div>
                <div class="menu-title">Departments</div>
            </a>
        </li>

        <li>
            <a href="{{ route('specializations.index') }}">
                <div class="parent-icon"><i class="bx bx-star"></i></div>
                <div class="menu-title">Specializations</div>
            </a>
        </li>

        <li class="menu-label">Testimonial</li>
        <li>
            <a href="{{ route('testimonials.index') }}">
                <div class="parent-icon"><i class="bx bx-group"></i></div>
                <div class="menu-title">Testimonial</div>
            </a>
        </li>

        <li class="menu-label">Pages</li>
        <li>
            <a href="{{ route('page.index') }}">
                <div class="parent-icon"><i class="bx bx-file"></i></div>
                <div class="menu-title">Pages</div>
            </a>
        </li>

        

        <li class="menu-label">Reviews</li>
        <li>
            <a href="{{ route('review.index') }}">
                <div class="parent-icon"><i class="bx bx-comment"></i></div>
                <div class="menu-title">Reviews</div>
            </a>
        </li>

        <li class="menu-label">Sliders</li>
        <li>
            <a href="{{ route('slider.index') }}">
                <div class="parent-icon"><i class="bx bx-slider"></i></div>
                <div class="menu-title">Sliders</div>
            </a>
        </li>

        <li class="menu-label">Enquiries</li>
        <li>
            <a href="{{ route('enquiry.index') }}">
                <div class="parent-icon"><i class="bx bx-mail-send"></i></div>
                <div class="menu-title">Enquiries</div>
            </a>
        </li>

        <li class="menu-label">Settings</li>
        <li>
            <a href="{{ route('setting.index') }}">
                <div class="parent-icon"><i class="bx bx-wrench"></i></div>
                <div class="menu-title">Settings</div>
            </a>
        </li>
    </ul>
    <!-- End Navigation -->
</div>
<!-- End Sidebar Wrapper -->
