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
                    <h1 class="m-0 text-dark">Requisition Assignment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('requisition') }}">Requisitions</a></li>
                        <li class="breadcrumb-item active">Assign</li>
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
                    <form method="POST" action="{{ url('requisition/assignment/store') }}">
                        @csrf

                        {{-- Requisition ID --}}
                        <input type="hidden" name="requisition_id" value="{{ $requisition->id }}">

                        {{-- Component --}}
                        <div class="form-group">
                            <label for="component_id">Components</label>
                            <select name="component_id[]" class="form-control" id="component_id" multiple="multiple">
                                <option value="">Select</option>
                                @forelse($components as $component)
                                <option value="{{ $component->id }}" >
                                    {{ $component->code }}
                                </option>
                                @empty
                                <option value="">No Component Found</option>
                                @endforelse
                            </select>
                        </div>

                        {{-- Unit --}}
                        <div class="form-group">
                            <label for="unit_id">Units</label>
                            <select name="unit_id[]" class="form-control" id="unit_id" multiple="multiple">
                                <option value="">Select</option>
                                @forelse($units as $unit)
                                <option value="{{ $unit->id }}" >
                                    {{ $unit->code }}
                                </option>
                                @empty
                                <option value="">No Unit Found</option>
                                @endforelse
                            </select>
                        </div>

                        {{-- Details --}}
                        <div class="form-group">
                            <label for="details">
                                Remarks
                            </label>

                            <textarea name="details" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" id="details" cols="30" rows="5" placeholder="Remarks">{{ old('details') }}</textarea>

                            @if( $errors->has('details'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('details') }}</strong>
                            </span>
                            @endif
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" value="1" name="status">
                              <label class="form-check-label">Complete</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" value="0" name="status">
                              <label class="form-check-label">Remains</label>
                            </div>
                        </div>
                        
                        {{-- Save --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Assign') }}
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

@section('script')
<script>

//search component
$('#component_id').select2({
    placeholder: 'Select',

    ajax: {
        url: '{!!URL::route('component-autocomplete-search')!!}',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    theme: "bootstrap"
});

$('#unit_id').select2({
    placeholder: 'Select',

    ajax: {
        url: '{!!URL::route('unit-autocomplete-search')!!}',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    theme: "bootstrap"
});

</script>

@endsection
