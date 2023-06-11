@extends('adminlte::page')

@section('title', 'PUSHメッセージ一覧')

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
    <h1>PUSHメッセージ一覧</h1>
    <a class="btn btn-primary create" href="{{ url('push/create') }}" >新規登録</a>
@stop

@section('content')
<table class="table table-bordered">
  <thead class="thead-dark">
    <tr>
      <th scope="col" style="width: 5%; text-align:center;">メッセージID</th>
      <th scope="col" style="width: 15%; text-align:center;">件名</th>
      <th scope="col" style="width: 20%; text-align:center;">内容</th>
      <th scope="col" style="width: 10%; text-align:center;">通知受信者</th>
    </tr>
  </thead>
  <tbody>
    @foreach($all_broadcasted_message as $alm)
    <tr>
      <th scope="row" style="text-align:center;">{{ $alm->push_id }}</th>
      <td>{{ $alm->subjects }}</td>
      <td>{{ $alm->message }}</td>
      <td class="text-center"><a class="btn btn-primary" href="{{ sprintf(url('push/%d/confirm'),$alm->push_id) }}" >確認</a></td>
    </tr>
    @endforeach
  </tbody>
</table>

@stop

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
    </script>
@stop