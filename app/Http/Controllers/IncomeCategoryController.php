<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\IncomeCategory;
use Illuminate\Http\Request;

class IncomeCategoryController extends Controller
{
    public function IncomeCategoryPage()
    {
        return view('frontend.pages.dashboard.incomeCategory-page');
    }

    public function incomeCategoryList()
    {
        $user_id = auth()->user()->id;
        return IncomeCategory::where('user_id', '=', $user_id)->get();
    }

    public function incomeCategoryCreate(Request $request)
    {
        $user_id = auth()->user()->id;
        $name = $request->input('name');

        return IncomeCategory::create([
            'name' => $name,
            'user_id' => $user_id
        ]);
    }

    public function incomeCategoryUpdate(Request $request)
    {
        // $user_id = auth()->user()->id;
        $income_cat_id = $request->input('id');
        return IncomeCategory::where('id', '=', $income_cat_id)->update([
            'name' => $request->input('name'),
            'user_id' => $request->input('user_id')
        ]);
    }

    public function incomeCategoryDelete(Request $request)
    {
        $income_cat_id = $request->id;
        $hasIncomes = Income::where('income_category_id', $income_cat_id)->exists();
        if ($hasIncomes) {
            return response()->json([
                'message' => 'Cannot delete. There are incomes associated with this category'
            ], 400);
        }

        return IncomeCategory::where('id', '=', $income_cat_id)->delete();
    }

    public function incomeCategoryById(Request $request){
        return IncomeCategory::find($request->input('id'));
    }
}
