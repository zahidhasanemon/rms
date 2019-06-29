{{-- Name --}}
<div class="form-group">
	<label for="name">
		Name
	</label>

	<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name', optional($product)->name) }}" autofocus placeholder="Name">

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
				@if( old('category_id', optional($product)->category_id) == $category->id )
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

{{-- Sub Category --}}
<div id="subcategory_info" class="form-group">
	<label for="sub_category_id">Sub Category</label>
	<select id="sub_category_id" name="sub_category_id" class="form-control{{ $errors->has('sub_category_id') ? ' is-invalid' : '' }}">
		<option value="">Select</option>
		@if(old('sub_category_id'))
		<option value="{{ old('sub_category_id') }}" selected="selected">{{ old('sub_category_id') }}</option>
		@endif
		@if(optional($product)->sub_category_id)
		<option value="{{ $product->sub_category_id }}" selected="selected">{{ $product->subCategory->name }}</option>
		@endif
	</select>
	@if ($errors->has('sub_category_id'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('sub_category_id') }}</strong>
		</span>
	@endif
</div>

{{-- Details --}}
<div class="form-group">
	<label for="details">
		Remarks
	</label>

	<textarea name="details" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" id="details" cols="30" rows="5" placeholder="Remarks">{{ old('details', optional($product)->details) }}</textarea>

	@if( $errors->has('details'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('details') }}</strong>
		</span>
	@endif
</div>

{{-- Show Image --}}
@if( optional($product)->image ) 
	<div class="form-group" id="showImage">
		<img src="{{ asset('images/products/'.$product->image) }}" alt="" class="img-thumbnail" width="200">
		<input type="hidden" value="{{ $product->image }}" name="oldimage">
	</div>	
@endif

{{-- Upload Image --}}
<div class="form-group" style="display: none;" id="uploadImage">
	<img id="upload" class="img-thumbnail" width="200" src="#" alt="" />
</div>

{{-- Image --}}
<div class="form-group">
	<label for="image">
		Image
	</label>

	<input type="file" class="form-control-file" name="image" id="image" accept="image/*" onchange="handleFiles(this.files)">
	<small id="fileHelp" class="form-text text-muted">(JPEG or PNG Format)</small>

	@if ($errors->has('image'))
		<span class="invalid-feedback" style="display: block;">
			<strong>{{ $errors->first('image') }}</strong>
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
	<script src="{{ asset('js/library/image-upload.js') }}"></script>
	<script>
		$('#category_id').on('change', function(){
			var category_id = $('#category_id').val();
			
			if (category_id != '') {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});

				$.ajax({
					url:"/get-sub-category/"+category_id,  
					method:'GET',                               
					success: function( data ) {
						sections = '';
						$.each( data, function( key, value ) {
							sections += '<option value="' + value.id + '">' + value.name + '</option>';
						});
						sections += '';

						$( '#sub_category_id' ).html( sections );
					}
				}); 
			}
		});

	</script>
@endsection