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
    <a class="btn btn-success search" href="javascript:void(0);" onclick="boxsearch();">検索条件</a>
    <a class="btn btn-primary create" href="{{ url('groups/create') }}" >新規登録</a>
@stop

@section('content')
<section class="content form-edit searchmodal">
<form action="{{ url('groups') }}" method="GET">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">検索条件</h3>
    </div>
    <div class="card-body">
        {{ method_field('get') }}
        <div class="row">
          <div class="col-lg-1 col-md-2">
            <div class="form-group">
              <label for="group_id">グループID</label>
              <input type="text" class="form-control" name="group_id" id="group_id" value="{{ $group_id }}">
            </div>
          </div>
          <div class="col-lg-5 col-md-12">
            <div class="form-group">
              <label for="group_name">グループ名</label>
              <input type="text" class="form-control" name="group_name" id="group_name" value="{{ $group_name }}">
            </div>
          </div>
          <div class="col-lg-3 col-md-12">
            <div class="form-group">
              <label for="administrator_name">管理者名</label>
              <input type="text" class="form-control" name="administrator_name" id="administrator_name" value="{{ $administrator_name }}">
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
{{ $groups->links() }}
@stop

@section('css')
    <style>
      .create{
        float: right;
        margin-top: -35px;
        margin-bottom: 30px;
        margin-right: 10px;;
      }
      .entry{
        float: right;
      }

      .search{
        float: right;
        margin-top: -35px;
        margin-bottom: 30px;
      }

      .searchmodal {
        display: none;
      }
    </style>
@stop

@section('js')
    <script>
      function search_check(){
        if ($('#group_id').val() != "" || $('#group_name').val() != "" || $('#administrator_name').val() != ""){
          $('.searchmodal').fadeIn(30);
        }
      }

      function boxsearch(){
        $('.searchmodal').fadeIn(300);
      }

      search_check();
    </script>
@stop