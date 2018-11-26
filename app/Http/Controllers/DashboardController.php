<?php

namespace App\Http\Controllers;

use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;
use function public_path;
use function redirect;
use function view;

class DashboardController extends Controller
{
    public function getUserDashboard(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user_all_order = DB::table('car_order')
                ->where([['user_id', '=', $user->id]])
                ->get();
            // dd($user_all_order);
            return view('customer_dashboard', compact('user', 'user_all_order'));
        }

        return view('auth.login');

    }

    public function getMerchantDashboard(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user_all_order = DB::table('car_order')
                ->where([['merchant_id', '=', $user->id]])
                ->get();
            // dd($user_all_order);
            return view('merchant.merchant_dashboard', compact('user', 'user_all_order'));
        }

        return view('auth.login');

    }


    public function getDepositPay(Request $request) {
        if (Auth::check()) {

            $user = Auth::user();
            //dd($user->usertype );
            $user_all_order = DB::table('car_order')
                ->where([['id', '=', $request->id]])
                ->first();

            if ($user->usertype == "user") {
                return view('payment',compact('user_all_order','user'));
            }
            return view('admin.admin404', compact('user'));
        }
    }

}
