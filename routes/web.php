<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\Invite\InviteController;
use App\Http\Controllers\unite\UniteController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\PvController;
use App\Http\Controllers\Admin\HistoryController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('invalide_route', function () {return view('invalide_route');});
Route::get('/welcome', function () { return view('welcome');});
Route::get('/message', function () { return view('vendor.Chatify.pages.app');});
Route::get('calender', [CalenderController::class, 'index']);
Auth::routes();


//******************* route visiteur **********************/
Route::group(['middleware'=>['auth','isAdmin']], function(){

        //compte
        Route::get('list',                    [UserController::class, 'showAccount'])->name('list');
        Route::get('/edit/{id}',              [UserController::class, 'showEditAccount'])->name('showEditAccount');
        Route::post('/update/{id}/account',   [UserController::class, 'handleUpdateAccount'])->name('handleUpdateAccount');
        Route::get('/delete/{id}',            [UserController::class, 'handleDeleteAccount'])->name('handleDeleteAccount');
        Route::post('new',                    [UserController::class, 'handleAddAccount'])->name('handleAddAccount');

        //historique
        Route::get('historique',              [historyController::class, 'showHistory'])->name('historique');

});

 //*********route unite******* */
Route::group(['middleware'=>['auth','isUnite']], function(){
    Route::get('unite/home',                     [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //entreprise
    Route::get('/listEntreprise',                [EntrepriseController::class, 'ListEntrepise'])->name('ListEntrepise');
    Route::get('/EditEntreprise/{id}',           [EntrepriseController::class, 'getUpdate'])->name('getUpdate');
    Route::post('/EditEntreprises/{id}',         [EntrepriseController::class, 'EditEntreprise'])->name('EditEntreprises');
    Route::get('/DeleteEntreprise/{id}',         [EntrepriseController::class, 'DeleteEntreprise']);
    Route::get('/AjouterEntreprise',             [EntrepriseController::class, 'getAddEntreprise'])->name('getAddEntreprise');
    Route::post('/AjouterEntreprises',           [EntrepriseController::class, 'AddEntreprise'])->name('AddEntreprise');

    //route reunion
    Route::get('/prepare_reunion',               [ReunionController::class, 'PrepareReunion'])->name('prepare_reunion');
    Route::post('/add_reunion',                  [ReunionController::class, 'AddReunion'])->name('add_reunion');
    Route::get('/detailler_reunion/{id}',        [ReunionController::class, 'DetailReunion'])->name('detailler_reunion');
    Route::get('/delete_planifier/{id}',         [ReunionController::class, 'DestroyPlanifier'])->name('delete_planifier');
    Route::get('/voir_reunion',                  [ReunionController::class, 'GetReunion'])->name('voir_reunion');
    Route::get('/view_invite_reunion/{id}',      [ReunionController::class, 'GetInviteReunion'])->name('view_invite_reunion');

    Route::get('/delete_reunion/{id}',           [ReunionController::class, 'DeleteReunion'])->name('delete_reunion');

    //route pv
    Route::get('/form_pv/{id}',                  [ReunionController::class, 'showReunionFinish'])->name('showReunionFinish');
    Route::post('/proces/verbal/{id}/new',       [PvController::class, 'HandleAddProcesVerbal'])->name('HandleAddProcesVerbal');

    Route::post('calender/action',               [CalenderController::class, 'action']);

});


//********route invite ************/

Route::group(['middleware'=>['auth','isInvite']], function(){

    Route::get('invite/home', function () {
        return view('invite.index');
    });


    Route::get('invite/pv/show',              [PvController::class, 'showInvitePv'])->name('showInvitePv');
    Route::post('invite/pv/comment/new',      [PvController::class, 'handleAddComment'])->name('handleAddComment');
    Route::get('invite/pv/show/{id}/detaille',[PvController::class, 'showInvitePvDetailled'])->name('showInvitePvDetailled');



    Route::get('invite/reunion/show',         [InviteController::class, 'showInviteReunion'])->name('showInviteReunion');
    Route::get('/download/{file}',            [InviteController::class, 'download'])->name('download');


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
