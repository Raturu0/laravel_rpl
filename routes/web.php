<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;


// --------------
// EVENTS
// --------------

// Menampilkan halaman utama
Route::get('/', EventController::class . '@index')->name('events.index');
// Menampilkan halaman untuk membuat event
Route::get('/events/create', EventController::class . '@create')->name('events.create');
// Menyimpan data event
Route::post('/events', EventController::class . '@store')->name('events.store');
// Menampilkan detail event
Route::get('/events/{Event}', EventController::class . '@show')->name('events.show');
// Menampilkan halaman untuk mengedit
Route::get('/events/{Event}/edit', EventController::class . '@edit')->name('events.edit');
// Mengupdate data
Route::put('/events/{Event}', EventController::class . '@update')->name('events.update');
// Menghapus data event
Route::delete('/events/{Event}', EventController::class . '@destroy')->name('events.destroy');


// --------------
// COMMENTS
// --------------

// Menampilkan halaman untuk edit comment
Route::get('/events/comments/{comment}/edit', [EventController::class, 'editComment'])->name('events.editComment');
// Menghapus Comment
Route::delete('/events/comments/{comment}', [EventController::class, 'destroyComment'])->name('events.destroyComment');
// Untuk update comment
Route::put('/comments/{event}', [EventController::class, 'updateComment'])->name('events.updateComment');
// Route mengarahkan ke halaman createComment
Route::get('/events/{eventId}/comments/create', [EventController::class, 'createComment'])->name('events.createComment');
// Membuat/create comment baru
Route::post('/comments/{event}', EventController::class . '@storeComment')->name('events.storeComment');
















// Menampilkan detail comment
Route::get('/events/{event}/show-comment/{comment}', [EventController::class, 'showComment'])->name('events.showComment');