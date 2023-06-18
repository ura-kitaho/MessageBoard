<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MessageBoardController;

use App\Models\Message;


//////////////
/* Coach モデルを読み込みする */
use App\Models\Coach;

/* Team モデルを読み込みする */
use App\Models\Team;

use App\Models\Player;

use App\Models\Position;

use App\Http\Controllers\TeamController;

use App\Http\Controllers\PlayerController;



/////////////

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/MessageBoard', [MessageBoardController::class, "add"]);

Route::post('/MessageBoard/confirm', [MessageBoardController::class, "confirm"]);

Route::get('/MessageBoard/complete', function(){
    return view('MessageBoard.complete');
});

Route::get('/MessageBoard/index', [MessageBoardController::class, 'index']);

Route::get('/MessageBoard/edit/{id}', [MessageBoardController::class, 'edit']);

Route::post('/MessageBoard/edit/{id}', [MessageBoardController::class, 'update']);

Route::post('/MessageBoard/delete/{id}', [MessageBoardController::class, 'delete']);

// // 検索参考箇所
// Route::get('/MessageBoard/index', [MessageBoardController::class, 'index'])->name('messages.index');

////////////
///hasone
///
Route::get('/coach', function(){
    /* Coach モデルを通じて、coaches テーブルの内容をすべて取得 */
    $all_coaches = Coach::all();

    foreach($all_coaches as $coach){
        /* $coach->teamで、関連付けされたteams テーブルのレコードの内容を取得できる */
        print("<p>監督名： {$coach->name} (担当チーム名： {$coach->team->name})</p>");

        // if($coach->id === 4){
        //     break;
        // }
    }
});

//hasmany
Route::get('/team', function(){
    /* Team モデルを通じて、teams テーブルのデータをすべて取得 */
    $all_teams = Team::all();
    foreach($all_teams as $team){
        /* nullの場合があるので、ifでチェック */
        if ($team->coach != null){
            $coach = $team->coach->name;
        } else {
            $coach = '';
        }
        print("<h2>チーム名： {$team->name} (監督：{$coach}) </h2>");
        print("<p>所属プレイヤー</p>");
        print('<ul>');
            /* $team->playersで、関連付けされたteams テーブルのレコードの内容を取得できる
             * Team モデルとPlayer モデルのリレーションは一対多(hasMany)
             * 複数データが取得されるため、foreachでループしてひとつずつ処理する
             */
            foreach($team->players as $player) {
                print("<li>{$player->name}</li>");
            }
        print('</ul>');
    }
});

Route::get('/', function () {
    return view('welcome');
});

//belongto
Route::get('/coach', function(){
    /* Coach モデルを通じて、coaches テーブルの内容をすべて取得 */
    $all_coaches = Coach::all();
    foreach($all_coaches as $coach){
        /* $coach->teamで、関連付けされたteams テーブルのレコードの内容を取得できる */
        print("<p>監督名： {$coach->name} (担当チーム名： {$coach->team->name})</p>");
    }
});

Route::get('player', function(){
    /* Player モデルを通じて、players テーブルのデータをすべて取得 */
    $all_players = Player::all();
    foreach($all_players as $player){
        /* null の場合があるので、if でチェック */
        if ($player->team != null){
            $team = $player->team->name;
        } else {
            $team = '';
        }
        print("<h2>プレイヤー名： {$player->name} (所属チーム: {$team})</h2>");
        print("<p>得意ポジション</p>");
        print('<ul>');
            /* $player->positionsで、関連付けされたpositions テーブルのレコードの内容を取得できる
            * Player モデルとPosition モデルのリレーションは多対多(belongsToMany)
            * 複数データが取得されるため、foreachでループしてひとつずつ処理する
            */
            foreach($player->positions as $position){
                print("<li>{$position->name}</li>");
            }
        print('</ul>');
    }
});

Route::get('/team/edit/{id}', [TeamController::class, 'edit']);

Route::post('/team/edit/{id}', [TeamController::class, 'update']);

Route::get('/player/edit/{id}', [PlayerController::class, 'edit']);

Route::post('/player/edit/{id}', [PlayerController::class, 'update']);