@extends('adminlte::page')

@section('title', 'アカウント編集')

@section('content_header')
  <h1>アカウント編集</h1>
@stop

@section('content')
<section class="content form-edit">
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
<form action="{{ url(sprintf('accounts/%d/delete', $accounts->user_id)) }}" method="POST" class="delform">
        {{ @csrf_field() }}
          <input type="hidden" name="status" value="3">
          <input type="button" value="削除" class="btn btn-danger" onclick="delete_OK()">
          <label> ← アカウントの削除はこちらから</label>
</form>
<form action="{{ url(sprintf('accounts/%d/update', $accounts->user_id)) }}" method="POST">
{{ @csrf_field() }}
  <div class="card card-primary card-outline" style="margin-top: 20px;">
    <div class="card-header">
      <h3 class="card-title">編集</h3>
    </div>
    <div class="card-body">
        <h4><b>基本情報</b></h4>
        <table class="table table-bordered" style="margin-bottom:40px;">
            <tbody>
                <tr>
                    <th style="width:10%; text-align:center; background-color:black; color:white;">
                        名前
                    </th>
                    <td style="width:40%;">
                        {{ $accounts->name }}
                    </td>
                </tr>
                <tr>
                    <th style="width:10%; text-align:center; background-color:black; color:white;">
                        メールアドレス
                    </th>
                    <td style="width:40%;">
                        {{ $accounts->email }}
                    </td>
                </tr>
                <tr>
                    <th style="width:10%; text-align:center; background-color:black; color:white;">
                        電話番号
                    </th>
                    <td style="width:40%;">
                        {{ $accounts->telephone_number }}
                    </td>
                </tr>
                <tr>
                    <th style="width:10%; text-align:center; background-color:black; color:white;">
                        BET365アカウント
                    </th>
                    <td style="width:40%;">
                        {{ $accounts->bet365_userid }}
                    </td>
                </tr>
            </tbody>
        </table>
        <h4><b>グループ・制限</b></h4>
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
              <label for="group_id">グループ情報</label>
              <select class="form-control" name="group_id" id="group_id">
                <option value="0">選択してください...</option>
                @foreach($groups as $group)
                <option value="{{ $group->group_id }}"{{ ($group->group_id === (int)old('group_id', $accounts->group_id)) ? ' selected' : '' }}>{{ $group->group_name }}</option>
                @endforeach
              </select>
              @if ($errors->has('group_id'))
                  <span class="help-block">{{ $errors->first('group_id') }}</span>
              @endif
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="member_limit_id">制限項目 <span class="badge badge-danger">必須</span></label>
              <select class="form-control" name="member_limit_id" id="member_limit_id">
                <option value="0">選択してください...</option>
                @foreach($roles as $role)
                <option value="{{ $role->id }}"{{ ($role->id === (int)old('member_limit_id', $accounts->member_limit_id)) ? ' selected' : '' }}>{{ $role->role_name }}</option>
                @endforeach
              </select>
              @if ($errors->has('member_limit_id'))
                  <span class="help-block">{{ $errors->first('member_limit_id') }}</span>
              @endif
            </div>
          </div>
        </div>
        <h4><b>利用期限</b></h4>
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="form-group{{ $errors->has('playdue') ? ' has-error' : '' }}">
                <label class="radio-inline" for="PlayingDue0">
                  <input type="radio" name="playdue" id="PlayingDue0" onchange="choose_radio_due()" value="0" {{ (old('playdue') == 0) ? 'checked' : '' }}>
                  無期限
                </label>
                <label class="radio-inline" for="PlayingDue2" style="margin-left:3%;">
                  <input type="radio" name="playdue" id="PlayingDue2" onchange="choose_radio_due()" value="1" {{ (old('playdue') == 1) ? 'checked' : '' }}>
                  日付で設定
                </label>
              @if ($errors->has('playdue'))
                  <span class="help-block">{{ $errors->first('playdue') }}</span>
              @endif
            </div>
          </div>
          <div class="col-lg-6 col-md-12 due_setting_2">
            <div class="form-group{{ $errors->has('license_deadline') ? ' has-error' : '' }}">
              <label for="name">日付設定 </label>
              <input type="date" class="form-control" name="license_deadline" id="license_deadline" value="{{ old('license_deadline') }}">
              @if ($errors->has('license_deadline'))
                  <span class="help-block">{{ $errors->first('license_deadline') }}</span>
              @endif
            </div>
          </div>
        </div>
        <h4><b>メモ</b></h4>
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="form-group{{ $errors->has('memo') ? ' has-error' : '' }}">
              <label for="memo">FREE</label>
              <textarea class="form-control" name="memo" id="memo" style="height:240px;">{{ old('memo',$accounts->memo) }}</textarea>
              @if ($errors->has('memo'))
                  <span class="help-block">{{ $errors->first('memo') }}</span>
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

      .due_setting_2 {
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

  function choose_radio_due(){
    var attr = $('input[name="playdue"]');

    if (attr[0].checked) {
      $('.due_setting_2').css('display','none');
    } else if (attr[1].checked) {
      $('.due_setting_2').css('display','block');
    }
  }
</script>
@stop