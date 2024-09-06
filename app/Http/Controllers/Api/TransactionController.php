<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\TransactionJob;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function order(Request $request)
    {
        // $validator = Validator::make($request->all(),[
        //     "amount" 
        // ]);

        $fee = 2500;

        $transaction = Transaction::create([
            "name" => $request->name,
            "phone_number" => $request->phone_number,
            "amount" => $request->amount + $fee,
            "reff" => $request->reff,
            "code" => "8834" + $request->phone_number,
            "expired_at" =>  Carbon::now()->setTimezone('Asia/Jakarta')->addDay()->toIso8601String()
        ]);

        return response()->json([
            "status" => true,
            "message" => "Transaction Created",
            "data" => $transaction
        ]);
    }

    public function payment(Request $request){
        $isExist = Transaction::whereReff($request->reff)->first();

        if(!$isExist || $isExist->status == "paid"){
            return response()->json([
                "status" => false,
                "message" => "Reff is Invalid"
            ],403);
        }

        $isExist->status = "paid";
        $isExist->save();

        TransactionJob::dispatch($isExist);

        return response()->json([
            "status" => true,
            "message" => "Transaction Paid",
            "data" => $isExist
        ]);
    }

    public function status(Request $request){
        $isExist = Transaction::whereReff($request->reff)->first();

        if(!$isExist){
            return response()->json([
                "status" => false,
                "message" => "Reff is Invalid"
            ],403);
        }

        return response()->json([
            "status" => true,
            "message" => "Data Found",
            "data" => $isExist
        ]);        
    }
}
