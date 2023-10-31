<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\Invite\InviteController;
use \App\Http\Controllers\Ministere\ministereController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\PvController;
use App\Http\Controllers\Admin\HistoryController;


Route::get('invite/pv/show/{id}/detaille',[PvController::class, 'showInvitePvDetailled'])->name('showInvitePvDetailled');
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
    Route::put('/reporter_reunion/{id}',         [ReunionController::class, 'handleReporterReunion'])->name('handleReporterReunion');

    //route pv

    Route::get('/form_pv/{id}',                  [ReunionController::class, 'showReunionFinish'])->name('showReunionFinish');
    Route::post('/proces/verbal/{id}/new',       [PvController::class, 'HandleAddProcesVerbal'])->name('HandleAddProcesVerbal');

    Route::get('unite/pv/show',                  [PvController::class, 'showUnitePv'])->name('showUnitePv');


    Route::get('unite/file/{id}/show',                [ReunionController::class, 'showUniteFile'])->name('showUniteFile');


    //decision

    Route::get('/unite/reunion/finish',          [DecisionController::class, 'showReunionFinished'])->name('showReunionFinished');
    Route::get('/unite/decision/list',           [DecisionController::class, 'showUniteDecision'])->name('showUniteDecision');
    Route::post('/unite/decision/new',           [DecisionController::class, 'handleAddDecision'])->name('handleAddDecision');
    Route::get('/unite/download/decision{file}', [DecisionController::class, 'handleDownloadDecision'])->name('handleDownloadDecision');
    Route::get('/unite/delete/decision{id}',     [DecisionController::class, 'handleUniteDeleteDecision'])->name('handleUniteDeleteDecision');





    Route::post('calender/action',               [CalenderController::class, 'action']);

});


//********route invite ************/

Route::group(['middleware'=>['auth','isInvite']], function(){

    Route::get('invite/home', function () {
        return view('invite.index');
    });

    Route::get('invite/pv/show',              [PvController::class, 'showInvitePv'])->name('showInvitePv');
    Route::post('invite/pv/comment/new',      [PvController::class, 'handleAddComment'])->name('handleAddComment');

    Route::get('invite/decision/list',        [InviteController::class, 'showListDecision'])->name('showListDecision');
    Route::put('invite/decision/update/{id}', [InviteController::class, 'handleInviteUpdateDecision'])->name('handleInviteUpdateDecision');
    Route::get('invite/reunion/show',         [InviteController::class, 'showInviteReunion'])->name('showInviteReunion');
    Route::get('invite/download/{file}',      [InviteController::class, 'handleInviteDownload'])->name('handleInviteDownload');
    Route::get('invite/down/{file}',          [InviteController::class, 'handleInviteDownloadReunion'])->name('handleInviteDownloadReunion');

});





//********route ministere ************/

Route::group(['middleware'=>['auth','isMinistere']], function(){

    Route::get('ministere/pv/show',              [ministereController::class, 'showMinisterePv'])->name('showMinisterePv');
    Route::post('ministere/pv/comment/new',      [ministereController::class, 'handleMinistereAddComment'])->name('handleMinistereAddComment');
    Route::get('ministere/pv/show/{id}/detaille',[ministereController::class, 'showMinisterePvDetailled'])->name('showMinisterePvDetailled');
    Route::get('ministere/index',                [ministereController::class, 'index']);
    Route::get('ministere/reunion/show',         [ministereController::class, 'showMinistereReunion'])->name('showMinistereReunion');
    Route::get('ministere/download/{file}',      [ministereController::class, 'handleMinistereDownload'])->name('handleMinistereDownload');
    Route::get('ministere/down/{file}',          [ministereController::class, 'handleMinistereDownloadReunion'])->name('handleMinistereDownloadReunion');
    Route::get('/ministere/decision/list',       [ministereController::class, 'showministereDecision'])->name('showministereDecision');

    Route::get('/profile',                         [ministereController::class, 'showMinistereEditProfile'])->name('showMinistereEditProfile');
    Route::post('/profile/update',                 [ministereController::class, 'handleMinistereUpdateProfile'])->name('handleMinistereUpdateProfile');
    Route::post('/profile/picture/update',         [ministereController::class, 'handleMinistereUpdatePictureProfile'])->name('handleMinistereUpdatePictureProfile');
    Route::get('/password',                        [ministereController::class, 'showMinistereEditPassword'])->name('showMinistereEditPassword');
    Route::post('/password/update',                [ministereController::class, 'handleMinistereUpdatePassword'])->name('handleMinistereUpdatePassword');


});
