<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>@yield('title', 'Web制作依頼管理システム')</title>

  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      color: #333;
      background: #f5f6f8;
      font-family:
        -apple-system,
        BlinkMacSystemFont,
        "Segoe UI",
        "Hiragino Kaku Gothic ProN",
        "Hiragino Sans",
        Meiryo,
        sans-serif;
    }

    header {
      color: #fff;
      background: #26364a;
    }

    .header-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: min(1100px, calc(100% - 40px));
      margin: 0 auto;
      padding: 18px 0;
    }

    header a {
      color: #fff;
      text-decoration: none;
    }

    .site-title {
      margin: 0;
      font-size: 20px;
    }

    .container {
      width: min(1100px, calc(100% - 40px));
      margin: 40px auto;
    }

    .page-header {
      display: flex;
      gap: 20px;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 24px;
    }

    h1 {
      margin: 0;
      font-size: 28px;
    }

    h2 {
      margin-top: 0;
      font-size: 20px;
    }

    .card {
      margin-bottom: 24px;
      padding: 28px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
    }

    .button {
      display: inline-block;
      padding: 11px 18px;
      color: #fff;
      background: #2563eb;
      border: 0;
      border-radius: 5px;
      font: inherit;
      text-decoration: none;
      cursor: pointer;
    }

    .button-secondary {
      color: #333;
      background: #e5e7eb;
    }

    .button-success {
      background: #15803d;
    }

    .button-group {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 24px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
    }

    th,
    td {
      padding: 14px;
      border-bottom: 1px solid #ddd;
      text-align: left;
      vertical-align: middle;
    }

    th {
      background: #f0f2f5;
      font-size: 14px;
    }

    td a {
      color: #2563eb;
    }

    .form-group {
      margin-bottom: 22px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    input,
    select,
    textarea {
      width: 100%;
      padding: 11px 12px;
      border: 1px solid #bbb;
      border-radius: 5px;
      background: #fff;
      font: inherit;
    }

    textarea {
      min-height: 160px;
      resize: vertical;
    }

    .required {
      margin-left: 6px;
      color: #d00;
      font-size: 12px;
    }

    .optional {
      margin-left: 6px;
      color: #666;
      font-size: 12px;
    }

    .status {
      display: inline-block;
      padding: 5px 10px;
      border-radius: 20px;
      background: #e5e7eb;
      font-size: 13px;
    }

    .status-progress {
      color: #1d4ed8;
      background: #dbeafe;
    }

    .status-confirmation {
      color: #92400e;
      background: #fef3c7;
    }

    .status-completed {
      color: #166534;
      background: #dcfce7;
    }

    .detail-list {
      display: grid;
      grid-template-columns: 160px 1fr;
      margin: 0;
    }

    .detail-list dt,
    .detail-list dd {
      margin: 0;
      padding: 13px 0;
      border-bottom: 1px solid #eee;
    }

    .detail-list dt {
      font-weight: bold;
    }

    .description {
      line-height: 1.8;
      white-space: pre-wrap;
    }

    .message {
      margin-bottom: 20px;
      padding-bottom: 20px;
      border-bottom: 1px solid #ddd;
    }

    .message:last-child {
      margin-bottom: 0;
      padding-bottom: 0;
      border-bottom: 0;
    }

    .message-meta {
      margin-bottom: 10px;
      color: #666;
      font-size: 14px;
    }

    .message-body {
      white-space: pre-wrap;
    }

    .success-message {
      margin-bottom: 24px;
      padding: 12px 16px;
      color: #166534;
      background: #dcfce7;
      border: 1px solid #86efac;
      border-radius: 6px;
    }

    @media (max-width: 700px) {
      .page-header {
        align-items: flex-start;
        flex-direction: column;
      }

      .table-wrapper {
        overflow-x: auto;
      }

      .detail-list {
        display: block;
      }

      .detail-list dt {
        padding-bottom: 4px;
        border-bottom: 0;
      }

      .detail-list dd {
        padding-top: 0;
      }
    }
  </style>
</head>

<body>
  <header>
    <div class="header-inner">
      <p class="site-title">
        <a href="{{ route('work_requests.index') }}">Web制作依頼管理システム</a>
      </p>

      <nav>
        <a href="{{ route('work_requests.index') }}">依頼一覧</a>
      </nav>
    </div>
  </header>

  <main class="container">
    @if (session('success'))
    <div class="success-message">
      {{ session('success') }}
    </div>
    @endif

    @yield('content')
  </main>
</body>

</html>