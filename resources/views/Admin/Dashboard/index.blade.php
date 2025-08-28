@extends('Admin.Layout.index')
@section('title','Dashboard')
@section('content')

<div class="page-wrapper">
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-4">
            @if($User_Can)
                <div class="col">
                    <div class="card radius-10 bg-gradient-cosmic">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-auto">
                                    <p class="mb-0 text-white">Total Users</p>
                                    <h4 class="my-1 text-white">{{ $Total_Users ?? 0 }}</h4>
                                </div>
                                <!-- <div id="chart1"></div> -->
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($Blog_Can)
                <div class="col">
                    <div class="card radius-10 bg-gradient-ohhappiness">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-auto">
                                    <p class="mb-0 text-white">Total Blogs</p>
                                    <h4 class="my-1 text-white">{{ $Total_Blogs ?? 0 }}</h4>
                                </div>
                                <!-- <div id="chart3"></div> -->
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($Service_Can)
                <div class="col">
                    <div class="card radius-10 bg-gradient-kyoto">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-auto">
                                    <p class="mb-0 text-dark">Total Services</p>
                                    <h4 class="my-1 text-dark">{{ $Total_Services ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($Enquiry_Can)
                <div class="col">
                    <div class="card radius-10 bg-gradient-ohhappiness">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-auto">
                                    <p class="mb-0 text-white">Total Enquiries</p>
                                    <h4 class="my-1 text-white">{{ $Total_Enquiries ?? 0 }}</h4>
                                </div>
                                <!-- <div id="chart3"></div> -->
                            </div>
                        </div>
                    </div>
                </div>
            @endif
    
            @if($Review_Can)
                <div class="col">
                    <div class="card radius-10 bg-gradient-kyoto">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-auto">
                                    <p class="mb-0 text-dark">Total Blog Review</p>
                                    <h4 class="my-1 text-dark">{{ $Total_Blog_Reviews ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div><!--end row-->
</div>
@endsection