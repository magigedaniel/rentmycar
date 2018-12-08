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

class CarController extends Controller {

    public function createCar(Request $request) {
        $userId = Auth::user()->id;
        if ($request->hasFile('vimage')) {
            $error = null;

            $image = $request->vimage;

            $unique = mt_rand(1000000, 9999999);

            $filename = $image->getClientOriginalName();
// $filename = 'ID-'.$unique.'-'.$image;
            $filename = $unique . '_' . $filename;

            $path = public_path('images/car/' . $filename);
            $vimageurl = 'images/car/' . $filename;

            Image::make($image->getRealPath())->resize(200, 150)->save($path);
//$path = storage_path() . '/' . $filename;
        }


//        $vurl = $request->input('vurl');
        $cartitle = $request->input('cartitle');
        $car_content = $request->input('car_content');
        $vcategory = $request->input('category');
        $car_reg=$request->input('car_reg');
        $PricePerDay=$request->input('PricePerDay');
        $year = date("Y");

        DB::table('carpost')->insert(
                ['userID' => $userId, 'title' => $cartitle, 'videoUrl' => $vimageurl, 'imageurl' => $vimageurl, 'content' => $car_content, 'category' => $vcategory,'car_reg'=>$car_reg,'price_per_day'=>$PricePerDay, 'year' => $year]
        );
//Redirect to that video
        $videoId = DB::table('carpost')->where('userID', $userId)->pluck('id')->last();
        return redirect('/rentCar?car=' . $videoId);
    }

    public function getVideoById($id) {

    }

    public function updateVideo($id) {

    }

    public function deleteVideo($id) {
        if (Auth::check()) {
            $user = Auth::user();
//dd($user->usertype );
            if ($user->usertype == "super-user") {
                DB::table('carpost')->where('id', '=', $id)->delete();
                return $this->getAllVideos();
            }
        }
    }

    public function getAllVideos() {
//$ipAddress = '';

        if (Auth::check()) {

            $user = Auth::user();
//dd($user->usertype );
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $videos = DB::table('carpost')
                        ->leftJoin('users', 'carpost.userID', '=', 'users.id')
                        ->select('carpost.*', 'users.fname', 'users.lname')
                        ->get();
                $current_year = DB::table('carpost')->max('year');
//                $video_total = DB::table('carpost')->count();
//                $user_total = DB::table('users')->count();
//                $user_total_voted = DB::table('carpost')->where('votes','!=',0)->count();
                $title = 'Posted Videos';
                $excelUrl = "/admin/video/posted/open/excel";
                return view('admin.video', compact('user', 'title', 'videos', 'excelUrl', 'current_year'));
            }
            return view('admin.admin404', compact('user'));
        }
    }

    public function getUserVideos($userId) {
//$ipAddress = '';

        if (Auth::check()) {

            $user = Auth::user();
//dd($user->usertype );
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $videos = DB::table('carpost')
                        ->join('users', 'carpost.userID', '=', 'users.id')
                        ->select('carpost.*', 'users.fname', 'users.lname')
                        ->where('users.id', '=', $userId)
                        ->orderby('votes', 'asc')
                        ->get();
//                $video_total = DB::table('carpost')->count();
//                $user_total = DB::table('users')->count();
//                $user_total_voted = DB::table('carpost')->where('votes','!=',0)->count();
                $title = 'Posted Videos';
                $excelUrl = "/admin/video/posted/open/excel";
                return view('admin.video', compact('user', 'title', 'videos', 'excelUrl'));
            }
            return view('admin.admin404', compact('user'));
        }
    }

    public function getVotedVideos() {
//$ipAddress = '';

        if (Auth::check()) {

            $user = Auth::user();
//dd($user->usertype );
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $videos = DB::table('carpost')
                        ->leftJoin('users', 'carpost.userID', '=', 'users.id')
                        ->select('carpost.*', 'users.fname', 'users.lname')
                        ->where('votes', '>', 0)
                        ->orderby('votes', 'desc')
                        ->get();
                $current_year = DB::table('carpost')->max('year');
//                $video_total = DB::table('carpost')->count();
//                $user_total = DB::table('users')->count();
//                $user_total_voted = DB::table('carpost')->where('votes','!=',0)->count();
//                return view('admin.video', compact('user', 'videos'));$title = 'Posted Videos';
                $title = 'Voted Videos';
                $excelUrl = "/admin/video/voted/open/excel";
                return view('admin.video', compact('user', 'title', 'videos', 'current_year', 'excelUrl'));
            }
            return view('admin.admin404', compact('user'));
        }
    }

    public function printAllPostedVideos() {
        if (Auth::check()) {

            $user = Auth::user();
//dd($user->usertype );
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $php_excel = new PHPExcel();
                $php_excel->setActiveSheetIndex(0);
                $videos = DB::table('carpost')
                        ->leftJoin('users', 'carpost.userID', '=', 'users.id')
                        ->select('carpost.*', 'users.fname', 'users.lname')
                        ->orderBy('year', 'votes', 'desc')
                        ->get();
                $current_year = DB::table('carpost')->max('year');
                $row = 4;
                foreach ($videos as $video) {
                    if ($user->usertype == "super-user") {
                        $php_excel->getActiveSheet()
                                ->setCellValue('A' . $row, $video->title)
                                ->setCellValue('B' . $row, $video->category)
                                ->setCellValue('C' . $row, $video->year)
                                ->setCellValue('D' . $row, $video->fname)
                                ->setCellValue('E' . $row, $video->vdirector)
                                ->setCellValue('F' . $row, $video->votes)
                                ->setCellValue('G' . $row, $video->points)
                                ->setCellValue('H' . $row, $video->votes_percentage)
                                ->setCellValue('I' . $row, $video->points_percentage)
                                ->setCellValue('J' . $row, $video->votes_percentage + $video->points_percentage)
                                ->setCellValue('K' . $row, $video->position);
                    } else {
                        if ($video->year . '' === $current_year . '') {
                            $php_excel->getActiveSheet()
                                    ->setCellValue('A' . $row, $video->title)
                                    ->setCellValue('B' . $row, $video->category)
                                    ->setCellValue('C' . $row, $video->year)
                                    ->setCellValue('D' . $row, $video->fname)
                                    ->setCellValue('E' . $row, $video->vdirector)
                                    ->setCellValue('F' . $row, "")
                                    ->setCellValue('G' . $row, "")
                                    ->setCellValue('H' . $row, "")
                                    ->setCellValue('I' . $row, "")
                                    ->setCellValue('J' . $row, "")
                                    ->setCellValue('K' . $row, "");
                        }
                    }
                    $row++;
                }

                $php_excel->getActiveSheet()
                        ->setCellValue('A1', 'POSTED VIDEOS')
                        ->setCellValue('A3', 'Title')
                        ->setCellValue('B3', 'Category')
                        ->setCellValue('C3', 'Year')
                        ->setCellValue('D3', 'Posted By')
                        ->setCellValue('E3', 'Video Director')
                        ->setCellValue('F3', 'Number of Votes')
                        ->setCellValue('G3', 'Points')
                        ->setCellValue('H3', 'Percentage Votes')
                        ->setCellValue('I3', 'Percentage Points')
                        ->setCellValue('J3', 'Total percentage')
                        ->setCellValue('K3', 'Position');
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


                $objWriter = PHPExcel_IOFactory::createWriter($php_excel, "Excel2007");

                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;  filename = "posted videos.xlsx"');
                header('Cache-Control: max-age = 0');

                $objWriter->save('php://output');
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function printAllVotedVideos() {
        if (Auth::check()) {
            $user = Auth::user();
//dd($user->usertype );
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $php_excel = new PHPExcel();
                $php_excel->setActiveSheetIndex(0);
                $videos = DB::table('carpost')
                        ->leftJoin('users', 'carpost.userID', '=', 'users.id')
                        ->select('carpost.*', 'users.fname', 'users.lname')
                        ->where('votes', '>', 0)
                        ->orderby('year', 'votes', 'desc')
                        ->get();
                $row = 4;
                foreach ($videos as $video) {
                    if ($user->usertype == "super-user") {
                        $php_excel->getActiveSheet()
                                ->setCellValue('A' . $row, $video->title)
                                ->setCellValue('B' . $row, $video->category)
                                ->setCellValue('C' . $row, $video->year)
                                ->setCellValue('D' . $row, $video->fname)
                                ->setCellValue('E' . $row, $video->vdirector)
                                ->setCellValue('F' . $row, $video->votes)
                                ->setCellValue('G' . $row, $video->points)
                                ->setCellValue('H' . $row, $video->votes_percentage)
                                ->setCellValue('I' . $row, $video->points_percentage)
                                ->setCellValue('J' . $row, $video->votes_percentage + $video->points_percentage)
                                ->setCellValue('K' . $row, $video->position);
                    } else {
                        if ($video->year . '' === $current_year . '') {
                            $php_excel->getActiveSheet()
                                    ->setCellValue('A' . $row, $video->title)
                                    ->setCellValue('B' . $row, $video->category)
                                    ->setCellValue('C' . $row, $video->year)
                                    ->setCellValue('D' . $row, $video->fname)
                                    ->setCellValue('E' . $row, $video->vdirector)
                                    ->setCellValue('F' . $row, "")
                                    ->setCellValue('G' . $row, "")
                                    ->setCellValue('H' . $row, "")
                                    ->setCellValue('I' . $row, "")
                                    ->setCellValue('J' . $row, "")
                                    ->setCellValue('K' . $row, "");
                        }
                    }
                    $row++;
                }

                $php_excel->getActiveSheet()
                        ->setCellValue('A1', 'VOTED VIDEOS')
                        ->setCellValue('A3', 'Title')
                        ->setCellValue('B3', 'Category')
                        ->setCellValue('C3', 'Year')
                        ->setCellValue('D3', 'Posted By')
                        ->setCellValue('E3', 'Video Director')
                        ->setCellValue('F3', 'Number of Votes')
                        ->setCellValue('G3', 'Points')
                        ->setCellValue('H3', 'Percentage Votes')
                        ->setCellValue('I3', 'Percentage Points')
                        ->setCellValue('J3', 'Total percentage')
                        ->setCellValue('K3', 'Position');

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



                $objWriter = PHPExcel_IOFactory::createWriter($php_excel, "Excel2007");

                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;  filename = "voted videos.xlsx"');
                header('Cache-Control: max-age = 0');

                $objWriter->save('php://output');
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function getVideoVotedData() {
        if (Auth::check()) {

            $user = Auth::user();
//dd($user->usertype );
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $voted_videos = DB::table('carpost')
                        ->select(DB::raw('count(*) as votes, year'))
                        ->where([['votes', '>', 0], ['year', '>', 0]])
                        ->groupBy('year')
                        ->orderBy('year', 'asc')
                        ->get();
                $voted_videos_array = array();
                $years = array();
                foreach ($voted_videos as $voted_video) {
                    $voted_videos_array['' . $voted_video->year] = $voted_video->votes;
                    $years[] = $voted_video->year;
                }
                $un_voted_videos = DB::table('carpost')
                        ->select(DB::raw('count(*) as votes, year'))
                        ->where([['votes', '=', 0], ['year', '>', 0]])
                        ->groupBy('year')
                        ->orderBy('year', 'asc')
                        ->get();
                $un_voted_videos_array = array();
                foreach ($un_voted_videos as $un_voted_video) {
                    $un_voted_videos_array['' . $un_voted_video->year] = $un_voted_video->votes;
                    $years[] = $un_voted_video->year;
                }
                $years = array_unique($years);
                sort($years);
                for ($i = 0; $i < count($years); $i++) {
                    try {
                        $value1 = $voted_videos_array['' . $years[$i]];
                    } catch (ErrorException $ex) {
                        $voted_videos_array['' . $years[$i]] = 0;
                    }
                    try {
                        $value2 = $un_voted_videos_array['' . $years[$i]];
                    } catch (ErrorException $ex) {
                        $un_voted_videos_array['' . $years[$i]] = 0;
                    }
                }
                return view('admin.voted_video_charts', compact('user', 'voted_videos_array', 'un_voted_videos_array', 'years'));
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function getVideoViewedData() {
        if (Auth::check()) {
            $user = Auth::user();
//dd($user->usertype );
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $viewed_videos = DB::table('carpost')
                        ->select(DB::raw('count(*) as views, year'))
                        ->where([['views', '>', 0], ['year', '>', 0]])
                        ->groupBy('year')
                        ->orderBy('year', 'asc')
                        ->get();
                $viewed_videos_array = array();
                $years = array();
                foreach ($viewed_videos as $viewed_video) {
                    $viewed_videos_array['' . $viewed_video->year] = $viewed_video->views;
                    $years[] = $viewed_video->year;
                }
                $un_viewed_videos = DB::table('carpost')
                        ->select(DB::raw('count(*) as views, year'))
                        ->where([['views', '=', 0], ['year', '>', 0]])
                        ->groupBy('year')
                        ->orderBy('year', 'asc')
                        ->get();
                $un_viewed_videos_array = array();
                foreach ($un_viewed_videos as $un_viewed_video) {
                    $un_viewed_videos_array['' . $un_viewed_video->year] = $un_viewed_video->views;
                    $years[] = $un_viewed_video->year;
                }
                $years = array_unique($years);
                sort($years);
                for ($i = 0; $i < count($years); $i++) {
                    try {
                        $value1 = $viewed_videos_array['' . $years[$i]];
                    } catch (ErrorException $ex) {
                        $viewed_videos_array['' . $years[$i]] = 0;
                    }
                    try {
                        $value2 = $un_viewed_videos_array['' . $years[$i]];
                    } catch (ErrorException $ex) {
                        $un_viewed_videos_array['' . $years[$i]] = 0;
                    }
                }
                return view('admin.viewed_video_charts', compact('user', 'viewed_videos_array', 'un_viewed_videos_array', 'years'));
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function getVideoYears() {
        if (Auth::check()) {
            $user = Auth::user();
//dd($user->usertype );
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $videos = DB::table('carpost')->get();
                $years = array();
                foreach ($videos as $video) {
                    $years[] = $video->year;
                }
                $years = array_unique($years);
                rsort($years);
                $video_array = array();
                for ($i = 0; $i < count($years); $i++) {
                    $all_videos = DB::table('carpost')->where('year', '=', $years[$i])->get();
                    $video_array[$years[$i] . ''] = $all_videos;
                }
                return view('admin.video_voting_charts', compact('user', 'years', 'video_array'));
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function getVideoResultsByCategories() {
        if (Auth::check()) {
            $user = Auth::user();
//dd($user->usertype );
            $current_year = DB::table('carpost')->max('year');
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                if ($user->usertype == "admin") {
                    $videos = DB::table('carpost')->where('year', '!=', $current_year)->get();
                } else {
                    $videos = DB::table('carpost')->get();
                }
                $years = array();
                foreach ($videos as $video) {
                    $years[] = $video->year;
                }
                $years = array_unique($years);
                rsort($years);
                $videos_by_category = array();
                $yearly_car_category = array();
                for ($i = 0; $i < count($years); $i++) {
                    $video_categories_array = array();
                    $all_current_videos = DB::table('carpost')->where('year', '=', $years[$i])->orderBy('votes', 'points', 'desc')->get();
                    foreach ($all_current_videos as $current_video) {
                        $video_categories_array[] = $current_video->category;
                    }
                    $video_categories_array = array_unique($video_categories_array);
                    sort($video_categories_array);
                    $yearly_car_category[$years[$i] . ''] = $video_categories_array;
                    for ($j = 0; $j < count($video_categories_array); $j++) {
                        $category_videos = DB::table('carpost')
                                ->leftJoin('users', 'carpost.userID', '=', 'users.id')
                                ->select('carpost.*', 'users.fname', 'users.lname')
                                ->where([['category', '=', $video_categories_array[$j]], ['year', '=', $years[$i]]])
                                ->orderBy('position', 'asc')
                                ->get();
                        $videos_by_category[$video_categories_array[$j] . '-' . $years[$i]] = $category_videos;
                    }
                }
                return view('admin.car_category_results', compact('user', 'years', 'yearly_car_category', 'videos_by_category'));
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function printYearlyResults($year) {
        if (Auth::check()) {
            $user = Auth::user();
//dd($user->usertype );
            if ($user->usertype == "super-user") {
                $php_excel = new PHPExcel();
                $php_excel->setActiveSheetIndex(0);
                $php_excel->getActiveSheet()->setCellValue('A1', $year . "  VIDEO VOTES RESULTS");
                $videos_by_category = array();
                $video_categories_array = array();
                $all_current_videos = DB::table('carpost')->where('year', '=', $year)->orderBy('votes', 'points', 'desc')->get();
                foreach ($all_current_videos as $current_video) {
                    $video_categories_array[] = $current_video->category;
                }
                $video_categories_array = array_unique($video_categories_array);
                sort($video_categories_array);

                $row = 5;
                $header_position = 4;
                $header_positions = array();
                foreach ($video_categories_array as $car_category) {
                    $header_positions[] = $header_position;
                    $videos = DB::table('carpost')
                            ->leftJoin('users', 'carpost.userID', '=', 'users.id')
                            ->select('carpost.*', 'users.fname', 'users.lname')
                            ->where([['category', '=', $car_category], ['year', '=', $year]])
                            ->orderBy('votes', 'desc')
                            ->get();

                    $php_excel->getActiveSheet()
                            ->setCellValue('A' . ($header_position - 1), $car_category)
                            ->setCellValue('A' . $header_position, 'Title')
                            ->setCellValue('B' . $header_position, 'Uploaded By')
                            ->setCellValue('C' . $header_position, 'Director')
                            ->setCellValue('D' . $header_position, 'Votes')
                            ->setCellValue('E' . $header_position, 'Points')
                            ->setCellValue('F' . $header_position, 'Percentage votes')
                            ->setCellValue('G' . $header_position, 'Percentage points')
                            ->setCellValue('H' . $header_position, 'Total Percentage')
                            ->setCellValue('I' . $header_position, 'Position');

                    foreach ($videos as $video) {
                        $php_excel->getActiveSheet()
                                ->setCellValue('A' . $row, $video->title)
                                ->setCellValue('B' . $row, $video->fname . ' ' . $video->lname)
                                ->setCellValue('C' . $row, $video->vdirector)
                                ->setCellValue('D' . $row, $video->votes)
                                ->setCellValue('E' . $row, $video->points)
                                ->setCellValue('F' . $row, $video->votes_percentage)
                                ->setCellValue('G' . $row, $video->points_percentage)
                                ->setCellValue('H' . $row, $video->votes_percentage + $video->points_percentage)
                                ->setCellValue('I' . $row, $video->position);
                        $row++;
                    }
                    $header_position = ($row + 3);
                    $row += 4;
                }
                $php_excel->getActiveSheet()->mergeCells('A1:I1');
                $php_excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');
                $php_excel->getActiveSheet()->getStyle('A1')->applyFromArray(
                        array(
                            'font' => array(
                                'size' => 24
                            ))
                );
                foreach ($header_positions as $value) {
                    $php_excel->getActiveSheet()->mergeCells('A' . ($value - 1) . ':I' . ($value - 1));
                    $php_excel->getActiveSheet()->getStyle('A' . ($value - 1))->getAlignment()->setHorizontal('center');
                    $php_excel->getActiveSheet()->getStyle('A' . ($value - 1))->applyFromArray(
                            array(
                                'font' => array(
                                    'size' => 18
                                ))
                    );
                }
                foreach ($header_positions as $value) {
                    $php_excel->getActiveSheet()->getStyle('A' . $value . ':I' . $value)->applyFromArray(
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
                }


                $php_excel->getActiveSheet()->getStyle('A4:I' . ($row - 3))->applyFromArray(
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

                foreach ($header_positions as $value) {
                    $php_excel->getActiveSheet()->getStyle('A4:I' . ($value - 2))->applyFromArray(
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
                }


                $php_excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                $php_excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                $php_excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
                $php_excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
                $php_excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                $php_excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
                $php_excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
                $php_excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
                $php_excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);


                $objWriter = PHPExcel_IOFactory::createWriter($php_excel, "Excel2007");

                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;  filename = "video votes results.xlsx"');
                header('Cache-Control: max-age = 0');

                $objWriter->save('php://output');
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function getCurrentVideos() {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $current_year = DB::table('carpost')->max('year');
                $user_points_award = array();
                $videos = DB::table('carpost')
                        ->leftJoin('users', 'carpost.userID', '=', 'users.id')
                        ->select('carpost.*', 'users.fname', 'users.lname')
                        ->where('carpost.year', '=', $current_year)
                        ->get();
                foreach ($videos as $video) {
                    $user_points_award[$video->id . ''] = 0;
                }
                $points_award = DB::table('points_award')
                        ->where('user_id', '=', $user->id)
                        ->get();
                foreach ($points_award as $point_award) {
                    $user_points_award[$point_award->video_id . ''] = $point_award->points;
                }
                $title = $current_year . ' Posted Videos Dashboard';
                return view('admin.current_videos', compact('user', 'videos', 'title', 'current_year', 'user_points_award'));
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function awardPoints(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $video_id = $request->input('video_id');
                $points = $request->input('points');
                $points_awarded = DB::table('points_award')->where([['user_id', '=', $user->id], ['video_id', '=', $video_id]])->first();
                if (!($points_awarded)) {
                    DB::table('points_award')->insert(
                            ['user_id' => $user->id, 'video_id' => $video_id, 'points' => $points]
                    );
                } else {
                    DB::table('points_award')
                            ->where([['user_id', '=', $user->id], ['video_id', '=', $video_id]])
                            ->update(['points' => $points]);
                }
                $total_points_awarded = DB::table('points_award')
                        ->where('video_id', '=', $video_id)
                        ->sum('points');
                DB::table('carpost')
                        ->where('id', '=', $video_id)
                        ->update(['points' => $total_points_awarded]);

                $video = DB::table('carpost')->where('id', $video_id)->first();
                $total_points = DB::table('carpost')->where([['year', '=', $video->year], ['category', '=', $video->category]])->sum('points');
                $all_videos_in_category = DB::table('carpost')->where([['year', '=', $video->year], ['category', '=', $video->category]])->get();
                foreach ($all_videos_in_category as $video_in_category) {
                    $video_percentage = ($video_in_category->points / $total_points) * 70;
                    DB::table('carpost')
                            ->where('id', '=', $video_in_category->id)
                            ->update(['points_percentage' => $video_percentage]);
                }
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

                return $this->getCurrentVideos();
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function getVideoCategory() {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $video_categories = DB::table('car_category')->get();
                return view('admin.car_category', compact('user', 'video_categories'));
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function addVideoCategory(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->usertype == "super-user") {
                $category_new_name = $request->input('category_name');
                $car_category = DB::table('car_category')->where('name', '=', $category_new_name)->first();
                if ($car_category == null) {
                    DB::table('car_category')->insert(
                            ['name' => $category_new_name]);
                }
                $video_categories = DB::table('car_category')->get();
                return view('admin.car_category', compact('user', 'video_categories'));
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function editVideoCategory(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->usertype == "super-user") {
                $category_id = $request->input('edit_category_id');
                $category_new_name = $request->input('new_category_name');
                $category_old_name = $request->input('old_category_name');
                DB::table('car_category')
                        ->where('id', '=', $category_id)
                        ->update(['name' => $category_new_name]);

                DB::table('carpost')
                        ->where('category', '=', $category_old_name)
                        ->update(['category' => $category_new_name]);
                $video_categories = DB::table('car_category')->get();
                return view('admin.car_category', compact('user', 'video_categories'));
            }
        }
        return view('admin.admin404', compact('user'));
    }

    public function deleteVideoCategory($category_id) {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->usertype == "super-user") {
                DB::table('car_category')->where('id', '=', $category_id)->delete();
                $video_categories = DB::table('car_category')->get();
                return view('admin.car_category', compact('user', 'video_categories'));
            }
        }
        return view('admin.admin404', compact('user'));
    }

    //New get new posts
    public function getNewPartnerVideoPost() {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $video_categories = DB::table('car_category')->get();
                return view('admin.partner_video_post', compact('user', 'video_categories'));
            }
        }
        return view('auth.login');
    }

    public function createPartnerVideo(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $userId = Auth::user()->id;

//        $vurl = $request->input('vurl');
                $cartitle = $request->input('cartitle');
                $car_content = $request->input('car_content');
                $vcategory = $request->input('category');

                $vurl2 = str_replace("m.", "", str_replace("watch?v=", "embed/", $request->input('vurl')));
                $year = date("Y");
                $vurl = str_replace("m.", "", str_replace("youtu.be", "youtube.com/embed", $vurl2));
                if (strpos($vurl, '&') !== false) {
	$vurl  = substr($vurl, 0, strpos($vurl, "&"));
}


                DB::table('partner_videos')->insert(
                        ['title' => $cartitle, 'videoUrl' => $vurl,'content' => $car_content, 'category' => $vcategory]
                );
            }
        }

        return redirect('/');
    }

    public function getAllPartnerVideos() {
//$ipAddress = '';

        if (Auth::check()) {

            $user = Auth::user();
//dd($user->usertype );
            if ($user->usertype == "admin" || $user->usertype == "super-user") {
                $videos = DB::table('partner_videos')
                        ->get();
                $title = 'Partner Posted Videos';
                return view('admin.partner_video_list', compact('user', 'title', 'videos'));
            }
            return view('admin.admin404', compact('user'));
        }
    }

    public function deletePartnerVideo($id) {
        if (Auth::check()) {

            $user = Auth::user();
//dd($user->usertype );
            if ($user->usertype == "super-user") {
                DB::table('partner_videos')->where('id', '=', $id)->delete();
                return $this->getAllPartnerVideos();
            }
        }
    }

}
