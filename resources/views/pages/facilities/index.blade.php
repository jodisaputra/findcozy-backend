@extends('layouts.main')

@section('title', 'Facilities')

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
                    <a href="{{ route('facilities.create', $boardinghouse_id) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
                </div>
                <div class="card-body">
                    <table id="table-1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Facility Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facilities as $f)
                                <tr>
                                   <td>{{ $f->facility_name }}</td>
                                   <td>

                                       <a href="{{ route('facilities.edit', [$f->id, $boardinghouse_id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>

                                       <form action="{{ route('facilities.destroy', [$f->id, $boardinghouse_id]) }}" class="d-inline" method="POST">
                                           @csrf
                                           @method('DELETE')
                                           <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                       </form>

                                   </td>
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
