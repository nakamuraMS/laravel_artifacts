@extends('admin.layouts.app')

@section('content')

<div class="card-body">
  <form method="POST" id="EditForm" action="{{ route('admin.remind_mail.update', ['remind_mail_id' => $remind_mail->id]) }}">
    @method('PATCH')
    @csrf
    <div class="form-group row">
      <label for="title" class="col-md-2 col-form-label">タイトル</label>
      <div class="col-md-8">
        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $remind_mail->title }}">
        @error('title')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <label for="body" class="col-md-2 col-form-label">メール本文</label>
      <div class="col-md-8">
        <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body" rows="20">{{ $remind_mail->body }}</textarea>
        @error('body')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <label class="col-md-2 col-form-label">送信時間</label>
      <div class="input-group col-md-8">
        <select class="form-control @error('datetime') is-invalid @enderror" name="date_year">
          <option value=""></option>
          @foreach ($formYear as $year)
          <option value="{{ $year }}" @if (date('Y', strtotime($remind_mail->datetime)) == $year) selected @endif>{{ $year }}</option>
          @endforeach
        </select>
        <span>年</span>

        <select class="form-control @error('datetime') is-invalid @enderror" name="date_month">
          <option value=""></option>
          @foreach ($formMonth as $month)
          <option value="{{ $month }}" @if (date('n', strtotime($remind_mail->datetime)) == $month) selected @endif>{{ $month }}</option>
          @endforeach
        </select>
        <span>月</span>

        <select class="form-control @error('datetime') is-invalid @enderror" name="date_day">
          <option value=""></option>
          @foreach ($formDay as $day)
          <option value="{{ $day }}" @if (date('d', strtotime($remind_mail->datetime)) == $day) selected @endif>{{ $day }}</option>
          @endforeach
        </select>
        <span>日</span>

        <select class="form-control @error('datetime') is-invalid @enderror" name="date_hour">
          <option value=""></option>
          @foreach ($formHour as $hour)
          <option value="{{ $hour }}" @if (date('G', strtotime($remind_mail->datetime)) == $hour) selected @endif>{{ $hour }}</option>
          @endforeach
        </select>
        <span>時</span>

        <select class="form-control @error('datetime') is-invalid @enderror" name="date_minute">
          <option value=""></option>
          @foreach ($formMinute as $minute)
          <option value="{{ str_pad($minute, 2, 0, STR_PAD_LEFT) }}" @if (date('i', strtotime($remind_mail->datetime)) == $minute) selected @endif>{{ str_pad($minute, 2, 0, STR_PAD_LEFT) }}</option>
          @endforeach
        </select>
        <span>分</span>
        @error('datetime')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
  </form>
</div>
<div class="card-footer">
  <div class="form-group row mb-0">
    <div class="col-md-2">
      <button class="btn btn-primary btn-block" type="submit" form="EditForm">更新</button>
    </div>
    <div class="col-md-2 offset-md-6">
      <form action="{{ route('admin.remind_mail.destroy', ['remind_mail_id' => $remind_mail->id])}}" method="post">
        @csrf
        <button class="btn btn-danger btn-block" type="submit" onclick="return dataDelete()">削除</button>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts-foot')
<script>
  function dataDelete () {
    var flag = confirm("データを削除しますか？");
    /* trueなら送信、falseなら送信しない */
    return flag;
  }
</script>
@endpush