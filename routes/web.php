<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\Invite\InviteController;
use App\Http\Controllers\unite\UniteController;



Route::get('/', function () {
    return view('welcome');
});
Route::get('invalide_route', function () {return view('invalide_route');});
Route::get('/welcome', function () { return view('welcome');});
Route::get('/message', function () { return view('vendor.Chatify.pages.app');});
Route::get('calender', [CalenderController::class, 'index']);

Auth::routes();


//********route visiteur ************/

Route::group(['middleware'=>['auth','isAdmin']], function(){

      //compte
        Route::get('list',                    [UserController::class, 'ListUser'])->name('list');
        Route::get('/EditUser/{id}',          [UserController::class, 'getUpdate'])->name('getUpdateuser');
        Route::post('/EditUsers/{id}',        [UserController::class, 'EditUser'])->name('EditUsers');
        Route::get('/DeleteUser/{id}',        [UserController::class, 'DeleteUser']);
        Route::POST('new',                    [UserController::class, 'handleAddAccount'])->name('handleAddAccount');
});

 //*********route admin******* */
Route::group(['middleware'=>['auth','isUnite']], function(){
Route::get('/home',                           [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//entreprise
Route::get('/listEntreprise',                 [App\Http\Controllers\EntrepriseController::class, 'ListEntrepise'])->name('ListEntrepise');
Route::get('/EditEntreprise/{id}',            [App\Http\Controllers\EntrepriseController::class, 'getUpdate'])->name('getUpdate');
Route::post('/EditEntreprises/{id}',          [App\Http\Controllers\EntrepriseController::class, 'EditEntreprise'])->name('EditEntreprises');
Route::get('/DeleteEntreprise/{id}',          [App\Http\Controllers\EntrepriseController::class, 'DeleteEntreprise']);
Route::get('/AjouterEntreprise',              [App\Http\Controllers\EntrepriseController::class, 'getAddEntreprise'])->name('getAddEntreprise');
Route::post('/AjouterEntreprises',            [App\Http\Controllers\EntrepriseController::class, 'AddEntreprise'])->name('AddEntreprise');

//*route reunion*////
Route::get('/prepare_reunion',               [ReunionController::class, 'PrepareReunion'])->name('prepare_reunion');
Route::post('/add_reunion',                  [ReunionController::class, 'AddReunion'])->name('add_reunion');
Route::get('/detailler_reunion/{id}',        [ReunionController::class, 'DetaikReunion'])->name('detailler_reunion/{id}');
Route::get('/delete_planifier/{id}',         [ReunionController::class, 'DestroyPlanifier'])->name('delete_planifier/{id}');
Route::get('/fetch_reunion',                 [ReunionController::class, 'GetReunion'])->name('fetch_reunion/{id}');
Route::get('/view_invite_reunion/{id}',      [ReunionController::class, 'GetInviteReunion'])->name('view_invite_reunion/{id}');
Route::get('/download/{document}',           [ReunionController::class, 'Download']);
Route::get('/delete_reunion/{id}',           [ReunionController::class, 'DeleteReunion'])->name('delete_reunion/{id}');

Route::post('calender/action',               [CalenderController::class, 'action']);



});


//********route invite ************/

Route::group(['middleware'=>['auth','isInvite']], function(){

    Route::get('invite/home', function () {
        return view('invite.index');
    });

    Route::get('invite/voir_reunion', [InviteController::class, 'GetReunionInvite']);
    Route::get('/download_document/{document}',[ReunionController::class, 'Download']);




});



//********route visiteur ************/

Route::group(['middleware'=>['auth','isVisiteur']], function(){

    Route::get('visiteur', function () {
        return 'hi visiteur';
    });


});



//********route ministere ************/

Route::group(['middleware'=>['auth','isMinistere']], function(){

    Route::get('ministere', function () {
        return 'hi ministere';
    });


});
