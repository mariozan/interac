@extends('layout')

@section('title', 'Adicionar Empleados')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <br>
        <ol class="breadcrumb">
            <li><a href="{{ url('/employee') }}">Lista de Empleadoss</a></li>
            <li class="active"> Adicionar Empleados </li>
        </ol>

        <h1 class="lead"> <i class="fa fa-plus"></i> Adicionar Empleados </h1>
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
        <form action="{{ url('employee/'.$employee->id) }}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="text" name="first_name" class="form-control" value="{{ $employee->first_name }}" placeholder="Nombre" required>
            </div>
            <div class="form-group">
                <input type="text" name="last_name" class="form-control" value="{{ $employee->last_name }}" placeholder="Apellidos" required>
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" class="form-control" value="{{ $employee->email }}" placeholder="Correo Electrónico" required>
                <span id="check" class="fa fa-2x form-control-feedback"> </span>
            </div>
            <div class="form-group">
                <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}" placeholder="Website" required>
            </div>

            <div class="form-group">
                <select name="company" class="form-control" required>
                    <option value="">Seleccione Compañia...</option>
                    @if(isset($companies))
                    @foreach($companies as $company)
                    <option value="{{$company->id}}" @if($employee->company == $company->id) selected  @endif >{{$company->name}}</option>
                    @endforeach
                    @endif
                </select>
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
