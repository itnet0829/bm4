@extends('adminlte::page')

@section('title', 'グループ参加メンバー一覧')

@section('content_header')
  <h1>グループ詳細</h1>
@stop

@section('content')
@if ($errors->all())
    <div class="alert alert-danger" role="alert">
      入力不備な箇所があります。
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger" role="alert">
      {{ session('error') }}
    </div>
@endif
<table class="table table-bordered" style="margin-bottom:40px;">
            <tbody>
                <tr>
                    <th style="width:10%; text-align:center; background-color:black; color:white;">
                        グループID
                    </th>
                    <td style="width:40%;">
                        {{ $groups->group_id }}
                    </td>
                </tr>
                <tr>
                    <th style="width:10%; text-align:center; background-color:black; color:white;">
                        グループ名
                    </th>
                    <td style="width:40%;">
                        {{ $groups->group_name }}
                    </td>
                </tr>
                <tr>
                    <th style="width:10%; text-align:center; background-color:black; color:white;">
                        管理者
                    </th>
                    <td style="width:40%;">
                        {{ $groups->administrator_name }}
                    </td>
                </tr>
            </tbody>
</table>
<h3>グループ参加メンバー一覧</h3>
<table class="table table-bordered" style="margin-top:40px;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" style="width: 6%; text-align:center;">ユーザーID</th>
      <th scope="col" style="width: 30%; text-align:center;">名前</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
      <th scope="row" style="text-align:center;">{{ $user->user_id }}</th>
      <td>{{ $user->name }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection

@section('css')
    <style>
      .create{
        float: right;
        margin-top: -35px;
        margin-bottom: 30px;
      }
      .entry{
        float: right;
      }
      .help-block{
        color: red;
      }
    </style>
@stop

@section('js')
<script>

</script>
@stop