@extends('adminlte::page')

@section('title', 'PUSHメッセージ新規作成')

@section('content_header')
  <h1>PUSHメッセージ新規作成</h1>
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
<form action="{{ url('push/insert') }}" method="POST">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">PUSHメッセージ作成</h3>
    </div>
    <div class="card-body">
        {{ @csrf_field() }}
        <h4><b>送信者</b></h4>
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="form-group{{ $errors->has('sender') ? ' has-error' : '' }}">
                <label class="radio-inline" for="PlayingDue0">
                  <input type="radio" name="sender" id="PlayingDue0" onchange="choose_radio_due()" value="0" {{ (is_null(old('sender')) || old('sender') == 0) ? 'checked' : '' }}>
                  全員
                </label>
                <label class="radio-inline" for="PlayingDue1" style="margin-left:3%;">
                  <input type="radio" name="sender" id="PlayingDue1" onchange="choose_radio_due()" value="1" {{ (old('sender') == 1) ? 'checked' : '' }}>
                  グループ送信
                </label>
                <label class="radio-inline" for="PlayingDue2" style="margin-left:3%;">
                  <input type="radio" name="sender" id="PlayingDue2" onchange="choose_radio_due()" value="2" {{ (old('sender') == 2) ? 'checked' : '' }}>
                  個別送信
                </label>
              @if ($errors->has('sender'))
                  <span class="help-block">{{ $errors->first('sender') }}</span>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 target1">
            <label>▶︎ グループ選択</label>
            @foreach($group as $gs)
              <div class="checkbox">
                <label><input type="checkbox" name="check-group[]" id="check-group" value="{{ $gs->group_id }}" style="margin-right:10px;" {{ (old('check_group')) ? 'checked' : '' }}>{{ $gs->group_name }}</label>
              </div>
              @if ($errors->has('check-group[]'))
                  <span class="help-block">{{ $errors->first('check-group[]') }}</span>
              @endif
            @endforeach
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 target2">
            <label>▶︎ ユーザー選択</label>
            @foreach($account as $as)
              <div class="checkbox">
                <label><input type="checkbox" name="check-user[]" id="check-user" value="{{ $as->user_id }}" style="margin-right:10px;">{{ $as->name }}</label>
              </div>
              @if ($errors->has('check-user[]'))
                  <span class="help-block">{{ $errors->first('check-user[]') }}</span>
              @endif
            @endforeach
          </div>
        </div>
        <h4><b>タイトル・メッセージ</b></h4>
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="form-group{{ $errors->has('subjects') ? ' has-error' : '' }}">
              <label for="subjects">タイトル <span class="badge badge-danger">必須</span></label>
              <input type="text" class="form-control" name="subjects" id="subjects" value="{{ old('subjects') }}">
              @if ($errors->has('subjects'))
                  <span class="help-block">{{ $errors->first('subjects') }}</span>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
              <label for="message">メッセージ本文 <span class="badge badge-danger">必須</span></label>
              <textarea class="form-control" name="message" id="message" style="height:240px;">{{ old('message') }}</textarea>
              @if ($errors->has('message'))
                  <span class="help-block">{{ $errors->first('message') }}</span>
              @endif
            </div>
          </div>
        </div>
        <h4><b>予約送信</b></h4>
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="form-group{{ $errors->has('start_broadcasting_time') ? ' has-error' : '' }}">
              <label for="start_broadcasting_time">日時 <span class="badge badge-danger">必須</span></label>
              <input type="datetime-local" class="form-control" name="start_broadcasting_time" id="start_broadcasting_time" value="{{ old('start_broadcasting_time') }}">
              @if ($errors->has('start_broadcasting_time'))
                  <span class="help-block">{{ $errors->first('start_broadcasting_time') }}</span>
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