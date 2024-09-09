<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LiveMatchController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerStatMatchController;
use App\Http\Controllers\PlayerStatMatchInsertController;
use App\Http\Controllers\LiveStatMatchController;
use App\Http\Controllers\MatchTeamController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ArticleController;

Route::get('/contact', [MessageController::class, 'showForm']);


/* Admin Route */
Route::get('/article', function () {
    return view('admin.article');
});

Route::get('/manageuser', function () {
    return view('admin.manageuser');
});

Route::get('/managematch', function () {
    return view('admin.managematch');
});

// Route::get('/adminpage', function () {
//     return view('admin.page');
// });


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/contacts/{id}', [ContactController::class, 'show']);


Route::get('/adminpage', [ContactController::class, 'showContactInfo2'])->name('contact.show');
Route::post('/admin/contact/update', [ContactController::class, 'updateContactInfo'])->name('contact.update');

/*End Admin Route */
/* Manager Route */
// Tournament
Route::post('/tournament/create', [TournamentController::class, 'create'])->name('tournament.create');
Route::post('/tournament/store', [TournamentController::class, 'store'])->name('tournament.store');
Route::get('/tournament', function () { return view('tournament');})->name('tournament');
Route::get('/tournaments-view', [TournamentController::class, 'index'])->name('tournaments.index');

//Formation (Manager)

// Route::get('/team', function () { return view('team');})->name('team');
Route::get('/team/index', [TeamController::class, 'index'])->name('team.index');
Route::get('/team', [TeamController::class, 'view'])->name('team.view');
Route::get('/team', [TeamController::class, 'create'])->name('team.create');
Route::post('/team', [TeamController::class, 'store'])->name('team.store');


//Player (Manager)
Route::get('/player/create', [PlayerController::class, 'create'])->name('player.create');
Route::post('/player/store', [PlayerController::class, 'store'])->name('player.store');
Route::get('/player', function () { return view('player');})->name('player');
Route::get('/player/index', [PlayerController::class, 'index'])->name('player.index');
Route::get('/player-view', [PlayerController::class, 'view'])->name('player.view');
Route::get('/player-view', function () {$players = App\Models\Player::all(); return view('player-view', ['players' => $players]);})->name('player.view');
Route::get('/players/export', [PlayerController::class, 'exportCsv'])->name('players.export');
Route::get('/players/import', [PlayerController::class, 'importForm'])->name('players.import.form');
Route::post('/players/import', [PlayerController::class, 'importCsv'])->name('players.import');
Route::get('/player/{id}/edit', [PlayerController::class, 'edit'])->name('player.edit');
Route::post('/player/{id}/update', [PlayerController::class, 'update'])->name('player.update');
Route::delete('/player/{id}', [PlayerController::class, 'destroy'])->name('player.destroy');

//Manager
//Dashboard
Route::get('/manager-dashboard', function () {return view('manager-dashboard');});

// Line-Up
Route::get('/line-up', function () {return view('line-up');});
Route::get('/line-up', [TeamController::class, 'showLineUp'])->name('line-up');

/*End Manager Route */
/* User Route */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/playerstatmatch', [PlayerStatMatchInsertController::class, 'create'])->name('playerstatmatch.create');
Route::post('/playerstatmatch', [PlayerStatMatchInsertController::class, 'store'])->name('playerstatmatch.store');

Route::get('/livematch/{matchGroupId}', [LiveStatMatchController::class, 'showLiveMatch'])->name('livematch');
Route::get('/match/{matchGroupId}' , [MatchTeamController::class, 'showMatchDetails'])->name('matchDetail');

Route::get('/live-matches', [LiveMatchController::class, 'showLiveMatch'])
    ->name('live-matches');

Route::get('/tournament',  [LiveMatchController::class, 'showLiveMatch'])
    ->name('live-matches');

Route::get('/livematch', function () {
    return view('livematch');
});

Route::get('/', function () {
    return view('user.Home');
});

Route::get('/home', function () {
    return view('dashboard');
});

// Route::get('/match', function () {
//     return view('match');
// });

Route::get('/livematch', function () {
    return view('user.livematch');
});

Route::get('/group', function () {
    return view('user.group');
});

// Route::get('/forum', function () {
//     return view('forum');
// });

Route::get('/forum', [ArticleController::class, 'latestPublished']);


Route::get('/about', function () {
    return view('user.about');
});

Route::get('/contact', function () {
    return view('user.contact');
});

Route::get('/contact',  [ContactController::class, 'showcontactinfo'])
    ->name('showcontactinfo');

Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');

// Route::get('/draft', function () {
//     return view('draft');
// });

// web.php
Route::get('/user', function () {
    return view('user.user');
})->middleware(['auth','verified'])->name('user');

// Route::get('/login2', function () {
//     return view('login2');
// });

// Route::get('/register2', function () {
//     return view('register2');
// });

Route::get('/fixture', function () {
    return view('fixture');
});

/*End User Route */

// login controller 

// Admin Dashboard
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'role:1'])->name('dashboard');

// // Manager Dashboard
// Route::get('/manager-dashboard', function () {
//     return view('manager-dashboard');
// })->middleware(['auth', 'role:2']);

// // User Homepage
// Route::get('/', function () {
//     return view('home'); 
// });

// end login 




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
