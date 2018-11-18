<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function view;

class PostDataController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function admin() {
        //$ipAddress = '';

        if (Auth::check()) {

            $user = Auth::user();
            //dd($user->usertype );
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $post_total = DB::table('posts')->count();
                $video_total = DB::table('carpost')->count();
                $user_total = DB::table('users')->count();
                $video_total_voted = DB::table('carpost')->where([['votes', '>', 0]])->count();

                $current_year = DB::table('carpost')->max('year');
                $all_current_videos = DB::table('carpost')->where('year', '=', $current_year)->get();
                $current_video_total_voted = DB::table('carpost')->where([['votes', '>', 0], ['year', '=', $current_year]])->count();
                $current_video_total_viewed = DB::table('carpost')->where([['views', '>', 0], ['year', '=', $current_year]])->count();
                $current_video_total_views = DB::table('carpost')->where([['year', '=', $current_year]])->sum('views');
                $current_video_total_votes = DB::table('carpost')->where([['year', '=', $current_year]])->sum('votes');

                $video_posts_stats = "0% Increase to " . ($current_year - 1);
                $video_views_stats = "0% Increase to " . ($current_year - 1);
                $video_votes_stats = "0% Increase to " . ($current_year - 1);

                $all_last_year_videos = DB::table('carpost')->where('year', '=', ($current_year - 1))->get();
                $last_year_video_total_views = DB::table('carpost')->where([['year', '=', ($current_year - 1)]])->sum('views');
                $last_year_video_total_votes = DB::table('carpost')->where([['year', '=', ($current_year - 1)]])->sum('votes');

                if (count($all_last_year_videos) > 0) {
                    if ((count($all_current_videos) - count($all_last_year_videos)) > 0) {
                        $change = ((count($all_current_videos) - count($all_last_year_videos)) * 100) / count($all_last_year_videos);
                        settype($change, "integer");
                        $video_posts_stats = $change . "% Increase to " . ($current_year - 1);
                    } else {
                        $change = ((count($all_last_year_videos) - count($all_current_videos)) * 100) / count($all_last_year_videos);
                        settype($change, "integer");
                        $video_posts_stats = $change . "% Decrease to " . ($current_year - 1);
                    }

                    if (($current_video_total_views - $last_year_video_total_views) > 0) {
                        $change = (($current_video_total_views - $last_year_video_total_views) * 100) / $last_year_video_total_views;
                        settype($change, "integer");
                        $video_views_stats = $change . "% Increase to " . ($current_year - 1);
                    } else {
                        $change = (($last_year_video_total_views - $current_video_total_views) * 100) / $last_year_video_total_views;
                        settype($change, "integer");
                        $video_views_stats = $change . "% Decrease to " . ($current_year - 1);
                    }

                    if (($current_video_total_votes - $last_year_video_total_votes) > 0) {
                        $change = (($current_video_total_votes - $last_year_video_total_votes) * 100) / $last_year_video_total_votes;
                        settype($change, "integer");
                        $video_votes_stats = $change . "% Increase to " . ($current_year - 1);
                    } else {
                        $change = (($last_year_video_total_votes - $current_video_total_votes) * 100) / $last_year_video_total_votes;
                        settype($change, "integer");
                        $video_votes_stats = $change . "% Decrease to " . ($current_year - 1);
                    }
                }

                $video_categories_array = array();
                foreach ($all_current_videos as $current_video) {
                    $video_categories_array[] = $current_video->category;
                }
                $video_categories_array = array_unique($video_categories_array);
                sort($video_categories_array);
                $winners_array = array();
                for ($i = 0; $i < count($video_categories_array); $i++) {
                    $winner = DB::table('carpost')->where('category', '=', $video_categories_array[$i])->max('votes');
                    $winners_array[$video_categories_array[$i] . ''] = $winner;
                }
                $vote_setting = DB::table('vote_setting')->first();
                $vote_status = $vote_setting->setting;
                return view('admin.dashboard', compact('video_votes_stats', 'video_views_stats', 'video_posts_stats', 'current_video_total_votes', 'current_video_total_views', 'user', 'video_total', 'user_total', 'video_total_voted', 'post_total', 'current_video_total_viewed', 'all_current_videos', 'current_year', 'video_categories_array', 'winners_array', 'current_video_total_voted', 'vote_status'));
            }
            return view('admin.admin404', compact('user'));
        }
    }

    public function deleteVideo(Request $request) {
        if (Auth::check()) {

            $user = Auth::user();
            //dd($user->usertype );
            if ($user->usertype == "super-user") {
                $video_id = $request->id;
                return $video_id;
            }
        }
    }

    public static function getVoteStatus() {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $vote_setting = DB::table('vote_setting')->first();
                return $vote_setting->setting;
            }
        }
    }

}
