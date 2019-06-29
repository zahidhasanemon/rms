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
                    <h1 class="m-0 text-dark">Add Store</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('store') }}">Store</a></li>
                        <li class="breadcrumb-item active">Add</li>
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
                    <form method="POST" action="{{ route('store.store') }}">
                        @csrf
                        {{-- Date --}}
                        <div class="form-group">
                            <label for="date">
                                Date
                            </label>

                            <input type="text" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" id="date" value="{{ old('date') }}" placeholder="Date"> 

                            @if ($errors->has('date'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                            @endif
                        </div>

                        {{-- Supplier --}}
                        <div class="form-group">
                            <label for="supplier_selection">Supplier</label>
                            <select name="supplier_selection" class="form-control{{ $errors->has('supplier_selection') ? ' is-invalid' : '' }}" id="supplier_selection">
                                <option value="">Select</option>
                                <option value="1">Old Supplier</option>
                                <option value="2">New Supplier</option>
                            </select>
                            @if ($errors->has('supplier_selection'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('supplier_selection') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div id="supplier_info"></div>

                        {{-- Product --}}
                        <div class="form-group">
                            <label for="product_id">Product</label>
                            <select name="product_id" class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}" id="product_id">
                                <option value="">Select</option>
                                @forelse($products as $product)
                                <option value="{{ $product->id }}" 
                                    @if( old('product_id') == $product->id )
                                    selected
                                    @endif
                                    >
                                    {{ $product->name }}
                                </option>
                                @empty
                                <option value="">No Product Found</option>
                                @endforelse
                            </select>
                            @if ($errors->has('product_id'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('product_id') }}</strong>
                            </span>
                            @endif
                        </div>

                        {{-- Rate --}}
                        <div class="form-group">
                            <label for="rate">
                                Rate
                            </label>

                            <input type="number" min="0" step="any" class="form-control{{ $errors->has('rate') ? ' is-invalid' : '' }}" name="rate" id="rate" value="{{ old('rate') }}" placeholder="Rate">

                            @if ($errors->has('rate'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('rate') }}</strong>
                            </span>
                            @endif
                        </div>

                        {{-- Quantity --}}
                        <div class="form-group">
                            <label for="quantity">
                                Quantity
                            </label>

                            <input type="number" min="0" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" id="quantity" value="{{ old('quantity') }}" placeholder="Quantity">

                            @if ($errors->has('quantity'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('quantity') }}</strong>
                            </span>
                            @endif
                        </div>

                        {{-- Amount --}}
                        <div class="form-group">
                            <label for="amount">
                                Amount
                            </label>

                            <input type="number" min="0" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" id="amount" value="{{ old('amount') }}" readonly="readonly" placeholder="Amount">

                            @if ($errors->has('amount'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                            @endif
                        </div>


                        {{-- Invoice --}}
                        <div class="form-group">
                            <label for="invoice">Invoice</label>
                            <input type="text" class="form-control{{ $errors->has('invoice') ? ' is-invalid' : '' }}" name="invoice" id="invoice" value="{{ old('invoice') }}" placeholder="Invoice">

                            @if ($errors->has('invoice'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('invoice') }}</strong>
                            </span>
                            @endif
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
    {{-- jquery datepicker --}}
    $( function() {
        $( "#date" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
        });
    });

    //amount calculation
    $(document).ready(function(){
        var rate=$("#rate");
        var quantity=$("#quantity");
        rate.keyup(function(){
            var total=isNaN(parseFloat(rate.val()* quantity.val())) ? 0 :(rate.val()* quantity.val())
            $("#amount").val(total);
        });
        quantity.keyup(function(){
            var total=isNaN(parseInt(rate.val()* quantity.val())) ? 0 :(rate.val()* quantity.val())
            $("#amount").val(total);
        });
    });
</script>

<script>
    $('#supplier_selection').on('change', function(){
        var supplier_selection = $('#supplier_selection').val();
        if (supplier_selection == 1) {
            $('#supplier_info').html('');
            supplier_info = '';
            supplier_info += '<div class="form-group"><label for="supplier_id"> Supplier</label><select name="supplier_id" class="form-control" id="supplier_id" required="required"> <option value="">Select</option> @forelse($suppliers as $supplier) <option value="{{ $supplier->id }}" @if( old('supplier_id') == $supplier->id ) selected @endif> {{ $supplier->name }} </option> @empty <option value="">No Supplier Found</option> @endforelse </select></div>';
            $('#supplier_info').html(supplier_info);
            $('#supplier_id').select2({
                placeholder: 'Select',

                ajax: {
                    url: '{!!URL::route('supplier-autocomplete-search')!!}',
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
        }

        else if (supplier_selection == 2) {
            $('#supplier_info').html('');
            supplier_info = '';
            supplier_info += '{{-- Name --}}<div class="form-group"><label for="name">Name</label><input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" autofocus required="required" placeholder="Name"></div>{{-- Mobile --}}<div class="form-group"><label for="mobile">Mobile</label><input type="text" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') }}" required="required" placeholder="Mobile"></div>{{-- Email --}}<div class="form-group"><label for="email">Email</label><input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email"></div>{{-- Address --}}<div class="form-group"><label for="address">Address</label><textarea name="address" class="form-control" id="address" cols="30" rows="5" placeholder="Address">{{ old('address') }}</textarea></div>';
            $('#supplier_info').html(supplier_info);
        }
        else{
            $('#supplier_info').html('');
        }
    });

    //search product
    $('#product_id').select2({
        placeholder: 'Select',

        ajax: {
            url: '{!!URL::route('product-autocomplete-search')!!}',
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
