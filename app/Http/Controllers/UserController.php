<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;
use function view;

class UserController extends Controller {

    public function getUsers($usertype) {
        //$ipAddress = '';
        if (Auth::check()) {
            $user = Auth::user();
            //dd($user->usertype );
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $users = DB::table('users')->where('usertype', '=', 'user')->get();
                if ($usertype == 'admin') {
                    $users = DB::table('users')->where('usertype', '=', 'admin')->get();
                }if ($usertype == 'all') {
                    $users = DB::table('users')->get();
                }
                $excelUrl = "/admin/users/" . $usertype . "/excel";
                $pdfUrl = "/admin/users/" . $usertype . "/pdf";
//                $video_total = DB::table('carpost')->count();
//                $user_total = DB::table('users')->count();
//                $user_total_voted = DB::table('carpost')->where('votes','!=',0)->count();
                return view('admin.users', compact('user', 'users', 'excelUrl', 'pdfUrl', 'usertype'));
            }
            return view('admin.admin404', compact('user'));
        }
    }

    public function printUsers($usertype) {
        if (Auth::check()) {
            $user = Auth::user();
            //dd($user->usertype );
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $users = DB::table('users')->where('usertype', '=', 'user')->get();
                if ($usertype == 'admin') {
                    $users = DB::table('users')->where('usertype', '=', 'admin')->get();
                }if ($usertype == 'all') {
                    $users = DB::table('users')->get();
                }
                $php_excel = $this->getExcel($users, $usertype);
                $objWriter = PHPExcel_IOFactory::createWriter($php_excel, "Excel2007");
                $file = "" . $usertype . "-users.xlsx";
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header("Content-Disposition: attachment;  filename = $file");
                header('Cache-Control: max-age = 0');
                $objWriter->save('php://output');
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function getExcel($users, $usertype) {
        $php_excel = new PHPExcel();
        $php_excel->setActiveSheetIndex(0);
        $row = 4;
        foreach ($users as $user) {
            $php_excel->getActiveSheet()
                    ->setCellValue('A' . $row, $user->idno)
                    ->setCellValue('B' . $row, $user->fname . ' ' . $user->lname)
                    ->setCellValue('C' . $row, $user->email)
                    ->setCellValue('D' . $row, $user->usertype)
                    ->setCellValue('E' . $row, $user->gender)
                    ->setCellValue('F' . $row, $user->phone)
                    ->setCellValue('G' . $row, $user->university)
                    ->setCellValue('H' . $row, $user->admission_number)
                    ->setCellValue('I' . $row, $user->box)
                    ->setCellValue('J' . $row, $user->code)
                    ->setCellValue('K' . $row, $user->company);
            $row++;
        }

        $php_excel->getActiveSheet()
                ->setCellValue('A1', strtoupper($usertype . ' users'))
                ->setCellValue('A3', 'National ID')
                ->setCellValue('B3', 'Name')
                ->setCellValue('C3', 'Email')
                ->setCellValue('D3', 'User Type')
                ->setCellValue('E3', 'Gender')
                ->setCellValue('F3', 'Phone')
                ->setCellValue('G3', 'University')
                ->setCellValue('H3', 'Admission Number')
                ->setCellValue('I3', 'Box')
                ->setCellValue('J3', 'Code')
                ->setCellValue('K3', 'Company');

        $php_excel->getActiveSheet()->mergeCells('A1:K1');
        $php_excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');
        $php_excel->getActiveSheet()->getStyle('A1')->applyFromArray(
                array(
                    'font' => array(
                        'size' => 24
                    ))
        );
        $php_excel->getActiveSheet()->getStyle('A3:K3')->applyFromArray(
                array(
                    'font' => array(
                        'bold' => true
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                )
        );
        $php_excel->getActiveSheet()->getStyle('A4:K' . ($row - 1))->applyFromArray(
                array(
                    'borders' => array(
                        'outline' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        ),
                        'vertical' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                )
        );


        $php_excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $php_excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $php_excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $php_excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $php_excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $php_excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $php_excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $php_excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $php_excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $php_excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $php_excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        return $php_excel;
    }

    public function getUserProfile($user_id) {
        if (Auth::check()) {
            $user = Auth::user();
            //dd($user->usertype );
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $videos = DB::table('carpost')->where('userID', '=', $user_id)->orderBy('id', 'desc')->get();
                $profile_user = User::find($user_id);
                return view('admin.user-profile', compact('user', 'videos', 'profile_user'));
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function getUserById($user_id) {
        if (Auth::check()) {
            $user = Auth::user();
            //dd($user->usertype );
            if ($user->usertype == "super-user") {
                $profile_user = User::find($user_id);
                return view('admin.user-edit', compact('user', 'profile_user'));
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function editVideo(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();
            //dd($user->usertype );
            if ($user->usertype == "super-user") {
                $user_edit = User::find($request->user_id);
                $user_edit->fname = $request->fname;
                $user_edit->lname = $request->lname;
                $user_edit->email = $request->email;
                $user_edit->gender = $request->gender;
                $user_edit->usertype = $request->user_type;
                $user_edit->phone = $request->phone;
                $user_edit->idno = $request->idno;
                $user_edit->university = $request->university;
                $user_edit->country = $request->country;
                $user_edit->company = $request->company;
                $user_edit->language = $request->language;
                $user_edit->save();
                return $this->getUserProfile($user_edit->id);
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function deleteUser($user_id) {
        if (Auth::check()) {
            $user = Auth::user();
            //dd($user->usertype );
            if ($user->usertype == "super-user") {
                $user_delete = User::find($user_id);
                if (!($user_delete === null)) {
                    $user_delete->delete();
                }
                return $this->getUsers('all');
            }
        }
        return view('admin.admin404', compact('user'));
    }

}
