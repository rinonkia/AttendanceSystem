<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Timestamp;

class TimestampsController extends Controller
{
    public function punchIn()
    {
        $user = Auth::user();
        $timestamp = Timestamp::create([
            'user_id' => $user->id,
            'punchIn' => Carbon::now()
        ]);

        return redirect()->back()->with('my_status', '出勤打刻が完了しました');
    }
    public function punchOut()
    {
        $user = Auth::user();
        $timestamp = Timestamp::where('user_id', $user->id)->latest()->first();

        if( !empty($timestamp->punchOut)) {
            return redirect()->back()->with('error', '既に退勤の打刻がされているか、出勤打刻されていません');
        }
        $timestamp->update([
            'punchOut' => Carbon::now()
        ]);

        return redirect()->back()->with('my_status', '退勤打刻が完了しました');

    }
}
