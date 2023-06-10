@extends('adminlte::page')

@section('title', 'アカウント新規作成')

@section('content_header')
  <h1>アカウント新規作成</h1>
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
<form action="{{ url('accounts/insert') }}" method="POST">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">新規作成</h3>
    </div>
    <div class="card-body">
        {{ @csrf_field() }}
        <h4><b>基本情報</b></h4>
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name">名前 <span class="badge badge-danger">必須</span></label>
              <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
              @if ($errors->has('name'))
                  <span class="help-block">{{ $errors->first('name') }}</span>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email">メールアドレス <span class="badge badge-danger">必須</span></label>
              <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
              @if ($errors->has('email'))
                  <span class="help-block">{{ $errors->first('email') }}</span>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="form-group{{ $errors->has('telephone_number') ? ' has-error' : '' }}">
              <label for="telephone_number">電話番号 <span class="badge badge-danger">必須</span></label>
              <input type="tel" class="form-control" name="telephone_number" id="telephone_number" value="{{ old('telephone_number') }}">
              @if ($errors->has('telephone_number'))
                  <span class="help-block">{{ $errors->first('telephone_number') }}</span>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="form-group{{ $errors->has('encrypted_password') ? ' has-error' : '' }}">
              <label for="encrypted_password">パスワード <span class="badge badge-danger">必須</span></label>
              <input type="password" class="form-control" name="encrypted_password" id="encrypted_password" value="{{ old('encrypted_password') }}">
              @if ($errors->has('encrypted_password'))
                  <span class="help-block">{{ $errors->first('encrypted_password') }}</span>
              @endif
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="form-group{{ $errors->has('encrypted_password_confirm') ? ' has-error' : '' }}">
              <label for="encrypted_password_confirm">パスワード(確認) <span class="badge badge-danger">必須</span></label>
              <input type="password" class="form-control" name="encrypted_password_confirm" id="encrypted_password_confirm" value="{{ old('encrypted_password_confirm') }}">
              @if ($errors->has('encrypted_password_confirm'))
                  <span class="help-block">{{ $errors->first('encrypted_password_confirm') }}</span>
              @endif
            </div>
          </div>
        </div>
        <h4><b>BET365ログイン情報</b></h4>
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="form-group{{ $errors->has('bet365_userid') ? ' has-error' : '' }}">
              <label for="bet365_userid">ログインID </label>
              <input type="text" class="form-control" name="bet365_userid" id="bet365_userid" value="{{ old('bet365_userid') }}">
              @if ($errors->has('bet365_userid'))
                  <span class="help-block">{{ $errors->first('bet365_userid') }}</span>
              @endif
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="form-group{{ $errors->has('bet365_enc_password') ? ' has-error' : '' }}">
              <label for="name">パスワード </label>
              <input type="password" class="form-control" name="bet365_enc_password" id="bet365_enc_password" value="{{ old('bet365_enc_password') }}">
              @if ($errors->has('bet365_enc_password'))
                  <span class="help-block">{{ $errors->first('bet365_enc_password') }}</span>
              @endif
            </div>
          </div>
        </div>
        <h4><b>グループ・制限</b></h4>
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
              <label for="group_id">グループ選択</label>
              <select class="form-control" name="group_id" id="group_id">
                <option value="0">選択してください...</option>
                @foreach($groups as $group)
                <option value="{{ $group->group_id }}"{{ ($group->group_id === (int)old('group_id')) ? ' selected' : '' }}>{{ $group->group_name }}</option>
                @endforeach
              </select>
              @if ($errors->has('group_id'))
                  <span class="help-block">{{ $errors->first('group_id') }}</span>
              @endif
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="form-group{{ $errors->has('member_limit_id') ? ' has-error' : '' }}">
              <label for="member_limit_id">制限項目 <span class="badge badge-danger">必須</span></label>
              <select class="form-control" name="member_limit_id" id="member_limit_id">
                <option value="0">選択してください...</option>
                @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ ($role->id === (int)old('member_limit_id')) ? ' selected' : '' }}>{{ $role->role_name }}</option>
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
                <label class="radio-inline" for="PlayingDue1" style="margin-left:3%;">
                  <input type="radio" name="playdue" id="PlayingDue1" onchange="choose_radio_due()" value="1" {{ (old('playdue') == 1) ? 'checked' : '' }}>
                  『今日から〇〇日後まで』にと設定
                </label>
                <label class="radio-inline" for="PlayingDue2" style="margin-left:3%;">
                  <input type="radio" name="playdue" id="PlayingDue2" onchange="choose_radio_due()" value="2" {{ (old('playdue') == 2) ? 'checked' : '' }}>
                  日付で設定
                </label>
              @if ($errors->has('playdue'))
                  <span class="help-block">{{ $errors->first('playdue') }}</span>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-12 due_setting_1">
            <div class="form-group{{ $errors->has('num_due') ? ' has-error' : '' }}">
              <label for="name">数値型設定 </label>
              <p>今日から<input type="number" class="form-control" name="num_due" id="num_due" value="{{ old('num_due') }}" style="width:20%; display:inline;">日後までアカウントを使用可能とする。</p>
              @if ($errors->has('num_due'))
                  <span class="help-block">{{ $errors->first('num_due') }}</span>
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
              <textarea class="form-control" name="memo" id="memo" style="height:240px;">{{ old('memo') }}</textarea>
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
      .help-block{
        color: red;
      }
      .due_setting_1 {
        display: none;
      }
      .due_setting_2 {
        display: none;
      }
    </style>
@stop

@section('js')
<script>
  function memo(mems){
    var mem = "【メモ】\n";
    mem += mems;
    alert(mem);
  }

  function choose_radio_due(){
    var attr = $('input[name="playdue"]');

    if (attr[1].checked) {
      $('.due_setting_1').css('display','block');
      $('.due_setting_2').css('display','none');
    } else if (attr[2].checked) {
      $('.due_setting_1').css('display','none');
      $('.due_setting_2').css('display','block');
    } else if (attr[0].checked) {
      $('.due_setting_1').css('display','none');
      $('.due_setting_2').css('display','none');
    }
  }
  choose_radio_due();
</script>
@stop