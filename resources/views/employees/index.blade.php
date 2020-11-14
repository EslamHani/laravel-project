@extends('layouts.base')

@section('title', 'Employess')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"  href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css">
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				Employees
				<a href="{{ route('employees.create') }}" target="_self" class="btn btn-info">
					Create
				</a>
			</div>
			<div class="card-body">
				{!! $dataTable->table() !!}
			</div>
		</div>
	</div>
</div>
@endsection

@push('js')
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap4.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
@endpush