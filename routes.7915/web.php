<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AiapplicationController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ComponentpageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\PlatformTransactionController;

//Route::controller(DashboardController::class)->group(function () {
//    Route::get('/', 'index')->name('index');
//});

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::get('/loginPage', [HomeController::class, 'loginPage'])->name('login.view');
Route::get('/signupPage', [HomeController::class, 'signupPage'])->name('signUp.view');
Route::get('/forgotPassword', [HomeController::class, 'forgotPassword'])->name('forgotpassword.view');

Route::post('/signup', [HomeController::class, 'store'])->name('signup.store');
Route::post('/login', [HomeController::class, 'login'])->name('login.store');

Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

Route::get('/users/dashboard', [UsersController::class, 'dashboard'])->middleware('auth')->name('users.dashboard');

Route::get('/users/profile', [UsersController::class, 'profile'])->middleware('auth')->name('users.user_profile');
Route::post('/users/upload-profile-image', [UsersController::class, 'uploadProfileImage'])->middleware('auth')->name('users.uploadProfileImage');
Route::post('/users/updateProfile', [UsersController::class, 'updateProfile'])->middleware('auth')->name('users.updateProfile');
Route::post('/users/updatePassword', [UsersController::class, 'updatePassword'])->middleware('auth')->name('users.password');

/* Bank account Details */

Route::post('/user/bank-accounts', [BankAccountController::class, 'store'])->middleware('auth')->name('users.bankAccount');
Route::put('/user/bank-accounts/{id}', [BankAccountController::class, 'update'])->name('bank_accounts.update');
Route::delete('/user/bank-accounts/{id}', [BankAccountController::class, 'destroy'])->name('bank_accounts.destroy');




/* Payment Request */

Route::get('/payment/request', [UsersController::class, 'paymentRequest'])->middleware('auth')->name('users.payment_request');
Route::get('/requestPayment', [PaymentController::class, 'requestPayment'])->middleware('auth')->name('admin.payment_request');

Route::get('/admin/users', [UsersController::class, 'usersList'])->middleware('auth')->name('admin.users');
Route::get('/admin/users/userDetail/{id}', [UsersController::class, 'userDetail'])->middleware('auth')->name('admin.user.view');
Route::PATCH('/admin/users/updateUserStatus/{id}/{status}', [UsersController::class, 'updateUserStatus'])->middleware('auth')->name('admin.user.status');
Route::post('/users/{user}/update-assigned-games', [UsersController::class, 'updateAssignedGames'])->name('admin.updateAssignedGames');

Route::put('/admin/users/{userId}/update-assigned-games', [UsersController::class, 'updateAssignedUsernames'])
    ->name('admin.user.updateAssignedGames');

Route::get('/admin/users/userAttachments/{id}', [UsersController::class, 'userAttachments'])->middleware('auth')->name('admin.user.attachments');
Route::get('/admin/dashboard', [UsersController::class, 'adminDashboard'])->middleware('auth')->name('admin.dashboard');
//Route::get('/admin/dashboard', [GameController::class, 'adminGame'])->middleware('auth')->name('admin.game');

Route::resource('games', GameController::class)->middleware('auth');
Route::patch('games/{game}/disable', [GameController::class, 'disable'])->name('games.disable');
Route::patch('games/{game}/enable', [GameController::class, 'enable'])->name('games.enable');
Route::post('games/uploadAccounts', [GameController::class, 'uploadAccounts'])->name('games.uploadAccounts');
Route::get('/download-sample', [GameController::class, 'downloadSample'])->name('admin.sample.download');

/* Trasnactions */


// For web routes
Route::post('/transactions', [PlatformTransactionController::class, 'storeTransaction'])->name('transaction.store');
Route::delete('/transaction/{id}', [PlatformTransactionController::class, 'destroy'])->name('transaction.destroy');
Route::post('/submit-withdrawal', [PlatformTransactionController::class, 'submitWithdrawal'])->name('submitWithdrawal');



Route::get('/admin/users/{userId}/export', [UsersController::class, 'exportUserGames'])
    ->name('admin.user.exportGames');

// Route for importing the updated Excel file
Route::post('/admin/users/{userId}/import', [UsersController::class, 'importUserGames'])
    ->name('admin.user.importGames');

Route::controller(HomeController::class)->group(function () {
    //Route::get('calendar', 'calendar')->name('calendar');
    Route::get('chatmessage', 'chatMessage')->name('chatMessage');
    Route::get('chatempty', 'chatEmpty')->name('chatEmpty');
    Route::get('email', 'email')->name('email');
    Route::get('error', 'error1')->name('error');
    Route::get('faq', 'faq')->name('faq');
    Route::get('gallery', 'gallery')->name('gallery');
    Route::get('kanban', 'kanban')->name('kanban');
    Route::get('pricing', 'pricing')->name('pricing');
    Route::get('termscondition', 'termsCondition')->name('termsCondition');
    Route::get('widgets', 'widgets')->name('widgets');
    Route::get('chatprofile', 'chatProfile')->name('chatProfile');
    Route::get('veiwdetails', 'veiwDetails')->name('veiwDetails');
});

// aiApplication
Route::prefix('aiapplication')->group(function () {
    Route::controller(AiapplicationController::class)->group(function () {
        Route::get('/codegenerator', 'codeGenerator')->name('codeGenerator');
        Route::get('/codegeneratornew', 'codeGeneratorNew')->name('codeGeneratorNew');
        Route::get('/imagegenerator', 'imageGenerator')->name('imageGenerator');
        Route::get('/textgeneratornew', 'textGeneratorNew')->name('textGeneratorNew');
        Route::get('/textgenerator', 'textGenerator')->name('textGenerator');
        Route::get('/videogenerator', 'videoGenerator')->name('videoGenerator');
        Route::get('/voicegenerator', 'voiceGenerator')->name('voiceGenerator');
    });
});

// Authentication
Route::prefix('authentication')->group(function () {
    Route::controller(AuthenticationController::class)->group(function () {
        Route::get('/forgotpassword', 'forgotPassword')->name('forgotPassword');
        Route::get('/signin', 'signIn')->name('signIn');
        Route::get('/signup', 'signUp')->name('signUp');
    });
});

// chart
Route::prefix('chart')->group(function () {
    Route::controller(ChartController::class)->group(function () {
        Route::get('/columnchart', 'columnChart')->name('columnChart');
        Route::get('/linechart', 'lineChart')->name('lineChart');
        Route::get('/piechart', 'pieChart')->name('pieChart');
    });
});

// Componentpage
Route::prefix('componentspage')->group(function () {
    Route::controller(ComponentpageController::class)->group(function () {
        Route::get('/alert', 'alert')->name('alert');
        Route::get('/avatar', 'avatar')->name('avatar');
        Route::get('/badges', 'badges')->name('badges');
        Route::get('/button', 'button')->name('button');
        Route::get('/calendar', 'calendar')->name('calendar');
        Route::get('/card', 'card')->name('card');
        Route::get('/carousel', 'carousel')->name('carousel');
        Route::get('/colors', 'colors')->name('colors');
        Route::get('/dropdown', 'dropdown')->name('dropdown');
        Route::get('/imageupload', 'imageUpload')->name('imageUpload');
        Route::get('/list', 'list')->name('list');
        Route::get('/pagination', 'pagination')->name('pagination');
        Route::get('/progress', 'progress')->name('progress');
        Route::get('/radio', 'radio')->name('radio');
        Route::get('/starrating', 'starRating')->name('starRating');
        Route::get('/switch', 'switch')->name('switch');
        Route::get('/tabs', 'tabs')->name('tabs');
        Route::get('/tags', 'tags')->name('tags');
        Route::get('/tooltip', 'tooltip')->name('tooltip');
        Route::get('/typography', 'typography')->name('typography');
        Route::get('/videos', 'videos')->name('videos');
    });
});

// Dashboard
Route::prefix('dashboard')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/index2', 'index2')->name('index2');
        Route::get('/index3', 'index3')->name('index3');
        Route::get('/index4', 'index4')->name('index4');
        Route::get('/index5', 'index5')->name('index5');
        Route::get('/wallet', 'wallet')->name('wallet');
    });
});

// Forms
Route::prefix('forms')->group(function () {
    Route::controller(FormsController::class)->group(function () {
        Route::get('/form-layout', 'formLayout')->name('formLayout');
        Route::get('/form-validation', 'formValidation')->name('formValidation');
        Route::get('/form', 'form')->name('form');
        Route::get('/wizard', 'wizard')->name('wizard');
    });
});

// invoice/invoiceList
Route::prefix('invoice')->group(function () {
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoice-add', 'invoiceAdd')->name('invoiceAdd');
        Route::get('/invoice-edit', 'invoiceEdit')->name('invoiceEdit');
        Route::get('/invoice-list', 'invoiceList')->name('invoiceList');
        Route::get('/invoice-preview', 'invoicePreview')->name('invoicePreview');
    });
});

// Settings
Route::prefix('settings')->group(function () {
    Route::controller(SettingsController::class)->group(function () {
        Route::get('/company', 'company')->name('company');
        Route::get('/currencies', 'currencies')->name('currencies');
        Route::get('/language', 'language')->name('language');
        Route::get('/notification', 'notification')->name('notification');
        Route::get('/notification-alert', 'notificationAlert')->name('notificationAlert');
        Route::get('/payment-gateway', 'paymentGateway')->name('paymentGateway');
        Route::get('/theme', 'theme')->name('theme');
    });
});

// Table
Route::prefix('table')->group(function () {
    Route::controller(TableController::class)->group(function () {
        Route::get('/tablebasic', 'tableBasic')->name('tableBasic');
        Route::get('/tabledata', 'tableData')->name('tableData');
    });
});

// Users
Route::prefix('users')->group(function () {
    Route::controller(UsersController::class)->group(function () {
        Route::get('/add-user', 'addUser')->name('addUser');
        Route::get('/users-grid', 'usersGrid')->name('usersGrid');
        //Route::get('/users-list', 'usersList')->name('usersList');
        Route::get('/view-profile', 'viewProfile')->name('viewProfile');
    });
});
