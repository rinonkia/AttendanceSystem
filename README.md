# AttendanceSystem

Vue.jsとの共同開発にてスタッフ勤怠管理用アプリを作成中ですが、Laravelだけで勤怠管理アプリを作成したことがなく、不明点が多かったため検証のため作成しました。
作成において特に気になった点は、以下になります。
 - スタッフが打刻ボタンを押した際、DBに時刻を格納する方法、dateTime型かstring型にするか
 - 最低限のバリデーションをどこまで実装すれば良いか
   - 退勤打刻は出勤打刻が済んでいないと押せないようにする。
   - 出勤打刻済みの状態で出勤打刻が押せないようにする。

その他、気付きがあったものを書き記します。

### ルーティング

```
Route::get('/', function () {
    return view('home');
})->middleware('auth');
```

ホームの`"/"`が`middleware('auth')`を潜らないといけないので`'/login'`にリダイレクトさせます。
https://github.com/rinonkia/AttendanceSystem/blob/52e6a70118ca7e1e1ae5fa28bb8fb9bad03b3dee/app/Http/Middleware/Authenticate.php#L15