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
                    <h1 class="m-0 text-dark">Edit Component</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('component') }}">Components</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                    <form method="POST" action="{{ route('component.update', $component->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Status --}}
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" id="status">
                                <option value="">Select</option>
                                
                                <option value="1" 
                                    @if( $component->status == 1 )
                                    selected
                                    @endif
                                    >
                                    Free
                                </option>

                                <option value="2" 
                                    @if( $component->status == 2 )
                                    selected
                                    @endif
                                    >
                                    In Use
                                </option>

                                <option value="3" 
                                    @if( $component->status == 3 )
                                    selected
                                    @endif
                                    >
                                    Repairable
                                </option>

                                <option value="4" 
                                    @if( $component->status == 4 )
                                    selected
                                    @endif
                                    >
                                    Damaged
                                </option>
                                
                            </select>
                            @if ($errors->has('status'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span>
                            @endif
                        </div>

                        {{-- Save --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
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
