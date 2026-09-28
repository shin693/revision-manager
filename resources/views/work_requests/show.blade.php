@extends('layouts.app')

@section('title', '依頼詳細')

@section('content')
<div class="page-header">
  <div>
    <p>#{{ $workRequest->id }}</p>
    <h1>{{ $workRequest->title }}</h1>
  </div>

  <div class="button-group">
    <a href="{{ route('work_requests.index') }}" class="button button-secondary">
      一覧へ戻る
    </a>

    <a href="{{ route('work_requests.edit', $workRequest->id) }}" class="button">
      依頼を編集
    </a>
  </div>
</div>

<section class="card">
  <h2>依頼情報</h2>

  <dl class="detail-list">
    <dt>クライアント会社</dt>
    <dd>{{ $workRequest->client->name }}</dd>


    <dt>依頼者名</dt>
    <dd>{{ $workRequest->requester_name }}</dd>

    <dt>登録日</dt>
    <dd>{{ $workRequest->created_at }}</dd>

    <dt>希望納期</dt>
    <dd>{{ $workRequest->deadline ?? '未設定' }}</dd>

    <dt>社内担当者</dt>
    <dd>{{ $workRequest->staffMember?->name ?? '未定' }}</dd>

    <dt>ステータス</dt>
    <dd>
      <span class="status status-progress">{{ $workRequest->status_label }}</span>
    </dd>

    <dt>対象サイト</dt>
    <dd>{{ $workRequest->site ?? '未設定' }}</dd>

    <dt>対象ページURL</dt>
    <dd>
      @if ($workRequest->url)
      <a
        href="{{ $workRequest->url }}"
        target="_blank"
        rel="noopener">
        {{ $workRequest->url }}
      </a>
      @else
      未設定
      @endif
    </dd>
  </dl>
</section>

<section class="card">
  <h2>依頼内容</h2>

  <p class="description">{{ $workRequest->description }}</p>
</section>

<section class="card">
  <h2>添付ファイル</h2>

  @forelse ($workRequest->attachments as $attachment)
  <a
    href="{{ asset('storage/' . $attachment->file_path) }}"
    target="_blank"
    rel="noopener">
    {{ $attachment->original_name }}
  </a>
  @empty
  <p>添付ファイルはありません。</p>
  @endforelse
</section>

<section class="card">
  <h2>メッセージ</h2>

  @forelse ($workRequest->messages as $message)
  <article class="message">
    <div class="message-meta">
      <strong>{{ $message->poster_name }}</strong>
      ／{{ $message->created_at->timezone('Asia/Tokyo')->format('Y/m/d H:i') }}
    </div>

    <p class="message-body">{{ $message->body }}</p>
    @foreach ($message->attachments as $attachment)
    <p>
      <a
        href="{{ asset('storage/' . $attachment->file_path) }}"
        target="_blank"
        rel="noopener">
        {{ $attachment->original_name }}
      </a>
    </p>
    @endforeach
  </article>
  @empty
  <p>まだメッセージはありません。</p>
  @endforelse
</section>

<section class="card">
  <h2>メッセージを追加</h2>

  <form action="{{ route('work_requests.messages.store', $workRequest->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
      <label for="poster_name">
        投稿者名
        <span class="required">必須</span>
      </label>

      <input
        type="text"
        id="poster_name"
        name="poster_name"
        value="{{ old('poster_name') }}"
        placeholder="例：佐藤花子">
    </div>

    <div class="form-group">
      <label for="message_body">
        メッセージ
        <span class="required">必須</span>
      </label>

      <textarea
        id="message_body"
        name="body"
        placeholder="メッセージを入力してください"></textarea>
    </div>

    <div class="form-group">
      <label for="message_attachment">
        添付ファイル
        <span class="optional">任意</span>
      </label>

      <input
        type="file"
        id="message_attachment"
        name="attachment">
    </div>

    <button type="submit" class="button">
      メッセージを送信
    </button>
  </form>
</section>
@endsection