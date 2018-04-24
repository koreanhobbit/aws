{{ csrf_field() }}
	
	<div class="row">
		@component('admin.widgets.panel')
			@slot('panelTitle1', 'Add Team Profile')
		@endcomponent
	</div>
	
	<div class="row">
		@component('admin.widgets.panel')
			@slot('panelBody')
				<div class="row">
					<div class="col-md-4">
						<div class="row">
							@component('admin.widgets.panel')
								@slot('panelBody')
								<div class="col-sm-12">
									<div class="thumbnail">
										<a href="javascript:" id="teamprofileImage" data-toggle="modal" data-target="#teamprofileModal" data-urlreload="{{ route('teamprofile.reload') }}">
											<img class="img-responsive" src="{{ url($profileImages->where('id', '=', 1)->first()->thumbnail->location) }}" alt="" data-imageid="1">

											<div class="add-img"><i class="fa fa-plus fa-5x"></i></div>
										</a>
									</div>
								</div>
								@endslot
							@endcomponent
						</div>
						<div class="row">
							@component('admin.widgets.panel')
								@slot('panelTitle1', "Description")
								@slot('panelBody')
									<div class="form-group">
										<label for="teamprofileName">Name</label>
										<input type="text" name="teamprofileName" id="teamprofileName" placeholder="Profile Name" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="teamprofileBirthday">Birthday</label>
										<div class="row" id="teamprofileBirthday">
											<div class="col-xs-4" >
												<select name="month" id="month" class="form-control" required>
													<option value="" selected>Month</option>
													<option value="01">January</option>
													<option value="02">February</option>
													<option value="03">March</option>
													<option value="04">April</option>
													<option value="05">May</option>
													<option value="06">June</option>
													<option value="07">July</option>
													<option value="08">August</option>
													<option value="09">September</option>
													<option value="10">October</option>
													<option value="11">November</option>
													<option value="12">December</option>
												</select>
											</div>
											<div class="col-xs-4">
												<input type="text" name="date" id="date" class="form-control" placeholder="Date" required>
											</div>
											<div class="col-xs-4">
												<input type="text" name="year" id="year" class="form-control" placeholder="Year" required>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="teamprofileEmail">Email</label>
										<input type="text" name="teamprofileEmail" id="teamprofileEmail" class="form-control" required placeholder="Email Address">
									</div>
									<div class="form-group">
										<label for="teamprofileJobTitle">Job Title</label>
										<input type="text" name="teamprofileJobTitle" id="teamprofileJobTitle" class="form-control" required placeholder="Job Title">
									</div>
									<div class="form-group">
										<label for="teamprofileUserRole">User Role</label>
										<select name="teamprofileUserRole" id="teamprofileUserRole" class="form-control" required>
												<option value="" selected>User Role</option>
												@foreach($roles as $role)
													<option value="{{ $role->id }}">{{ $role->name }}</option>
												@endforeach
										</select>
									</div>
									<div class="form-group">
										<label for="teamprofileUserStatus">User Status</label>
										<select name="teamprofileUserStatus" id="teamprofileUserStatus" class="form-control" required>
											<option value="0">Not Activated</option>
											<option value="1">Activated</option>
										</select>
									</div>
								@endslot
							@endcomponent
						</div>
					</div>
					<div class="col-md-8">
						<div class="row">
							@component('admin.widgets.panel')
								@slot('panelTitle1', 'Additional Information')
								@slot('panelBody')
									<div class="form-group">
										<label for="teamprofileLocation">Location</label>
										<input type="text" name="teamprofileLocation" id="teamprofileLocation" class="form-control" placeholder="Location" required>
									</div>
									<div class="form-group">
										<label for="teamprofileDescription">Description</label>
										<textarea name="teamprofileDescription" id="teamprofileDescription" class="form-control" placeholder="Description"></textarea>
									</div>
									<div>
										@foreach($socialMedias as $socmed)
											<div class="form-group teamprofileSocialMedias">
												<label for="{{ $socmed->name }}">{{ ucfirst($socmed->name) }}</label>
												<input type="text" name="{{ $socmed->name }}" id="{{ $socmed->name }}" class="form-control" placeholder="{{ $socmed->link }}" data-name="{{ $socmed->name }}" value="">
											</div>
										@endforeach
									</div>
								@endslot
							@endcomponent
						</div>
						<div class="row">
							@component('admin.widgets.panel')
								@slot('panelTitle1', 'Attributes')
								@slot('panelBody')
									@foreach($attributes as $index => $attribute)
										@if($index % 2 != 1)
											<div class="row">
										@endif
										<div class="col-sm-6">
											<div class="form-group teamprofileAttributes">
												<label for="{{$attribute->name}}">{{$attribute->name}}</label>
												<input type="text" name="{{$attribute->name}}" id="{{$attribute->name}}" class="form-control" placeholder="Value of {{$attribute->name}} Skill" data-name="{{ $attribute->name }}">
											</div>
										</div>
										@if($index % 2 == 1)
											</div>
										@endif
									@endforeach
								@endslot
							@endcomponent
						</div>
					</div>
				</div>
				<div class="row">
					<div class="pull-right">
						<a href="javascript:">
							<button class="btn btn-primary btn-sm pull-right addProfileBtn" style="margin-right:20px;">
							Add Profile
							</button>
						</a>
						<a href="{{route('teamprofile.index')}}">
							<button class="btn btn-default btn-sm pull-right" style="margin-right:20px;">
								Cancel
							</button>
						</a>
					</div>
				</div>
			@endslot
		@endcomponent
	</div>
	{{-- modal for images --}}
	@include('admin.teamprofile.partials._modal')