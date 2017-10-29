@extends('admin.master')

@section('title', '| Show Category')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h2 class="text-center">Category Details</h2>
			<div class="col-md-10 col-md-offset-1">
				<hr>
			</div>
			<table class="table table-striped">
				<tr>
					<th width="15%">ID</th>
					<td>{{ $category->id }}</td>
				</tr>
				<tr>
					<th width="15%">Name</th>
					<td>{{ $category->name }}</td>
				</tr>
				<tr>
					<th width="15%">Image</th>
					<td>{{ $category->image }}</td>
				</tr>
			</table>
			<table class="table text-right">
				<tr>
					<td>
						<div class="col-md-11 text-right">
							{!! Html::linkRoute('category.edit', 'Edit', array($category->id), array('class' => 'btn btn-primary')) !!}
						</div>
						<div class="col-md-1  text-right">
							{!! Html::linkRoute('category.index', 'Cancel', [$category->id], ['class' => 'btn btn-danger pull-right']) !!}
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>

@endsection