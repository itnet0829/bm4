@extends('adminlte::page')

@section('title', 'グループ新規作成')

@section('content_header')
  <h1>グループ新規作成</h1>
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
<section class="content form-edit">
<form action="{{ url('groups/insert') }}" method="POST">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">グループ新規作成</h3>
    </div>
    <div class="card-body">
        {{ @csrf_field() }}
        <h4><b>基本情報</b></h4>
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="form-group{{ $errors->has('group_name') ? ' has-error' : '' }}">
              <label for="group_name">グループ名<span class="badge badge-danger">必須</span></label>
              <input type="text" class="form-control" name="group_name" id="group_name" value="{{ old('group_name') }}">
              @if ($errors->has('group_name'))
                  <span class="help-block">{{ $errors->first('group_name') }}</span>
              @endif
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="form-group{{ $errors->has('administrator_name') ? ' has-error' : '' }}">
              <label for="administrator_name">管理者名<span class="badge badge-danger">必須</span></label>
              <input type="text" class="form-control" name="administrator_name" id="administrator_name" value="{{ old('administrator_name') }}">
              @if ($errors->has('administrator_name'))
                  <span class="help-block">{{ $errors->first('administrator_name') }}</span>
              @endif
            </div>
          </div>
        </div>
    </div>
    <div class="card-footer">
      <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
      <input type="submit" value="登録" class="btn btn-primary entry">
    </div>
  </div>
</form>
</section>
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
      .target1 {
        display: none;
      }
      .target2 {
        display: none;
      }
    </style>
@stop

@section('js')
<script>

  function choose_radio_due(){
    var attr = $('input[name="sender"]');

    if (attr[0].checked) {
      $('.target1').css('display','none');
      $('.target2').css('display','none');
    } else if (attr[1].checked) {
      $('.target1').css('display','block');
      $('.target2').css('display','none');
    } else if (attr[2].checked) {
      $('.target1').css('display','none');
      $('.target2').css('display','block');
    }
  }

  choose_radio_due();
</script>
@stop