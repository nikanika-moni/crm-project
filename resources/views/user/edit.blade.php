@extends('layouts.user')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Create New Account</div>

                <div class="card-body">
                    <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">メール</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"required>
                        </div>

                        <button type="submit" class="btn btn-primary">Edit Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
