<div class="modal fade @if(isset($modalClass)) {{ $modalClass }} @endif" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			@if(isset($modalTitle))
				<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        		<h4 class="modal-title">{{ $modalTitle }}</h4>
	      		</div>
	      	@endif
	      	@if (isset($modalBody))
	      		<div class="modal-body">
	        		{{ $modalBody }}
	      		</div>
      		@endif
      		@if (isset($modalFooter))
	      		<div class="modal-footer">
	        		{{ $modalFooter }}
	      		</div>
      		@endif
		</div>
	</div>
</div>