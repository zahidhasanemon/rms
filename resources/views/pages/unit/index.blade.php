@extends('layouts.master')
@section('title', 'Unit')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Units</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Units</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Code</th>
                                <th>Assigned To</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($units as $unit)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $unit->code }}</td>
                                @if( $unit->assigned_to == 1 )
                                <td>{{ $unit->user->name }}</td>
                                @elseif( $unit->assigned_to == 2 )
                                <td>{{ $unit->lab->name }}</td>
                                @else
                                <td>Free</td>
                                @endif      
                                <td>{{ $unit->details }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('unit.show', $unit->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View">
                                            View
                                        </a>
                                        <a href="{{ route('unit.edit', $unit->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Update">
                                            Update
                                        </a>
                                        <form action="{{ route('unit.destroy', $unit->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" title="Delete">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('script')

<script>
    $(function () {
        $("#myTable").DataTable();
    });
</script>

@endsection