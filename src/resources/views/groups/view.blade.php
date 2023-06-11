@extends('adminlte::page')

@section('title', 'グループ一覧')

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
    <h1>グループ一覧</h1>
    <a class="btn btn-primary create" href="{{ url('groups/create') }}" >新規登録</a>
@stop

@section('content')
<table class="table table-bordered">
  <thead class="thead-dark">
    <tr>
      <th scope="col" style="width: 6%; text-align:center;">グループID</th>
      <th scope="col" style="width: 30%; text-align:center;">グループ名</th>
      <th scope="col" style="width: 15%; text-align:center;">グループ管理者</th>
      <th scope="col" style="width: 5%; text-align:center;">編集</th>
      <th scope="col" style="width: 8%; text-align:center;">アクティビティ</th>
    </tr>
  </thead>
  <tbody>
    @foreach($groups as $group)
    <tr>
      <th scope="row" style="text-align:center;">{{ $group->group_id }}</th>
      <td>{{ $group->group_name }}</td>
      <td>{{ $group->administrator_name }}</td>
      <td class="text-center"><a class="btn btn-primary" href="{{ sprintf(url('groups/%d/edit'),$group->group_id) }}" >編集</a></td>
      <td class="text-center"><a class="btn btn-success" href="{{ sprintf(url('groups/%d/confirm'),$group->group_id) }}" >ユーザーの確認</a></td>
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