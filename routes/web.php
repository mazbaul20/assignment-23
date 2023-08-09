<?php

use App\Http\Controllers\Assignment\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('Assignment.pages.dashboard.dashboard-page');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Assignment route
    Route::get('/get-user',[UserController::class,'GetUser']);
    Route::get('/logout',[UserController::class,'UserLogout'])->name('logout');

    // page route ----------------------------------------
    Route::get('/income-category-page',[IncomeCategoryController::class,'IncomeCategoryPage']);
    Route::get('/income-page',[IncomeController::class,'IncomePage']);
    Route::get('/expense-category-page',[ExpenseCategoryController::class,'ExpenseCategoryPage']);
    Route::get('/expense-page',[ExpenseController::class,'ExpensePage']);

    // Income Category
    Route::get('/create-incomeCategory',[IncomeCategoryController::class,'CreateIncomeCategory']);
    Route::get('/list-incomeCategory',[IncomeCategoryController::class,'ListIncomeCategory']);
    Route::post('/incomeCategory-by-id',[IncomeCategoryController::class,'IncomeCategoryById']);
    Route::patch('/update-incomeCategory',[IncomeCategoryController::class,'UpdateIncomeCategory']);
    Route::post('/delete-incomeCategory',[IncomeCategoryController::class,'DeleteIncomeCategory']);

    // Income
    Route::post('/create-income',[IncomeController::class,'CreateIncome']);
    Route::get('/list-income',[IncomeController::class,'ListIncome']);
    Route::post('/income-by-id',[IncomeController::class,'IncomeById']);
    Route::patch('/update-income',[IncomeController::class,'UpdateIncome']);
    Route::post('/delete-income',[IncomeController::class,'DeleteIncome']);

    // Expense Category
    Route::post('/create-expenseCategory',[ExpenseCategoryController::class,'CreateExpenseCategory']);
    Route::get('/list-expenseCategory',[ExpenseCategoryController::class,'ListExpenseCategory']);
    Route::post('/expenseCategory-by-id',[ExpenseCategoryController::class,'ExpenseCategoryById']);
    Route::patch('/update-expenseCategory',[ExpenseCategoryController::class,'UpdateExpenseCategory']);
    Route::post('/delete-expenseCategory',[ExpenseCategoryController::class,'DeleteExpenseCategory']);

    // Expense
    Route::post('/create-expense',[ExpenseController::class,'CreateExpense']);
    Route::get('/list-expense',[ExpenseController::class,'ListExpense']);
    Route::post('/expense-by-id',[ExpenseController::class,'ExpenseById']);
    Route::patch('/update-expense',[ExpenseController::class,'UpdateExpense']);
    Route::post('/delete-expense',[ExpenseController::class,'DeleteExpense']);
    
});

require __DIR__.'/auth.php';

//Assignment route

