{{-- Name --}}
<div class="form-group">
	<label for="name">
		Name
	</label>

	<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name', optional($lab)->name) }}" autofocus placeholder="Name">

	@if ($errors->has('name'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
	@endif
</div>

{{-- user --}}
<div class="form-group">
	<label for="user_id">Assigned To</label>
	<select name="user_id" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" id="user_id">
		<option value="">Select</option>
		@forelse($users as $user)
			<option value="{{ $user->id }}" 
				@if( old('user_id', optional($lab)->user_id) == $user->id )
					selected
				@endif
				>
				{{ $user->name }}
			</option>
		@empty
			<option value="">No User Found</option>
		@endforelse
	</select>
	@if ($errors->has('user_id'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('user_id') }}</strong>
		</span>
	@endif
</div>


{{-- Details --}}
<div class="form-group">
	<label for="details">
		Remarks
	</label>

	<textarea name="details" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" id="details" cols="30" rows="5" placeholder="Remarks">{{ old('details', optional($lab)->details) }}</textarea>

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
