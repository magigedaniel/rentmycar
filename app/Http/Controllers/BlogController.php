<?php

namespace App\Http\Controllers;

use App\Post as Posts;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use function view;

class BlogController extends Controller {

    public function newBlog() {
        $user = Auth::user();
        //dd($user->usertype );
        if ($user->usertype == "admin" || $user->usertype == "super-user") {
            $title = "New Post";
            $description = "Description";
            $post = new Posts();
            $action = "/admin/post/save";
            $submit_value = "Save Post!";
            return view('admin.post', compact('post', 'user', 'title', 'description', 'action', 'submit_value'));

//            return view('admin.post', compact('user', 'title', 'description'));
        }
        return view('admin.admin404', compact('user'));
//        return view('admin.post');
    }

    public function createBlog() {
        //IP address Get
//        // Check for X-Forwarded-For headers and use those if found
//        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ('' !== trim($_SERVER['HTTP_X_FORWARDED_FOR']))) {
//            $ipAddress = trim($_SERVER['HTTP_X_FORWARDED_FOR']);
//        } else {
//            if (isset($_SERVER['REMOTE_ADDR']) && ('' !== trim($_SERVER['REMOTE_ADDR']))) {
//                $ipAddress = trim($_SERVER['REMOTE_ADDR']);
//            }
//        }
//        dd($ipAddress);

        $posts = new Posts;
        $auth_user_email = Auth::User()->email;
        $title = Input::get('title');
        $content = Input::get('content');

        $posts->title = $title;
        $posts->content = $content;
        $posts->email = $auth_user_email;
        $posts->save();
        return $this->getAllPosts();
        //dd($content);
        //return view('admin.post');
    }

    public function editBlog() {
        //IP address Get
//        // Check for X-Forwarded-For headers and use those if found
//        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ('' !== trim($_SERVER['HTTP_X_FORWARDED_FOR']))) {
//            $ipAddress = trim($_SERVER['HTTP_X_FORWARDED_FOR']);
//        } else {
//            if (isset($_SERVER['REMOTE_ADDR']) && ('' !== trim($_SERVER['REMOTE_ADDR']))) {
//                $ipAddress = trim($_SERVER['REMOTE_ADDR']);
//            }
//        }
//        dd($ipAddress);
        $id = Input::get('id');
        $post = Posts::find($id);
        $title = Input::get('title');
        $content = Input::get('content');

        $post->title = $title;
        $post->content = $content;
        $post->save();
        return $this->getAllPosts();
        //dd($content);
        //return view('admin.post');
    }

    public function getAllPosts() {
        if (Auth::check()) {

            $user = Auth::user();
            //dd($user->usertype );
            $posts = Posts::all();
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                return view('admin.post-list', ['posts' => $posts, 'user' => $user, 'title' => 'Blog Posts']);
            }
            return view('admin.admin404', compact('user'));
        }
    }

    public function getBlog($id) {
        if (Auth::check()) {

            $user = Auth::user();
            //dd($user->usertype );
            $post = Posts::find($id);
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                return view('admin.post-view', ['post' => $post, 'user' => $user]);
            }
            return view('admin.admin404', compact('user'));
        }
    }

    public function getEditBlog($id) {
        if (Auth::check()) {

            $user = Auth::user();
            //dd($user->usertype );
            $post = Posts::find($id);
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $title = $post->title . " Post - edit";
                $description = "Description";
                $action = "/admin/post/edit";
                $submit_value = "Update Post!";
                return view('admin.post', compact('post', 'user', 'title', 'description', 'action', 'submit_value'));
            }
            return view('admin.admin404', compact('user'));
        }
    }
public function deleteBlogPost($id) {
        if (Auth::check()) {
            $user = Auth::user();
//dd($user->usertype );
            if ($user->usertype == "super-user") {
                DB::table('posts')->where('id', '=', $id)->delete();
                return $this->getAllPosts();
            }
        }
    }
}
