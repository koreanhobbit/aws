@extends('admin.layouts.dashboard')

@section('page_heading', 'Products')
@section('section')
@if(!count($products))
	<h1 class="alert alert-info text-center">
		There is no product. Add one please!
	</h1>
@else
	@if(session()->has('message'))
		<div class="alert alert-info">
			<h4>
				{{ session()->get('message') }}
			</h4>
		</div>
	@endif
	@component('admin.widgets.panel')
		@slot('panelTitle1', 'Products List')
		@slot('panelBody')
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table class="table table-condensed table-striped">
							<thead>
								<tr>
									<td class="col-sm-2 text-center">
										Image
									</td>
									<td class="col-sm-3 text-center">
										Product Name
									</td>
									<td class="col-sm-2 text-center">
										Price
									</td>
									<td class="col-sm-5 text-center">
										Description
									</td>
									<td class="col-sm-1 text-center">
										Publish
									</td>
									<td class="col text-center">
										Edit
									</td>
									<td class="text-center col">
										Delete
									</td>
								</tr>
							</thead>
							<tbody>
								@foreach($products as $product)
									<tr>
										<td class="text-center">
											@foreach($product->images as $image)
												@if($image->pivot->is_maskot == 1)
													<div class="thumbnail">
														<img src="{{ asset($image->thumbnail->location) }}" title="{{ $image->name }}" class="img-responsive thumbnail-img">
													</div>
												@endif
											@endforeach
										</td>
										<td class="text-center">
											{{ $product->name }}
										</td>
										<td class="text-center">
											{{ $product->price }}
										</td>
										<td class="text-center">
											{{ strip_tags($product->description) }}
										</td>
										<td class="text-center">
											<form action="{{ route('product.publish', ['product' => $product->id]) }}" method="POST" class="form_publish">
											{{ csrf_field() }}
											{{ method_field('PUT') }}
												<div class="checkbox">
													<label for="checkbox_product">
														<input onChange="this.form.submit()" type="checkbox" name="checkbox_product" class="checkbox_product" {{ $product->is_published == 1 ? 'checked' : '' }}>
													</label>
												</div>
											</form>
										</td>
										<td class="text-center">
											<form action="{{ route('product.edit', ['product' => $product->id]) }}" method="GET">
												{{ csrf_field() }}
												<button type="submit" name="editBtn" class="btn btn-info editBtn">
														<i class="fa fa-edit"></i>
												</button>
											</form>
										</td>
										<td class="text-center">
											<form action="{{ route('product.destroy', ['product' => $product->id]) }}" method="POST">
												{{ method_field('DELETE') }}
												{{ csrf_field() }}
												<button type="submit" onclick="return confirm('Are you sure want to delete the product?')" name="deleteBtn" class="btn btn-danger deleteBtn">
														<i class="fa fa-trash-o"></i>
												</button>
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col text-center">
					<span>
						{{ $products->links() }}
					</span>
				</div>
			</div>
		@endslot
	@endcomponent
@endif
@endsection
@section('script')
	@include('admin.product.partials._script_index')
@endsection



