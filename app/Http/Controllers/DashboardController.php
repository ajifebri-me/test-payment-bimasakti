<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data = Transaction::all();

        return view("dashboard",compact("data"));
    }

    public function updateStatus(Request $request,$id){
        $data = Transaction::whereId($id)->update([
            "status" => $request->status
        ]);

        return redirect()->back();
    }
}
