@extends('layouts.app')

@section('css')
	<!-- Data Table CSS -->
	<link href="{{URL::asset('plugins/datatable/datatables.min.css')}}" rel="stylesheet" />
	<!-- Sweet Alert CSS -->
	<link href="{{URL::asset('plugins/sweetalert/sweetalert2.min.css')}}" rel="stylesheet" />
@endsection

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7 justify-content-center">
		<div class="page-leftheader text-center">
			<h4 class="page-title mb-0"> {{ __('Frontend Pages') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-globe mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('Frontend Management') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Frontend Pages') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection
@section('content')					
	<div class="row justify-content-center">
		<div class="col-lg-9 col-md-12 col-xm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Created Frontend Pages') }}</h3>
					<a href="{{ route('admin.settings.page.create') }}" id="createButton" class="btn btn-primary text-right right ripple">{{ __('Create New Page') }}</a>
				</div>
				<div class="card-body pt-2">
					<!-- SET DATATABLE -->
					<table id='pagesTable' class='table' width='100%'>
							<thead>
								<tr>
									<th width="20%">{{ __('Title') }}</th>
									<th width="10%">{{ __('Status') }}</th>	
									<th width="10%">{{ __('Updated At') }}</th>																			
									<th width="5%">{{ __('Actions') }}</th>
								</tr>
							</thead>
					</table> <!-- END SET DATATABLE -->
				</div>
			</div>
		</div>
	</div>	
@endsection

@section('js')
	<script src="{{URL::asset('plugins/datatable/datatables.min.js')}}"></script>
	<script src="{{URL::asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
	<script type="text/javascript">
		$(function () {

			"use strict";

			// INITILIZE DATATABLE
			var table = $('#pagesTable').DataTable({
				"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
				responsive: true,
				colReorder: true,
				"order": [[ 2, "desc" ]],
				language: {
					"emptyTable": "<div>{{ __('No Pages created yet') }}</div>",
					"info": "{{ __('Showing page') }} _PAGE_ {{ __('of') }} _PAGES_",
					search: "<i class='fa fa-search search-icon'></i>",
					lengthMenu: '_MENU_ ',
					paginate : {
						first    : '<i class="fa fa-angle-double-left"></i>',
						last     : '<i class="fa fa-angle-double-right"></i>',
						previous : '<i class="fa fa-angle-left"></i>',
						next     : '<i class="fa fa-angle-right"></i>'
					}
				},
				pagingType : 'full_numbers',
				processing: true,
				serverSide: true,
				ajax: "{{ route('admin.settings.page') }}",
				columns: [
					{
						data: 'title',
						name: 'title',
						orderable: true,
						searchable: true
					},			
					{
						data: 'custom-status',
						name: 'custom-status',
						orderable: true,
						searchable: true
					},			
					{
						data: 'custom-updated',
						name: 'custom-updated',
						orderable: true,
						searchable: true
					},								
					{
						data: 'actions',
						name: 'actions',
						orderable: false,
						searchable: false
					},
				]
			});

			
			// DELETE FAQ
			$(document).on('click', '.deletePageButton', function(e) {

				e.preventDefault();

				Swal.fire({
					title: '{{ __('Confirm Page Deletion') }}',
					text: '{{ __('It will permanently delete this Page') }}',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: '{{ __('Delete') }}',
					reverseButtons: true,
				}).then((result) => {
					if (result.isConfirmed) {
						var formData = new FormData();
						formData.append("id", $(this).attr('id'));
						$.ajax({
							headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
							method: 'post',
							url: 'page/delete',
							data: formData,
							processData: false,
							contentType: false,
							success: function (data) {
								if (data == 'success') {
									Swal.fire('{{ __('Page Deleted') }}', '{{ __('Page has been successfully deleted') }}', 'success');	
									$("#pagesTable").DataTable().ajax.reload();								
								} else {
									Swal.fire('{{ __('Delete Failed') }}', '{{ __('There was an error while deleting this Page') }}', 'error');
								}      
							},
							error: function(data) {
								Swal.fire('Oops...','Something went wrong!', 'error')
							}
						})
					} 
				})
			});

		});
	</script>
@endsection