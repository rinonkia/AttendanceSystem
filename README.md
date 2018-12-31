# AttendanceSystem

Vue.jsとの共同開発にてスタッフ勤怠管理用アプリを作成中ですが、Laravelだけで勤怠管理アプリを作成したことがなく、不明点が多かったため検証のため作成しました。
作成において特に気になった点は、以下になります。
 - スタッフが打刻ボタンを押した際、DBに時刻を格納する方法、dateTime型かstring型にするか
 - 最低限のバリデーションをどこまで実装すれば良いか
   - 退勤打刻は出勤打刻が済んでいないと押せないようにする。
   - 出勤打刻済みの状態で出勤打刻が押せないようにする。

追記：Laravelerの方からCarbonをお聞きしました。こちらで実装したいと思います。

## Carbon
***

 Carbonを使えば簡単にDBに打刻時間を格納できます。
使用したいコントローラに`Carbon\Carbon`をインポート
`Carbon::now()`を使えば現在時刻を取得できます。
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




その他、気付きがあったものを書き記します。

## データの受け渡しについて
  どのようにDBに時間が格納されるのか順を追って説明したいと思います。

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
フォームのsubmitボタン(出勤)を押下すると、`route('timestamp/punchin')`のルートメソッドに飛びます。

```
// rotes/web.php

Route::group(['middleware' => 'auth'], function() {
    Route::post('/punchin', 'TimestampsController@punchIn')->name('timestamp/punchin');
    Route::post('/punchout', 'TimestampsController@punchOut')->name('timestamp/punchout');
});
```
一行目:ユーザのログインしているかチェックしています。問題なければ二行目の`name('timestamp/punchin')`と名付けられたルートメソッド`Route::post('/punchin', 'TimestampsController@punchIn')`が動きます。  
　このメソッドは「`TimestampsController`の`punchIn`メソッドの処理を行え」ということです。第一引数の`/puchin`はURLパラメータです。ここではあまり気にしなくて良いと思います。

```

```



## 初期ルーティング

```
Route::get('/', function () {
    return view('home');
})->middleware('auth');
```

`"/"`は`middleware('auth')`を通過できないため`'/login'`にリダイレクト
[AttendanceSystem/app/Http/Middleware/Authenticate.php](https://github.com/rinonkia/AttendanceSystem/blob/52e6a70118ca7e1e1ae5fa28bb8fb9bad03b3dee/app/Http/Middleware/Authenticate.php#L15)

