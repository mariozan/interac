@extends('layout')

@section('title', 'Lista de Compañias')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <br>
        <h1 class="lead"> Lista de Compañias </h1>
        @if(session('status'))
        <div class="alert alert-success">
            <ul>
                <li> {!! session('status') !!} </li>
            </ul>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">
            <ul>
                <li> {!! session('error') !!} </li>
            </ul>
        </div>
        @endif
        <hr>
        <a class="btn btn-success" href="{{ url('company/create') }}">
            <i class="fa fa-plus"></i>
            Adicionar Compañia
        </a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $companie)
                <tr>
                    <td> {{ $companie->name }}</td>
                    <td> {{ $companie->email }}</td>
                    <td> {{ $companie->website }}</td>
                    <td> <img src=" {{ URL::asset('storage/'.$companie->logo) }} " width="100px"></td>

                    <td>
                        <a class="btn btn-info" href="{{ url('company/'.$companie->id.'/edit') }}">
                            Editar
                        </a>
                        <form action="{{ url('company/'.$companie->id) }}" method="POST" style="display: inline">
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
        </table>
    </div>
</div>
@endsection
