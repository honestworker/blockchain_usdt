<?php

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

//Payment IPN
Route::post('/ipncoinpay', 'PaymentController@ipnCoinPay')->name('ipn.coinPay');
//Payment IPN

//Round END CRON
Route::get('/end-round', 'VisitorController@endRound')->name('endRound');

Route::get('/', 'VisitorController@index')->name('user.index');
Route::get('/language/{lang}', 'VisitorController@language')->name('user.language');
Route::post('/contac-message', 'VisitorController@contacMessage')->name('contac.message');

Route::get('/404', function () {return view('404');})->middleware('language')->name('404');
Auth::routes();
Route::group(['middleware' => ['guest']], function () {
    Route::get('/register/{reference}', 'VisitorController@register');
});

//verification
Route::get('/verifiaction', 'VisitorController@verification')->name('user.verify');
Route::post('/send-vcode', 'VisitorController@sendVcode')->name('user.send-vcode');
Route::post('/email-verify', 'VisitorController@emailVerify')->name('user.email-verify');
Route::post('/sms-verify', 'VisitorController@smsVerify')->name('user.sms-verify');

//Password Reset
Route::get('/password-resetreq', 'VisitorController@resetEmail')->name('password.resetreq');
Route::post('/password-sendemail', 'VisitorController@sendEmail')->name('password.sendemail');
Route::get('/password-reset/{token}', 'VisitorController@resetForm')->name('password.resetform');
Route::post('/reset-password', 'VisitorController@resetPassword')->name('password.resetpassword');

//User Routes
Route::group(['middleware' => ['auth','uverify','language']], function() {
    Route::group(['prefix' => 'home'], function () 
    {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/payments', 'HomeController@payments')->name('user.payments');
        Route::get('/keys', 'HomeController@keys')->name('user.keys');
        Route::get('/profile', 'HomeController@userProfileData')->name('user.profile');
        Route::post('/update-profile', 'HomeController@updateProfile')->name('user.update-profile');
        Route::post('/change-password', 'HomeController@changePassword')->name('user.change-passwordpost');
        Route::get('/transactions', 'HomeController@transactionLog')->name('user.transactions');
        Route::post('/purchase-vault', 'HomeController@purchaseVault')->name('user.purchase');
        Route::post('/deposit-confirm', 'PaymentController@depositConfirm')->name('deposit.confirm');
        Route::get('/withdraw', 'HomeController@withdraw')->name('user.withdraw');
        Route::post('/withdraw-post', 'HomeController@withdrawPost')->name('withdraw.post');
    });
});

Route::group(['middleware' => ['auth:admin']], function() {
    Route::prefix('admin')->group(function() {
    
        Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
        Route::get('/keys', 'AdminController@keys')->name('admin.keys');
        Route::get('/transactions', 'AdminController@transactions')->name('admin.transactions');

        //General Settings
        Route::get('/general', 'AdminController@general')->name('admin.general');
        Route::post('/general-update', 'AdminController@generalUpdate')->name('admin.gnlupdate');

        //Payment Gateway
        Route::get('/gateway', 'AdminController@gateway')->name('admin.gateway');
        Route::put('/gateway-update/{gateway}', 'AdminController@gatewayUpdate')->name('admin.gateup');

        //Withdraw Gateway
        Route::get('/wmethod', 'AdminController@wmethod')->name('admin.wmethod');
        Route::post('/wmethod-craete', 'AdminController@wmethodCreate')->name('admin.wmethod-create');
        Route::put('/wmethod-update/{wmethod}', 'AdminController@wmethodUpdate')->name('admin.wmethod-update');

        //Rounds
        Route::get('/round', 'RoundController@round')->name('admin.round');
        Route::post('/round-craete', 'RoundController@roundCreate')->name('admin.round-create');
        Route::put('/round-update/{round}', 'RoundController@roundUpdate')->name('admin.round-update');

        //Teams
        Route::get('/team', 'TeamController@team')->name('admin.team');
        Route::post('/team-craete', 'TeamController@teamCreate')->name('admin.team-create');
        Route::put('/team-update/{team}', 'TeamController@teamUpdate')->name('admin.team-update');

        //Logo-Icon
        Route::get('/logo-icon', 'AdminController@logoIcon')->name('admin.logo');
        Route::post('/logo-update', 'AdminController@logoUpdate')->name('admin.logoupdate');

        //Email-SMS
        Route::get('/email-sms', 'AdminController@emailSms')->name('admin.email');
        Route::post('/email-update', 'AdminController@emailUpdate')->name('admin.emailup');

        //User Management
        Route::get('/users', 'AdminController@userIndex')->name('admin.users');
        Route::post('/user-search', 'AdminController@userSearch')->name('admin.search-users');
        Route::get('/user/{user}', 'AdminController@singleUser')->name('admin.user-single');
        Route::get('/user-banned', 'AdminController@bannedUser')->name('admin.user-ban');
        Route::get('/mail/{user}', 'AdminController@email')->name('admin.user-email');
        Route::post('/sendmail', 'AdminController@sendemail')->name('admin.send-email');
        Route::put('/user/pass-change/{user}', 'AdminController@userPasschange')->name('admin.user-pass');
        Route::put('/user/status/{user}', 'AdminController@statupdate')->name('admin.user-status');
        Route::get('/broadcast', 'AdminController@broadcast')->name('admin.broadcast');
        Route::post('/broadcast/email', 'AdminController@broadcastemail')->name('admin.broadcast-email');
        Route::get('/deposits', 'AdminController@deposits')->name('admin.deposits');
        Route::put('/deposit-approve/{depo}', 'AdminController@depoApprove')->name('admin.depo-approve');
        Route::put('/deposit-cancel/{depo}', 'AdminController@depoCancel')->name('admin.depo-cancel');
        Route::get('/withdraw-request', 'AdminController@withdrawRequest')->name('admin.withdraw-request');
        Route::get('/withdraw-log', 'AdminController@withdrawLog')->name('admin.withdraw-log');
        Route::put('/withdraw-approve/{withdraw}', 'AdminController@withdrawApprove')->name('admin.withdraw-approve');
        Route::put('/withdraw-cancel/{withdraw}', 'AdminController@withdrawCancel')->name('admin.withdraw-cancel');

        //Password Change
        Route::get('/change-password', 'AdminController@changePassword')->name('admin.change-password');
        Route::post('/password-update', 'AdminController@updatePassword')->name('admin.password-update');

        //Register New Admin
        Route::get('/new-admin', 'AdminController@newAdmin')->name('admin.new-admin');
        Route::get('/list-admin', 'AdminController@listAdmin')->name('admin.list-admin');
        Route::post('/create-admin', 'AdminController@createAdmin')->name('admin.create-admin');

        //Slider Content
        Route::get('/slider-section', 'FrontendController@sliderSection')->name('admin.slidersection');
        Route::post('/slider-store', 'FrontendController@sliderStore')->name('admin.slide-store');
        Route::put('/slide-update/{slide}', 'FrontendController@sliderUpdate')->name('admin.slide-update');
        Route::put('/slide-delete/{slide}', 'FrontendController@sliderDestroy')->name('admin.slide-delete');
        
        //Social Content
        Route::get('/social-section', 'FrontendController@socialSection')->name('admin.socialsection');
        Route::post('/social-store', 'FrontendController@socialStore')->name('admin.social-store');
        Route::put('/social-update/{social}', 'FrontendController@socialUpdate')->name('admin.social-update');
        Route::put('/social-delete/{social}', 'FrontendController@socialDestroy')->name('admin.social-delete');
        
        //About Content
        Route::get('/about-section', 'FrontendController@aboutSection')->name('admin.aboutsection');
        Route::post('/about-update', 'FrontendController@aboutUpdate')->name('admin.about-update');
        
        //Footer Content
        Route::get('/footer-section', 'FrontendController@footerSection')->name('admin.footersection');
        Route::post('/footer-update', 'FrontendController@footerUpdate')->name('admin.footer-update');

        //Language
        Route::get('/language', 'LanguageController@index')->name('admin.language');
        Route::post('/new-lang', 'LanguageController@store')->name('admin.newlang');
        Route::post('/update-lang', 'LanguageController@update')->name('admin.updateLang');
        Route::post('/delete-lang', 'LanguageController@delete')->name('admin.deleteLang');
    });
});

//Admin Auth
Route::prefix('admin')->group(function() {
    Route::get('/', 'AdminController@showLoginForm')->name('admin.login')->middleware('guest:admin');
    Route::post('/login', 'AdminController@login')->name('admin.loginpost')->middleware('guest:admin');
    Route::get('/register', 'AdminController@showRegistrationForm')->name('admin.register')->middleware('auth:admin');
    Route::post('/register-post', 'AdminController@register')->name('admin.registerpost')->middleware('auth:admin');
    Route::post('/logout', 'AdminController@logout')->name('admin.logout');  
});
