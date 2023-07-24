<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stamp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceManagementController extends Controller
{
    public function getAttendanceInfo(){

        $dates = Carbon::today()->format('Y-m-d');

        $stampdatas = Stamp::whereDate('created_at', $dates)->paginate(5);    

        return view("date" , ['stampdatas' => $stampdatas, 'dates' => $dates]);

    }
    
    public function getNextDate($dates)
    {
        // 次の日付を取得
        $nextDate = Carbon::parse($dates)->addDay()->format('Y-m-d');

        $stampdatas = Stamp::whereDate('created_at', $nextDate)->paginate(5);  

        return view('date', ['stampdatas' => $stampdatas, 'dates' => $nextDate]);
    }

    public function getBeforeDate($dates)
    {
        // 次の日付を取得
        $beforeDate = Carbon::parse($dates)->subDay()->format('Y-m-d');
        
        $stampdatas = Stamp::whereDate('created_at', $beforeDate)->paginate(5);  

        return view('date', ['stampdatas' => $stampdatas, 'dates' => $beforeDate]);
    }
}
