<?php

use App\PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

//Old home page
//Route::get('/', function () {
//    return view('welcome');
//});
//Home page index
//Route::get('/', function () {
//    return view('index');

//});
//Registration form
Route::get('/rentCar', function () {

    if (!empty($_GET['car'])) {
        $user = Auth::user();
        //$userid = Auth::user()->id;
        $id = $_GET['car'];
        DB::table('carpost')->where('id', $id)->increment('views');
        $car = DB::table('carpost')->where('id', $id)->first();
        $cars = DB::table('carpost')->get();
        $current_year = DB::table('carpost')->max('year');
        $vote_setting = DB::table('vote_setting')->first();
        return view('carpost', compact( 'user', 'car', 'current_year', 'vote_setting'));
    }
    return view('index');
    //return view('carpost',compact('video'));
});

//Vote
//Route::get('/vote',function ()
//
//
//
//});
//Menu pages
//About page
Route::get('/about', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return view('about', compact('user'));
    }

    return view('about');
});
Route::get('/archive', function () {
    $current_year = DB::table('carpost')->max('year');
    $archive_videos = DB::table('carpost')
            ->where([['year', '!=', $current_year]])
            ->orderBy('year', 'desc')
            ->paginate(6);
//    $video_archive_array = array();
//    $counter = 1;
//    foreach ($archive_videos as $archive_video) {
//        $video_archive_array[$counter] = $archive_video;
//        $counter++;
//    }
    if (Auth::check()) {
        $user = Auth::user();
        return view('video_archives', compact('user','archive_videos'));
    }
    return view('video_archives', compact('archive_videos'));
});

//FAQ PAGE
Route::get('/faq', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return view('faq', compact('user'));
    }

    return view('faq');
});

//Suuport

Route::get('/support', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return view('support', compact('user'));
    }

    return view('support');
});

Route::get('/contact', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return view('contact', compact('user'));
    }

    return view('contact');
});

Route::post('contact/email', 'HomeController@sendEmail');

//Post Order
Route::post('car/order', 'OrderController@postCarOrder');

//Dashboard Routes
Route::get('/memberDashboard', 'DashboardController@getUserDashboard');
Route::get('/merchantDashboard', 'DashboardController@getMerchantDashboard');
Route::get('/MPesa', 'DashboardController@MpesaTokenGenerate');

Route::get('/memberDashboard/deposit/pay/{id}', 'DashboardController@getDepositPay');
Route::post('/memberDashboard/deposit/pay', 'DashboardController@postDepositPay');


//Vote
Route::get('/vote', 'HomeController@vote');
Route::get('/NewPost', 'HomeController@getNewPost');


//Post data from register form
Route::post('/', function () {
    return view('index');
});

Auth::routes();

//Member Route
Route::get('/', 'HomeController@index');
Route::get('/page/{page_id}', 'HomeController@page');

//Route for Admin template downloaded by bower
//Route::get('admin', function () {
//    if (Auth::check()) {
//
//        $user = Auth::user();
//        //dd($user->usertype );
//        if ($user->usertype == "admin") {
//            return view('admin.dashboard',compact('user'));
//        }
//        return view('admin.admin404',compact('user'));
//    }
//});
//Admin Route
Route::get('/admin', 'PostDataController@admin');

//Video Route
Route::post('/postvideo', 'CarController@createVideo');
Route::get('admin/video/posted', 'CarController@getAllVideos');
Route::get('admin/video/posted/current', 'CarController@getCurrentVideos');
Route::get('admin/video/posted/open/excel', 'CarController@printAllPostedVideos');
Route::get('admin/video/posted/{userId}', 'CarController@getUserVideos');
Route::get('admin/video/voted', 'CarController@getVotedVideos');
Route::get('admin/video/voted/open/excel', 'CarController@printAllVotedVideos');
Route::get('/admin/video/delete/{video_id}', 'CarController@deleteVideo');
Route::get('admin/video/voted/chart/data', 'CarController@getVideoVotedData');
Route::get('admin/video/viewed/chart/data', 'CarController@getVideoViewedData');
Route::get('admin/video/posted/chart/years', 'CarController@getVideoYears');
Route::get('admin/video/posted/results/bycategory', 'CarController@getVideoResultsByCategories');
Route::get('admin/video/posted/results/{year}', 'CarController@printYearlyResults');
Route::post('admin/video/posted/current/award_points', 'CarController@awardPoints');
Route::get('admin/video/category', 'CarController@getVideoCategory');
Route::post('admin/video/category/add', 'CarController@addVideoCategory');
Route::post('admin/video/category/edit', 'CarController@editVideoCategory');
Route::get('admin/video/category/delete/{category_id}', 'CarController@deleteVideoCategory');

// partner videos
Route::get('admin/video/partner/new', 'CarController@getNewPartnerVideoPost');
Route::post('admin/video/partner/add', 'CarController@createPartnerVideo');
Route::get('admin/video/partner/posted', 'CarController@getAllPartnerVideos');
Route::get('/admin/partner/video/delete/{video_id}', 'CarController@deletePartnerVideo');

Route::get('admin/video/posted/chart/data/{year}', function ($year) {
    $all_videos = array();
    if (Auth::check()) {
        $user = Auth::user();
        //dd($user->usertype );
        if ($user->usertype == "admin" || $user->usertype == "super-user") {
            $all_videos = DB::table('carpost')->where('year', '=', $year)->get();
        }
    } return json_encode($all_videos);
});

//Blog/Post Route
Route::get('/admin/new-post', 'BlogController@newBlog');
Route::post('/admin/post/save', 'BlogController@createBlog');
Route::get('/admin/post/view/list', 'BlogController@getAllPosts');
Route::get('/admin/post/view/{id}', 'BlogController@getBlog');
Route::get('/admin/post/edit/{id}', 'BlogController@getEditBlog');
Route::post('/admin/post/edit', 'BlogController@editBlog');
Route::get('/admin/post/delete/{post_id}', 'BlogController@deleteBlogPost');

//Users route
Route::get('admin/users/{usertype}', 'UserController@getUsers');
Route::get('admin/users/{usertype}/excel', 'UserController@printUsers');
Route::get('admin/users/profile/{user_id}', 'UserController@getUserProfile');
Route::get('admin/users/profile/{user_id}/edit', 'UserController@getUserById');
Route::post('admin/users/profile/edit', 'UserController@editVideo');
Route::get('admin/users/delete/{user_id}', 'UserController@deleteUser');

Route::get('pdf', function () {
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times', '', 12);
    for ($i = 1; $i <= 40; $i++) {
        $pdf->Cell(0, 10, 'Printing line number ' . $i, 0, 1);
        $pdf->Output();
    }
    exit;
});

//Homepage pictures
Route::get('admin/homepage_picture/new', function () {
    if (Auth::check()) {
        $user = Auth::user();
        $message = null;
        if ($user->usertype == "admin" || $user->usertype == "super-user") {
            return view('admin.home_image_post', compact('user', 'message'));
        }
    }
});
Route::post('admin/homepage_picture/front_new_image', function (Request $request) {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->usertype == "admin" || $user->usertype == "super-user") {
            if ($request->hasFile('frontImage')) {
                $image = $request->frontImage;
                $unique = mt_rand(1000000, 9999999);
                $filename = $image->getClientOriginalName();
                $filename = $unique . '_' . $filename;
                $path = public_path('images/' . $filename);
                $frontImageUrl = 'images/' . $filename;
                Image::make($image->getRealPath())->resize(1631, 1080)->save($path);
                $image_content = $request->input('image_content');
                DB::table('home_page_image')->insert(
                        ['image_url' => $frontImageUrl, 'description' => $image_content]
                );
                $message = 'Image saved successfully';
                return view('admin.home_image_post', compact('user', 'message'));
            }
        }
    }
});
Route::get('admin/homepage_picture/list', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->usertype == "admin" || $user->usertype == "super-user") {
            $images = DB::table('home_page_image')->get();
            return view('admin.front_image_list', compact('user', 'images'));
        }
    }
});
Route::get('admin/homepage_picture/delete/{image_id}', function ($image_id) {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->usertype == "admin" || $user->usertype == "super-user") {
            DB::table('home_page_image')->where('id', '=', $image_id)->delete();
            $images = DB::table('home_page_image')->get();
            return view('admin.front_image_list', compact('user', 'images'));
        }
    }
});
Route::get('videos/category/{category_name}', function ($category_name) {
    $current_year = DB::table('carpost')->max('year');
    $video_in_category = DB::table('carpost')
            ->where([['year', '=', $current_year], ['category', '=', $category_name]])
            ->orderBy('id', 'desc')
            ->paginate(6);
    if (Auth::check()) {
        $user = Auth::user();
        return view('car_category', compact('user', 'video_in_category', 'category_name', 'current_year'));
    }
    return view('car_category', compact('video_in_category', 'category_name', 'current_year'));
});

Route::get('admin/vote_setting', function() {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->usertype == "admin" || $user->usertype == "super-user") {
            $vote_setting = DB::table('vote_setting')->first();
            if ($vote_setting->setting == 1) {
                DB::table('vote_setting')
                        ->update(['setting' => 0]);
                return 0;
            } else {
                DB::table('vote_setting')
                        ->update(['setting' => 1]);
                return 1;
            }
        }
    }
});
Route::get('/terms_conditions', function() {
    $filename = 'Terms & Conditions.pdf';
    $path = public_path('documents/' . $filename);
    return response()->file($path);
});
Route::get('/selection_criteria', function() {
    $filename = 'Selection criteria.pdf';
    $path = public_path('documents/' . $filename);
    return response()->file($path);
});
