@extends('layouts.app')
@section('content')
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
                                <a data-url="{{route('usuario.deleteUser',$user->id)}}" type="button" class="btn btn_eliminar_usuario btn-danger text-light"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                <a data-url="{{route('usuario.getUser',$user->id)}}" type="button" class="btn btn-success text-light btn_modal_actualizar_usuario" data-bs-toggle="modal" data-bs-target="#modal_actualizar_usuario" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
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
            <div class="d-flex justify-content-between">
                {{ $data->links() }}
                <form class="d-flex align-items-end">
                 <input name="paginacion" class="form-control-sm mb-3 " type="number" @if(isset($_GET["paginacion"]) && !is_null($_GET["paginacion"])) value="{{$_GET["paginacion"]}}" @else value="10" @endif>
                </form>
            </div>
        </div>
    </div>
    <!--MODAL CREAR USUARIO-->
    <div class="modal fade" id="modal_crear_usuario"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
        <div class="modal-header bg-primary text-light">
            <h5 class="modal-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Crear usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('usuario.addUser')}}">
              <div class="row">
                {{csrf_field()}}
                 <div class="mb-3">
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" class="form-control border border-input" id="email" name="email" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="password">Contraseña *</label>
                        <input type="password" class="form-control border border-input" id="password" name="password" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="password_repeat">Repetir contraseña *</label>
                        <input type="password" class="form-control border border-input" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="nombre">Nombre completo *</label>
                        <input type="text" class="form-control border border-input" id="nombre" name="nombre" required>
                    </div>
                </div>
                 <div class="mb-3">
                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input type="number" class="form-control border border-input" id="celular" name="celular">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="cedula">cedula*</label>
                        <input type="number" class="form-control border border-input" id="cedula" name="cedula" required>
                    </div>
                </div>   
                <div class="mb-3">
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha nacimiento *</label>
                        <input type="date" class="form-control border border-input" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="pais">Pais *</label>
                        <select id="pais" name="pais" data-i="" data-url="{{url('/')}}/getState/" class="pais form-control border border-input">
                            <option value="">-- Seleccionar --</option>
                            @foreach($pais as $paises)
                                <option value="{{ $paises->id }}">{{ $paises->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="departamento">Departamento *</label>
                        <select id="departamento" name="departamento"  data-url="{{url('/')}}/getCity/" class="departamento form-control border border-input text-lowercase">
                            <option value="">-- Seleccionar --</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="codigo_ciudad">Ciudad *</label>
                        <select id="codigo_ciudad" name="codigo_ciudad" class="codigo_ciudad form-control border border-input text-lowercase">
                            <option value="">-- Seleccionar --</option>

                        </select>
                    </div>
                </div>
                    <br><br>
                    <div class="form-group m-0">
                        <button class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar usuario</button>
                    </div>
                </div>
            </form>
        </div>
     </div>
    </div>
    </div>
    <!--MODAL ACTUALIZAR USUARIO-->
    <div class="modal fade" id="modal_actualizar_usuario"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" >
            <div class="modal-header bg-primary text-light">
                <h5 class="modal-title"><i class="fa fa-refresh" aria-hidden="true"></i>
                    Actualizar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body body_actualizar_usuario"></div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/usuario.js')}}"></script>

@endsection