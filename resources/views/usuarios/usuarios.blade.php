@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <h4><i class="fa fa-list" aria-hidden="true"></i> Lista usuarios</h4>
        <button class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i> Registrar usuario </button>
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
                    {{-- @if($flag)
                        <button href="#" class="btn btn-outline-warning" id="BtnVolver">Volver</button>
                    @endif --}}
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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection