<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReceipysController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\user\AuthUsersController;
use App\Http\Controllers\user\IdentificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// LOGIN & REGISTER USERS

// register
Route::post('/user/register', [AuthUsersController::class, 'register']);
// login
Route::post('/user/login', [AuthUsersController::class, 'login']);
// send code to verification email
Route::post('/user/send-code', [AuthUsersController::class, 'sendCodeVerification']);
// Code comparison
Route::post('/user/verification', [AuthUsersController::class, 'verificationCode']);
// forget password
Route::post('/user/forget-password', [AuthUsersController::class, 'forgetPassword']);
// confirm code in forgot password
Route::post('/user/confirm-code', [AuthUsersController::class, 'verificationCodeWithResetPassword']);
// reset password in forgot password
Route::post('/user/reset-password', [AuthUsersController::class, 'resetPassword'])->middleware('auth:sanctum');
// reset password in old password
Route::post('/user/new-password', [AuthUsersController::class, 'resetPasswordWithOldPassword'])->middleware('auth:sanctum');
// login & register with google account
Route::get('/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
// login & register with facebook account
Route::get('/facebook/callback', [SocialiteController::class, 'handleFacebookCallback']);


// identification user
// all identification
Route::get('/user/identification', [IdentificationController::class, 'allIdentification']); //admin
// add identification
Route::post('/user/identification', [IdentificationController::class, 'addIdentification']);
// identification valid
Route::get('/user/identification/valid/{id}', [IdentificationController::class, 'valid']); //admin
// identification not valid
Route::get('/user/identification/not_valid/{id}', [IdentificationController::class, 'notValid']); //admin


// terms
Route::get('/terms', [TermsController::class, 'terms']);
// add term
Route::post('/terms', [TermsController::class, 'addTerm']); //admin
// update term
Route::post('/term/{id}', [TermsController::class, 'updateTerm']); //admin
// delete term
Route::delete('/term/{id}', [TermsController::class, 'delete']); //admin


// category
Route::get('/category', [CategoryController::class, 'all']);
// category by id
Route::get('/category/{id}', [CategoryController::class, 'cateById']);
// add category
Route::post('/category', [CategoryController::class, 'add']); //admin
// update category
Route::post('/category/{id}', [CategoryController::class, 'update']); //admin
// delete category
Route::delete('/category/{id}', [CategoryController::class, 'delete']); //admin


// Property
Route::get('/properties', [PropertyController::class, 'all']);
// Property by id
Route::get('/properties/{id}', [PropertyController::class, 'propById']);
// get all properties by category name
Route::get('/{categoryName}/properties', [PropertyController::class, 'propByCateName']);
// create property
Route::post('/properties', [PropertyController::class, 'create']); //admin
// update property
Route::post('/properties/{id}', [PropertyController::class, 'update']); //admin
// delete property
Route::delete('/properties/{id}', [PropertyController::class, 'delete']); //admin
// fillter properties
Route::post('/property/filter', [PropertyController::class, 'filter']);


// get Timelines by property id
Route::get('/timeline/{propId}', [TimelineController::class, 'getTimelines']);
// add Timelines
Route::post('/timeline', [TimelineController::class, 'create']); //admin
// update Timelines
Route::post('/timeline/{id}', [TimelineController::class, 'update']); //admin
// delete Timelines
Route::delete('/timeline/{id}', [TimelineController::class, 'delete']); //admin


// get Favorites by user
Route::get('/favorites', [FavoriteController::class, 'getFavoByUser'])->middleware('auth:sanctum');
// add Favorites
Route::post('/favorites/{propertyId}', [FavoriteController::class, 'create'])->middleware('auth:sanctum');
// remove Favorite
Route::delete('/favorites/{id}', [FavoriteController::class, 'delete'])->middleware('auth:sanctum');
// clear all Favorites
Route::delete('/favorites', [FavoriteController::class, 'clearAll'])->middleware('auth:sanctum');


// get receipts by user
Route::get('/receipt', [ReceipysController::class, 'getReceiptsByuser'])->middleware('auth:sanctum');
// get receipt by id
Route::get('/receipt/{id}', [ReceipysController::class, 'receiptById'])->middleware('auth:sanctum');
// get receipts by status
Route::get('/receipt/status/{status}', [ReceipysController::class, 'receiptByStatus'])->middleware('auth:sanctum');
// create receipts
Route::post('/receipt', [ReceipysController::class, 'create'])->middleware('auth:sanctum');
// accepted receipt
Route::get('/receipt/accepted/{id}', [ReceipysController::class, 'accepted']);
// rejected receipt
Route::get('/receipt/rejected/{id}', [ReceipysController::class, 'rejected']);


// notifications 
// Notification::send($user, new Notifications('login', 'login true', '50'));
// notifications in application
Route::get('/notifications', [NotificationsController::class, 'all'])->middleware('auth:sanctum');
