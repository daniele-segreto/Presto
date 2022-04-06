<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\AnnouncementController;

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

Route::get("/home",[HomeController::class,"home"])->name("home");
Route::get('/', [HomeController::class, "home"])->name("home");

Route::get('/category/{name}/{id}/announcement', [HomeController::class, "announcementByCategory"])->name('announcements.category');

// Dettaglio
Route::get('/announcement/detail/{announcement}', [AnnouncementController::class, "show" ])->name("announcements.detail");

// Crea
Route::get("/announcement/new",[AnnouncementController::class,"newAnnouncement"])->name("announcements.new");
Route::post("/announcement/create",[AnnouncementController::class,"createAnnouncement"])->name("announcements.create");
// Route::get('/announcement/detail/{announcement}', [AnnouncementController::class, "show" ])->name("announcement.detail");

// Dropzone Upload/Remove
Route::post('/announcement/images/upload', [AnnouncementController::class, "uploadImage"])->name("announcement.images.upload");
Route::delete('/announcement/images/remove', [AnnouncementController::class, "removeImage"])->name("announcement.images.remove");

Route::get('/announcement/images', [AnnouncementController::class, "getImages"])->name("announcement.images");


// Ricerca
Route::get('/search', [AnnouncementController::class, "search"])->name('search');


// Rotta della pagina di modifica
Route::get("/announcement/update/{announcement}", [AnnouncementController::class, "announcementUpdate"])->name("announcements.update");

// Modifica - Cancella
Route::put("/announcement/edit/{announcement}", [AnnouncementController::class, "announcementEdit"])->name("announcements.edit");
// Route::delete("/announcement/delete/{announcement}", [AnnouncementController::class, "announcementDelete"])->name("announcements.delete");


// Revisor
Route::get('/revisor/index', [RevisorController::class, "index" ])->name("auth.revisor");
Route::post('/revisor/announcement/{id}/accept', [RevisorController::class, "accept"])->name('revisor.accept');
Route::post('/revisor/announcement/{id}/reject', [RevisorController::class, "reject"])->name('revisor.reject');

// Multilingua
Route::post('/locale/{locale}', [HomeController::class, "locale"])->name('locale');