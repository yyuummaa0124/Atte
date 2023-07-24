<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Stamp;
use App\Models\Rest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class StampController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        //ユーザーIDがログインユーザのIDと一致するかつ、作成日が本日のレコードがある場合trueを取得
        $exists = Stamp::where('user_id', $user->id)
                ->whereDate('created_at', Carbon::today())
                //existsは条件に当てはまる場合trueが返却され、当てはまらない場合falseが返却される　
                ->exists();

        //ユーザーIDがログインユーザのIDと一致するかつ、作成日が本日のレコードがある場合、作成日を降順にソートして最初のレコードを取得
        $restRecord = Rest::where('date_id', $user->id)
                    ->whereDate('created_at', Carbon::today())
                    ->latest('created_at')
                    ->first();

        return view('stamps', ['user' => $user, 'exists' => $exists, 'restRecord' => $restRecord]);
    }

    public function startwork(Request $request)
    {   
        $user = Auth::user();

        // 一致しない場合の処理
        $newStamp = new Stamp();
        $newStamp->user_id = $user->id;
        $newStamp->start_time = now();
        $newStamp->save();

        return redirect("/");

    }

    public function endwork(Request $request)
    {
        
        $stamp = Stamp::latest()->first();

        $start_time = Carbon::parse($stamp->start_time); // parse()　→　Carbonのデータ型に変換するメソッド
        $end_time = now();
        // 開始時間と終了時間の差分を時間単位で取得
        $total_hours = $start_time->diff($end_time)->format('%H:%I:%S'); // format() →　指定したformatに変換 
        $stamp->end_time = $end_time;
        $stamp->total_time = $total_hours;

        $stamp->save();

        return redirect("/");
    }

    public function startrest(Request $request)
    {
        $user = Auth::user();

        $rest = new Rest();
        $rest->date_id = $user->id;
        //現在時刻をrestsテーブルに登録
        $rest->start_rest = now();
        $rest->save();

        return redirect("/");
    }

    public function endrest()
    {
    $user = Auth::user();

    // 直近の休憩開始レコードを取得
    $rest = Rest::where('date_id', $user->id)
                ->whereNull('end_rest')
                ->latest()
                ->first();

    if ($rest) {
        // 休憩終了時刻を保存
        $rest->end_rest = now();
        $rest->save();

        // 開始終了の差時間を計算
        $startRest = Carbon::parse($rest->start_rest);
        $endRest = Carbon::parse($rest->end_rest);
        $totalRest = $endRest->diff($startRest)->format('%H:%I:%S');  // 開始時間と終了時間の差分を時間単位で取得;

        // total_rest レコードを取得
        $stamp = Stamp::where('user_id', $user->id)->latest()->first();

        //$stamp->total_restに値が入っている場合
        if($stamp->total_rest)
        {
            $stampTotalRest = Carbon::parse($stamp->total_rest);

            // 差分と元々の値を足して total_rest を更新
            $newTotalRest = $stampTotalRest->add(CarbonInterval::createFromFormat('H:i:s', $totalRest));

            $stamp->total_rest = $newTotalRest; // 時間形式にフォーマット
            $stamp->save();
        }
        else
        {
            $stamp->total_rest = $totalRest; // 時間形式にフォーマット
            $stamp->save();
        }
        
    }
    
        return redirect("/");
    }

    public function getUserList()
    {
        $users = User::query()->paginate(5);
        $stamps = Stamp::all();

        return view('user', ['users' => $users, 'stamps' => $stamps]);
    }

    
    public function getUserDate($id)
    {
        $dates = Carbon::now()->format('Y-m');

        $stampdatas = Stamp::where('user_id', $id)
                    ->whereMonth('created_at', Carbon::parse($dates)->month)
                    ->whereYear('created_at', Carbon::parse($dates)->year)
                    ->paginate(5);

        return view("userdate", ['stampdatas' => $stampdatas, 'dates' => $dates, 'id' => $id]);
    }

    public function getNextMonth($dates, $id)
    {
        // 次の日付を取得
        $nextDate = Carbon::parse($dates)->addMonth()->format('Y-m');

        $stampdatas = Stamp::where('user_id', $id)
                            ->whereMonth('created_at', Carbon::parse($nextDate)->month)
                            ->whereYear('created_at', Carbon::parse($nextDate)->year)
                            ->paginate(5);

        return view('userdate', ['stampdatas' => $stampdatas, 'dates' => $nextDate, 'id' => $id]);
    }

    public function getBeforeMonth($dates, $id)
    {
        // 次の日付を取得
        $beforeDate = Carbon::parse($dates)->subMonth()->format('Y-m');
        
        $stampdatas = Stamp::where('user_id', $id)
                            ->whereMonth('created_at', Carbon::parse($beforeDate)->month)
                            ->whereYear('created_at', Carbon::parse($beforeDate)->year)
                            ->paginate(5);

        return view('userdate', ['stampdatas' => $stampdatas, 'dates' => $beforeDate, 'id' => $id]);
    }
}
