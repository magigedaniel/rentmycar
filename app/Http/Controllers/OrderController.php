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

class OrderController extends Controller
{
    public function postCarOrder(Request $request)
    {
        //return response()->json(['success' => 'Data is successfully added ']);
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->usertype == "user" ) {


                $number_of_day = $request->NumberOfDay;
                $booking_date_from = $request->startDate;
                $booking_date_to = $request->endDate;
                $phone_used = $request->mpesaMobilePhone;
                $Deposit = $request->DepositAmount;
                $Total_amount = $request->TotalAmount;
                $car_reg=$request->car_reg;
                $balance_amount=$Total_amount-$Deposit;

                $merchant = DB::table('carpost')
                    ->select('userID')
                    ->where('car_reg', '=', $car_reg)
                    ->get();
                $merchant_id=$merchant[0]->userID;

                DB::table('car_order')->insert(
                    [
                        'user_id' => $user->id,
                        'car_ordered_reg' => $car_reg,
                        'merchant_approval_status' => 'Pending',
                        'number_of_days_ordered' => $number_of_day,
                        'Balance_amount' => $balance_amount,
                        'phone_used' => $phone_used,
                        'booking_date_from' => $booking_date_from,
                        'booking_date_to' => $booking_date_to,
                        'deposit_payment_status' => 'Pending',
                        'balance_payment_status' => 'Pending',
                        'total_amount' => $Total_amount,
                        'deposit_amount' => $Deposit,
                        'merchant_id' => $merchant_id

                    ]
                );
                return response()->json(['success' => 'Booking is successfully Placed for car  ' . $car_reg .'go to Dashboard to followup']);
            }
            return response()->json(['error' => 'Create a customer account to rent car (Service available to customer only) ']);
        }
        return response()->json(['error' => 'You are not logged in. Login to rent now ']);

        return redirect('/login');
    }

}
