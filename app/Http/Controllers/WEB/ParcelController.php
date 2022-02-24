<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    public function senderDashboard()
    {
        return view('sender-dashboard');
    }

    public function bikerDashboard(Request $request)
    {
        return view('biker-dashboard');
    }

    public function pickup()
    {
        return view('pickup');
    }

    public function detail()
    {
        return view('pickup');
    }

    public function create()
    {
        return view('create');
    }

    public function edit($id)
    {
        return view('edit')->with('id', $id);;
    }
}
