@extends('layouts.app')
@section('title', '依頼登録')

@section('content')
<div class="page-header">
  <h1>依頼登録</h1>

  <a href="{{ route('work_requests.index') }}" class="button button-secondary">
    依頼一覧へ戻る
  </a>
</div>

<div class="card">
  <form action="{{ route('work_requests.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($errors->any())
    <div class="error-box">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <div class="form-group">
      <label for="title">
        依頼タイトル
        <span class="required">必須</span>
      </label>

      <input
        type="text"
        id="title"
        name="title"
        placeholder="例：TOPページ画像差し替え"
        required>
    </div>

    <div class="form-group">
      <label for="client_id">
        クライアント会社
        <span class="required">必須</span>
      </label>

      <select id="client_id" name="client_id" required>
        <option value="">選択してください</option>
        @foreach($clients as $client)
        <option value="1">{{$client->name}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="requester_name">
        依頼者名
        <span class="required">必須</span>
      </label>

      <input
        type="text"
        id="requester_name"
        name="requester_name"
        placeholder="例：山田太郎"
        required>
    </div>

    <div class="form-group">
      <label for="site">
        対象サイト
        <span class="optional">任意</span>
      </label>

      <input
        type="text"
        id="site"
        name="site"
        placeholder="例：コーポレートサイト">
    </div>

    <div class="form-group">
      <label for="url">
        対象ページURL
        <span class="optional">任意</span>
      </label>

      <input
        type="url"
        id="url"
        name="url"
        placeholder="https://example.com/">
    </div>

    <div class="form-group">
      <label for="description">
        依頼内容
        <span class="required">必須</span>
      </label>

      <textarea
        id="description"
        name="description"
        placeholder="変更したい内容や確認事項などを入力してください"
        required></textarea>
    </div>

    <div class="form-group">
      <label for="deadline">
        希望納期
        <span class="optional">任意</span>
      </label>

      <input
        type="date"
        id="deadline"
        name="deadline">
    </div>

    <div class="form-group">
      <label for="staff_member_id">
        社内担当者
        <span class="optional">任意</span>
      </label>

      <select id="staff_member_id" name="staff_member_id">
        <option value="">未定</option>
        @foreach($staffMembers as $staffMember)
        <option value="1">{{$staffMember->name}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="work_request_files">
        添付ファイル
        <span class="optional">任意</span>
      </label>

      <input
        type="file"
        id="work_request_files"
        name="work_request_files[]"
        multiple>
    </div>

    <div class="button-group">
      <button type="submit" class="button">
        依頼を登録する
      </button>

      <a href="{{ route('work_requests.index') }}" class="button button-secondary">
        キャンセル
      </a>
    </div>
  </form>
</div>
@endsection