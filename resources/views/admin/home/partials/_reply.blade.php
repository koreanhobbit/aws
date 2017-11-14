<div class="row">
	<div class="col-sm-12">
		@if ($rp->status == 0)
			<div class="alert alert-warning text-center"><h4>Message Is Not Yet Responded</h4></div>
		@else
			<div class="alert alert-info text-center"><h4>Message Was Responded</h4></div>
		@endif
		<div class="table-responsive">
			<table class="table table-striped">
				<tr>
					<td class="col-sm-2"><h4>From</h4></td>
					<td><h4>:</h4></td>
					<td class="col-sm-10"><h4>{{ ucfirst($rp->name) }}</h4></td>
				</tr>
				<tr>
					<td class="col-sm-2"><h4>Email</h4></td>
					<td><h4>:</h4></td>
					<td class="col-sm-10"><h4>{{ ucfirst($rp->email) }}</h4></td>
				</tr>
				<tr>
					<td class="col-sm-2"><h4>Phone</h4></td>
					<td><h4>:</h4></td>
					<td class="col-sm-10"><h4>{{ ucfirst($rp->phone) }}</h4></td>
				</tr>
				<tr>
					<td class="col-sm-2"><h4>Message</h4></td>
					<td><h4>:</h4></td>
					<td class="col-sm-10"><h4>{{ ucfirst($rp->message) }}</h4></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="text-center">
			<a href="javascript:" class="dashboardBtn" data-url="{{ route('dashboard.index') }}"><button class="btn btn-warning form-control">Go Back To Dashboard</button></a>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="text-center">
			<a href="javascript:" class="message_details" data-url="{{ route('dashboard.messages') }}"><button class="btn btn-info form-control">View All Messages</button></a>
		</div>
	</div>
</div>
<br>
@can('super-admin')
	<div class="row">
		<div class="col-sm-offset-3 col-sm-6">
			<form action="{{ route('dashboard.delete', ['cr' => $rp->id]) }}" method='post'>
				{{ csrf_field() }}
				{{ method_field("DELETE") }}
				<a href="javascript:" class="" onclick="confirm('Are you sure want to delete this message?')"><button class="btn btn-primary form-control">Delete</button></a>
			</form>
		</div>
	</div>
@endcan
@if ($rp->status == 0)
	<br>
	<hr>
	<div class="row">
		<div class="col-sm-12">
			<h4>Response Message</h4>
			<hr>
			<div class="form-group">
				<label for="reply_text">Reply Message</label>
				<textarea id="reply_text" name="reply_text"></textarea>
			</div>
			
			<div class="pull-right">
				<a href="javascript:" class="responseBtn" data-url="{{ route('dashboard.update', ['rp' => $rp->id]) }}"><button class="btn btn-primary">Send</button></a>
			</div>
		</div>
	</div>
@else
	<br>
	<hr>
	<div class="row">
		<div class="col-sm-12">
			<div class="table-responsive">
				<table class="table table-striped">
					<tr>
						<td class="col-sm-2">Sent At</td>
						<td>:
						</td>
						<td class="col-sm-10">{{ $rp->updated_at }}</td>
					</tr>
					<tr>
						<td>Response</td>
						<td>:</td>
						<td>{{ $rp->response }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
@endif
