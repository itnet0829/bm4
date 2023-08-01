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
    <a class="btn btn-success search" href="javascript:void(0);" onclick="boxsearch();">検索条件</a>
@stop

@section('content')
<section class="content form-edit searchmodal">
<form action="{{ url('activates') }}" method="GET">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">検索条件</h3>
    </div>
    <div class="card-body">
        {{ method_field('get') }}
        <div class="row">
          <div class="col-lg-1 col-md-2">
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
          <div class="col-lg-3 col-md-12">
            <div class="form-group">
              <label for="email">メールアドレス</label>
              <input type="email" class="form-control" name="email" id="email" value="{{ $email }}">
            </div>
          </div>
          <div class="col-lg-2 col-md-12">
            <div class="form-group">
              <label for="telephone_number">電話番号</label>
              <input type="text" class="form-control" name="telephone_number" id="telephone_number" value="{{ $telephone_number }}">
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
{{ $accounts->links() }}
@stop

@section('css')
<style>
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

      function search_check(){
        if ($('#user_id').val() != "" || $('#name').val() != "" || $('#email').val() != "" || $('#telephone_number').val() != ""){
          $('.searchmodal').fadeIn(30);
        }
      }

      function boxsearch(){
        $('.searchmodal').fadeIn(300);
      }
    </script>
@stop