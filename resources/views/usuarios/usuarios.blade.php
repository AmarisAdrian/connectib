@extends('layouts.app')
@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container">
    <div class="d-flex justify-content-between">
        <h4><i class="fa fa-list" aria-hidden="true"></i> Lista usuarios</h4>
        <button class="btn btn-primary"data-bs-toggle="modal" data-bs-target="#modal_crear_usuario"><i class="fa fa-user-plus" aria-hidden="true"></i> Registrar usuario </button>
    </div>
    <hr class="border border-primary">
    <form>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control border border-secondary" placeholder="Puede buscar por nombre cedula email o celular" aria-label="search" aria-describedby="Nombre">
                    <div class="input-group-append">
                    <button class="btn btn-primary text-light"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                    @if($flag)
                        <button href="#" class="btn btn-outline-warning" id="BtnVolver">Volver</button>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
    <div class="table-responsive">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-darl bg-light text-center">#</th>
                        <th class="text-darl bg-light text-center">Cedula</th>
                        <th class="text-darl bg-light text-center">Nombre</th>
                        <th class="text-darl bg-light text-center">Email</th>
                        <th class="text-darl bg-light text-center">Celular</th>
                        <th class="text-darl bg-light text-center">Fecha nacimiento</th>
                        <th class="text-darl bg-light text-center">Edad</th>
                        <th class="text-darl bg-light text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($data) > 0)
                        @foreach($data as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->cedula}}</td>
                            <td>{{$user->nombre}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->celular}}</td>
                            <td>{{$user->fecha_nacimiento}}</td>
                            <td>{{$user->edad}}</td>
                            <td>
                                <a data-url="" type="button" class="btn btn-danger text-light"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                <a data-url="" type="button" class="btn btn-success text-light"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @else 
                    <tr>
                        <td colspan="7">
                            <div class="col-md-12">
                                <div class="alert alert-danger">No hay datos de usuario </div>
                            </div>  
                        </td>
                    </tr>              
                    @endif
                </tbody>        
            </table>
            {{ $data->links() }}
        </div>
    </div>
    <!--MODAL CREAR USUARIO-->
    <div class="modal fade" id="modal_crear_usuario"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content" >
        <div class="modal-header bg-primary text-light">
            <h5 class="modal-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Crear usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" name="" class="" action="#">
            
            </form>
        </div>
     </div>
    </div>
    </div>
</div>
@endsection