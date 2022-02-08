@extends('layout')

@section('title', 'Adicionar Compañia')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<br>
			<ol class="breadcrumb">
				<li><a href="{{ url('/company') }}">Lista de Compañias</a></li>
				<li class="active"> Adicionar Compañia </li>
			</ol>

			<h1 class="lead"> <i class="fa fa-plus"></i> Adicionar Compañia </h1>
			<hr>
			@if($errors->any())
				<div class="alert alert-danger">
					<ul>
					@foreach($errors->all() as $error)
						<li> {{ $error }}</li>
					@endforeach
					</ul>
				</div>
			@endif
			<form action="{{ url('company') }}" method="post" enctype="multipart/form-data">
				<div class="form-group">
					{{ csrf_field() }}
					<input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nombre" required>
				</div>
				<div class="form-group">
					<input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Correo Electrónico" required>
					<span id="check" class="fa fa-2x form-control-feedback"> </span>
				</div>
				<div class="form-group">
					<input type="text" name="website" class="form-control" value="{{ old('website') }}" placeholder="Website" required>
				</div>

				<div class="form-group" id="appUpload">
					<input type="file" class="" name="logo" id="upload" accept="image/*" required>

				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success btn-block">
						<i class="fa fa-save"></i> Guardar
					</button>
				</div>

			</form>
		</div>
	</div>
@endsection
