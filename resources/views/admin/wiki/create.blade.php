@extends('admin.layouts.app')

@section('content')

<div class="card-body">
  <form method="POST" action="{{ route('admin.wiki.store') }}" enctype="multipart/form-data">
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
      <label for="body" class="col-md-2 col-form-label">文章</label>
      <div class="col-md-8">
        <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body">{{ old('body') }}</textarea>
        @error('body')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <label for="disp" class="col-md-2 col-form-label">公開制御</label>
      <div class="col-md-8">
        <select id="disp" class="form-control @error('disp') is-invalid @enderror" name="disp">
          @foreach(\App\Models\Wiki::DISP as $k => $v)
            <option value="{{ $k }}" @if( \App\Models\Wiki::DISP_ON === $k) selected @endif>{{ $v }}</option>
          @endforeach
        </select>
        @error('disp')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <label for="file" class="col-md-2 col-form-label">サムネイル</label>
      <div class="col-md-8">
        <input id="file" type="file" class="form-control-file @error('thumbnail') is-invalid @enderror" name="thumbnail">
        @error('thumbnail')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
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
@include('admin._partical.tinymce')
@endpush