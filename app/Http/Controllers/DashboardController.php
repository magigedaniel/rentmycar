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
use Carbon\Carbon;


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


    public function getDepositPay(Request $request)
    {
        if (Auth::check()) {

            $user = Auth::user();
            //dd($user->usertype );
            $user_all_order = DB::table('car_order')
                ->where([['id', '=', $request->id]])
                ->first();

            if ($user->usertype == "user") {
                return view('payment', compact('user_all_order', 'user'));
            }
            return view('admin.admin404', compact('user'));
        }
    }

    public function postDepositPay(Request $request)
    {
        //http://localhost:8000/testMpesa for testing
        //Calling Mpesa Function to hit Apigee
        //$Mpesa_response = $this->MpesaPayment('', '254710775577');
        //dd($Mpesa_response);

        if (Auth::check()) {
            $user = Auth::user();
            $phone = $request->input('Phone');
            $amount = $request->input('Amount');

            //Trim phone no to replace 0 with 254
            $phone = ltrim($phone, '0');
            $phone = '254' . $phone;

            //Calling Mpesa Function to hit Apigee
            $Mpesa_response = $this->MpesaPayment(1, $phone);
            if($Mpesa_response=='Success'){
                return response()->json(['success' => 'Check your phone to enter M-Pesa Pin to Complete Payments ']);
            }
            return response()->json(['error' => $Mpesa_response]);

        }
    }

    public function MpesaPayment($amount, $phone)
    {
        $access_token = $this->MpesaTokenGenerate();
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer '.$access_token)); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => '174379',
            'Password' => 'MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMTgxMTIwMTExNjMw',
            'Timestamp' => '20181120111630',
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $phone,
            'PartyB' => '174379',
            'PhoneNumber' => $phone,
            'CallBackURL' => 'http://mobitechleo.com/mpesa_api.php',
            'AccountReference' => 'RentMyCar',
            'TransactionDesc' => 'danTest'
        );

        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $curl_response = curl_exec($curl);
        curl_close($curl);
        $curl_response = json_decode($curl_response);
        if (empty($curl_response->{'errorMessage'})){
            return 'Success';
        }
        return $curl_response->{'errorMessage'};


    }

    //Method to generate access token
    Public function MpesaTokenGenerate()
    {
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        $credentials = base64_encode('csyTPQ2MV39Dw3jpYnuRWhreAf1ospog:Enu5fwa0WUu5pHWB');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials)); //setting a custom header
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $curl_response = json_decode($curl_response);
        $access_token = $curl_response->{'access_token'};
        //Retrun access token to calling function
        return $access_token;

    }

}
