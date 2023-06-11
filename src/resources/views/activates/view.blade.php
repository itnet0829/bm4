@extends('adminlte::page')

@section('title', 'アクティベート情報一覧')

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
    <h1>アクティベート情報一覧</h1>
@stop

@section('content')
<table class="table table-bordered">
  <thead class="thead-dark">
    <tr>
      <th scope="col" style="width: 5%; text-align:center;">ユーザーID</th>
      <th scope="col" style="width: 15%; text-align:center;">名前</th>
      <th scope="col" style="width: 20%; text-align:center;">メールアドレス</th>
      <th scope="col" style="width: 10%; text-align:center;">電話番号</th>
      <th scope="col" style="width: 12%; text-align:center;">アクティベーション判定</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($accounts as $active)
    <tr>
      <th scope="row" style="text-align:center;">{{ $active->user_id }}</th>
      <td>{{ $active->name }}</td>
      <td>{{ $active->email }}</td>
      <td>{{ $active->telephone_number }}</td>
      <td style="text-align:center;">
        <form action="{{ url(sprintf('activates/%d/unlock', $active->user_id)) }}" method="POST" class="unlockform">
        {{ @csrf_field() }}
          <input type="hidden" name="status" value="1">
          <input type="button" value="ロック解除" class="btn btn-primary btn-sm" onclick="unlock_OK()">
        </form>
        <form action="{{ url(sprintf('activates/%d/delete', $active->user_id)) }}" method="POST" class="delform" style="margin-top: 10px;">
        {{ @csrf_field() }}
          <input type="hidden" name="status" value="3">
          <input type="button" value="削除" class="btn btn-danger btn-sm" onclick="delete_OK()">
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@stop

@section('css')
@stop

@section('js')
    <script>
      function delete_OK(){
        let conf = window.confirm('削除してもよろしいでしょうか？');
        if (conf == true) {
          $('.delform').submit();
        }
      }
      function unlock_OK(){
        let conf = window.confirm('ロックを解除してもよろしいでしょうか？');
        if (conf == true) {
          $('.unlockform').submit();
        }
      }
    </script>
@stop