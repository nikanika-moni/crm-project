<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>顧客管理画面 - 一覧</title>
    <link rel="stylesheet" href="/css/admin/tailwind/tailwind.min.css">
    <link rel="stylesheet" href="/css/admin/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="/js/main.js"></script>
    <script src="/js/admin/jquery-3.6.0.slim.min.js"></script>
    <script src="/js/admin/select2.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">顧客管理画面 - 一覧</h1>
            <div class="d-flex align-items-center">
                <p class="mb-0 me-3">{{ \Auth::user()->name }}でログイン中</p>
                <form action=" {{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">ログアウト</button>
                </form>
            </div>
        </div>

        <!-- 共通のヘッダー -->
        <!-- 共通のヘッダー -->

        <!-- 共通のナビバー -->
        <!-- 共通のナビバー -->
        <!-- ▼▼▼▼ページ毎の個別内容▼▼▼▼　-->
        @yield('content')
        <!-- ▲▲▲▲ページ毎の個別内容▲▲▲▲　-->

    </div>
</body>
