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
                    <h1 class="m-0 text-dark">Create New Unit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('unit') }}">Unit</a></li>
                        <li class="breadcrumb-item active">Create New</li>
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
                    <form method="POST" action="{{ route('unit.store') }}">
                        @csrf
                        {{-- Code --}}
                        <div class="form-group">
                            <label for="code">
                                Code
                            </label>

                            <input type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" id="code" value="{{ old('code') }}" placeholder="Code"> 

                            @if ($errors->has('code'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                            @endif
                        </div>


                        {{-- Component --}}
                        <div class="form-group">
                            <label for="component_id">Components</label>
                            <select name="component_id[]" class="form-control" id="component_id" required="required" multiple="multiple">
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
                                        

                        {{-- Assignment --}}
                        <div class="form-group">
                            <label for="assigned_to">Assignment</label>
                            <select name="assigned_to" class="form-control{{ $errors->has('assigned_to') ? ' is-invalid' : '' }}" id="assigned_to">
                                <option value="">Select</option>
                                <option value="1">User</option>
                                <option value="2">Lab</option>
                                <option value="3">Free</option>
                            </select>
                            @if ($errors->has('assigned_to'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('assigned_to') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div id="assignment_info"></div>


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

@section('script')

<script>
    $('#assigned_to').on('change', function(){
        var assigned_to = $('#assigned_to').val();
        if (assigned_to == 1) {
            $('#assignment_info').html('');
            assignment_info = '';
            assignment_info += '<div class="form-group"><label for="user_id">User</label><select name="user_id" class="form-control" id="user_id" required="required"> <option value="">Select</option> @forelse($users as $user) <option value="{{ $user->id }}" @if( old('user_id') == $user->id ) selected @endif> {{ $user->name }} </option> @empty <option value="">No User Found</option> @endforelse </select></div>';
            $('#assignment_info').html(assignment_info);
        }

        else if (assigned_to == 2) {
            $('#assignment_info').html('');
            assignment_info = '';
            assignment_info += '<div class="form-group"><label for="lab_id">Lab</label><select name="lab_id" class="form-control" id="lab_id" required="required"> <option value="">Select</option> @forelse($labs as $lab) <option value="{{ $lab->id }}" @if( old('lab_id') == $lab->id ) selected @endif> {{ $lab->name }} </option> @empty <option value="">No Lab Found</option> @endforelse </select></div>';
            $('#assignment_info').html(assignment_info);
        }
        else{
            $('#assignment_info').html('');
        }
    });

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

</script>
@endsection
