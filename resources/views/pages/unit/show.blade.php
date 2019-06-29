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
                    <h1 class="m-0 text-dark">View Unit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('unit') }}">Unit</a></li>
                        <li class="breadcrumb-item active">View</li>
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
                                <th>Code</th>
                                <th>Assigned To</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $unit->code }}</td>
                                @if( $unit->assigned_to == 1 )
                                <td>{{ $unit->user->name }}</td>
                                @elseif( $unit->assigned_to == 2 )
                                <td>{{ $unit->lab->name }}</td>
                                @else
                                <td>Free</td>
                                @endif      
                                <td>{{ $unit->details }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <h4>Components</h4>
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($components as $component)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $component->code }}</td>
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
    // $(function () {
    //     $("#myTable").DataTable();
    // });
</script>

@endsection