@extends('layouts.main')

@section('title', 'Review')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ $title }}</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div>
</div>

<div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('boardinghouse.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Go Back</a>
                </div>
                <div class="card-body">
                    <table id="table-1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="20%">Comments By</th>
                                <th>Rating</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $r)
                                <tr>
                                   <td>{{ $r->user->name }}</td>
                                   <td>{{ $r->rate }}</td>
                                   <td>{{ $r->comment }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection

@push('script-down')
<script>
    $('#table-1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
</script>
@endpush
