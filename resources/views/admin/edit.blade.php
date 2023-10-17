@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2>編集</h2>
    <form action="{{ route('admin.update', ['project' => $project->id]) }}" method="POST" id="update-form">
        @csrf
        @method('PUT')
        <!-- ▼▼▼▼エラーメッセージ▼▼▼▼　-->
        @if($errors->any())
        <div class="mb-8 py-4 px-6 border border-red-300 bg-red-50 rounded">
            <ul>
                @foreach($errors->all() as $error)
                <li class="text-red-400">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- ▲▲▲▲エラーメッセージ▲▲▲▲　-->

        <div class="form-group">
            <label for="project_name">案件名</label>
            <input type="text" class="form-control" id="project_name" name="project_name" value="{{ old('project_name', $project->project_name) }}" required>
        </div>

        <div class="form-group">
            <label for="contact_name">担当者名</label>
            <input type="text" class="form-control" id="contact_name" name="contact_name" value="{{ old('contact_name', $project->contact_name) }}" required>
        </div>

        <div class="form-group">
            <label for="contact_email">担当者メールアドレス</label>
            <input type="email" class="form-control" id="contact_email" name="contact_email"  value="{{ old('contact_email', $project->contact_email) }}" required>
        </div>

        <div class="form-group">
            <label for="environment">環境</label>
            <select class="form-control" id="environment" name="environment_id">
                <option value="select-def">選択してください</option>
                @foreach ($environments as $environment)
                <option value="{{ $environment->id }}" @if($environment->id === old('environment_id', $project->environment->id))selected @endif>{{ $environment->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
        <label>契約期間</label>
        <div class="row">
            <div class="col">
                <label for="start_date">開始日</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $project->start_date) }}" required>
            </div>
            <div class="col">
                <label for="end_date">終了日</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $project->end_date) }}" {{ old('auto_renewal') ? 'disabled' : '' }}>
            </div>
        </div>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="auto_renewal" name="auto_renewal" value="1" {{ $project->auto_renewal ? 'checked' : '' }}>
        <label class="form-check-label" for="auto_renewal">自動延長</label>
    </div>

        <div class="form-group">
            <label for="option">オプション</label>
            <select id="option" class="form-control" name="options_id[]" multiple>
                @foreach($options as $option)
                <option value="{{ $option->id }}" @if (in_array($option->id, old('options_id', $project->options->pluck('id')->all()))) selected @endif>{{ $option->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="member">営業担当</label>
            <select class="form-control" id="member" name="member_id">
                <option value="member-def">選択してください</option>
                @foreach($members as $member)
                <option value="{{ $member->id }}" @if($member->id === old('member_id', $project->member->id)) selected @endif>{{ $member->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
        <label for="notes">備考</label>
        <textarea class="form-control" id="notes" name="notes" rows="4">{{ old('notes', $project->notes) }}</textarea>
    </div>



        <button type="submit" class="btn btn-primary my-4" id="update-button">更新</button>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">戻る</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // オプション追加
    $('#option').select2();

    const autoRenewalCheckbox = document.getElementById('auto_renewal');
    const endDateInput = document.getElementById('end_date');

    autoRenewalCheckbox.addEventListener('change', function () {
        endDateInput.disabled = this.checked;
        if (this.checked) {
            endDateInput.value = ''; // 自動延長が有効な場合、終了日をクリア
        }
    });

    // 初期状態で自動延長がチェックされている場合は終了日の入力を無効化
    if (autoRenewalCheckbox.checked) {
        endDateInput.disabled = true;
        endDateInput.value = ''; // 初期状態で自動延長が有効な場合、終了日をクリア
    }

    // 確認用のウィンドウを表示する関数
    function showConfirmation() {
        const confirmed = confirm("変更内容を保存しますか？");
        if (confirmed) {
            document.getElementById("update-form").submit(); // フォームを送信
        }
    }

    // 更新ボタンをクリックしたときに確認用のウィンドウを表示する
    const updateButton = document.getElementById("update-button");
    updateButton.addEventListener("click", function(event) {
        event.preventDefault(); // ボタンのデフォルトの動作をキャンセル
        showConfirmation();
    });

    // フォームが送信された後に遷移する処理
    document.getElementById("update-form").addEventListener("submit", function() {
        // 実際の遷移先のURLを指定してください
        const targetURL = "{{ route('admin.index') }}"; // 例えば、admin.index ルートへの遷移
        window.location.href = targetURL;
    });
</script>
@endsection
