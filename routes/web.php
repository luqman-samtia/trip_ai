<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\BotManController;

// Default route for the homepage
Route::get('/', [PageController::class, 'home'])->name('home');

// Route::get('/chat' , [BotManController::class, 'chat'])->name('chat');
// Route::get('/chat', function () {
//      $response = app('openai')->chat()->create([
//         'model' => 'gpt-4o-mini',
//         'messages' => [
//             ['role' => 'system', 'content' => 'You are a helpful assistant.'],
//             ['role' => 'user', 'content' => 'What is the capital of the United States?'],
//             ['role' => 'assistant', 'content' => 'The capital of the United States is Washington, D.C.'],
//         ],

//     ]);

// $answer = $response['choices'][0]['message']['content'];


// return response()->json(['answer' => $answer]);
//         // dd($response);
// })->name('chat');


// Static pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/umra-haj', [PageController::class, 'umraHaj'])->name('umra.haj');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/book-call', [PageController::class, 'book_call'])->name('book-call');
Route::get('/chat', [PageController::class, 'chat'])->name('chat');

// Subscription routes
Route::middleware(['auth'])->group(function () {
    Route::get('/pricing', [SubscriptionController::class, 'pricing'])->name('pricing');
    Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
});

// Authenticated routes
// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
//     Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
//     Route::post('/profile/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.update-picture');
//     Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

//      // Search functionality
//      Route::post('/search', [SearchController::class, 'handleSearch'])->name('search');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::post('/profile/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.update-picture');
    Route::post('/search', [SearchController::class, 'handleSearch'])->name('search');
});
// Fallback for 'dashboard' route issue
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->name('dashboard');

// Authentication routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/forgot-password', [PasswordResetController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'edit'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'update'])->name('password.update');

Route::get('/verify-email', [VerifyEmailController::class, 'notice'])->name('verification.notice');
Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, 'verify'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
Route::post('/email/verification-notification', [VerifyEmailController::class, 'store'])->middleware(['throttle:6,1'])->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);
Route::get('/features', [PageController::class, 'features'])->name('features');

// Include authentication routes (if necessary, for Laravel Breeze/Jetstream)

Route::match(['get', 'post'], '/botman', 'App\Http\Controllers\BotManController@handle');
require __DIR__.'/auth.php';
