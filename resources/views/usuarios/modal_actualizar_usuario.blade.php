<form method="post" action="{{route('usuario.updateUser')}}">
    <div class="row">
      {{csrf_field()}}
       <div class="mb-3">
          <div class="form-group">
              <label for="email">Email</label>
              <input type="email" value="{{$user->email}}" class="form-control border border-input" id="email" name="email" disabled>
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
              <input type="text" value="{{$user->nombre}}" class="form-control border border-input" id="nombre" name="nombre" required>
          </div>
      </div>
       <div class="mb-3">
          <div class="form-group">
              <label for="celular">Celular</label>
              <input type="number" value="{{$user->celular}}"  class="form-control border border-input" id="celular" name="celular">
          </div>
      </div>
      <div class="mb-3">
          <div class="form-group">
              <label for="cedula">cedula</label>
              <input type="number" value="{{$user->cedula}}" class="form-control border border-input" disabled>
          </div>
      </div>   
      <div class="mb-3">
          <div class="form-group">
              <label for="fecha_nacimiento">Fecha nacimiento *</label>
              <input type="date" value="{{$user->fecha_nacimiento}}" class="form-control border border-input" id="fecha_nacimiento" name="fecha_nacimiento" required>
          </div>
      </div>
      <div class="mb-3">
          <div class="form-group">
              <label for="pais">Pais *</label>
              <select id="pais" name="pais" data-url="{{url('/')}}/getState/" class="pais form-control border border-input">
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
              <label for="ciudad">Ciudad *</label>
              <select id="codigo_ciudad" name="codigo_ciudad" class="codigo_ciudad form-control border border-input text-lowercase">
                  <option value="">-- Seleccionar --</option>

              </select>
          </div>
      </div>
          <br><br>
          <div class="form-group m-0">
              <button class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar</button>
              <input type="hidden" value="{{$user->id}}" class="d-none" id="id" name="id">
          </div>
      </div>
  </form>