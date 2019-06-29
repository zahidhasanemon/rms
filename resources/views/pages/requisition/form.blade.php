{{-- Date --}}
<div class="form-group">
    <label for="date">
        Date
    </label>

    <input type="text" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" id="date" value="{{ old('date', optional($requisition)->date) }}" placeholder="Date"> 

    @if ($errors->has('date'))
    <span class="invalid-feedback">
        <strong>{{ $errors->first('date') }}</strong>
    </span>
    @endif
</div>		

{{-- Requisition For --}}
<div class="form-group">
    <label for="requisition_for">Requisition For</label>
    <select name="requisition_for" class="form-control{{ $errors->has('requisition_for') ? ' is-invalid' : '' }}" id="requisition_for">
        <option value="">Select</option>
        <option value="1" 
            @if( old('requisition_for',optional($requisition)->requisition_for) == 1 )
            selected
            @endif
            >
            Personal Use
        </option>
        @if($user->lab)
        <option value="2" 
            @if( old('requisition_for',optional($requisition)->requisition_for) == 2 )
            selected
            @endif
            >
            Lab
        </option>
        @endif
    </select>
    @if ($errors->has('requisition_for'))
    <span class="invalid-feedback">
        <strong>{{ $errors->first('requisition_for') }}</strong>
    </span>
    @endif
</div>


{{-- Details --}}
<div class="form-group">
	<label for="details">
		Requisition
	</label>

	<textarea name="details" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" id="details" cols="30" rows="5" placeholder="Be Specific What You Want With Quantity">{{ old('details', optional($requisition)->details) }}</textarea>

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
</script>
@endsection