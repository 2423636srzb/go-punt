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
use App\Http\Controllers\AccountManageController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlatformTransactionController;
use App\Http\Controllers\SportsController;
use App\Http\Controllers\StaffController;
use App\Http\Middleware\InactivityTimeout;
use Illuminate\Support\Facades\Broadcast;

//Route::controller(DashboardController::class)->group(function () {
//    Route::get('/', 'index')->name('index');
//});

// Register broadcasting routes
Broadcast::routes();

// Include channels definition
require base_path('routes/channels.php');
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});
Route::get('/sports', [SportsController::class, 'index']);
Route::get('/loginPage', [HomeController::class, 'loginPage'])->name('login.view');
Route::get('/score', [HomeController::class, 'score']);
Route::get('/signupPage', [HomeController::class, 'signupPage'])->name('signUp.view');
Route::get('/forgotPassword', [HomeController::class, 'forgotPassword'])->name('forgotpassword.view');
Route::post('/approvePassword', [UsersController::class, 'approvePassword'])->name('approve.password');

Route::get('/match/live/{eventId}/{name}/{channelId}', [MatchController::class, 'cricketLive'])->name('match.live');
// Route::get('/tennis/live', [MatchController::class, 'tennisLive'])->name('tennis.live');
// Route::get('/football/live', [MatchController::class, 'footballLive'])->name('football.live');
Route::post('/signup', [HomeController::class, 'store'])->name('signup.store');
Route::post('/login', [HomeController::class, 'login'])->name('login');

Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
// Route::post('/system/logout', function () {
//     Auth::logout();
//     session()->invalidate(); // Invalidate session
//     session()->regenerateToken(); // Prevent CSRF reuse
// })->name('system.logout');
Route::post('/admin-verify-otp', [HomeController::class, 'verifyOtp']);
Route::middleware(['auth', InactivityTimeout::class])->group(function () {

Route::get('/notifications', [UsersController::class, 'showNotification'])->name('notifications.show');
Route::get('/notifications/{id}/read', [UsersController::class, 'markAsRead'])->name('notifications.read');
Route::post('games/uploadAccountMultiplee', [GameController::class, 'uploadAccountsMultiple']);
Route::get('/users/dashboard', [UsersController::class, 'dashboard'])->middleware('auth')->name('users.dashboard');
Route::post('/forgot-password', [UsersController::class, 'forgotPassword'])->name('forgot.password');
Route::get('/users/profile', [UsersController::class, 'profile'])->middleware('auth')->name('users.user_profile');
Route::post('/users/upload-profile-image', [UsersController::class, 'uploadProfileImage'])->middleware('auth')->name('users.uploadProfileImage');
Route::post('/users/updateProfile', [UsersController::class, 'updateProfile'])->middleware('auth')->name('users.updateProfile');
Route::post('/users/updatePassword', [UsersController::class, 'updatePassword'])->middleware('auth')->name('users.password');
Route::get('/ifsc-details/{ifsc}', [BankAccountController::class, 'getIfscDetails']);

/* Bank account Details */
Route::post('/user/bank-accounts/otp', [BankAccountController::class, 'sendOtp'])->middleware('auth')->name('send.otp');
Route::post('/verify-otp', [BankAccountController::class, 'verifyOtp'])->name('verify.otp');

Route::get('/users/bankAccount/{id}', [BankAccountController::class, 'edit'])->name('users.bankAccount.edit');
Route::get('/bank_account', [BankAccountController::class, 'bankAccount'])->name('users.bankAccount.view');
Route::any('/user/bank-accounts/{id}', [BankAccountController::class, 'update'])->name('bank_accounts.update');

Route::post('/user/bank-accounts', [BankAccountController::class, 'store'])->name('users.bankAccount');


Route::delete('/user/bank-accounts/delete/{id}', [BankAccountController::class, 'destroy'])->name('bank_accounts.destroy');

Route::get('/admin/bankAccount/{id}', [BankAccountController::class, 'adminBankEdit'])->name('admin.bankAccount.edit');
Route::any('/admin/bank-accounts/{id}', [BankAccountController::class, 'adminBankUpdate'])->middleware('auth')->name('admin.bank_accounts.update');
Route::post('/admin/bank-accounts', [BankAccountController::class, 'adminBankStore'])->name('admin.bankAccount');
Route::delete('/admin/bank-accounts/delete/{id}', [BankAccountController::class, 'adminBankDestroy'])->name('admin.bank_accounts.destroy');




/* Payment Request */
Route::get('/forgot-requests/unread-count', [UsersController::class, 'getUnreadCount'])
    ->name('forgotRequests.unreadCount');
Route::get('/live/matches', [UsersController::class, 'liveMatches'])->middleware('auth')->name('live.matches');
Route::get('/live/stream/{eventId}/{sportId}/{channelId}', [UsersController::class, 'liveStream'])->middleware('auth')->name('live.stream');
Route::get('/payment/request', [UsersController::class, 'paymentRequest'])->middleware('auth')->name('users.payment_request');
Route::get('/password/request', [UsersController::class, 'passwordRequestList'])->middleware('auth')->name('admin.user_password_request');
Route::get('/requestPayment', [PaymentController::class, 'requestPayment'])->middleware('auth')->name('admin.payment_request');
Route::middleware('auth')->prefix('staffSetting')->name('admin.staff.')->group(function () {
    Route::get('/', [StaffController::class, 'index'])->name('setting');
    Route::get('/delete{id}', [StaffController::class, 'destroy'])->name('destroy');
    Route::post('/store', [StaffController::class, 'store'])->name('store');
    Route::put('/update/{admin}', [StaffController::class, 'update'])->name('update');
    Route::delete('/delete/{admin}', [StaffController::class, 'destroy'])->name('delete');


});
Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
Route::get('/analytics-data', [AnalyticsController::class, 'fetchData']);
Route::get('/get-payment-request/{id}', [PaymentController::class, 'getPaymentRequest'])->middleware('auth')->name('payment_request');

Route::get('/admin-account-details/{id}', [PaymentController::class, 'getDetails']);

Route::get('/payment-request-approve/{id}', [PaymentController::class, 'acceptPaymentRequest']);
Route::get('/payment-request-reject/{id}', [PaymentController::class, 'rejectPaymentRequest']);
Route::get('/withdraw-request-approve/{id}', [PaymentController::class, 'acceptWithdrawRequest']);
Route::get('/withdraw-request-reject/{id}', [PaymentController::class, 'rejectWithdrawRequest']);
Route::get('/withdrawal/{id}', [PaymentController::class, 'getWithdrawalData']);

Route::get('/admin/user/edit/{id}', [UsersController::class, 'getUser'])->middleware('auth');
Route::post('/admin/user/update', [UsersController::class, 'updateUser'])->name('user.update')->middleware('auth');


// Route::post('/admin/update-user-status/{id}', [UsersController::class, 'updateUserStatus']);


Route::get('/admin/website-setting', [UsersController::class, 'webSiteSetting'])->middleware('auth')->name('admin.website.setting');
Route::post('/admin/website-setting-update', [UsersController::class, 'webSiteSettingUpdate'])->middleware('auth')->name('website.update');

Route::post('/admin/website-announcement-update', [UsersController::class, 'webSiteAnnounceUpdate'])->middleware('auth')->name('website.announce');



Route::get('/admin/users', [UsersController::class, 'usersList'])->middleware('auth')->name('admin.users');

Route::post('/give-bonus', [UsersController::class, 'bonus'])->middleware('auth')->name('admin.give.bonus');
Route::get('/bonus-list', [UsersController::class, 'bonusList'])->middleware('auth')->name('admin.bonus.list');
Route::get('/user-bonus-list', [UsersController::class, 'userBonusList'])->middleware('auth')->name('user.bonus.list');
Route::post('/assign-bonus', [UsersController::class, 'assignBonus'])->middleware('auth')->name('admin.assign.bonus');

Route::get('/admin/users/userDetail/{id}', [UsersController::class, 'userDetail'])->middleware('auth')->name('admin.user.view');

Route::PATCH('/admin/users/updateUserStatus/{id}/{status}', [UsersController::class, 'updateUserStatus'])->middleware('auth')->name('admin.user.status');
Route::post('/users/{user}/update-assigned-games', [UsersController::class, 'updateAssignedGames'])->name('admin.updateAssignedGames');

Route::put('/admin/users/{userId}/update-assigned-games', [UsersController::class, 'updateAssignedUsernames'])
    ->name('admin.user.updateAssignedGames');

Route::get('/admin/users/userAttachments/{id}', [UsersController::class, 'userAttachments'])->middleware('auth')->name('admin.user.attachments');
Route::get('/admin/dashboard', [UsersController::class, 'adminDashboard'])->middleware('auth')->name('admin.dashboard');
//Route::get('/admin/dashboard', [GameController::class, 'adminGame'])->middleware('auth')->name('admin.game');
Route::get('games/list', [GameController::class, 'listing'])->name('games.list'); // Define specific routes first
Route::get('/games/{id}/edit', [GameController::class, 'edit'])->name('games.edit');
Route::post('/games/{id}', [GameController::class, 'update'])->name('games.update');
Route::post('/game/account/request', [GameController::class, 'requestAccount'])->name('game.account.request');

Route::get('games/accounts', [GameController::class, 'accounts'])->name('games.accounts');
Route::get('games/accounts_request', [GameController::class, 'accountsRequestList'])->name('admin.game_account_request');

Route::post('/account-requests/approve', [GameController::class, 'accountApprove'])->name('account-requests.approve');
Route::post('/account-requests/reject', [GameController::class, 'accountReject'])->name('account-requests.reject');


Route::post('/acount-store', [GameController::class, 'accountStore'])->name('account.store');


Route::resource('games', GameController::class)->middleware('auth');
Route::patch('games/{game}/disable', [GameController::class, 'disable'])->name('games.disable');
Route::patch('games/{game}/enable', [GameController::class, 'enable'])->name('games.enable');

Route::get('/download-sample', [GameController::class, 'downloadSample'])->name('admin.sample.download');


/* Trasnactions */


Route::resource('account-manage', AccountManageController::class)->middleware('auth');
Route::get('/assigned-accounts/{id}', [AccountManageController::class, 'assignedAccount'])->name('accounts.assigned');
Route::get('/account/{id}', [AccountManageController::class, 'getAccount'])->name('get.account');
Route::post('/account-update', [AccountManageController::class, 'updateAccount'])->name('account.update');


Route::patch('games/{game}/disable', [AccountManageController::class, 'disable'])->name('games.disable');
Route::patch('games/{game}/enable', [AccountManageController::class, 'enable'])->name('games.enable');
Route::post('games/uploadAccounts', [AccountManageController::class, 'uploadAccounts'])->name('games.uploadAccounts');
Route::get('/download-sample', [AccountManageController::class, 'downloadSample'])->name('admin.sample.download');



// For web routes
Route::post('/transaction-store', [PlatformTransactionController::class, 'storeTransaction'])->name('transaction.store');
Route::delete('/transaction/{id}', [PlatformTransactionController::class, 'destroy'])->name('transaction.destroy');
Route::delete('/withdraw/{id}', [PlatformTransactionController::class, 'withdrawDestroy'])->name('withdraw.destroy');
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
});
