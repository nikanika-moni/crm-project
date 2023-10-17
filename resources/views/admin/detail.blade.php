@extends('layouts.admin')
@section('content')
<div class="container mt-5">
    <h2>案件情報閲覧</h2>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $project->project_name }}</h4>
            <p class="card-text"><strong>担当者名:</strong> {{ $project->contact_name }}</p>
            <p class="card-text"><strong>担当者メールアドレス:</strong> {{ $project->contact_email }}</p>
            <p class="card-text"><strong>環境:</strong> {{ $project->environment->name }}</p>
            <p class="card-text"><strong>契約期間:</strong> {{ $project->start_date }} ～ {{ $project->end_date ?: '自動延長中' }}</p>
            <p class="card-text"><strong>オプション:</strong>
                @foreach ($project->options as $option)
                    {{ $option->name }}{{ $loop->last ? '' : ', ' }}
                @endforeach
            </p>
            <p class="card-text"><strong>営業担当:</strong> {{ $project->member->name }}</p>
            <p class="card-text"><strong>備考:</strong> {{ $project->notes }}</p>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">戻る</a>
    </div>
</div>
@endsection
