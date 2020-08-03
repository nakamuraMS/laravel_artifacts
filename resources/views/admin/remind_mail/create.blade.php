@extends('admin.layouts.app')

@section('content')

<div class="card-body">
  <form method="POST" action="{{ route('admin.remind_mail.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
      <label for="title" class="col-md-2 col-form-label">タイトル</label>
      <div class="col-md-8">
        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">
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
        <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body" rows="20">{{ old('body') }}</textarea>
        @error('body')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <label for="body" class="col-md-2 col-form-label">送信時間</label>
      <div class="input-group col-md-2">
        <select class="form-control" name="date_year">
          <option value=""></option>
          @foreach ($formYear as $year)
          <option value="{{ $year }}">{{ $year }}</option>
          @endforeach
        </select>
      </div>
      <div class="input-group col-md-1">
        <select class="form-control" name="date_month">
          <option value=""></option>
          @foreach ($formMonth as $month)
          <option value="{{ $month }}">{{ $month }}</option>
          @endforeach
        </select>
      </div>
      <div class="input-group col-md-1">
        <select class="form-control" name="date_day">
          <option value=""></option>
          @foreach ($formDay as $day)
          <option value="{{ $day }}">{{ $day }}</option>
          @endforeach
        </select>
      </div>
      <div class="input-group col-md-1">
        <select class="form-control" name="date_hour">
          <option value=""></option>
          @foreach ($formHour as $hour)
          <option value="{{ $hour }}">{{ $hour }}</option>
          @endforeach
        </select>
      </div>
      <div class="input-group col-md-1">
        <select class="form-control" name="date_minute">
          <option value=""></option>
          @foreach ($formMinute as $minute)
          <option value="{{ $minute }}">{{ $minute }}</option>
          @endforeach
        </select>
      </div>
      @error('datetime')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group row mb-0">
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary btn-block">
          登録
        </button>
      </div>
    </div>
  </form>
</div>
@endsection

@push('scripts-foot')

@endpush