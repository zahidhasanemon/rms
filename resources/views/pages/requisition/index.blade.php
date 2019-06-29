@extends('layouts.master')
@section('title', 'Requisitions')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Requisitions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Requisitions</li>
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
                                <th>Date</th>
                                <th>Requisition By</th>
                                <th>For</th>
                                <th>Requisition</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requisitions as $requisition)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $requisition->date }}</td>
                                <td>{{ $requisition->user->name }}</td>
                                <td>
                                    @if( 1 == $requisition->requisition_for )
                                    Personal Use
                                    @else
                                    Lab
                                    @endif
                                </td>   
                                <td>{{ $requisition->details }}</td>
                                <td>
                                    @if( 1 == $requisition->status )
                                    <span class="badge badge-info">Delivered</span>
                                    @else
                                    <span class="badge badge-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @if( 0 == $requisition->status )
                                        <a href="{{ url('requisition/assignment', $requisition->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Assign">
                                            Assign
                                        </a>
                                        @endif
                                        <a href="{{ route('requisition.edit', $requisition->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Update">
                                            Update
                                        </a>
                                        <form action="{{ route('requisition.destroy', $requisition->id) }}" method="POST">
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