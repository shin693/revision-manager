@extends('layouts.app')

@section('title', '依頼編集')

@section('content')
<div class="page-header">
  <div>
    <p>{{ $workRequest->id }}</p>
    <h1>依頼編集</h1>
  </div>

  <a href="{{ route('work_requests.show', $workRequest->id) }}" class="button button-secondary">
    詳細へ戻る
  </a>
</div>

<div class="card">
  <form action="{{ route('work_requests.update', $workRequest->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="title">依頼タイトル<span class="required">必須</span></label>

      <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $workRequest->title) }}">
    </div>

    <div class="form-group">
      <label for="client_id">
        クライアント会社
        <span class="required">必須</span>
      </label>

      <select id="client_id" name="client_id">
        @foreach($clients as $client)
        <option value="{{ $client->id }}" @selected(old('client_id', $workRequest->client_id) == $client->id)>{{ $client->name }}</option>
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
        value="{{ old('requester_name', $workRequest->requester_name) }}">
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
        value="{{ old('site', $workRequest->site) }}">
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
        value="{{old('url', $workRequest->url ) }}">
    </div>

    <div class="form-group">
      <label for="description">
        依頼内容
        <span class="required">必須</span>
      </label>

      <textarea id="description" name="description">{{ old('description', $workRequest->description ) }}</textarea>
    </div>

    <div class="form-group">
      <label for="deadline">
        希望納期
        <span class="optional">任意</span>
      </label>

      <input
        type="date"
        id="deadline"
        name="deadline"
        value="{{ old('deadline', $workRequest->deadline) }}">
    </div>

    <div class="form-group">
      <label for="staff_member_id">
        社内担当者
        <span class="optional">任意</span>
      </label>

      <select id="staff_member_id" name="staff_member_id">
        <option
          value=""
          @selected(
          old('staff_member_id', $workRequest->staff_member_id) == ''
          )
          >
          未定
        </option>

        @foreach ($staffMembers as $staffMember)
        <option
          value="{{ $staffMember->id }}"
          @selected(
          old('staff_member_id', $workRequest->staff_member_id)
          == $staffMember->id
          )
          >
          {{ $staffMember->name }}
        </option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="status">
        ステータス
        <span class="required">必須</span>
      </label>

      <select id="status" name="status">
        @foreach (App\Models\WorkRequest::STATUS_LABELS as $value => $label)
        <option
          value="{{ $value }}"
          @selected(
          old('status', $workRequest->status) === $value
          )
          >
          {{ $label }}
        </option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="attachment">
        添付ファイルを追加
        <span class="optional">任意</span>
      </label>

      <input
        type="file"
        id="attachment"
        name="attachment">
    </div>

    <div class="button-group">
      <button type="submit" class="button button-success">
        変更を保存する
      </button>

      <a
        href="{{ route('work_requests.show', $workRequest->id) }}"
        class="button button-secondary">
        キャンセル
      </a>
    </div>
  </form>
</div>
@endsection