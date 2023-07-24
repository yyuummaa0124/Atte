<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/stamps.css') }}">
</head>
<body>
  <header>
    <div class="header-content">
      <div class="header-logo">
        <p>Atte</p>
      </div>
      <div class="header-list">
        <ul>

        <!-- ホーム -->
        <form action="{{route('posts.index')}}" method="GET">
          @csrf
          <button class="home btn" type="submit">ホーム</button>
        </form>

        <!-- ユーザ一覧 -->
        <form action="{{route("posts.getUserList")}}" method="GET">
          @csrf
          <button class="home btn" type="submit">ユーザ一覧</button>
        </form>

        <!-- 日付一覧ページ遷移処理 -->
        <form action="{{route('posts.getAttendanceInfo')}}" method="GET">
          @csrf
          <button class="dateview btn" type="submit">日付一覧</button>
        </form>

        <!-- ログアウト処理 -->
        <form action="{{route('logout')}}" method="POST">
          @csrf
            <button class="logout btn" type="submit">ログアウト</button>
        </form>
        </ul>
      </div>
    </div>
  </header>

  <main>
      @yield('content')       
  </main>

  <footer>
      <p class="footer-ctt">Atte,inc.</p>
  </footer>
</body>
</html>