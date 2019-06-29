{{-- Name --}}
<div class="form-group">
	<label for="name">
		Name
	</label>

	<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name', optional($subCategory)->name) }}" autofocus placeholder="Name">

	@if ($errors->has('name'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
	@endif
</div>

{{-- category --}}
<div class="form-group">
	<label for="category_id">Category</label>
	<select name="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" id="category_id">
		<option value="">Select</option>
		@forelse($categories as $category)
			<option value="{{ $category->id }}" 
				@if( old('category_id', optional($subCategory)->category_id) == $category->id )
					selected
				@endif
				>
				{{ $category->name }}
			</option>
		@empty
			<option value="">No Category Found</option>
		@endforelse
	</select>
	@if ($errors->has('category_id'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('category_id') }}</strong>
		</span>
	@endif
</div>

{{-- Details --}}
<div class="form-group">
	<label for="details">
		Remarks
	</label>

	<textarea name="details" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" id="details" cols="30" rows="5" placeholder="details">{{ old('details', optional($subCategory)->details) }}</textarea>

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
