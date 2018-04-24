{{ csrf_field() }}

@if(!count($users))
	<div class="alert alert-info text-center">
		<h1>There Is No User Profile, Please Add One</h1>
	</div>
@else
	<div class="row">
		@component('admin.widgets.panel')
			@slot('panelTitle1', 'All Team Profiles')
		@endcomponent
	</div>

	<div class="row">
		@component('admin.widgets.panel')
			@slot('panelBody')
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							<table class="table table-condensed table-striped">
								<thead>
									<tr>
										<td class="col">No</td>
										<td class="col-sm-2">Image</td>
										<td class="col-sm-2">Name</td>
										<td class="col-sm-2">Job Title</td>
										<td class="col">Description</td>
										@can('super-admin')
											<td class="col">Edit</td>
											<td class="col">Delete</td>
										@endcan
									</tr>
								</thead>
								<tbody>
									@foreach($users as $key => $teamprofile)	
										<tr>
											<td>{{ $users->firstItem() + $key }}</td>
											<td>
												<div class="thumbnail">
													<img src="{{ url($teamprofile->images()->firstOrFail()->thumbnail->location) }}" alt="">
												</div>
											</td>
											<td>{{ ucfirst($teamprofile->name) }}</td>
											<td>{{ $teamprofile->job_title }}</td>
											<td>{{ ucfirst(strip_tags($teamprofile->teamprofile->description)) }}</td>
											@can('super-admin')
												<td>
													<a href="javascript:" class="editBtn" data-url="{{ route('teamprofile.edit', ['tp' => $teamprofile->id]) }}" data-urlupdate="{{ route('teamprofile.update', ['tp' => $teamprofile->id]) }}">
														<span class="btn btn-info btn-sm">
															<i class="fa fa-edit"></i>
														</span>
													</a>
												</td>
												<td>
													<a href="javascript:" class="deleteBtn" data-url="{{ route('teamprofile.destroy', ['tp' => $teamprofile->id]) }}">
														<span class="btn btn-danger btn-sm">
															<i class="fa fa-trash-o"></i>
														</span>
													</a>
												</td>
											@endcan
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row text-center">
					{{ $users->withPath('teamprofile') }}
				</div>
			@endslot
		@endcomponent
	</div>
@endif

@can('super-admin')
	<div class="row">
		<button class="btn btn-primary pull-right" id="addTeamMember" data-urlcreate="{{ route('teamprofile.create') }}" data-urlstore="{{ route('teamprofile.store') }}" style="margin-right: 20px; margin-bottom: 50px;">
			Add Team Member
		</button>
	</div>
@endcan