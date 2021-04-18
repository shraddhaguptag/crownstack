<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Discount;
use App\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB;


class ApiAuthController extends Controller
{
    //
	public function register (Request $request) {

		$allDiscount = Discount::get()->toArray();

		$validator = Validator::make($request->all(), [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:customers',
			'phone' => 'required|numeric|gt:0|unique:customers',

		]);
		if ($validator->fails())
		{
			return response(['errors'=>$validator->errors()->all()], 422);
		}

		$discountValue = Discount::all()->random()->discount_value;
		//$discountValue = 5000;
		$data = [
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
			'discount_amount' => $discountValue,
		];

		$count = Discount::where('discount_value',$discountValue)->first();
		$countOccurences = $count->count_occurences;
		$repeatTimes = $count->repeat_times;

		if($countOccurences >= $repeatTimes){


			// return response()->json([
			// 	"message" => "Coupon not added"
			// ], 200);
			$this->register($request);

		}
		else{
			$user = Customer::create($data);
			$updateCount = DB::table('discounts')
			->where('discount_value',$discountValue)
			->increment("count_occurences",1);
			return response()->json([
				"message" => "Customer created successfully"
			], 201);
		}



	}




}
