@extends('layouts.main')

@section('title', 'Boarding House')

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
                    <a href="{{ route('boardinghouse.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
                </div>
                <div class="card-body">
                    <table id="table-1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Map Url</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($boardinghouses as $b)
                                <tr>
                                   <td>{{ $b->name }}</td>
                                   <td>{{ $b->address }}</td>
                                   <td>
                                        @if ($b->map_url != NULL || $b->map_url != '')
                                            <a href="{{ $b->map_url }}" target="_BLANK">Map Url</a>
                                        @else

                                        @endif
                                   </td>
                                   <td>{{ $b->city }}</td>
                                   <td>
                                       <a href="{{ route('boardinghouse.edit', $b->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>

                                       <form action="{{ route('boardinghouse.destroy', $b->id) }}" class="d-inline" method="POST">
                                           @csrf
                                           @method('DELETE')
                                           <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                       </form>
                                   </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Data Empty !</td>
                                </tr>
                            @endforelse
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
