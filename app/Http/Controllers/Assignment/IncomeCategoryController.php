<?php

namespace App\Http\Controllers\Assignment;

use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IncomeCategoryController extends Controller
{
    function IncomeCategoryPage(){
        //
    }// end method

    function CreateIncomeCategory(Request $request){
        $user_id = auth()->user()->id;
        $name = $request->input('name');

        return IncomeCategory::create([
            'name' => $name,
            'user_id' => $user_id
        ]);
    }// end method

    function ListIncomeCategory(){
        return IncomeCategory::all();
    }
}
