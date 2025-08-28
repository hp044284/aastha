<x-web.layout>
    <!-- Hero Section -->
    <section id="home" class="bg-gray py-5">
        <div class="container-fluid">
            <!-- Page Title and Description -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="display-4 fw-bold mb-3 fs-2 text-primary">About Us</h1>
                    <p class="lead fs-6 mb-0">Aastha Hospital provides compassionate, advanced medical care with expert doctors and modern healthcare facilities.</p>
                </div>
            </div>
        </div>
    </section>

<!-- About Section -->
<section id="about" class="py-5 bg-white">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <h2 class="section-title">Our Story</h2>
                {!! $page->Description ?? '' !!}
                <div class="col-lg-12 text-md-start mb-3 mb-lg-0">
                    <a href="our-team.html" class="view-all-btn">
                        Browse Our Experts <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <img
                    src="{{ !empty($page->File_Name) ? asset('Uploads/Page/' . $page->File_Name) : 'https://img.bdcnetwork.com/files/base/ebm/bdcnetwork/image/2024/09/66fb177b816f267adec3a333-15019_000_n8_medium.png?auto=format%2Ccompress&fill=blur&
                    fit=fill&q=45&w=640&width=640' }}"
                    alt="Aastha Hospital Building"
                    class="img-fluid rounded shadow"
                    onerror="this.onerror=null;this.src='{{ asset('Uploads/image_placeholder.jpg') }}';"
                />
            </div>
        </div>
        <div class="testimonial-stats mt-5">
            <div class="row g-4 wrapper">
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Happy Families</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">4.9/5</div>
                        <div class="stat-label">Average Rating</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Satisfaction Rate</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">100+</div>
                        <div class="stat-label">Video Stories</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Case Studies Section -->
    <section class="bg-gray py-5">
        <div class="container-fluid px-4">
            <div class="row mb-4">
                <div class="col-lg-8">
                    <h2 class="section-title">Welcoming lives with Expertise</h2>
                    <p class="section-description">Beautiful stories of Hope, Resilience and Recovery shared by families who have experienced our Excellence</p>
                </div>
                <div class="col-lg-4 text-lg-end text-md-start mb-3 mb-lg-0">
                    <a href="case-studies.html" class="view-all-btn">
                        View All <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="case-study-card" onclick="navigateTo('case-study-nirvaan.html')">
                        <div class="case-study-image">
                            <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Meet Nirvaan">
                        </div>
                        <div class="case-study-content">
                            <h4>Meet Nirvaan</h4>
                            <p>Miracle baby, born in 22nd week, beats all odds after spending 132 days in NICU</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="case-study-card" onclick="navigateTo('case-study-varad.html')">
                        <div class="case-study-image">
                            <img src="https://images.unsplash.com/photo-1559757175-0eb30cd8c063?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Meet Varad">
                        </div>
                        <div class="case-study-content">
                            <h4>Meet Varad</h4>
                            <p>2.5 years old who survived rare Pneumonia after 150+ days on ventilator with expert care</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="case-study-card" onclick="navigateTo('case-study-shivanya.html')">
                        <div class="case-study-image">
                            <img src="https://images.unsplash.com/photo-1609220136736-443140cffec6?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Meet Shivanya">
                        </div>
                        <div class="case-study-content">
                            <h4>Meet Shivanya</h4>
                            <p>Born at 24 weeks, she is one of the youngest babies in India to survive extreme preterm birth</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="case-study-card" onclick="navigateTo('case-study-ananya.html')">
                        <div class="case-study-image">
                            <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Meet Ananya">
                        </div>
                        <div class="case-study-content">
                            <h4>Meet Ananya</h4>
                            <p>Successful treatment of rare genetic disorder with innovative therapy and dedicated medical care</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- Our Team Section -->
    <section id="team" class="team-section py-5">
        <div class="container-fluid px-4">
            <div class="row mb-4">
                <div class="col-lg-8">
                    <h2 class="section-title">Our Expert Team</h2>
                    <p class="section-description">Meet the faces behind our excellence. Our dedicated team of highly qualified professionals to assist you on the journey to better health.</p>
                </div>
                <div class="col-lg-4 text-lg-end text-md-start mb-3 mb-lg-0">
                    <a href="our-team.html" class="view-all-btn">
                        View All <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="team-card" onclick="navigateTo('doctor-nandkishor.html')">
                        <div class="team-image">
                            <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Dr. Nandkishor Kabra">
                        </div>
                        <div class="team-content">
                            <h4>Dr. Nandkishor Kabra</h4>
                            <p class="designation">Director, Neonatal ICU</p>
                            <p class="experience">25+ Years Experience</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="team-card" onclick="navigateTo('doctor-rajesh.html')">
                        <div class="team-image">
                            <img src="https://images.unsplash.com/photo-1607990281513-2c110a25bd8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Dr. Rajesh Kumar">
                        </div>
                        <div class="team-content">
                            <h4>Dr. Rajesh Kumar</h4>
                            <p class="designation">Senior Consultant - Cardiology</p>
                            <p class="experience">22+ Years Experience</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="team-card" onclick="navigateTo('doctor-shobha.html')">
                        <div class="team-image">
                            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Dr. Shobha Sharma">
                        </div>
                        <div class="team-content">
                            <h4>Dr. Shobha Sharma</h4>
                            <p class="designation">Consultant General Pediatrics</p>
                            <p class="experience">20+ Years Experience</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="team-card" onclick="navigateTo('doctor-sunita.html')">
                        <div class="team-image">
                            <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Dr. Sunita Shishodia">
                        </div>
                        <div class="team-content">
                            <h4>Dr. Sunita Shishodia</h4>
                            <p class="designation">Sr. Director & HOD - Obstetrics</p>
                            <p class="experience">28+ Years Experience</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-web.layout>