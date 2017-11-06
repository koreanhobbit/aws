	<div class="row">
		<div class="table-responsive">
			<table class="table table-condensed table-striped table-category">
				<thead>
					<tr>
						<th>No</th>
						<th>Name</th>			
						<th>Slug</th>
						<th>Count</th>
						<th class="col-sm-1">Edit</th>
						<th class="col-sm-1">Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach($cats as $key => $cat)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td><a class="categoryEditBtn" href="javascript:" data-id="{{ $cat->id }}" data-url="{{ route('category.edit', $cat->id) }}">{{ $cat->category }}</a></td>
							<td>{{ $cat->slug }}</td>
							<td>1</td>
							<td><button class="categoryEditBtn btn btn-info btn-sm" data-url="{{ route('category.edit', $cat->id) }}"><span><i class="fa fa-edit"></i></span></button></td>
							<td><button class="btn btn-danger btn-sm categoryDeleteBtn" data-url="{{ route('category.destroy', $cat->id) }}" onclick="confirm('Are you sure want to delete this?')"><span><i class="fa fa-trash-o"></i></span></button></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="row text-center">
		{{ $cats->links() }}
	</div>
