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

        return redirect()->back()->with('my_status', '打刻が完了しました');
    }
}
