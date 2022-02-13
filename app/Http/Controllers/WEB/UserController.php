<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function biker(Request $request)
    {
        return view('biker.');
    }

    public function sender(Request $request)
    {
        return view('sender.index');
    }

}
