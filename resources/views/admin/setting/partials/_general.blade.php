@if(session()->has('message'))	
	<div class="row alert alert-success message">
		<h4>{{ session()->get('message') }}</h4>
	</div>
@endif
	<div class="row message">
		<h4></h4>
	</div>
<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-striped">
				<tr>
					<th scope="col" class="col-sm-3">Site Title</td>
					<td class="col-sm-6"><input type="text" id="site_title" name="site_title" class="form-control" placeholder="Site title" required @if(count($setting)) value="{{ $setting->first()->site_title }}" @endif></td>
					<td></td>
				</tr>
				<tr>
					<th scope="col" class="col-sm-3">Tagline</td>
					<td class="col-sm-6"><input type="text" id="tagline" name="tagline" class="form-control" placeholder="Tagline of the website" required @if(count($setting)) value="{{ $setting->first()->tagline }}" @endif></td>
					<td></td>
				</tr>
				<tr>
					<th scope="col" class="col-sm-3">Site Logo</th>
					<td class="col-sm-6">
						<div class="thumbnail">
							<a href="javascript:" data-toggle="modal" data-target="#logoModal" class="logoImgBtn" data-urllogo="{{ route('setting.logo') }}" data-urlicon="{{ route('setting.icon') }}">
								<img @if(count($setting->first()->images->where('pivot.is_maskot', '=', 1)->first())) src="{{ url($setting->first()->images->where('pivot.is_maskot', '=', 1)->first()->thumbnail->location) }}" @else src="{{ url($images->where('id', '=', 1)->first()->thumbnail->location) }}" @endif alt="" class="img-thumbnail img-responsive">
							</a>
						</div>
					</td>
					<td></td>
					<input type="hidden" name="logo" id="logoinput" @if(count($setting->first()->images->where('pivot.is_maskot', '=', 1)->first())) value="{{ $setting->first()->images->where('pivot.is_maskot', '=', 1)->first()->id }}" @else value="{{ $images->where('id', '=', 1)->first()->id }}" @endif>
				</tr>
				<tr>
					<th scope="col" class="col-sm-3">Site Icon</th>
					<td class="col-sm-6">
						<div class="thumbnail">
							<a href="javascript:" data-toggle="modal" data-target="#iconModal" class="iconImgBtn" data-urllogo="{{ route('setting.logo') }}" data-urlicon="{{ route('setting.icon') }}">
								<img @if(count($setting->first()->images->where('pivot.is_maskot', '=', 0)->first())) src="{{ url($setting->first()->images->where('pivot.is_maskot', '=', 0)->first()->thumbnail->location) }}" @else src="{{ url($images->where('id', '=', 1)->first()->thumbnail->location) }}" @endif alt="" class="img-thumbnail img-responsive">
							</a>
						</div>
					</td>
					<td></td>
					<input type="hidden" name="icon" id="iconinput" @if(count($setting->first()->images->where('pivot.is_maskot', '=', 0)->first())) value="{{ $setting->first()->images->where('pivot.is_maskot', '=', 0)->first()->id }}" @else value="{{ $images->where('id', '=', 1)->first()->id }}" @endif> 
				</tr>
				
				@foreach($setting->first()->websitesocialmedias as $socmed)
					<tr>
						<th scope="col" class="col-sm-3">{{ ucfirst($socmed->name) }} Link</th>
						<td class="col-sm-6 websitesocialmedias_container">
							<input type="text" id="{{ $socmed->name }}" name="{{ $socmed->name }}" class="form-control" value="{{ $socmed->link }}" data-name="{{ $socmed->slug }}">
						</td>
						<td></td>
					</tr>
				@endforeach
				
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="pull-right">
			<a href="javascript:" class="saveBtn" data-url="{{ route('setting.update', $setting->first()->id) }}" data-urlindex="{{ route('setting.index') }}">
				<button class="btn btn-primary">
					Save
				</button>
			</a>
		</div>
	</div>
</div>