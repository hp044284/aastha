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
    ReviewsController,
    SlidersController,
    SettingsController,
    ServicesController,
    PositionController,
    EventController,
    NewsController,
    DashboardController,
    EnquiriesController,
    CaseStudyController,
    DepartmentController,
    TestimonialsController,
    SpecializationController,
    BlogCategoriesController,
    RolePermissionsController,
    ServiceCategoriesController,
    BlogSubCategoriesController,
    ServiceSubCategoriesController,
};


    Route::get('/', [AuthController::class, 'Show_Login_Form'])->name('admin_login');
    Route::controller(LoginController::class)->group(function () {
        Route::get('/logout', 'Logout')->name('logout');
        Route::post('/login', 'Login')->name('login');
    });

    Route::controller(DashboardController::class)
        ->middleware(['admin'])
        ->group(function () {
            Route::get('/dashboard', 'Index')->name('dashboard');
    });

    Route::controller(UsersController::class)
    ->prefix('users')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/', 'Index')->name('user.index');
        Route::post('/axios-record', 'Axios_Record')->name('user.axios_record');

        Route::get('/edit/{id}', 'Edit')->name('user.edit');
        Route::post('/update', 'Update')->name('user.update');

        Route::get('/create', 'Create')->name('user.create');
        Route::post('/store', 'Store')->name('user.store');

        Route::get('/delete/{id}', 'Delete')->name('user.delete');

        Route::post('/update-profile', 'Update_Profile')->name('user.update_profile');
        Route::get('/profile', 'Profile')->name('user.profile');
        Route::get('/password', 'Change_Password')->name('user.change_password');
        Route::post('/update-password', 'Update_Password')->name('user.update_password');
    });

    Route::controller(RolesController::class)
    ->prefix('roles')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/', 'Index')->name('role.index');
        Route::post('/axios-record', 'Axios_Record')->name('role.axios_record');

        Route::get('/create', 'Create')->name('role.create');
        Route::post('/store', 'Store')->name('role.store');

        Route::get('/edit/{id}', 'Edit')->name('role.edit');
        Route::post('/update', 'Update')->name('role.update');
        Route::post('/status', 'Status')->name('role.status');
        Route::post('/create-update-role-permissions', 'Create_Update_Role_Permissions')->name('role.curp');

        Route::get('/delete/{id}', 'Delete')->name('role.delete');
    });

    Route::controller(EnquiriesController::class)
    ->prefix('enquiries')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/', 'index')->name('enquiry.index');
        Route::post('/axios-record', 'axiosRecord')->name('enquiry.axios_record');

        Route::post('/delete', 'destroy')->name('enquiry.delete');
    });

    Route::controller(BlogCategoriesController::class)
    ->prefix('blog-categories')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/', 'index')->name('blog_category.index');
        Route::post('/axios-record', 'axiosRecord')->name('blog_category.axios_record');

        Route::get('/create', 'create')->name('blog_category.create');
        Route::post('/store', 'store')->name('blog_category.store');

        Route::get('/edit/{id}', 'edit')->name('blog_category.edit');
        Route::post('/update', 'update')->name('blog_category.update');
        Route::post('/status', 'status')->name('blog_category.status');

        Route::post('/delete', 'destroy')->name('blog_category.delete');

        Route::post('/axios-blog-sub-category', 'Axios_Blog_Sub_Category')->name('blog_category.axios_blog_sub_category');
    });

    Route::controller(BlogSubCategoriesController::class)
    ->prefix('blog-sub-categories')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/{random_id}', 'index')->name('blog_sub_category.index');
        Route::post('/axios-record', 'axiosRecord')->name('blog_sub_category.axios_record');

        Route::get('/create/{random_id}', 'create')->name('blog_sub_category.create');
        Route::post('/store', 'Store')->name('blog_sub_category.store');

        Route::get('/edit/{id}', 'edit')->name('blog_sub_category.edit');
        Route::post('/update', 'update')->name('blog_sub_category.update');
        Route::post('/status', 'status')->name('blog_sub_category.status');

        Route::post('/delete', 'destroy')->name('blog_sub_category.delete');
    });

    Route::controller(ServiceCategoriesController::class)
    ->prefix('service-categories')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/', 'index')->name('service_category.index');
        Route::post('/axios-record', 'Axios_Record')->name('service_category.axios_record');

        Route::get('/create', 'create')->name('service_category.create');
        Route::post('/store', 'store')->name('service_category.store');

        Route::get('/edit/{id}', 'edit')->name('service_category.edit');
        Route::post('/update', 'update')->name('service_category.update');
        Route::post('/status', 'status')->name('service_category.status');

        Route::post('/delete', 'destroy')->name('service_category.delete');

        Route::post('/axios-service-sub-category', 'axiosServiceSubCategory')->name('service_category.axios_service_sub_category');
    });

    Route::controller(ServiceSubCategoriesController::class)
    ->prefix('service-sub-categories')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/{random_id}', 'index')->name('service_sub_category.index');
        Route::post('/axios-record', 'Axios_Record')->name('service_sub_category.axios_record');

        Route::get('/create/{random_id}', 'create')->name('service_sub_category.create');
        Route::post('/store', 'store')->name('service_sub_category.store');

        Route::get('/edit/{id}', 'edit')->name('service_sub_category.edit');
        Route::post('/update', 'update')->name('service_sub_category.update');
        Route::post('/status', 'status')->name('service_sub_category.status');

        Route::post('/delete', 'destroy')->name('service_sub_category.delete');
    });

    Route::controller(BlogsController::class)
    ->prefix('blogs')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/', 'index')->name('blog.index');
        Route::post('/axios-record', 'axiosRecord')->name('blog.axios_record');

        Route::get('/create', 'create')->name('blog.create');
        Route::post('/store', 'store')->name('blog.store');

        Route::get('/edit/{id}', 'edit')->name('blog.edit');
        Route::post('/update', 'update')->name('blog.update');
        Route::post('/status', 'status')->name('blog.status');

        Route::post('/delete', 'destroy')->name('blog.delete');
    });

    Route::controller(SlidersController::class)
    ->prefix('sliders')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/', 'Index')->name('slider.index');
        Route::post('/axios-record', 'Axios_Record')->name('slider.axios_record');

        Route::get('/create', 'Create')->name('slider.create');
        Route::post('/store', 'Store')->name('slider.store');

        Route::get('/edit/{id}', 'Edit')->name('slider.edit');
        Route::post('/update', 'Update')->name('slider.update');
        Route::post('/status', 'Status')->name('slider.status');

        Route::post('/delete', 'Destroy')->name('slider.delete');
    });

    Route::middleware(['admin'])->group(function () {
        Route::resource('doctors', DoctorController::class);
        Route::resource('services', ServicesController::class);
        Route::resource('positions', PositionController::class);
        Route::resource('events', EventController::class);

    Route::resource('news', NewsController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('testimonials', TestimonialsController::class);
        Route::resource('case-studies', CaseStudyController::class);
        Route::resource('specializations', SpecializationController::class);
    });

    Route::post('status/{model}/toggle-status/{id}', [StatusController::class, 'index'])->name('status.index');


    Route::controller(ReviewsController::class)
    ->prefix('reviews')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/', 'index')->name('review.index');
        Route::get('/reply/{id}', 'Reply.Index')->name('review.reply.Index');
        Route::post('/axios-record', 'axiosRecord')->name('review.axios_record');
        Route::post('/axios-reply-record', 'Axios_Reply_Record')->name('review.axios_reply_record');
        Route::post('/status', 'status')->name('review.status');
        Route::post('/reply-review', 'Reply_Review')->name('review.reply_review');
        Route::post('/approve-rejetc', 'Axios_Approve_Reject')->name('review.axios_approve_reject');
        Route::post('/delete', 'destroy')->name('review.delete');
    });

    Route::controller(PagesController::class)
    ->prefix('pages')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/', 'index')->name('page.index');
        Route::post('/axios-record', 'axiosRecord')->name('page.axios_record');
        Route::get('/create', 'create')->name('page.create');
        Route::post('/store', 'store')->name('page.store');
        Route::get('/edit/{id}', 'edit')->name('page.edit');
        Route::post('/update', 'update')->name('page.update');
        Route::post('/status', 'status')->name('page.status');
        Route::post('/delete', 'destroy')->name('page.delete');
    });

    Route::middleware(['admin'])->group(function () {
        Route::post('faqs/axios-record', [FaqController::class, 'axiosRecord'])->name('faqs.axios_record');
        Route::post('faqs/status', [FaqController::class, 'status'])->name('faqs.status');
        Route::resource('faqs', FaqController::class)->names('faqs');
    });

    Route::controller(SettingsController::class)
    ->prefix('settings')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/', 'Index')->name('setting.index');
        Route::post('/update', 'Update')->name('setting.update');
    });

    Route::controller(RolePermissionsController::class)
    ->prefix('role-permissions')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/update-all-permission', 'Update_All_Permissions')->name('role_permission.update_all_permission');
        Route::post('/update-status', 'Update_Status')->name('role_permission.update_status');
        Route::get('/{role_id}', 'Index')->name('role_permission.index');
    });

    Route::fallback(function () 
    {
        return redirect()->route('dashboard')->with('error', __('Page not found'));
    });
