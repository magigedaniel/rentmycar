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

    //Get Member dashboard based on status
    public function getMemberDashboardOrderStatus(Request $request)
    {
        $status = $request->status;
        //dd($status);
        if (Auth::check()) {
            $user = Auth::user();
            $user_all_order = DB::table('car_order')
                ->where([['user_id', '=', $user->id], ['merchant_approval_status', '=', $status]])
                ->get();
            // dd($user_all_order);
            return view('member_dashboard_status', compact('user', 'user_all_order'));
        }

        return view('auth.login');

    }


    public function getMerchantDashboard(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user_all_order = DB::table('carpost')
                ->where([['userID', '=', $user->id]])
                ->get();
            // dd($user_all_order);
            return view('merchant.merchant_dashboard', compact('user', 'user_all_order'));
        }

        return view('auth.login');

    }

    public function getMerchantDashboardOrderStatus(Request $request)
    {
        $status = $request->status;
        //dd($status);
        if (Auth::check()) {
            $user = Auth::user();
            $user_all_order = DB::table('car_order')
                ->where([['merchant_id', '=', $user->id], ['merchant_approval_status', '=', $status]])
                ->get();
            // dd($user_all_order);
            return view('merchant.merchant_dashboard_status', compact('user', 'user_all_order'));
        }

        return view('auth.login');

    }

    //Merchant get on order action
    public function getOneOrderDetails(Request $request)
    {
        if (Auth::check()) {

            $user = Auth::user();
            //dd($user->usertype );
            $user_all_order = DB::table('car_order')
                ->where([['id', '=', $request->id]])
                ->first();

            // dd($user_all_order);
            $customer = DB::table('users')
                ->select('fname', 'lname')
                ->where([['id', '=', $user_all_order->user_id]])
                ->first();
            //dd($customer);


            if ($user->usertype == "merchant") {
                return view('merchant.actionOrder', compact('user_all_order', 'customer', 'user'));
            }
            return view('admin.admin404', compact('user'));
        }
    }


//Merchant post accept/Reject order
    public function postMerchantOrderStatus(Request $request)
    {

        $status = $request->input('status');
        $id = $request->input('id');

        if ($status == 'accept') {
            DB::table('car_order')
                ->where('id', $id)
                ->update(['merchant_approval_status' => 'Approved']);

            return response()->json(['success' => 'Success Order Accepted. Wait Deposit Payment.']);
        } else {
            DB::table('car_order')
                ->where('id', $id)
                ->update(['merchant_approval_status' => 'Rejected']);

            return response()->json(['error' => 'You have Rejected this Order.']);
        }

    }

//Get details for customer/Members
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

    //Post cash for payment M-pesa
    public function postPaymentAmount(Request $request)
    {
        //http://localhost:8000/testMpesa for testing
        //Calling Mpesa Function to hit Apigee
        //$Mpesa_response = $this->MpesaPayment(1, '254710775577');
        // dd($Mpesa_response);

        if (Auth::check()) {
            $user = Auth::user();
            $phone = $request->input('Phone');
            $amount = $request->input('Amount');
            $order_id = $request->input('order_id');
            $amount_type = $request->input('amount_type');

            //Trim phone no to replace 0 with 254
            $phone = ltrim($phone, '0');
            $phone = '254' . $phone;

            //Calling Mpesa Function to hit Apigee
            $Mpesa_response = $this->MpesaPayment(1, $phone, $order_id, $amount_type);
            if ($Mpesa_response == 'Success') {
                return response()->json(['success' => 'Success']);
            }
            return response()->json(['error' => $Mpesa_response]);

        }
    }

    public function MpesaPayment($amount, $phone, $order_id, $amount_type)
    {
        $access_token = $this->MpesaTokenGenerate();
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $access_token)); //setting custom header


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
            'CallBackURL' => 'http://validate.rentmycar.co.ke/online_api.php',
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
        //return $curl_response;
        if (empty($curl_response->{'errorMessage'})) {

            $this->save_mpesa_apigee_response($curl_response, $order_id, $amount_type);
            return 'Success';
        }
        return $curl_response->{'errorMessage'};


    }


    Public function save_mpesa_apigee_response($Json, $order_id, $amount_type)
        //save detail to the database mpesa status from apigeee
    {
        $user = Auth::user();
        $user_id = $user->id;
        // dd($Json);
        DB::table('mpesa_transaction_status')->insert(
            ['MerchantRequestID' => $Json->{'MerchantRequestID'}, 'CheckoutRequestID' => $Json->{'CheckoutRequestID'}, 'user_id' => $user_id]
        );
        if ($amount_type == 'deposit') {

            DB::table('car_order')
                ->where('id', $order_id)
                ->update([
                        'MerchantRequestID_deposit' => $Json->{'MerchantRequestID'}
                    ]

                );
        }
        else{
            DB::table('car_order')
                ->where('id', $order_id)
                ->update([
                        'MerchantRequestID_balance' => $Json->{'MerchantRequestID'}
                    ]

                );

        }
    }

    Public function post_mpesa_response_check(Request $request)
    {
        //Receive the RAW post data.
        $content = trim(file_get_contents("php://input"));


        //Attempt to decode the incoming RAW post data from JSON.
        $response = json_decode($content);
        // $response=$decoded;

        $ResultCode = $response->{'Body'}->{'stkCallback'}->{'ResultCode'};

        $MerchantRequestID = $response->{'Body'}->{'stkCallback'}->{'MerchantRequestID'};
        $CheckoutRequestID = $response->{'Body'}->{'stkCallback'}->{'ResultCode'};
        $amountPaid = $response->{'Body'}->{'stkCallback'}->{'CallbackMetadata'}->{'Item'}[0]->{'Value'};
        $MpesaReceiptNumber = $response->{'Body'}->{'stkCallback'}->{'CallbackMetadata'}->{'Item'}[1]->{'Value'};
        $TransactionDate = $response->{'Body'}->{'stkCallback'}->{'CallbackMetadata'}->{'Item'}[3]->{'Value'};
        $MpesaPhoneNumber = $response->{'Body'}->{'stkCallback'}->{'CallbackMetadata'}->{'Item'}[4]->{'Value'};


        DB::table('mpesa_transaction_status')
            //->where('MerchantRequestID', $MerchantRequestID)
            ->update([
                // 'MpesaReceiptNumber' => $MpesaReceiptNumber,
                'status' => 'Paid'
            ]);

        //Receive the RAW post data.
        $content = trim(file_get_contents("php://input"));

        //Attempt to decode the incoming RAW post data from JSON.
        $decoded = json_decode($content, true);

        $TransactionType = $decoded['TransactionType'];
        $TransID = $decoded['TransID'];
        $TransTime = $decoded['TransTime'];
        $TransAmount = $decoded['TransAmount'];
        $BusinessShortCode = $decoded['BusinessShortCode'];
        $BillRefNumber = $decoded['BillRefNumber'];
        $InvoiceNumber = $decoded['InvoiceNumber'];
        $OrgAccountBalance = $decoded['OrgAccountBalance'];
        $ThirdPartyTransID = $decoded['ThirdPartyTransID'];
        $MSISDN = $decoded['MSISDN'];
        $FirstName = $decoded['FirstName'];
        $MiddleName = $decoded['MiddleName'];
        $LastName = $decoded['LastName'];

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

    public function test()
    {
        $json = "
        {
  \"Body\": {
    \"stkCallback\": {
      \"MerchantRequestID\": \"13514-847304-1\",
      \"CheckoutRequestID\": \"ws_CO_DMZ_175656984_29112018161509495\",
      \"ResultCode\": 0,
      \"ResultDesc\": \"The service request is processed successfully.\",
      \"CallbackMetadata\": {
        \"Item\": [
          {
            \"Name\": \"Amount\",
            \"Value\": 1
          },
          {
            \"Name\": \"MpesaReceiptNumber\",
            \"Value\": \"MKT57AT9KZ\"
          },
          {
            \"Name\": \"Balance\"
          },
          {
            \"Name\": \"TransactionDate\",
            \"Value\": 20181129161519
          },
          {
            \"Name\": \"PhoneNumber\",
            \"Value\": 254710775577
          }
        ]
      }
    }
  }
}";

        $response = json_decode($json);

        $ResultCode = $response->{'Body'}->{'stkCallback'}->{'ResultCode'};
        $MerchantRequestID = $response->{'Body'}->{'stkCallback'}->{'MerchantRequestID'};
        $CheckoutRequestID = $response->{'Body'}->{'stkCallback'}->{'ResultCode'};
        $amountPaid = $response->{'Body'}->{'stkCallback'}->{'CallbackMetadata'}->{'Item'}[0]->{'Value'};
        $MpesaReceiptNumber = $response->{'Body'}->{'stkCallback'}->{'CallbackMetadata'}->{'Item'}[1]->{'Value'};
        $TransactionDate = $response->{'Body'}->{'stkCallback'}->{'CallbackMetadata'}->{'Item'}[3]->{'Value'};
        $MpesaPhoneNumber = $response->{'Body'}->{'stkCallback'}->{'CallbackMetadata'}->{'Item'}[4]->{'Value'};

        dd($response->{'Body'}->{'stkCallback'}->{'CallbackMetadata'}->{'Item'}[4]->{'Value'});
    }

}
