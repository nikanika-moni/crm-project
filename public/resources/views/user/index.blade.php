@extends('layouts.user')
@section('content')
    <div class="container">
        <h1>ログインユーザー一覧</h1>
        <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">ユーザー新規作成</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th>アクション</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-primary">編集</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
