<?php

use App\Models\User;
use App\Events\UserEvent;
use App\Events\OrderEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Listeners\UpdateVendorAboutOrder;
use App\Http\Controllers\ProfileController;
use App\Mail\SendInvoice;
use Illuminate\Support\Facades\Mail;

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
    $user = User::create([
        'first_name' => 'shohel',
        'last_name' => 'hossain',
        'email' => 'noman@email'
    ]);
    UserEvent::dispatch($user);
    echo "ok";
    // return view('welcome');
});

Route::get('/send-email', function(){
    // $user = User::find(1);
    Mail::to('sohail1054155@gmail.com')->send(new SendInvoice(now()->format('m')));
    return 'success';
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test', [TestController::class, 'test']);

Route::get('test/{user}', [TestController::class, 'edit'])->name('test');


require __DIR__.'/auth.php';
