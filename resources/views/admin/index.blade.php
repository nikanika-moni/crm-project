@extends('layouts.admin')
@section('content')
    <!-- 検索フォーム -->
    <form action="{{ route('admin.search') }}" method="GET" class="mb-4 p-3 border rounded bg-light">
        <div class="row g-3">
            <div class="col-md-3">
                <label for="startDate" class="form-label">契約開始日：</label>
                <input type="date" id="startDate" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <label for="endDate" class="form-label">契約終了日：</label>
                <input type="date" id="endDate" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-3">
                <label for="environment" class="form-label">環境：</label>
                <select class="form-select" id="environment" name="environment">
                    <option value="">すべて</option>
                    @foreach ($environments as $environment)
                    <option value="{{ $environment->id }}" {{ $environment->id == request('environment') ? ' selected' : '' }}>{{ $environment->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="member" class="form-label">営業担当者：</label>
                <select class="form-select" id="member" name="member">
                    <option value="">すべて</option>
                    @foreach($members as $member)
                    <option value="{{ $member->id }}" {{ $member->id == request('member') ? ' selected' : '' }}>{{ $member->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="option" class="form-label">オプション：</label>
                <select id="option" class="form-control" name="options_id[]" multiple>
                    @foreach($options as $option)
                    <option value="{{ $option->id }}"{{ in_array($option->id, old('options_id', session('selected_options', []))) ? ' selected' : '' }}>{{ $option->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="freeSearch" class="form-label">フリーワード検索：</label>
                <input type="text" id="freeSearch" name="free_search" class="form-control" value="{{ request('free_search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary mt-3">検索</button>
            </div>
        </div>
    </form>
    <a href="/admin/create" class="btn btn-success">新規追加</a>
    <table class="table table-striped table-bordered my-3">
        <thead class="table-dark">
            <tr>
                <th>案件名</th>
                <th>環境</th>
                <th>契約開始日</th>
                <th>契約終了日</th>
                <th>営業担当者</th>
                <th>アクション</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td>{{ $project->project_name }}</td>
                <td>{{ $project->environment->name }}</td>
                <td>{{ $project->start_date }}</td>
                <td>{{ $project->end_date }}</td>
                <td>{{ $project->member->name }}</td>
                <td class="d-flex">
                <a href="{{ route('admin.detail', ['project' => $project->id]) }}" class="btn btn-info btn-sm me-1">詳細</a>
                <a href="{{ route('admin.edit', ['project' => $project->id]) }}" class="btn btn-primary btn-sm me-1">編集</a>
                <!-- <form action="{{ route('admin.destroy', ['project' => $project->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">削除</button>
                </form> -->
            </td>
            </tr>
            @endforeach
            <!-- 他の顧客データも同様に追加 -->
        </tbody>
    </table>
    {{ $projects->links() }} {{-- ページネーションリンクの表示 --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
        $('#option').select2();
</script>
@endsection
