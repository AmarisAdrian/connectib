@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card border border-info bg-light">
        <div class="card-body ">
        <h4><i class="fa fa-address-card" aria-hidden="true"></i> Mis datos</h4>
        <hr class="border border-primary">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="cedula">Cedula</label>
                <input type="text" class="form-control form-control-lg border border-info" id="cedula" name="cedula" value="{{Auth::user()->cedula}}" readonly>
        </div>
        <div class="col-md-6 mb-3">
                <label for="email">Nombre</label>
                <input type="text" class="form-control form-control-lg border border-info " id="nombre" name="nombre" value="{{Auth::user()->nombre}}" readonly>
        </div>
        <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control form-control-lg border border-info" id="email" name="email"  value="{{Auth::user()->email}}"  readonly>
        </div>
        <div class="col-md-6 mb-3">
                <label for="celular">Celular</label>
                <input type="number" class="form-control form-control-lg border border-info" id="celular" name="celular"  value="{{Auth::user()->celular}}"  readonly>
        </div>
        <div class="col-md-6 mb-3">
                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" class="form-control form-control-lg border border-info" id="fecha_nacimiento"  value="{{Auth::user()->fecha_nacimiento}}"  name="fecha_nacimiento" readonly>
        </div>
    </div>
</div>
</div>
</div>

@endsection
