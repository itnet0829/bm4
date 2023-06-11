@extends('adminlte::page')

@section('title', 'アカウント情報一覧')

@section('content_header')
@if (session('message'))
            <div class="alert alert-success" role="alert">
              {{ session('message') }}
            </div>
@endif
@if (session('error'))
            <div class="alert alert-danger" role="alert">
              {{ session('error') }}
            </div>
@endif
    <h1>アカウント情報一覧</h1>
    <a class="btn btn-primary create" href="{{ url('accounts/create') }}" >新規登録</a>
@stop

@section('content')
<table class="table table-bordered">
  <thead class="thead-dark">
    <tr>
      <th scope="col" style="width: 1%; text-align:center;">UID</th>
      <th scope="col" style="width: 7%; text-align:center;">作成日</th>
      <th scope="col" style="width: 7%; text-align:center;">名前</th>
      <th scope="col" style="width: 6%; text-align:center;">メールアドレス</th>
      <th scope="col" style="width: 1%; text-align:center;">電話番号</th>
      <th scope="col" style="width: 8%; text-align:center;">グループ</th>
      <th scope="col" style="width: 6%; text-align:center;">制限</th>
      <th scope="col" style="width: 7%; text-align:center;">利用期限</th>
      <th scope="col" style="width: 6%; text-align:center;">ログイン回数</th>
      <th scope="col" style="width: 1%; text-align:center;">メモ</th>
      <th scope="col" style="width: 8%; text-align:center;">ステータス</th>
      <th scope="col" style="width: 7%; text-align:center;">各種操作</th>
      <th scope="col" style="width: 7%; text-align:center;">編集</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($accounts as $active)
    <tr>
      <th scope="row" style="text-align:center;">{{ $active->user_id }}</th>
      <td style="text-align:center;">{{ $active->created_at }}</td>
      <td>{{ $active->name }}</td>
      <td>{{ $active->email }}</td>
      <td>{{ $active->telephone_number }}</td>
      <td>{{ $active->group_name }}</td>
      <td>{{ $active->role_name }}</td>
      <td style="text-align:center;">{{ $active->license_deadline }}</td>
      <td>{{ $active->login_counter }}</td>
      <td><a href="javascript:void(0);" onclick="memo('{{$active->memo}}')" class="open-modal">{{ Str::limit($active->memo , 8,'...') }}</a></td>
      <td style="text-align:center;">
        @if($active->status == 0)
        <span class="badge badge-success">アクティブ</span>
        @elseif($active->status == 1)
        <span class="badge badge-danger">ロック中</span>
        @endif
      </td>
      <td style="text-align:center;">
        <form action="{{ url(sprintf('accounts/%d/status_change', $active->user_id)) }}" method="POST">
        {{ @csrf_field() }}
          @if($active->status == 0)
          <input type="hidden" name="status" value="0">
          <input type="submit" class="btn btn-danger" value="ロック">
          @elseif($active->status == 1)
          <input type="hidden" name="status" value="1">
          <input type="submit" class="btn btn-success" value="解除">
          @endif
        </form>
      </td>
      <td style="text-align:center;">
        <a class="btn btn-primary" href="{{ url(sprintf('accounts/%d/edit', $active->user_id)) }}">編集</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection

@section('modal')
  @include('accounts.memo_modal')
@endsection

@section('css')
    <style>
      .create{
        float: right;
        margin-top: -35px;
        margin-bottom: 30px;
      }
    </style>
@stop

@section('js')
<script>
  function memo(mems){
    var mem = "【メモ】\n";
    mem += mems;
    alert(mem);
  }
</script>
@stop