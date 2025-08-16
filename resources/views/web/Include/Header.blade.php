<!-- header start -->
@php
    $Get_Product_Categories = Get_Product_Categories();
    $Get_Service_Categories = Get_Service_Categories();
    $firstSegment = Request::segment(1) ?? 'Home';
@endphp

<header class="header-style1 menu_area-light">

    <div class="navbar-default border-bottom border-color-light-white">

        <!-- start top search -->
        <div class="top-search bg-secondary">
            <div class="container-fluid px-sm-1-6 px-lg-2-9">
                <form class="search-form" action="search.html" method="GET" accept-charset="utf-8">
                    <div class="input-group">
                        <span class="input-group-addon cursor-pointer">
                            <button class="search-form_submit fas fa-search text-white" type="submit"></button>
                        </span>
                        <input type="text" class="search-form_input form-control" name="s" autocomplete="off" placeholder="Type & hit enter...">
                        <span class="input-group-addon close-search mt-1"><i class="fas fa-times"></i></span>
                    </div>
                </form>
            </div>
        </div>
        <!-- end top search -->

        <div class="container-fluid px-lg-1-6 px-xl-2-5 px-xxl-2-9">
            <div class="row align-items-center">
                <div class="col-12 col-lg-12">
                    <div class="menu_area alt-font">
                        <nav class="navbar navbar-expand-lg navbar-light p-0">
                            <div class="navbar-header navbar-header-custom">
                                <!-- start logo -->
                                <a href="index.php" class="navbar-brand"><img id="logo" src="{{ $settings['Site_Logo'] }}" alt="logo" /></a>
                                <!-- end logo -->
                            </div>

                            <div class="navbar-toggler bg-secondary"></div>

                            <!-- menu area -->
                            <ul class="navbar-nav align-items-lg-center ms-auto" id="nav" style="display: none;">
                                <li>
                                    <a href="#!">Company</a>
                                    <ul>
                                        <li><a href="about-us.php">About Us</a></li>
                                        <li><a href="career.php">Career</a></li>
                                        <li><a href="mission.php">Mission</a></li>
                                        <li><a href="vision.php">Vision</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Products</a>
                                    <ul>
                                        <li><a href="products.php">Security Systems</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Our Services11</a>
                                    <ul>
                                        <li><a href="#">Commercial CCTV Systems</a>
                                            <ul>
                                                <li><a href="cctv.php">Office</a></li>
                                                <li><a href="cctv.php">Industry</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="biometric-access-control.php">Biometric Systems</a></li>
                                    </ul>
                                </li>
                                <li><a href="projects.php">Projects</a></li>
                                <li><a href="blog.php">Blog</a></li>
                                <li><a href="our-clients.php">Clients</a></li>
                            </ul>
                            <!-- end menu area -->

                            <!-- start attribute navigation -->
                            <div class="attr-nav align-items-xl-center ms-xl-auto main-font">
                                <ul>
                                    <li class="search"><a href="#!"><i class="fas fa-search"></i></a></li>
                                    <li class="d-none d-xl-inline-block"><a href="contact-us.php" class="butn text-white md"><span>Get In Touch</span></a></li>
                                </ul>
                            </div>
                            <!-- end attribute navigation -->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end -->
