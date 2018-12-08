<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function view;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index() {
        //dd('sssas');
        $current_year = DB::table('carpost')->max('year');
        $cars = array();
        $car_categories = DB::table('car_category')->get();
        foreach ($car_categories as $car_category) {
            $car_in_category = DB::table('carpost')
                ->where([ ['category', '=', $car_category->name]])
                ->orderBy('id', 'desc')
                ->limit(4)
                ->get();
            $cars[$car_category->name] = $car_in_category;
        }
        $front_images = DB::table('home_page_image')->get();
        if (Auth::user()) {
            $user = Auth::user();
            //dd($user);
            return view('index', compact('user', 'cars', 'video_categories', 'front_images'));
        } else {
            return view('index', compact('cars',  'university_cars', 'video_categories', 'front_images'));
        }
    }

    //New get new posts
    public function getNewPost() {
        if (Auth::check()) {
            $user = Auth::user();
            if($user->usertype=='merchant')
            {
            $car_categories = DB::table('car_category')->get();
            $car_cc = DB::table('car_cc')->get();
            $error = "";
            return view('postnew_car', compact('user', 'car_categories','car_cc', 'error'));
            }

        }
        return view('auth.login');
    }

    //Method that return pages

    public function sendEmail(Request $request) {
        $to = "magigedaniel@gmail.com";
        $subject = $request->input('subject');
        $txt = $request->input('message');
        $name = $request->input('name');
        $phone = $request->input('mobile');
        $email = $request->input('email');
        $from = 'Name: ' . $name . ' Email: ' . $email . ' Phone' . $phone;
        $headers = "From: " . $from;
        mail($to, $subject, $txt, $headers);
        if (Auth::check()) {
            $user = Auth::user();
            return view('contact', compact('user'));
        }
        return view('contact');
    }

}
