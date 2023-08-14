<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function IncomePage(){
        return view('frontend.pages.dashboard.income-page');
    }
    public function IncomeList()
    {
        $user_id = auth()->user()->id;
        return Income::where('user_id', '=', $user_id)->get();
    }

    public function createIncome(Request $request)
    {
        // dd($request->all());
        $name = $request->input('name');
        $amount = $request->input('amount');
        $desc = $request->input('desc');

        $date = $request->date("Y-m-d H:i:s");

        $user_id = auth()->user()->id;
        $income_category_id = $request->input('income_category_id');

        return Income::create([
            'name' => $name,
            'amount' => $amount,
            'desc' => $desc,
            'date' => $date,
            'user_id' => $user_id,
            'income_category_id' => $income_category_id
        ]);
    }

    public function updateIncome(Request $request)
    {
    
        $income_id = $request->id;

        $income = Income::find($income_id);

        if (!$income) {
            return response()->json(['message' => 'Income not found'], 404);
        }

        // Update only the fields that are provided in the request
        return $income->update($request->only(['name', 'amount', 'desc', 'date']));
    }

    public function deleteIncome(Request $request)
    {
        $income_id = $request->id;

        return Income::where('id', '=', $income_id)->delete();
    }

    public function incomeById(){
        //
    }
}
