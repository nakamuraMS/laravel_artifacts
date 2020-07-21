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
          <th>文章</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        {{-- <tr>
          <td>Tiger Nixon</td>
          <td>System Architect</td>
          <td>Edinburgh</td>
          <td>61</td>
          <td>2011/04/25</td>
          <td>$320,800</td>
        </tr>
        <tr>
          <td>Garrett Winters</td>
          <td>Accountant</td>
          <td>Tokyo</td>
          <td>63</td>
          <td>2011/07/25</td>
          <td>$170,750</td>
        </tr>
        <tr>
          <td>Ashton Cox</td>
          <td>Junior Technical Author</td>
          <td>San Francisco</td>
          <td>66</td>
          <td>2009/01/12</td>
          <td>$86,000</td>
        </tr>
        <tr>
          <td>Cedric Kelly</td>
          <td>Senior Javascript Developer</td>
          <td>Edinburgh</td>
          <td>22</td>
          <td>2012/03/29</td>
          <td>$433,060</td>
        </tr>
        <tr>
          <td>Airi Satou</td>
          <td>Accountant</td>
          <td>Tokyo</td>
          <td>33</td>
          <td>2008/11/28</td>
          <td>$162,700</td>
        </tr>
        <tr>
          <td>Brielle Williamson</td>
          <td>Integration Specialist</td>
          <td>New York</td>
          <td>61</td>
          <td>2012/12/02</td>
          <td>$372,000</td>
        </tr> --}}
      </tbody>
    </table>
  </div>
</div>
@endsection

@push('scripts-foot')
<script>
  // $(document).ready(function() {
  //   $('#dataTable').DataTable();
  // });

  $(function () {
    $('#dataTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.wiki.index') }}",
      columns: [
        {data: 'id', name: 'id'},
        {data: 'title', name: 'title'},
        {data: 'body', name: 'body'},
        {data: 'edit', name: 'edit', orderable: false, searchable: false},
      ]
    });
  });
</script>
@endpush