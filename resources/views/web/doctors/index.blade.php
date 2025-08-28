<x-web.layout>

<!-- Hero Section -->
    <section id="home" class="bg-gray py-5">
        <div class="container-fluid px-4">
            <!-- Page Title and Description -->
            <div class="row">
                <div class="col-lg-9">
                    <h1 class="display-4 fw-bold mb-3 fs-2 text-primary">Our Doctors</h1>
                    <p class="lead text-muted mb-4">Find and connect with our experienced medical professionals across various specializations.</p>
                </div>
                <div class="col-lg-3 text-lg-end text-md-start mt-4 mb-lg-0">
                    <a href="book-an-appointment" class="view-all-btn">
                        <i class="fas fa-calendar-days"></i> Book An Appointment
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container-fluid">
            <div class="row">
                <!-- Desktop Sidebar - Filters -->
                <div class="col-lg-3 col-md-4">
                    <div class="sidebar">
                        <h4 class="filter-title">
                            <i class="bi bi-funnel me-2"></i>Find Doctors
                        </h4>

                        <!-- Search Bar -->
                        <div class="filter-group">
                            <label class="filter-label">Search by Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control search-input" id="doctorSearchInput" placeholder="Enter doctor name...">
                                <button class="btn btn-primary search-btn" type="button" onclick="performDoctorSearch()">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        
                        @if(!empty($positions))
                            <!-- Department Filter -->
                            <div class="filter-group">
                                <label class="filter-label">Department</label>
                                @foreach($positions as $id => $title)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $id }}" id="position-{{ $id }}">
                                        <label class="form-check-label" for="position-{{ $id }}">{{ $title }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Experience Filter -->
                        <div class="filter-group">
                            <label class="filter-label">Experience</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="5-10" id="exp5-10">
                                <label class="form-check-label" for="exp5-10">5-10 Years</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="10-15" id="exp10-15">
                                <label class="form-check-label" for="exp10-15">10-15 Years</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="15+" id="exp15plus">
                                <label class="form-check-label" for="exp15plus">15+ Years</label>
                            </div>
                        </div>

                        <!-- Clear Filters -->
                        <button class="btn btn-outline-primary w-100" id="resetDoctorFiltersBtn">
                            <i class="bi bi-arrow-clockwise me-2"></i>Clear Filters
                        </button>
                    </div>
                </div>

                <!-- Right Content - Doctor Listings -->
                <div class="col-lg-9 col-md-8">
                    <!-- Mobile Filter Header -->
                    <div class="mobile-filter-header d-lg-none">
                        <h4 class="mobile-filter-title">Find Doctors</h4>
                        <button class="btn mobile-filter-btn" id="mobileFilterToggle">
                            <i class="bi bi-funnel me-2"></i>Filters
                            <i class="bi bi-chevron-down ms-2" id="filterIcon"></i>
                        </button>
                    </div>

                    <!-- Mobile Filter Dropdown -->
                    <div class="mobile-filter-dropdown d-lg-none" id="mobileFilterDropdown">
                        <!-- Search Bar -->
                        <div class="filter-group">
                            <label class="filter-label">Search by Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control search-input" id="mobileSearchInput" placeholder="Enter doctor name...">
                                <button class="btn btn-primary search-btn" type="button" onclick="performMobileSearch()">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        @if(!empty($positions))
                            <!-- Department Filter -->
                            <div class="filter-group">
                                <label class="filter-label">Department</label>
                                @foreach($positions as $id => $title)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $id }}" id="mobile-department-{{ $id }}">
                                        <label class="form-check-label" for="mobile-department-{{ $id }}">{{ $title }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Experience Filter -->
                        <div class="filter-group">
                            <label class="filter-label">Experience</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="5-10" id="mobile-exp5-10">
                                <label class="form-check-label" for="mobile-exp5-10">5-10 Years</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="10-15" id="mobile-exp10-15">
                                <label class="form-check-label" for="mobile-exp10-15">10-15 Years</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="15+" id="mobile-exp15plus">
                                <label class="form-check-label" for="mobile-exp15plus">15+ Years</label>
                            </div>
                        </div>

                        <!-- Clear Filters -->
                        <button class="btn btn-outline-primary w-100" onclick="resetMobileFilters()">
                            <i class="bi bi-arrow-clockwise me-2"></i>Clear Filters
                        </button>
                    </div>

                    <div class="results-counter" id="resultsCounter">
                        Showing <span id="currentCount">{{ $doctors->count() }}</span> of <span id="totalCount">{{ $doctors->total() }}</span> doctors
                    </div>

                    <div class="pt-3" id="doctorsContainer">
                        @include('web.doctors.partials._list', ['doctors' => $doctors])
                    </div>
                    <!-- Load More Section -->
                    @if ($doctors->hasMorePages())
                        <div class="text-center mt-4" id="loadMoreSection">
                            @if($doctors->hasMorePages())
                                <button class="btn load-more-btn" id="loadMoreBtn" data-page="2">
                                    <i class="bi bi-plus-circle me-2"></i>Load More Doctors
                                </button>
                            @endif
                            <p class="text-muted mt-3 mb-0">
                                <span id="currentCountBottom">{{ $doctors->count() }}</span> of 
                                <span id="totalCountBottom">{{ $doctors->total() }}</span> doctors shown
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@push('css')
<style>
    
/* Our Doctors Section */

        /* Custom Bootstrap Color Overrides */
        .btn-primary {
            background-color: var(--primary-brown);
            border-color: var(--primary-brown);
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--dark-brown);
            border-color: var(--dark-brown);
        }
        .btn-outline-primary {
            color: var(--primary-brown);
            border-color: var(--primary-brown);
        }
        .btn-outline-primary:hover {
            background-color: var(--primary-brown);
            border-color: var(--primary-brown);
        }
        .text-primary {
            color: var(--primary-brown) !important;
        }
        .bg-primary {
            background-color: var(--primary-brown) !important;
        }

        /* Progressive Breadcrumb styling */
        .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 25px;
            padding: 0.75rem 1.5rem;
            margin-bottom: 0;
            backdrop-filter: blur(10px);
        }
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            color: rgba(255, 255, 255, 0.7);
            font-weight: bold;
            margin: 0 0.5rem;
        }
        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            transition: all 0.3s ease;
        }
        .breadcrumb-item a:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .breadcrumb-item.active {
            color: white;
            font-weight: 600;
            background-color: rgba(255, 255, 255, 0.15);
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
        }

        /* Sidebar Styling */
        .sidebar {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            height: fit-content;
        }

        /* Desktop sidebar */
        @media (min-width: 992px) {
            .sidebar {
                position: sticky;
                top: 20px;
            }
        }

        /* Mobile Filter Header */
        .mobile-filter-header {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .mobile-filter-title {
            color: var(--primary-brown);
            font-weight: 700;
            font-size: 1.2rem;
            margin: 0;
        }

        .mobile-filter-btn {
            background-color: var(--primary-brown);
            border-color: var(--primary-brown);
            color: white;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .mobile-filter-btn:hover {
            background-color: var(--dark-brown);
            border-color: var(--dark-brown);
            color: white;
        }

        .mobile-filter-btn:focus {
            background-color: var(--dark-brown);
            border-color: var(--dark-brown);
            color: white;
            box-shadow: none;
        }

        /* Mobile Filter Dropdown */
        .mobile-filter-dropdown {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 0;
            margin-bottom: 1rem;
            overflow: hidden;
            max-height: 0;
            opacity: 0;
            transition: all 0.4s ease;
        }

        .mobile-filter-dropdown.show {
            max-height: 800px;
            opacity: 1;
            padding: 1.5rem;
        }

        /* Hide mobile filter on desktop */
        @media (min-width: 992px) {
            .mobile-filter-header,
            .mobile-filter-dropdown {
                display: none !important;
            }
        }

        /* Show only on mobile */
        @media (max-width: 991px) {
            .sidebar {
                display: none !important;
            }
        }

        .filter-title {
            color: var(--primary-brown);
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            border-bottom: 2px solid var(--accent-orange);
            padding-bottom: 0.5rem;
        }

        .filter-group {
            margin-bottom: 1.5rem;
        }

        .filter-label {
            color: var(--dark-brown);
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.75rem;
            display: block;
        }

        .form-check-input:checked {
            background-color: var(--primary-brown);
            border-color: var(--primary-brown);
        }

        .form-check-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Doctor Card Styling */
        .doctor-card {
            background: white;
            border: 1px solid #e0e0e0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-radius: 15px;
            transition: all 0.3s ease;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .doctor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(139, 69, 19, 0.15);
            border-color: var(--accent-orange);
        }

        /* Mobile responsive doctor card */
        @media (max-width: 767px) {
            .mobile-doctor-layout {
                display: flex;
                flex-direction: column;
            }
            
            .mobile-doctor-top {
                display: flex;
                align-items: flex-start;
                margin-bottom: 1rem;
            }
            
            .mobile-doctor-image {
                flex-shrink: 0;
                margin-right: 1rem;
            }
            
            .mobile-doctor-info {
                flex: 1;
            }
            
            .mobile-doctor-buttons {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .mobile-doctor-buttons .btn {
                width: 100%;
            }
        }

        .doctor-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 12px;
        }

        /* Mobile doctor image */
        @media (max-width: 767px) {
            .doctor-image {
                width: 80px;
                height: 80px;
            }
        }

        .doctor-name {
            color: var(--primary-brown);
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 0.25rem;
        }

        @media (max-width: 767px) {
            .doctor-name {
                font-size: 1.1rem;
            }
        }

        .doctor-department {
            color: var(--accent-orange);
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 767px) {
            .doctor-department {
                font-size: 0.9rem;
            }
        }

        .doctor-qualification {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 767px) {
            .doctor-qualification {
                font-size: 0.8rem;
            }
        }

        .doctor-hospital {
            color: var(--dark-brown);
            font-size: 0.85rem;
            font-weight: 500;
        }

        @media (max-width: 767px) {
            .doctor-hospital {
                font-size: 0.75rem;
            }
        }

        .btn-view-profile {
            background-color: var(--accent-orange);
            border-color: var(--accent-orange);
            color: white;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .btn-view-profile:hover {
            background-color: var(--primary-brown);
            border-color: var(--primary-brown);
            color: white;
        }

        .btn-book-appointment {
            background-color: var(--primary-brown);
            border-color: var(--primary-brown);
            color: white;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .btn-book-appointment:hover {
            background-color: var(--dark-brown);
            border-color: var(--dark-brown);
            color: white;
        }

        /* Load More Button */
        .load-more-btn {
            background: linear-gradient(135deg, var(--primary-brown), var(--accent-orange));
            border: none;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .load-more-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
            color: white;
        }

        /* Hidden doctors */
        .doctor-item.hidden {
            display: none !important;
        }

        /* Animation for new items */
        .doctor-item.fade-in {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@push('js')
    <script>

        function showNoDoctorsAlert() {
            // Remove any existing alert
            let existing = document.getElementById('noDoctorsAlert');
            if (existing) existing.remove();

            // Create the alert div
            let alertDiv = document.createElement('div');
            alertDiv.id = 'noDoctorsAlert';
            alertDiv.className = 'alert alert-warning text-center';
            alertDiv.style.opacity = 1;
            alertDiv.style.transition = "opacity 0.5s";
            alertDiv.innerText = 'No doctors found.';

            // Insert at top of doctorsContainer or body as fallback
            let container = document.getElementById('doctorsContainer');
            if (container && container.parentNode) {
                container.parentNode.insertBefore(alertDiv, container);
            } else {
                document.body.appendChild(alertDiv);
            }

            // Fade out after 2 seconds
            setTimeout(function() {
                alertDiv.style.opacity = 0;
                setTimeout(function() {
                    if (alertDiv && alertDiv.parentNode) {
                        alertDiv.parentNode.removeChild(alertDiv);
                    }
                }, 500);
            }, 2000);
        }

        let isLoadingDoctors = false;
        function getDoctorFilters(page = 1, append = false) {
            // Collect search and filter values
            let name = document.getElementById('doctorSearchInput') ? document.getElementById('doctorSearchInput').value : '';
            let positions = [];
            document.querySelectorAll('.sidebar input[type="checkbox"][id^="position-"]:checked').forEach(function(cb) {
                positions.push(cb.value);
            });
            let experiences = [];
            document.querySelectorAll('.sidebar input[type="checkbox"][id^="exp"]:checked').forEach(function(cb) {
                experiences.push(cb.value);
            });

            // Build query string
            let params = new URLSearchParams();
            if (name) params.append('search', name);
            if (positions.length) params.append('positions', positions.join(','));
            if (experiences.length) params.append('experiences', experiences.join(','));
            params.append('page', page);

            // AJAX request
            fetch("{{ route('web.doctors.index') }}?" + params.toString(), {
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(response => response.text())
            .then(data => {
                let container = document.getElementById("doctorsContainer");
                if (container) {
                    if (append) {
                        // Append new doctors
                        container.insertAdjacentHTML("beforeend", data);
                    } else {
                        // Replace all doctors (for filter/search)
                        container.innerHTML = data;
                    }
                }
                // Optionally update pagination controls here if you have them
                // Update current count if available
                let currentCount = document.querySelectorAll("#doctorsContainer .doctor-item").length;
                console.log(currentCount , ' currentCount');
                if (currentCount === 0) {
                    showNoDoctorsAlert();
                }


                let currentCountBottom = document.getElementById("currentCountBottom");
                if (currentCountBottom) {
                    currentCountBottom.innerText = currentCount;
                }
            })
            .catch(err => console.error(err));
        }

        function loadMoreDoctors(page) {
            if (isLoadingDoctors) return;
            isLoadingDoctors = true;

            let loadMoreBtn = document.getElementById("loadMoreBtn");
            if (loadMoreBtn) {
                loadMoreBtn.disabled = true;
                loadMoreBtn.innerHTML = "Loading...";
            }

            // Use getDoctorFilters with append=true
            // page is required, fallback to 2 if not provided
            let nextPage = page || (loadMoreBtn ? loadMoreBtn.getAttribute("data-page") : 2);

            // Collect current search and filter values and append
            let name = document.getElementById('doctorSearchInput') ? document.getElementById('doctorSearchInput').value : '';
            let positions = [];
            document.querySelectorAll('.sidebar input[type="checkbox"][id^="position-"]:checked').forEach(function(cb) {
                positions.push(cb.value);
            });
            let experiences = [];
            document.querySelectorAll('.sidebar input[type="checkbox"][id^="exp"]:checked').forEach(function(cb) {
                experiences.push(cb.value);
            });

            let params = new URLSearchParams();
            if (name) params.append('search', name);
            if (positions.length) params.append('positions', positions.join(','));
            if (experiences.length) params.append('experiences', experiences.join(','));
            params.append('page', nextPage);

            fetch("{{ route('web.doctors.index') }}?" + params.toString(), {
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(response => response.text())
            .then(data => {
                let container = document.getElementById("doctorsContainer");
                if (container) {
                    container.insertAdjacentHTML("beforeend", data);
                }

                // Update current count
                let currentCount = document.querySelectorAll("#doctorsContainer .doctor-item").length;
                console.log(currentCount , ' currentCount');
                if (currentCount === 0) {
                    showNoDoctorsAlert();
                }
                let currentCountBottom = document.getElementById("currentCountBottom");
                if (currentCountBottom) {
                    currentCountBottom.innerText = currentCount;
                }

                // Update page number for next load
                let lastPage = {{ $doctors->lastPage() }};
                let newPage = parseInt(nextPage) + 1;
                if (newPage <= lastPage) {
                    if (loadMoreBtn) {
                        loadMoreBtn.setAttribute("data-page", newPage);
                        loadMoreBtn.disabled = false;
                        loadMoreBtn.innerHTML = '<i class="bi bi-plus-circle me-2"></i>Load More Doctors';
                    }
                } else {
                    // Hide the load more section
                    let loadMoreSection = document.getElementById("loadMoreSection");
                    if (loadMoreSection) {
                        loadMoreSection.style.display = "none";
                    }
                }
            })
            .catch(err => {
                if (loadMoreBtn) {
                    loadMoreBtn.disabled = false;
                    loadMoreBtn.innerHTML = '<i class="bi bi-plus-circle me-2"></i>Load More Doctors';
                }
                console.error(err);
            })
            .finally(() => {
                isLoadingDoctors = false;
            });
        }

        // Attach event listeners after DOM is ready
        document.addEventListener("DOMContentLoaded", function () {
            // Load More button
            let loadMoreBtn = document.getElementById("loadMoreBtn");
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    let page = this.getAttribute("data-page") || 2;
                    loadMoreDoctors(page);
                });
            }

            // Filter checkboxes
            document.querySelectorAll('.sidebar input[type="checkbox"]').forEach(function(cb) {
                cb.addEventListener("change", function() {
                    // On filter change, reload doctors (reset to page 1)
                    getDoctorFilters(1, false);
                    // Reset Load More button/page
                    let loadMoreSection = document.getElementById("loadMoreSection");
                    if (loadMoreSection) loadMoreSection.style.display = "";
                    let loadMoreBtn = document.getElementById("loadMoreBtn");
                    if (loadMoreBtn) loadMoreBtn.setAttribute("data-page", 2);
                });
            });

            // Search input
            let searchInput = document.getElementById('doctorSearchInput');
            if (searchInput) {
                searchInput.addEventListener("input", function() {
                    // On search, reload doctors (reset to page 1)
                    getDoctorFilters(1, false);
                    // Reset Load More button/page
                    let loadMoreSection = document.getElementById("loadMoreSection");
                    if (loadMoreSection) loadMoreSection.style.display = "";
                    let loadMoreBtn = document.getElementById("loadMoreBtn");
                    if (loadMoreBtn) loadMoreBtn.setAttribute("data-page", 2);
                });
            }

            // Reset filters button (if exists)
            let resetBtn = document.getElementById('resetDoctorFiltersBtn');
            if (resetBtn) {
                resetBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    // Reset all filters and search
                    if (searchInput) searchInput.value = '';
                    document.querySelectorAll('.sidebar input[type="checkbox"]').forEach(function(cb) {
                        cb.checked = false;
                    });
                    getDoctorFilters(1, false);
                    // Reset Load More button/page
                    let loadMoreSection = document.getElementById("loadMoreSection");
                    if (loadMoreSection) loadMoreSection.style.display = "";
                    let loadMoreBtn = document.getElementById("loadMoreBtn");
                    if (loadMoreBtn) loadMoreBtn.setAttribute("data-page", 2);
                });
            }
        });

        // Expose for manual use if needed
        window.getDoctorFilters = getDoctorFilters;
        window.loadMoreDoctors = loadMoreDoctors;


        let doctorsCurrentlyShown = 10;
        const doctorsTotalCount = 15;
        let mobileFiltersVisible = false;

        // Mobile filter toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileFilterToggle = document.getElementById('mobileFilterToggle');
            const mobileFilterDropdown = document.getElementById('mobileFilterDropdown');
            const filterIcon = document.getElementById('filterIcon');

            if (mobileFilterToggle) {
                mobileFilterToggle.addEventListener('click', function() {
                    mobileFiltersVisible = !mobileFiltersVisible;
                    
                    if (mobileFiltersVisible) {
                        mobileFilterDropdown.classList.add('show');
                        filterIcon.classList.remove('bi-chevron-down');
                        filterIcon.classList.add('bi-chevron-up');
                    } else {
                        mobileFilterDropdown.classList.remove('show');
                        filterIcon.classList.remove('bi-chevron-up');
                        filterIcon.classList.add('bi-chevron-down');
                    }
                });
            }

            // Initialize counters
            refreshDoctorCounters();
        });

    </script>
@endpush
  
</x-web.layout>