<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AuthController,
    FaqController,
    LoginController,
    UsersController,
    DoctorController,
    BlogsController,
    RolesController,
    PagesController,
    StatusController,
    SeoPageController,
    ClientsController,
    ReviewsController,
    SlidersController,
    ProductsController,
    SettingsController,
    ServicesController,
    PositionController,
    DashboardController,
    EnquiriesController,
    DepartmentController,
    TestimonialsController,
    SpecializationController,
    BlogCategoriesController,
    RolePermissionsController,
    FeaturedServiceController,
    ServiceCategoriesController,
    BlogSubCategoriesController,
    ProductCategoriesController,
    ServiceSubCategoriesController,
    ProductSubCategoriesController,
};


Route::get('/', [AuthController::class, 'Show_Login_Form'])->name('admin_login');
Route::controller(LoginController::class)->group(function ()
{
    Route::get('/logout', [LoginController::class, 'Logout'])->name('logout');
    Route::post('/login', [LoginController::class, 'Login'])->name('login');
    Route::post('/login', [LoginController::class, 'Login'])->name('login');
});

Route::middleware(['admin'])->controller(DashboardController::class)->group(function ()
{
    Route::get('/dashboard', [DashboardController::class, 'Index'])->name('dashboard');
});

Route::prefix('users')->middleware(['admin'])->controller(UsersController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Users,Is_Read']], function ()
    {
        Route::get('/', [UsersController::class, 'Index'])->name('user.index');
        Route::post('/axios-record', [UsersController::class, 'Axios_Record'])->name('user.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Users,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [UsersController::class, 'Edit'])->name('user.edit');
        Route::post('/update', [UsersController::class, 'Update'])->name('user.update');
    });

    Route::group(['middleware' => ['check-permission:Users,Is_Add']], function ()
    {
        Route::get('/create', [UsersController::class, 'Create'])->name('user.create');
        Route::post('/store', [UsersController::class, 'Store'])->name('user.store');
    });
    Route::group(['middleware' => ['check-permission:Users,Is_Delete']], function ()
    {
        Route::get('/delete/{id}', [UsersController::class, 'Delete'])->name('user.delete');
    });
    Route::post('/update-profile', [UsersController::class, 'Update_Profile'])->name('user.update_profile');
    Route::get('/profile', [UsersController::class, 'Profile'])->name('user.profile');
    Route::get('/password', [UsersController::class, 'Change_Password'])->name('user.change_password');
    Route::post('/update-password', [UsersController::class, 'Update_Password'])->name('user.update_password');
});

Route::prefix('seo-pages')->middleware(['admin'])->controller(SeoPageController::class)->group(function () {
    Route::group(['middleware' => ['check-permission:Seo_Pages,Is_Read']], function () {
        Route::get('/', 'index')->name('seo_page.index');
        Route::get('/show/{id}', 'show')->name('seo_page.show');
    });

    Route::group(['middleware' => ['check-permission:Seo_Pages,Is_Add']], function () {
        Route::get('/create', 'create')->name('seo_page.create');
        Route::post('/store', 'store')->name('seo_page.store');
    });

    Route::group(['middleware' => ['check-permission:Seo_Pages,Is_Edit']], function () {
        Route::get('/edit/{id}', 'edit')->name('seo_page.edit');
        Route::post('/update', 'update')->name('seo_page.update');
    });

    Route::post('/get-type', 'getType')->name('seo_page.getType');
    Route::post('/get-seoable-details', 'getSeoableDetails')->name('seo_page.getSeoableDetails');

    Route::group(['middleware' => ['check-permission:Seo_Pages,Is_Delete']], function () {
        Route::delete('/destroy/{id}', 'destroy')->name('seo_page.destroy');
    });
});

Route::prefix('roles')->middleware(['admin'])->controller(RolesController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Roles,Is_Read']], function ()
    {
        Route::get('/', [RolesController::class, 'Index'])->name('role.index');
        Route::post('/axios-record', [RolesController::class, 'Axios_Record'])->name('role.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Roles,Is_Add']], function ()
    {
        Route::get('/create', [RolesController::class, 'Create'])->name('role.create');
        Route::post('/store', [RolesController::class, 'Store'])->name('role.store');
    });

    Route::group(['middleware' => ['check-permission:Roles,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [RolesController::class, 'Edit'])->name('role.edit');
        Route::post('/update', [RolesController::class, 'Update'])->name('role.update');
        Route::post('/status', [RolesController::class, 'Status'])->name('role.status');
        Route::post('/create-update-role-permissions', [RolesController::class, 'Create_Update_Role_Permissions'])->name('role.curp');
    });

    Route::group(['middleware' => ['check-permission:Roles,Is_Delete']], function ()
    {
        Route::get('/delete/{id}', [RolesController::class, 'Delete'])->name('role.delete');
    });

});

Route::prefix('enquiries')->middleware(['admin'])->controller(EnquiriesController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Enquiries,Is_Read']], function ()
    {
        Route::get('/', [EnquiriesController::class, 'Index'])->name('enquiry.index');
        Route::post('/axios-record', [EnquiriesController::class, 'Axios_Record'])->name('enquiry.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Enquiries,Is_Delete']], function ()
    {
        Route::post('/delete', [EnquiriesController::class, 'Destroy'])->name('enquiry.delete');
    });

});

Route::prefix('product-categories')->middleware(['admin'])->controller(ProductCategoriesController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Product_Categories,Is_Read']], function ()
    {
        Route::get('/', [ProductCategoriesController::class, 'Index'])->name('product_category.index');
        Route::post('/axios-record', [ProductCategoriesController::class, 'Axios_Record'])->name('product_category.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Product_Categories,Is_Add']], function ()
    {
        Route::get('/create', [ProductCategoriesController::class, 'Create'])->name('product_category.create');
        Route::post('/store', [ProductCategoriesController::class, 'Store'])->name('product_category.store');
    });

    Route::group(['middleware' => ['check-permission:Product_Categories,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [ProductCategoriesController::class, 'Edit'])->name('product_category.edit');
        Route::post('/update', [ProductCategoriesController::class, 'Update'])->name('product_category.update');
        Route::post('/status', [ProductCategoriesController::class, 'Status'])->name('product_category.status');
    });

    Route::group(['middleware' => ['check-permission:Product_Categories,Is_Delete']], function ()
    {
        Route::post('/delete', [ProductCategoriesController::class, 'Destroy'])->name('product_category.delete');
    });
    Route::post('/axios-product-sub-category', [ProductCategoriesController::class, 'Axios_Product_Sub_Category'])->name('product_category.axios_product_sub_category');
});

Route::prefix('product-sub-categories')->middleware(['admin'])->controller(ProductSubCategoriesController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Product_Sub_Categories,Is_Read']], function ()
    {
        Route::get('/{random_id}', [ProductSubCategoriesController::class, 'Index'])->name('product_sub_category.index');
        Route::post('/axios-record', [ProductSubCategoriesController::class, 'Axios_Record'])->name('product_sub_category.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Product_Sub_Categories,Is_Add']], function ()
    {
        Route::get('/create/{random_id}', [ProductSubCategoriesController::class, 'Create'])->name('product_sub_category.create');
        Route::post('/store', [ProductSubCategoriesController::class, 'Store'])->name('product_sub_category.store');
    });

    Route::group(['middleware' => ['check-permission:Product_Sub_Categories,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [ProductSubCategoriesController::class, 'Edit'])->name('product_sub_category.edit');
        Route::post('/update', [ProductSubCategoriesController::class, 'Update'])->name('product_sub_category.update');
        Route::post('/status', [ProductSubCategoriesController::class, 'Status'])->name('product_sub_category.status');
    });

    Route::group(['middleware' => ['check-permission:Product_Sub_Categories,Is_Delete']], function ()
    {
        Route::post('/delete', [ProductSubCategoriesController::class, 'Destroy'])->name('product_sub_category.delete');
    });
});

Route::prefix('blog-categories')->middleware(['admin'])->controller(BlogCategoriesController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Blog_Categories,Is_Read']], function ()
    {
        Route::get('/', [BlogCategoriesController::class, 'Index'])->name('blog_category.index');
        Route::post('/axios-record', [BlogCategoriesController::class, 'Axios_Record'])->name('blog_category.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Blog_Categories,Is_Add']], function ()
    {
        Route::get('/create', [BlogCategoriesController::class, 'Create'])->name('blog_category.create');
        Route::post('/store', [BlogCategoriesController::class, 'Store'])->name('blog_category.store');
    });

    Route::group(['middleware' => ['check-permission:Blog_Categories,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [BlogCategoriesController::class, 'Edit'])->name('blog_category.edit');
        Route::post('/update', [BlogCategoriesController::class, 'Update'])->name('blog_category.update');
        Route::post('/status', [BlogCategoriesController::class, 'Status'])->name('blog_category.status');
    });

    Route::group(['middleware' => ['check-permission:Blog_Categories,Is_Delete']], function ()
    {
        Route::post('/delete', [BlogCategoriesController::class, 'Destroy'])->name('blog_category.delete');
    });
    Route::post('/axios-blog-sub-category', [BlogCategoriesController::class, 'Axios_Blog_Sub_Category'])->name('blog_category.axios_blog_sub_category');
});

Route::prefix('blog-sub-categories')->middleware(['admin'])->controller(BlogSubCategoriesController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Blog_Sub_Categories,Is_Read']], function ()
    {
        Route::get('/{random_id}', [BlogSubCategoriesController::class, 'Index'])->name('blog_sub_category.index');
        Route::post('/axios-record', [BlogSubCategoriesController::class, 'Axios_Record'])->name('blog_sub_category.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Blog_Sub_Categories,Is_Add']], function ()
    {
        Route::get('/create/{random_id}', [BlogSubCategoriesController::class, 'Create'])->name('blog_sub_category.create');
        Route::post('/store', [BlogSubCategoriesController::class, 'Store'])->name('blog_sub_category.store');
    });

    Route::group(['middleware' => ['check-permission:Blog_Sub_Categories,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [BlogSubCategoriesController::class, 'Edit'])->name('blog_sub_category.edit');
        Route::post('/update', [BlogSubCategoriesController::class, 'Update'])->name('blog_sub_category.update');
        Route::post('/status', [BlogSubCategoriesController::class, 'Status'])->name('blog_sub_category.status');
    });

    Route::group(['middleware' => ['check-permission:Blog_Sub_Categories,Is_Delete']], function ()
    {
        Route::post('/delete', [BlogSubCategoriesController::class, 'Destroy'])->name('blog_sub_category.delete');
    });
});

Route::prefix('service-categories')->middleware(['admin'])->controller(ServiceCategoriesController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Service_Categories,Is_Read']], function ()
    {
        Route::get('/', [ServiceCategoriesController::class, 'Index'])->name('service_category.index');
        Route::post('/axios-record', [ServiceCategoriesController::class, 'Axios_Record'])->name('service_category.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Service_Categories,Is_Add']], function ()
    {
        Route::get('/create', [ServiceCategoriesController::class, 'Create'])->name('service_category.create');
        Route::post('/store', [ServiceCategoriesController::class, 'Store'])->name('service_category.store');
    });

    Route::group(['middleware' => ['check-permission:Service_Categories,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [ServiceCategoriesController::class, 'Edit'])->name('service_category.edit');
        Route::post('/update', [ServiceCategoriesController::class, 'Update'])->name('service_category.update');
        Route::post('/status', [ServiceCategoriesController::class, 'Status'])->name('service_category.status');
    });

    Route::group(['middleware' => ['check-permission:Service_Categories,Is_Delete']], function ()
    {
        Route::post('/delete', [ServiceCategoriesController::class, 'Destroy'])->name('service_category.delete');
    });

    Route::post('/axios-service-sub-category', [ServiceCategoriesController::class, 'Axios_Service_Sub_Category'])->name('service_category.axios_service_sub_category');
});

Route::prefix('service-sub-categories')->middleware(['admin'])->controller(ServiceSubCategoriesController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Service_Sub_Categories,Is_Read']], function ()
    {
        Route::get('/{random_id}', [ServiceSubCategoriesController::class, 'Index'])->name('service_sub_category.index');
        Route::post('/axios-record', [ServiceSubCategoriesController::class, 'Axios_Record'])->name('service_sub_category.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Service_Sub_Categories,Is_Add']], function ()
    {
        Route::get('/create/{random_id}', [ServiceSubCategoriesController::class, 'Create'])->name('service_sub_category.create');
        Route::post('/store', [ServiceSubCategoriesController::class, 'Store'])->name('service_sub_category.store');
    });

    Route::group(['middleware' => ['check-permission:Service_Sub_Categories,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [ServiceSubCategoriesController::class, 'Edit'])->name('service_sub_category.edit');
        Route::post('/update', [ServiceSubCategoriesController::class, 'Update'])->name('service_sub_category.update');
        Route::post('/status', [ServiceSubCategoriesController::class, 'Status'])->name('service_sub_category.status');
    });

    Route::group(['middleware' => ['check-permission:Service_Sub_Categories,Is_Delete']], function ()
    {
        Route::post('/delete', [ServiceSubCategoriesController::class, 'Destroy'])->name('service_sub_category.delete');
    });
});

Route::prefix('products')->middleware(['admin'])->controller(ProductsController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Products,Is_Read']], function ()
    {
        Route::get('/', [ProductsController::class, 'Index'])->name('product.index');
        Route::post('/axios-record', [ProductsController::class, 'Axios_Record'])->name('product.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Products,Is_Add']], function ()
    {
        Route::get('/create', [ProductsController::class, 'Create'])->name('product.create');
        Route::post('/store', [ProductsController::class, 'Store'])->name('product.store');
    });

    Route::group(['middleware' => ['check-permission:Products,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [ProductsController::class, 'Edit'])->name('product.edit');
        Route::post('/update', [ProductsController::class, 'Update'])->name('product.update');
        Route::post('/status', [ProductsController::class, 'Status'])->name('product.status');
    });

    Route::group(['middleware' => ['check-permission:Products,Is_Delete']], function ()
    {
        Route::post('/delete', [ProductsController::class, 'Destroy'])->name('product.delete');
    });
});

Route::prefix('services')->middleware(['admin'])->controller(ServicesController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Services,Is_Read']], function ()
    {
        Route::get('/', [ServicesController::class, 'Index'])->name('service.index');
        Route::post('/axios-record', [ServicesController::class, 'Axios_Record'])->name('service.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Services,Is_Add']], function ()
    {
        Route::get('/create', [ServicesController::class, 'Create'])->name('service.create');
        Route::post('/store', [ServicesController::class, 'Store'])->name('service.store');
    });

    Route::group(['middleware' => ['check-permission:Services,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [ServicesController::class, 'Edit'])->name('service.edit');
        Route::post('/update', [ServicesController::class, 'Update'])->name('service.update');
        Route::post('/status', [ServicesController::class, 'Status'])->name('service.status');
    });

    Route::group(['middleware' => ['check-permission:Services,Is_Delete']], function ()
    {
        Route::post('/delete', [ServicesController::class, 'Destroy'])->name('service.delete');
    });
});

Route::prefix('blogs')->middleware(['admin'])->controller(BlogsController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Blogs,Is_Read']], function ()
    {
        Route::get('/', [BlogsController::class, 'Index'])->name('blog.index');
        Route::post('/axios-record', [BlogsController::class, 'Axios_Record'])->name('blog.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Blogs,Is_Add']], function ()
    {
        Route::get('/create', [BlogsController::class, 'Create'])->name('blog.create');
        Route::post('/store', [BlogsController::class, 'Store'])->name('blog.store');
    });

    Route::group(['middleware' => ['check-permission:Blogs,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [BlogsController::class, 'Edit'])->name('blog.edit');
        Route::post('/update', [BlogsController::class, 'Update'])->name('blog.update');
        Route::post('/status', [BlogsController::class, 'Status'])->name('blog.status');
    });

    Route::group(['middleware' => ['check-permission:Blogs,Is_Delete']], function ()
    {
        Route::post('/delete', [BlogsController::class, 'Destroy'])->name('blog.delete');
    });
});

Route::prefix('sliders')->middleware(['admin'])->controller(SlidersController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Sliders,Is_Read']], function ()
    {
        Route::get('/', [SlidersController::class, 'Index'])->name('slider.index');
        Route::post('/axios-record', [SlidersController::class, 'Axios_Record'])->name('slider.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Sliders,Is_Add']], function ()
    {
        Route::get('/create', [SlidersController::class, 'Create'])->name('slider.create');
        Route::post('/store', [SlidersController::class, 'Store'])->name('slider.store');
    });

    Route::group(['middleware' => ['check-permission:Sliders,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [SlidersController::class, 'Edit'])->name('slider.edit');
        Route::post('/update', [SlidersController::class, 'Update'])->name('slider.update');
        Route::post('/status', [SlidersController::class, 'Status'])->name('slider.status');
    });

    Route::group(['middleware' => ['check-permission:Sliders,Is_Delete']], function ()
    {
        Route::post('/delete', [SlidersController::class, 'Destroy'])->name('slider.delete');
    });
});

Route::prefix('testimonials')->middleware(['admin'])->controller(TestimonialsController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Testimonials,Is_Read']], function ()
    {
        Route::get('/', [TestimonialsController::class, 'Index'])->name('testimonial.index');
        Route::post('/axios-record', [TestimonialsController::class, 'Axios_Record'])->name('testimonial.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Testimonials,Is_Add']], function ()
    {
        Route::get('/create', [TestimonialsController::class, 'Create'])->name('testimonial.create');
        Route::post('/store', [TestimonialsController::class, 'Store'])->name('testimonial.store');
    });

    Route::group(['middleware' => ['check-permission:Testimonials,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [TestimonialsController::class, 'Edit'])->name('testimonial.edit');
        Route::post('/update', [TestimonialsController::class, 'Update'])->name('testimonial.update');
        Route::post('/status', [TestimonialsController::class, 'Status'])->name('testimonial.status');
    });

    Route::group(['middleware' => ['check-permission:Testimonials,Is_Delete']], function ()
    {
        Route::post('/delete', [TestimonialsController::class, 'Destroy'])->name('testimonial.delete');
    });
});


Route::resource('doctors', DoctorController::class);
Route::resource('positions', PositionController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('specializations', SpecializationController::class);

Route::post('status/{model}/toggle-status/{id}', [StatusController::class, 'index'])->name('status.index');


Route::prefix('reviews')->middleware(['admin'])->controller(ReviewsController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Reviews,Is_Read']], function ()
    {
        Route::get('/', [ReviewsController::class, 'Index'])->name('review.index');
        Route::get('/reply/{id}', [ReviewsController::class, 'Reply.Index'])->name('review.reply.Index');
        Route::post('/axios-record', [ReviewsController::class, 'Axios_Record'])->name('review.axios_record');
        Route::post('/axios-reply-record', [ReviewsController::class, 'Axios_Reply_Record'])->name('review.axios_reply_record');
    });

    Route::group(['middleware' => ['check-permission:Reviews,Is_Edit']], function ()
    {
        Route::post('/status', [ReviewsController::class, 'Status'])->name('review.status');
        Route::post('/reply-review', [ReviewsController::class, 'Reply_Review'])->name('review.reply_review');
        Route::post('/approve-rejetc', [ReviewsController::class, 'Axios_Approve_Reject'])->name('review.axios_approve_reject');
    });

    Route::group(['middleware' => ['check-permission:Reviews,Is_Delete']], function ()
    {
        Route::post('/delete', [ReviewsController::class, 'Destroy'])->name('review.delete');
    });
});

Route::prefix('pages')->middleware(['admin'])->controller(PagesController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Pages,Is_Read']], function ()
    {
        Route::get('/', [PagesController::class, 'Index'])->name('page.index');
        Route::post('/axios-record', [PagesController::class, 'Axios_Record'])->name('page.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Pages,Is_Add']], function ()
    {
        Route::get('/create', [PagesController::class, 'Create'])->name('page.create');
        Route::post('/store', [PagesController::class, 'Store'])->name('page.store');
    });

    Route::group(['middleware' => ['check-permission:Pages,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [PagesController::class, 'Edit'])->name('page.edit');
        Route::post('/update', [PagesController::class, 'Update'])->name('page.update');
        Route::post('/status', [PagesController::class, 'Status'])->name('page.status');
    });

    Route::group(['middleware' => ['check-permission:Pages,Is_Delete']], function ()
    {
        Route::post('/delete', [PagesController::class, 'Destroy'])->name('page.delete');
    });
});

Route::prefix('clients')->middleware(['admin'])->controller(ClientsController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Clients,Is_Read']], function ()
    {
        Route::get('/', [ClientsController::class, 'Index'])->name('client.index');
        Route::post('/axios-record', [ClientsController::class, 'Axios_Record'])->name('client.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Clients,Is_Add']], function ()
    {
        Route::get('/create', [ClientsController::class, 'Create'])->name('client.create');
        Route::post('/store', [ClientsController::class, 'Store'])->name('client.store');
    });

    Route::group(['middleware' => ['check-permission:Clients,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [ClientsController::class, 'Edit'])->name('client.edit');
        Route::post('/update', [ClientsController::class, 'Update'])->name('client.update');
        Route::post('/status', [ClientsController::class, 'Status'])->name('client.status');
    });

    Route::group(['middleware' => ['check-permission:Clients,Is_Delete']], function ()
    {
        Route::post('/delete', [ClientsController::class, 'Destroy'])->name('client.delete');
    });
});

Route::middleware(['admin'])->group(function () {
    Route::post('faqs/axios-record', [FaqController::class, 'axiosRecord'])->name('faqs.axios_record');
    Route::post('faqs/status', [FaqController::class, 'status'])->name('faqs.status');
    Route::resource('faqs', FaqController::class)->names('faqs');
});

Route::prefix('featured-services')->middleware(['admin'])->controller(FeaturedServiceController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Featured_Services,Is_Read']], function ()
    {
        Route::get('/', [FeaturedServiceController::class, 'index'])->name('featured-services.index');
        Route::post('/axios-record', [FeaturedServiceController::class, 'axiosRecord'])->name('featured-services.axios_record');
    });

    Route::group(['middleware' => ['check-permission:Featured_Services,Is_Add']], function ()
    {
        Route::get('/create', [FeaturedServiceController::class, 'create'])->name('featured-services.create');
        Route::post('/store', [FeaturedServiceController::class, 'store'])->name('featured-services.store');
    });

    Route::group(['middleware' => ['check-permission:Featured_Services,Is_Edit']], function ()
    {
        Route::get('/edit/{id}', [FeaturedServiceController::class, 'edit'])->name('featured-services.edit');
        Route::post('/update', [FeaturedServiceController::class, 'update'])->name('featured-services.update');
        Route::post('/status', [FeaturedServiceController::class, 'status'])->name('featured-services.status');
    });

    Route::group(['middleware' => ['check-permission:Featured_Services,Is_Delete']], function ()
    {
        Route::post('/delete', [FeaturedServiceController::class, 'destroy'])->name('featured-services.delete');
        Route::post('/delete-extra-input', [FeaturedServiceController::class, 'deleteExtraInput'])->name('featured-services.delete-extra-input');
    });
}); 

Route::prefix('settings')->middleware(['admin'])->controller(SettingsController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Settings,Is_Read']], function ()
    {
        Route::get('/', [SettingsController::class, 'Index'])->name('setting.index');
    });

    Route::group(['middleware' => ['check-permission:Settings,Is_Edit']], function ()
    {
        Route::post('/update', [SettingsController::class, 'Update'])->name('setting.update');
    });
});

Route::prefix('role-permissions')->middleware(['admin'])->controller(RolePermissionsController::class)->group(function ()
{
    Route::group(['middleware' => ['check-permission:Role_Permissions,Is_Edit']], function ()
    {
        Route::get('/update-all-permission', [RolePermissionsController::class, 'Update_All_Permissions'])->name('role_permission.update_all_permission');
        Route::post('/update-status', [RolePermissionsController::class, 'Update_Status'])->name('role_permission.update_status');
    });

    Route::group(['middleware' => ['check-permission:Role_Permissions,Is_Read']], function ()
    {
        Route::get('/{role_id}', [RolePermissionsController::class, 'Index'])->name('role_permission.index');
    });
});

Route::fallback(function () 
{
    return redirect()->route('dashboard')->with('error', __('Page not found'));
});
