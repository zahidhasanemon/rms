@extends('layouts.master')
@section('title', 'Component')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Components</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Components</li>
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
                                <th>Product</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($components as $component)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $component->product->name }}</td>
                                <td>{{ $component->code }}</td>       
                                <td>
                                    @if ( $component->status == 1 )
                                    {{ 'Free' }}
                                    @elseif ( $component->status == 2 )
                                    {{ 'In Use' }}
                                    @elseif ( $component->status == 3 )
                                    {{ 'Repairable' }}
                                    @else
                                    {{ 'Damaged' }}
                                    @endif
                                </td>
                                <td>{{ $component->details }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('component.edit', $component->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Update">
                                            Update
                                        </a>
                                        <form action="{{ route('component.destroy', $component->id) }}" method="POST">
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