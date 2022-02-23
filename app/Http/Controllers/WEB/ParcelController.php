<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    public function senderDashboard(Request $request)
    {
        return view('sender-dashboard');
    }

    public function bikerDashboard(Request $request)
    {
        return view('biker-dashboard');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function pickup(Request $request)
    {
        return view('pickup');
    }

    public function detail(Request $request)
    {
        return view('pickup');
    }

}
