<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImmoController;
use App\Http\Controllers\ReactionsController;
use App\Http\Controllers\FavouritesController;
use App\Http\Controllers\VisiteController;
use App\Http\Controllers\TchatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\NotificationController;



Route::get('/', function () {
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/immos', [ImmoController::class , 'index'])->name('index_page');
Route::middleware('role:property_owner')->get('/create_immo', [ImmoController::class , 'create'])->middleware('auth')->name('create_immo');
Route::post('/create_immo', [ImmoController::class , 'store'])->middleware('auth')->name('save_immo');
Route::middleware('role:property_owner')->get('/immos/{id}/edit', [ImmoController::class , 'edit'])->middleware('auth')->name('edit_immo');
Route::put('/immos/{id}/edit', [ImmoController::class , 'update'])->middleware('auth')->name('update_immo');
Route::get('/immos/{id}/show', [ImmoController::class , 'show'])->middleware('auth')->name('show_immo');
Route::middleware('role:property_owner')->get('/immos/{id}/delete', [ImmoController::class , 'destroy'])->middleware('auth')->name('delete_immo');
Route::get('/like_immo', [ReactionsController::class , 'like'])->middleware('auth','role:home_seeker')->name('like_immo');
Route::get('/dislike_immo', [ReactionsController::class , 'dislike'])->middleware('auth','home_seeker')->name('dislike_immo');
Route::get('/adore_immo', [ReactionsController::class , 'heart'])->middleware('auth','home_seeker')->name('adore_immo');
Route::get('/add_favoris', [FavouritesController::class , 'create_favourite'])->middleware('auth','home_seeker')->name('create_favoris');
Route::get('/get_favoris', [FavouritesController::class , 'index'])->middleware('auth','home_seeker')->name('get_favoris');
Route::get('/delete_favoris/{id}', [FavouritesController::class , 'destroy'])->middleware('auth','home_seeker')->name('delete_favoris');
Route::post('/save_ask', [VisiteController::class , 'store'])->middleware('auth','home_seeker')->name('save_ask');
Route::get('/ask_visite', [VisiteController::class , 'create'])->middleware('auth','home_seeker')->name('ask_visite');
Route::get('/planifier_visite/{id}', [ImmoController::class , 'planifier_visite'])->middleware('auth','home_seeker')->name('planifier_visite');
Route::post('/planifier_visite', [ImmoController::class , 'save_ask_visite'])->middleware('auth','home_seeker')->name('save_ask');

Route::get('/change_ask_visite_date/{id}', [ImmoController::class , 'change_ask_visite_date'])->middleware('auth','home_seeker')->name('change_ask_visite_date');
Route::get('/update_ask_visite_date', [ImmoController::class , 'update_ask_visite'])->middleware('auth','home_seeker')->name('update_ask_visite');

Route::get('/all_asked_visites', [VisiteController::class , 'index'])->middleware('auth','manager')->name('asked_visites');
Route::get('/delete/{id}/visites', [VisiteController::class , 'destroy'])->middleware('auth','home_seeker')->name('delete_visite');
//Route::get('/send_message', [TchatController::class , 'create'])->middleware('auth')->name('send_message');
Route::post('/send_message', [TchatController::class , 'store'])->middleware('auth')->name('send_confirmed');
Route::get('/tchat/{id}/show', [TchatController::class , 'show'])->middleware('auth')->name('show_tchat');
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('/immos/{id}/show_immo_properties', [ImmoController::class , 'get_immo_per_user'])->middleware('auth')->name('get_immo_per_user');
Route::get('/tchat/{id}/delete', [TchatController::class , 'destroy'])->middleware('auth')->name('delete_tchat');

Route::get('/create_messsage', [TchatController::class , 'create'])->middleware('auth')->name('create_message');
Route::post('/send_message', [MessagesController::class , 'store'])->middleware('auth')->name('send_confirmed');
Route::get('/own_messages', [MessagesController::class , 'index'])->middleware('auth')->name('own_messages');
Route::get('/create_answer/{id}/answer', [AnswerController::class , 'create'])->middleware('auth')->name('create_answer');
Route::post('/create_answer', [AnswerController::class , 'store'])->middleware('auth')->name('save_answer');
Route::get('/tchats', [TchatController::class , 'index'])->middleware('auth')->name('get_tchats');
Route::get('/tchat/{id}/discussion', [TchatController::class , 'get_hole_discussion'])->middleware('auth')->name('get_hole_discussion');
Route::get('/tchat/{id}/delete', [TchatController::class , 'delete_hole_discussion'])->middleware('auth')->name('delete_hole_discussion');
Route::get('/message/{id}/delete', [MessagesController::class , 'destroy'])->middleware('auth')->name('delete_message');
Route::get('/answer/{id}/delete', [AnswerController::class , 'destroy'])->middleware('auth')->name('delete_answer');
Route::get('/notifications', [NotificationController::class , 'index'])->middleware('auth')->name('get_notifications');
Route::get('/delete/notifications', [NotificationController::class , 'delete_notifications'])->middleware('auth')->name('delete_notifications');

