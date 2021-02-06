<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\MainPageController::class, 'index'])->name('index');
Route::get('/ranking', [\App\Http\Controllers\UserController::class, 'index_ranking'])->name('ranking');

Auth::routes();

//profile gamer
Route::get('/gamer/{user:name}', [\App\Http\Controllers\ProfileController::class, 'index'])->name('user.profile');
Route::get('/gamer/{user:name}/games', [\App\Http\Controllers\ProfileController::class, 'index_games'])->name('user.profile.games');
Route::get('/gamer/{user:name}/comments', [\App\Http\Controllers\ProfileController::class, 'index_comments'])->name('user.profile.comments');

//edit profile
Route::get('/gamer/{user:name}/edit', [\App\Http\Controllers\ProfileController::class, 'index_edit'])->name('user.profile.edit');
Route::post('/gamer/{user:name}/edit/upload_avatar', [\App\Http\Controllers\ProfileController::class, 'update_avatar'])->name('user.profile.edit.uploadAvatar');
Route::post('/gamer/{user:name}/edit/delete_avatar', [\App\Http\Controllers\ProfileController::class, 'delete_avatar'])->name('user.profile.edit.deleteAvatar');
Route::post('/gamer/{user:name}/edit/upload_header', [\App\Http\Controllers\ProfileController::class, 'update_header'])->name('user.profile.edit.uploadHeader');
Route::post('/gamer/{user:name}/edit/delete_header', [\App\Http\Controllers\ProfileController::class, 'delete_header'])->name('user.profile.edit.deleteHeader');
Route::post('/gamer/{user:name}/edit/update_info', [\App\Http\Controllers\ProfileController::class, 'update_info'])->name('user.profile.edit.updateInfo');
Route::post('/gamer/{user:name}/edit/changePassword', [\App\Http\Controllers\ProfileController::class, 'change_password'])->name('user.profile.edit.changePassword');

//games
Route::get('/games', [App\Http\Controllers\PostController::class, 'index'])->name('games.index');
Route::get('/games/{post:slug}', [App\Http\Controllers\PostController::class, 'show'])->name('games.show');
Route::post('/games/{post:slug}/follow', [App\Http\Controllers\PostController::class, 'follow'])->name('games.follow');
Route::get('/games/{post:slug}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('games.edit');
Route::get('/game/create', [App\Http\Controllers\PostController::class, 'create'])->name('games.create');
Route::post('/game/create/store', [App\Http\Controllers\PostController::class, 'store'])->name('games.store');
Route::post('/games/{post:slug}/edit/store', [App\Http\Controllers\PostController::class, 'edit_store'])->name('games.edit.store');

//comment

//Route::get('/games/{post:slug}/comment', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.add');
Route::post('/games/{post:slug}/comment', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.add');
Route::get('/comments/bestOfWeek', [App\Http\Controllers\CommentController::class, 'index_week_bests'])->name('comment.bestOfWeek');
Route::get('/comments/bests', [App\Http\Controllers\CommentController::class, 'index_bests'])->name('comment.bests');
Route::post('/comment/{comment:id}/reply', [App\Http\Controllers\CommentController::class, 'replyStore'])->name('comment.reply');
Route::post('/comment/{comment:id}/vote',[App\Http\Controllers\CommentController::class, 'voteComment'])->name('comment.vote');
Route::post('/comment/{comment:id}/delete',[App\Http\Controllers\CommentController::class, 'delete'])->name('comment.delete')->middleware('role:admin');
