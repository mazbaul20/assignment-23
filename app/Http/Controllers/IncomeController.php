<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\IncomeCategory;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function IncomePage(){
        return view('frontend.pages.dashboard.income-page');
    }// end method
    public function IncomeList()
    {
        $user_id = auth()->user()->id;
        return Income::where('user_id', '=', $user_id)->get();
    }// end method

    public function createIncome(Request $request)
    {
        $user_id = auth()->user()->id;

        return Income::create([
            'name' => $request->input('name'),
            'amount' => $request->input('amount'),
            'desc' => $request->input('desc'),
            'date' => $request->input('date'),
            'user_id' => $user_id,
            'income_category_id' => $request->input('income_category_id')
        ]);
    }// end method

    public function updateIncome(Request $request)
    {
        $income_id = $request->input('id');

        return Income::where('id',$income_id)->update([
            'name'=>$request->input('name'),
            'amount'=>$request->input('amount'),
            'desc'=>$request->input('desc'),
            'date'=>$request->input('date'),
            'income_category_id'=>$request->input('income_category_id')
        ]);
    }// end method

    public function deleteIncome(Request $request)
    {
        $income_id = $request->id;
        return Income::where('id', '=', $income_id)->delete();
    }// end method

    public function incomeById(Request $request){
        return Income::find($request->input('id'));
    }// end method

    // show Income category id
    public function getIncomeCategoryId(){
        //Income Category Id
        return IncomeCategory::all();
    }// end method
}
