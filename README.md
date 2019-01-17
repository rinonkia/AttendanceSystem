# AttendanceSystem

Vue.jsとの共同開発にてスタッフ勤怠管理用アプリを作成中ですが、<br>
Laravelだけで勤怠管理アプリを作成したことがなく、不明点が多かったため検証のため作成しました。<br>

作成において特に気になった点は、以下になります。<br>
 - スタッフが打刻ボタンを押した際、DBに時刻を格納する方法、dateTime型かstring型にするか
 - 最低限のバリデーションをどこまで実装すれば良いか
   - 退勤打刻は出勤打刻が済んでいないと押せないようにする。
   - 出勤打刻済みの状態で出勤打刻が押せないようにする。

追記：Laravelベテランの方からCarbonが便利だと教えていただきました。<br>
こちらで実装したいと思います。<br>

## Carbon

コマンドにてCarbonをインストール<br>

```
composer require nesbot/carbon
```

 Carbonを使えば簡単にDBに打刻時間を格納できます。<br>
使用したいコントローラに`Carbon\Carbon`をインポート<br>
`Carbon::now()`を使えば現在時刻を取得できます。<br>
```
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;
use App\Timestamp;

class TimestampsController extends Controller
{
    public function punchIn()
    {
        $user = Auth::user();
        $timestamp = Timestamp::create([
            'user_id' => $user->id,
            'punchIn' => Carbon::now()
        ]);
        return redirect()->back();

```




その他、気付きがあったものを書き記します。<br>

## データ処理について
　どのようにDBに時間が格納されるのか順を追って説明したいと思います。<br>
  
先に順序をお伝えすると以下になります。<br>

 - View
 - Route
 - Controller （Model）

では、コードを見ていきます。<br>

```
// resouses/views/home.blade.php

<div class="button-form">
    <ul>
        <li>
            <form action="{{ route('timestamp/punchin') }}" method="POST">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-primary">出勤</button>
            </form>
        </li>
        <li>
            <form action="{{ route('timestamp/punchout') }}" method="POST">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-success">退勤</button>
            </form>
        </li>
    </ul>
</div>

```
フォームのsubmitボタン(出勤)を押下すると、`route('timestamp/punchin')`のルートメソッドに飛びます。<br>

```
// rotes/web.php

Route::group(['middleware' => 'auth'], function() {
    Route::post('/punchin', 'TimestampsController@punchIn')->name('timestamp/punchin');
    Route::post('/punchout', 'TimestampsController@punchOut')->name('timestamp/punchout');
});
```
一行目:ユーザのログインしているかチェックしています。問題なければ二行目の`name('timestamp/punchin')`と名付けられたルートメソッド`Route::post('/punchin', 'TimestampsController@punchIn')`が動きます。  <br>
　このメソッドは「`TimestampsController`の`punchIn`メソッドの処理を行う」ということです。第一引数の`/puchin`はURLパラメータです。ここではあまり気にしなくて良いと思います。<br>

```
// app/Http/Controllers/TimestampsController 

class TimestampsController extends Controller
{
    public function punchIn()
    {
        $user = Auth::user();

        $timestamp = Timestamp::create([
            'user_id' => $user->id,
            'punchIn' => Carbon::now()
        ]);

        return redirect()->back()->with('my_status', '出勤打刻が完了しました');
```
`TimestampsController`の`punchIn()`メソッドの処理が書かれています。<br>
簡単にいうと「ボタンを押したユーザidとボタンを押した時間を取得し、DBにcreate」しています<br>


## 初期ルーティング

```
Route::get('/', function () {
    return view('home');
})->middleware('auth');
```

`"/"`は`middleware('auth')`を通過できないため`'/login'`にリダイレクト<br>

[AttendanceSystem/app/Http/Middleware/Authenticate.php](https://github.com/rinonkia/AttendanceSystem/blob/52e6a70118ca7e1e1ae5fa28bb8fb9bad03b3dee/app/Http/Middleware/Authenticate.php#L15)

