@extends('admin.layouts.app')

@section('content')
@include('admin._partical.message')
<a href="{{ route('admin.wiki.create') }}" class="btn btn-info btn-icon-split">
  <span class="text">新規登録</span>
</a>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>ID</th>
          <th>タイトル</th>
          <!-- <th>文章</th> -->
          <th></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
@endsection

@push('scripts-foot')
<script>
  $(function () {
    $('#dataTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.wiki.index') }}",
      columns: [
        {data: 'id', name: 'id'},
        {data: 'title', name: 'title'},
        // {data: 'body', name: 'body'},
        {data: 'edit', name: 'edit', orderable: false, searchable: false},
      ]
    });
  });
</script>
@endpush