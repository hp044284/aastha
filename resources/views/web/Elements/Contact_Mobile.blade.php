@php
    $getDynamicImageLogo = getDynamicImage($settings['Site_Logo'], 'Uploads/Settings');
@endphp
<div class="tp-sidebar-menu ">
    <button class="sidebar-close">
        <i class="fal fa-times"></i>
    </button>
    <div class="side-logo mb-20">
        <a href="{{ route('home.index') }}">
            <img src="{{ $getDynamicImageLogo }}" alt="logo">
        </a>
    </div>
    <div class="mobile-menu">
        <div class="sidebar-title">
            <h3>CONTACT US</h3>
        </div>
        <ul class="sidebar-list">
            @if(!empty($settings['Address']))
                <li>{!! $settings['Address'] !!}</li>
            @endif
            @if(!empty($settings['Support_Number']))
                <li>{{ $settings['Support_Number'] }}</li>
            @endif
            @if(!empty($settings['Support_Email']))
                <li>{{ $settings['Support_Email'] }}</li>
            @endif
        </ul>
        <div class="tp-sidebar-social">
            <a href="{{ $settings['Youtube_Link'] ?? 'https://www.youtube.com/'}}"><i class="fab fa-youtube"></i></a>
            <a href="{{ $settings['Twitter_Link'] ?? 'https://x.com/?lang=en&mx=2'}}"><i class="fab fa-twitter"></i></a>
            <a href="{{ $settings['Facebook_Link'] ?? 'https://www.facebook.com/'}}"><i class="fab fa-facebook-f"></i></a>
            <a href="{{ $settings['Linkedin_Link'] ?? 'https://www.linkedin.com/feed/'}}"><i class="fab fa-linkedin"></i></a>
            <a href="{{ $settings['Instagram_Link'] ?? 'https://www.instagram.com/'}}"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</div>