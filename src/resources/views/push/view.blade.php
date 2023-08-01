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
    <a class="btn btn-success search" href="javascript:void(0);" onclick="boxsearch();">検索条件</a>
    <a class="btn btn-primary create" href="{{ url('push/create') }}" >新規登録</a>
@stop

@section('content')
<section class="content form-edit searchmodal">
<form action="{{ url('push') }}" method="GET">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">検索条件</h3>
    </div>
    <div class="card-body">
        {{ method_field('get') }}
        <div class="row">
          <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label for="push_id">メッセージID</label>
              <input type="text" class="form-control" name="push_id" id="push_id" value="{{ $push_id }}">
            </div>
          </div>
          <div class="col-lg-10 col-md-12">
            <div class="form-group">
              <label for="title">件名</label>
              <input type="text" class="form-control" name="title" id="title" value="{{ $title }}">
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
{{ $all_broadcasted_message->links() }}
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
        if ($('#push_id').val() != "" || $('#title').val() != ""){
          $('.searchmodal').fadeIn(30);
        }
      }

      function boxsearch(){
        $('.searchmodal').fadeIn(300);
      }

      search_check();
    </script>
@stop