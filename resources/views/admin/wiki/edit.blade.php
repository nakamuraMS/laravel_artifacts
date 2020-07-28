@extends('admin.layouts.app')

@section('content')

<div class="card-body">
  <form method="POST" id="EditForm" action="{{ route('admin.wiki.update', ['wiki_id' => $wiki->id]) }}" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <div class="form-group row">
      <label for="title" class="col-md-2 col-form-label">タイトル</label>
      <div class="col-md-8">
        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $wiki->title }}">
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
        <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body">{{ $wiki->body }}</textarea>
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
            <option value="{{ $k }}" @if( $wiki->disp === $k) selected @endif>{{ $v }}</option>
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

    <div class="form-group row">
      <label for="file" class="col-md-2 col-form-label">登録済みサムネイル</label>
      <div class="col-md-8">
        <img src="{{ asset($wiki->filepass) }}" >
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
      <form action="{{ route('admin.wiki.destroy', ['wiki_id' => $wiki->id])}}" method="post">
        @csrf
        <button class="btn btn-danger btn-block" type="submit" onclick="return dataDelete()">削除</button>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts-foot')
@include('admin._partical.tinymce')
<script>
  function dataDelete () {
    var flag = confirm("データを削除しますか？");
    /* trueなら送信、falseなら送信しない */
    return flag;
  }
</script>
@endpush