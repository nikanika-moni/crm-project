@extends('layouts.admin')
@section('content')
    <form action="{{ route('admin.index.store') }}" method="POST" id="create-form">
        @csrf
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
            <input type="text" class="form-control" id="project_name" name="project_name" value="{{ old('project_name') }}" required>
        </div>

        <div class="form-group">
            <label for="contact_name">担当者名</label>
            <input type="text" class="form-control" id="contact_name" name="contact_name" value="{{ old('contact_name') }}" required>
        </div>

        <div class="form-group">
            <label for="contact_email">担当者メールアドレス</label>
            <input type="email" class="form-control" id="contact_email" name="contact_email"  value="{{ old('contact_email') }}" required>
        </div>

        <div class="form-group">
            <label for="environment">環境</label>
            <select class="form-control" id="environment" name="environment_id">
                <option value="select-def">選択してください</option>
                @foreach ($environments as $environment)
                <option value="{{ $environment->id }}">{{ $environment->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
        <label>契約期間</label>
        <div class="row">
            <div class="col">
                <label for="start_date">開始日</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
            </div>
            <div class="col">
                <label for="end_date">終了日</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" {{ old('auto_renewal') == 'on' ? 'disabled' : '' }}>
            </div>
        </div>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="auto_renewal" name="auto_renewal" value="1">
        <label class="form-check-label" for="auto_renewal">自動延長</label>
    </div>

        <div class="form-group">
            <label for="option">オプション</label>
            <select id="option" class="form-control" name="options_id[]" multiple>
                @foreach($options as $option)
                <option value="{{ $option->id }}"{{ in_array($option->id, old('options_id', [])) ? ' selected' : '' }}>{{ $option->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="member">営業担当</label>
            <select class="form-control" id="member" name="member_id">
                <option value="member-def">選択してください</option>
                @foreach($members as $member)
                <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary my-4" id="create-button">追加</button>
    </form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script>
    //　オプション
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
        const confirmed = confirm("案件を新規登録しますか？");
        if (confirmed) {
            document.getElementById("create-form").submit(); // フォームを送信
        }
    }

    // 更新ボタンをクリックしたときに確認用のウィンドウを表示する
    const updateButton = document.getElementById("create-button");
    updateButton.addEventListener("click", function(event) {
        event.preventDefault(); // ボタンのデフォルトの動作をキャンセル
        showConfirmation();
    });

    // フォームが送信された後に遷移する処理
    document.getElementById("create-form").addEventListener("submit", function() {
        // 実際の遷移先のURLを指定してください
        const targetURL = "{{ route('admin.index') }}"; // 例えば、admin.index ルートへの遷移
        window.location.href = targetURL;
    });
</script>
@endsection
