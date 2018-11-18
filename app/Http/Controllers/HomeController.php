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
        $videos = array();
        $video_categories = DB::table('car_category')->get();
        foreach ($video_categories as $car_category) {
            $video_in_category = DB::table('carpost')
                    ->where([['year', '=', $current_year], ['category', '=', $car_category->name]])
                    ->orderBy('id', 'desc')
                    ->limit(4)
                    ->get();
            $videos[$car_category->name] = $video_in_category;
        }
        $partner_videos = DB::table('partner_videos')->where('category', '=', 'Partner')
                ->orderBy('id', 'desc')
                ->limit(16)
                ->get();
        $university_videos = DB::table('partner_videos')->where('category', '=', 'University')
                ->orderBy('id', 'desc')
                ->limit(8)
                ->get();
        $front_images = DB::table('home_page_image')->get();
        if (Auth::user()) {
            $user = Auth::user();
            //dd($user);
            return view('index', compact('user', 'videos', 'partner_videos', 'university_videos', 'video_categories', 'front_images'));
        } else {
            return view('index', compact('videos', 'partner_videos', 'university_videos', 'video_categories', 'front_images'));
        }
    }

    //New get new posts
    public function getNewPost() {
        if (Auth::check()) {
            $user = Auth::user();
            $video_categories = DB::table('car_category')->get();
            $error = "";
            return view('postnew_video', compact('user', 'video_categories', 'error'));
        }
        return view('auth.login');
    }

    //Method that return pages
    public function vote() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        //echo $ipaddress;

        $id = $_GET['video'];
        $video = DB::table('carpost')->where('id', $id)->first();
//        $voters = DB::table('voters')->where('ip', $ipaddress)->first();
        $voters = DB::table('voters')->where('ip', $ipaddress)->get();
        $user_voted = false;
        foreach ($voters as $voter) {
            if ($voter->category . '' == $video->category . '') {
                $user_voted = true;
            }
        }
//        if (!$voters) {
        if (!($user_voted == true)) {
//user can vote more than once depending on number of video categories


            DB::table('voters')->insert(
                    ['ip' => $ipaddress, 'category' => $video->category]
            );
            DB::table('carpost')->where('id', $id)->increment('votes');
            $user_voted = true;
        }
        $videos = DB::table('carpost')->where('id', $id)->get();
        $video = DB::table('carpost')->where('id', $id)->first();
        $total_votes = DB::table('carpost')->where([['year', '=', $video->year], ['category', '=', $video->category]])->sum('votes');
        $all_videos_in_category = DB::table('carpost')->where([['year', '=', $video->year], ['category', '=', $video->category]])->get();
        foreach ($all_videos_in_category as $video_in_category) {
            $video_percentage = ($video_in_category->votes / $total_votes) * 30;
            DB::table('carpost')
                    ->where('id', '=', $video_in_category->id)
                    ->update(['votes_percentage' => $video_percentage]);
        }
        //$voters = DB::table('voters')->where('ip', $ipaddress)->get();
        //update positions
        $all_videos_in_category = DB::table('carpost')->where([['year', '=', $video->year], ['category', '=', $video->category]])->get();
        $percentages = array();
        foreach ($all_videos_in_category as $video_in_category) {
            $percentages[$video_in_category->id] = ($video_in_category->votes_percentage + $video_in_category->points_percentage);
        }
        arsort($percentages);
        $position = 1;
        $positions = array();
        foreach ($percentages as $key => $value) {
            if (!(array_key_exists($value . '', $positions))) {
                $positions[$value] = $position;
            }
            $position++;
        }
        foreach ($percentages as $key => $value) {
            DB::table('carpost')
                    ->where('id', '=', $key)
                    ->update(['position' => $positions[$value]]);
        }
        $current_year = DB::table('carpost')->max('year');
        return view('carpost', compact('videos', 'user', 'video', 'user_voted', 'current_year','vote_setting'));
        /*
          By Magige Daniel to replace IP voting
          if (Auth::check()) {

          if ($_GET['video']) {
          $user = Auth::user();
          $id = $_GET['video'];
          DB::table('users')
          ->where('id', $user->id)
          ->update(['voted' => 1]);
          DB::table('carpost')->where('id', $id)->increment('votes');
          $videos = DB::table('carpost')->where('id', $id)->get();

          return view('carpost', compact('videos', 'user'));
          }

          }
          return view('auth.login'); */
    }

    public function sendEmail(Request $request) {
        $to = "ewanyonyi@deasff.com";
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
