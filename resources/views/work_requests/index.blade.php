@extends('layouts.app')

@section('title', '依頼一覧')

@section('content')
<div class="page-header">
  <h1>依頼一覧</h1>

  <a href="{{ route('work_requests.create') }}" class="button">
    新しい依頼を登録
  </a>
</div>


<form
  action="{{ route('work_requests.index') }}"
  method="GET"
  class="filter-form">
  <div class="form-group">
    <label for="status">ステータス</label>

    <select id="status" name="status">
      <option value="">すべて</option>

      @foreach (App\Models\WorkRequest::STATUS_LABELS as $value => $label)
      <option
        value="{{ $value }}"
        @selected(request('status')===$value)>
        {{ $label }}
      </option>
      @endforeach
    </select>
  </div>

  <div class="button-group">
    <button type="submit" class="button">
      検索
    </button>

    <a
      href="{{ route('work_requests.index') }}"
      class="button button-secondary">
      条件をリセット
    </a>
  </div>
</form>


<div class="card">
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>依頼タイトル</th>
          <th>クライアント会社</th>
          <th>登録日</th>
          <th>希望納期</th>
          <th>社内担当者</th>
          <th>ステータス</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($workRequests as $workRequest)
        <tr>
          <td>{{ $workRequest->id }}</td>

          <td>
            <a href="{{ route('work_requests.show', $workRequest->id) }}">
              {{ $workRequest->title }}
            </a>
          </td>

          <td>
            {{ $workRequest->client?->name }}
          </td>

          <td>
            {{ $workRequest->created_at->timezone('Asia/Tokyo')->format('Y/m/d H:i') }}
          </td>

          <td>
            {{ $workRequest->deadline ?? '未設定' }}
          </td>

          <td>
            {{ $workRequest->staffMember?->name ?? '未定' }}
          </td>

          <td>
            <span class="status status-progress">
              {{ $workRequest->status_label }}
            </span>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7">
            条件に一致する依頼はありません。
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection