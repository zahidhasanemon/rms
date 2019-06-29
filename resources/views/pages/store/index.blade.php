@extends('layouts.master')
@section('title', 'Store')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Store</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Store</li>
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
                                <th>Supplier</th>
                                <th>Date</th>
                                <th>Invoice</th>
                                <th>Remarks</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stores as $store)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $store->product->name }}</td>
                                <td>{{ $store->supplier->name }}</td>
                                <td>{{ $store->date }}</td>
                                <td>{{ $store->invoice }}</td>        
                                <td>{{ $store->details }}</td>
                                <td>{{ $store->quantity }}</td>
                                <td>{{ $store->rate }}</td>
                                <td>{{ $store->amount }}</td>
                                <td>
                                    <div class="btn-group">
                                        {{-- <a href="{{ route('store.edit', $store->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Update">
                                            Update
                                        </a> --}}
                                        <form action="{{ route('store.destroy', $store->id) }}" method="POST">
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