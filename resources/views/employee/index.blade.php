@extends('layout')

@section('title', 'Lista de Empleados')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <br>
        <h1 class="lead"> Lista de Empleados </h1>
        @if(session('status'))
        <div class="alert alert-success">
            <ul>
                <li> {!! session('status') !!} </li>
            </ul>
        </div>
        @endif
        <hr>
        <a class="btn btn-success" href="{{ url('employee/create') }}">
            <i class="fa fa-plus"></i>
            Adicionar Empleado
        </a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo Electrónico</th>
                    <th>Telefono</th>
                    <th>Compañia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td> {{ $employee->first_name }}</td>
                    <td> {{ $employee->last_name }}</td>
                    <td> {{ $employee->email }}</td>
                    <td> {{ $employee->phone }}</td>
                    <td> {{ $employee->nombre_empresa }}</td>

                    <td>
                        <a class="btn btn-info" href="{{ url('employee/'.$employee->id.'/edit') }}">
                            Editar
                        </a>
                        <form action="{{ url('employee/'.$employee->id) }}" method="POST" style="display: inline">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="button" class="btn btn-danger btn-delete">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="4" class="text-center">
                        {!! $employees->render() !!}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
