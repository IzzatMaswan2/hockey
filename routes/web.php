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
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\FormationController;


Route::get('/contact', [MessageController::class, 'showForm']);
/* Admin Route */
Route::get('/article', [ArticleController::class, 'create'])->name('article.create');
Route::post('/article', [ArticleController::class, 'store'])->name('articles.store');

Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');

Route::get('/forum', function () {
    $latestArticle = \App\Models\Article::latest()->first();
    if ($latestArticle) {
        return redirect()->route('article.show', $latestArticle->id);
    }
    return redirect()->route('article.create')->with('info', 'No articles available.');
});

Route::get('/manageuser', function () {
    return view('admin.manageuser');
});

Route::get('/managematch', function () {
    return view('admin.managematch');
});

//Dashboard Admin
// Route::get('/dashboard', [DashboardController::class, 'index']);
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/dashboard', [GoalController::class, 'index']);

Route::get('/fixtures', [FixtureController::class, 'index'])->name('fixture.index');
Route::get('/matches', function () {
    return view('matches');
});


Route::get('/home', function () {
    return view('dashboard');
});
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/contacts/{id}', [ContactController::class, 'show']);

Route::get('/adminpage', [ContactController::class, 'showContactInfo2'])->name('contact.show');
Route::post('/admin/contact/update', [ContactController::class, 'updateContactInfo'])->name('contact.update');

/*End Admin Route */
/* Manager Route */
// Route to show the registration form
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');
// Route to handle the registration request
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/manageuser', [RegisteredUserController::class, 'listUsers'])->name('admin.manageuser');
Route::get('/manager/{id}/players', [PlayerController::class, 'getManagerPlayers']);

//MANAGE TOURNAMENT
Route::get('/managetournament', function () {return view('managetournament');});
Route::get('/managetournament', [TournamentController::class, 'create'])->name('managetournament');
Route::post('/managetournament', [TournamentController::class, 'store'])->name('managetournament.store');
Route::get('/managetournament/{id}', [TournamentController::class, 'show'])->name('managetournament.show');
Route::post('/managetournament/{id}', [TournamentController::class, 'update'])->name('managetournament.update');
Route::delete('/managetournament/{id}', [TournamentController::class, 'destroy'])->name('managetournament.destroy');

// Tournament
Route::post('/tournament/create', [TournamentController::class, 'create'])->name('tournament.create');
Route::post('/tournament/store', [TournamentController::class, 'store'])->name('tournament.store');
Route::get('/tournament', function () { return view('tournament');})->name('tournament');
Route::get('/tournaments-view', [TournamentController::class, 'index'])->name('tournaments.index');

//Formation (Manager)

// Route::get('/team', function () { return view('team');})->name('team');
Route::get('/formation/index', [FormationController::class, 'index'])->name('formation.index');
Route::get('/formation', [FormationController::class, 'view'])->name('formation.view');
Route::get('/formation', [FormationController::class, 'create'])->name('formation.create');
Route::post('/formation', [FormationController::class, 'store'])->name('formation.store');

Route::get('/formation/{id}/edit', [FormationController::class, 'edit'])->name('formation.edit');
Route::post('/formation/{id}', [FormationController::class, 'update'])->name('formation.update');


//Player (Manager)
Route::get('/player/create', [PlayerController::class, 'create'])->name('player.create');
Route::post('/player/store', [PlayerController::class, 'store'])->name('player.store');
Route::get('/player', function () { return view('player');})->name('player');
Route::get('/player/index', [PlayerController::class, 'index'])->name('player.index');
Route::get('/player-view', [PlayerController::class, 'view'])->name('player.view');
Route::get('/player-view', function () {$players = App\Models\Player::all(); return view('player-view', ['players' => $players]);})->name('player.view');
Route::get('/players/export', [PlayerController::class, 'exportCsv'])->name('players.export');
Route::post('/players/import', [PlayerController::class, 'importCsv'])->name('players.import');
Route::get('/player/{id}/edit', [PlayerController::class, 'edit'])->name('player.edit');
Route::put('/player/{id}', [PlayerController::class, 'update'])->name('player.update');
Route::delete('/player/{id}', [PlayerController::class, 'destroy'])->name('player.destroy');

//Manager
//Dashboard
Route::get('/manager-dashboard', [PlayerController::class, 'dashboard']);

// Line-Up (Manager)
Route::get('/line-up', function () {return view('line-up');});
Route::get('/line-up', [FormationController::class, 'showLineUp'])->name('line-up');


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


Route::get('/livematch', function () {
    return view('user.livematch');
});

Route::get('/group', function () {
    return view('user.group');
});

// Route::get('/forum', function () {
//     return view('forum');
// });

Route::get('/about', function () {
    return view('user.about');
});

Route::get('/contact', function () {
    return view('user.contact');
});

Route::get('/contact',  [ContactController::class, 'showcontactinfo'])
    ->name('showcontactinfo');

Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');

Route::get('/user', function () {
    return view('user.user');
})->middleware(['auth','verified'])->name('user');

Route::get('/fixture', function () {
    return view('fixture');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
