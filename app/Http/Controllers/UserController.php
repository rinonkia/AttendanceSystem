<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function index()
    {
        Log::Debug(__CLASS__.':'.__FUNCTION__);

        return view('admin.index');
    }
}
