<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\User;


class UserController extends Controller
{
    public function index()
    {
        Log::Debug(__CLASS__.':'.__FUNCTION__);

        $users = User::paginate(10);

        return view('admin.user.index', [
            'users' => $users
        ]);
    }
}
