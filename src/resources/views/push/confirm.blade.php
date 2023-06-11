@extends('adminlte::page')

@section('title', 'プッシュ通知確認')

@section('content_header')
  <h1>プッシュ通知確認</h1>
@stop

{{ @csrf_field() }}
@section('content')
<div class="card card-primary card-outline" style="margin-top: 20px;">
    <div class="card-header">
      <h3 class="card-title">配信情報</h3>
    </div>
    <div class="card-body">
        <h4><b>プッシュ配信情報</b></h4>
        <table class="table table-bordered" style="margin-bottom:40px;">
            <tbody>
                <tr>
                    <th style="width:10%; text-align:center; background-color:black; color:white;">
                        配信範囲
                    </th>
                    <td style="width:40%;">
                        @if($push->user_id)
                            個別
                        @elseif($push->group_id)
                            グループ
                        @else
                            全員
                        @endif
                    </td>
                </tr>
                <tr>
                    <th style="width:10%; text-align:center; background-color:black; color:white;">
                        配信開始時間
                    </th>
                    <td style="width:40%;">
                        {{ $push->start_broadcasting_time }}
                    </td>
                </tr>
                <tr>
                    <th style="width:10%; text-align:center; background-color:black; color:white;">
                        タイトル
                    </th>
                    <td style="width:40%;">
                        {{ $push->subjects }}
                    </td>
                </tr>
                <tr>
                    <th style="width:10%; text-align:center; background-color:black; color:white;">
                        メッセージ
                    </th>
                    <td style="width:40%;">
                        {{ $push->message }}
                    </td>
                </tr>
            </tbody>
        </table>
        @if($push->user_id)
            <h4><b>配信されたユーザー</b></h4>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 10%; text-align:center;">ユーザーID</th>
                        <th scope="col" style="width: 80%; text-align:center;">ユーザー名</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($get_user as $user)
                    <tr>
                        <th scope="row" style="text-align:center;">{{ $user->user_id }}</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @elseif($push->group_id)
            <h4><b>配信されたグループ</b></h4>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 10%; text-align:center;">グループID</th>
                        <th scope="col" style="width: 80%; text-align:center;">グループ名</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($get_group as $group)
                    <tr>
                        <th scope="row" style="text-align:center;">{{ $group->group_id }}</th>
                        <td>{{ $group->group_name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h4><b>全員に配信されています</b></h4>
        @endif
    </div>
    <div class="card-footer">
      <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
    </div>
  </div>
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
</script>
@stop