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
<a class="btn btn-success create" href="javascript:void(0);" onclick="boxsearch()" >検索条件</a>
<section class="content form-edits">
<form action="{{ sprintf(url('/groups/%d/confirm'),$groups->group_id) }}" method="GET">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">検索条件</h3>
    </div>
    <div class="card-body">
        {{ @csrf_field() }}
        <div class="row">
          <div class="col-lg-1 col-md-12">
            <div class="form-group">
              <label for="user_id">ユーザーID</label>
              <input type="text" class="form-control" name="user_id" id="user_id" value="{{ $user_id }}">
            </div>
          </div>
          <div class="col-lg-3 col-md-12">
            <div class="form-group">
              <label for="name">名前</label>
              <input type="text" class="form-control" name="name" id="name" value="{{ $name }}">
            </div>
          </div>
        </div>
    </div>
    <div class="card-footer">
      <input type="submit" value="検索" class="btn btn-primary entry">
    </div>
  </div>
</form>
</section>
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
{{ $users->links() }}
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

      .form-edits {
        margin-top: 40px;
        display: none;
      }
    </style>
@stop

@section('js')
<script>
      function search_check(){
        if ($('#user_id').val() != "" || $('#name').val() != ""){
          $('.form-edits').fadeIn(30);
        }
      }

      function boxsearch(){
        $('.form-edits').fadeIn(300);
      }

      search_check();
</script>
@stop