{{ csrf_field() }}
	<div class="row">
		@component('admin.widgets.panel')
			@slot('panelTitle1', 'Edit Team Profile')
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
											<img class="img-responsive" src="{{ url($tp->images()->firstOrFail()->thumbnail->location) }}" alt="" data-imageid="{{ $tp->images()->firstOrFail()->id }}">
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
										<input type="text" name="teamprofileName" id="teamprofileName" placeholder="Profile Name" class="form-control" required value="{{ $tp->name }}">
									</div>
									<div class="form-group">
										<label for="teamprofileBirthday">Birthday</label>
										<div class="row" id="teamprofileBirthday">
											<div class="col-xs-4" >
												<select name="month" id="month" class="form-control" required>
													<option value="">Month</option>
													<option value="01" @if($tp->teamprofile->month == 1) selected @endif>January</option>
													<option value="02" @if($tp->teamprofile->month == 2) selected @endif>February</option>
													<option value="03" @if($tp->teamprofile->month == 3) selected @endif>March</option>
													<option value="04" @if($tp->teamprofile->month == 4) selected @endif>April</option>
													<option value="05" @if($tp->teamprofile->month == 5) selected @endif>May</option>
													<option value="06" @if($tp->teamprofile->month == 6) selected @endif>June</option>
													<option value="07" @if($tp->teamprofile->month == 7) selected @endif>July</option>
													<option value="08" @if($tp->teamprofile->month == 8) selected @endif>August</option>
													<option value="09" @if($tp->teamprofile->month == 9) selected @endif>September</option>
													<option value="10" @if($tp->teamprofile->month == 10) selected @endif>October</option>
													<option value="11" @if($tp->teamprofile->month == 11) selected @endif>November</option>
													<option value="12" @if($tp->teamprofile->month == 12) selected @endif>December</option>
												</select>
											</div>
											<div class="col-xs-4">
												<input type="text" name="date" id="date" class="form-control" placeholder="Date" required value="{{ $tp->teamprofile->date }}">
											</div>
											<div class="col-xs-4">
												<input type="text" name="year" id="year" class="form-control" placeholder="Year" required value="{{ $tp->teamprofile->year }}">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="teamprofileEmail">Email</label>
										<input type="text" name="teamprofileEmail" id="teamprofileEmail" class="form-control" required placeholder="Email Address" value="{{ $tp->email }}">
									</div>
									<div class="form-group">
										<label for="teamprofileJobTitle">Job Title</label>
										<input type="text" name="teamprofileJobTitle" id="teamprofileJobTitle" class="form-control" required placeholder="Job Title" value="{{ $tp->job_title }}">
									</div>
									<div class="form-group">
										<label for="teamprofileUserRole">User Role</label>
										<select name="teamprofileUserRole" id="teamprofileUserRole" class="form-control" required>
											<option value="">User Role</option>
											@foreach($roles as $role)
												<option value="{{ $role->id }}"
													@foreach($tp->roles as $item) 
														@if($role->id == $item->id) 
															selected 
														@endif
														{{$item->id}}
													@endforeach
												> 
													{{ $role->name }} 
												</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<label for="teamprofileUserStatus">User Status</label>
										<select name="teamprofileUserStatus" id="teamprofileUserStatus" class="form-control">
											<option value="0" @if($tp->user_status == 0) selected @endif>Not Activated</option>
											<option value="1" @if($tp->user_status == 1) selected @endif>Activated</option>
										</select>
									</div>
								@endslot
							@endcomponent
						</div>
						<div class="row">
							@component('admin.widgets.panel')
								@slot('panelTitle1', 'Password')
								@slot('panelBody')
									<div class="row changePasswordContainer hidden">
										<div class="col-sm-12">
											<div class="form-group">
												<label for="teamprofileCurrentPassword">Current Password</label>
												<input type="password" id="teamprofileCurrentPassword" name="teamprofileCurrentPassword" value="" class="form-control">
											</div>
											<div class="form-group">
												<label for="teamprofileNewPassword">New Password</label>
												<input type="password" id="teamprofileNewPassword" name="teamprofileNewPassword" value="" class="form-control">
											</div>
											<div class="form-group">
												<label for="teamprofileConfirmPassword">Confirm Password</label>
												<input type="password" id="teamprofileConfirmPassword" name="teamprofileConfirmPassword" value="" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<button class="btn btn-primary" id="changePassBtn">Change Password</button>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<button class="btn btn-primary hidden" id="cancelchangePassBtn">Cancel Change</button>
										</div>
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
										<input type="text" name="teamprofileLocation" id="teamprofileLocation" class="form-control" placeholder="Location" required value="{{ $tp->teamprofile->location }}">
									</div>
									<div class="form-group">
										<label for="teamprofileDescription">Description</label>
										<textarea name="teamprofileDescription" id="teamprofileDescription" class="form-control" placeholder="Description" required>{{ $tp->teamprofile->description }}</textarea>
									</div>
									<div>
										@foreach($socialMedias as $socmed)
											<div class="form-group teamprofileSocialMedias">
												<label for="{{ $socmed->name }}">{{ ucfirst($socmed->name) }}</label>
												<input type="text" name="{{ $socmed->name }}" id="{{ $socmed->name }}" class="form-control" placeholder="{{ $socmed->link }}" data-name="{{ $socmed->name }}" @foreach($tp->profilesocialmedias as $sm) @if($socmed->name == $sm->name) value="{{ $sm->pivot->link }}" @break  @endif @endforeach>
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
												<label for="attribute{{$attribute->name}}">{{$attribute->name}}</label>
												<input type="text" name="attribute{{$attribute->name}}" id="attribute{{$attribute->name}}" class="form-control" placeholder="Value of {{$attribute->name}} Skill" data-name="{{ $attribute->name }}" @foreach($tp->profileattributes as $pa) @if($attribute->name == $pa->name) value="{{ $pa->pivot->value }}" @break @endif @endforeach>
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
							<button class="btn btn-primary btn-sm pull-right editProfileBtn" style="margin-right:20px;">
							Edit Profile
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