<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   @include('components.ui.head')

   <link rel="stylesheet" href="{{ asset('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
</head>

<body class="login-page">
   <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Gestor de inventario</b></a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
         <div class="card-body login-card-body">
            <p class="login-box-msg">Autenticación de acceso</p>
      
            <form action="{{ route('authenticate') }}" method="POST">
               @csrf
               @method('POST')

               <div class='form-group'>
                  <div class="input-group">
                     <input
                        type="email"
                        class="form-control @if($errors->has('email')) is-invalid @endif"
                        placeholder="Correo electrónico"
                        name="email"
                        value="{{ old('email', '') }}"
                     >
   
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-envelope"></span>
                        </div>
                     </div>
                  </div>
   
                  @error('email')
                     <span class="error invalid-feedback d-block">{{ $message }}</span>
                  @enderror
               </div>

               <div class='form-group'>
                  <div class="input-group">
                     <input
                        type="password"
                        class="form-control @if($errors->has('password')) is-invalid @endif"
                        placeholder="Contraseña"
                        name="password"
                     >
   
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                  </div>
   
                  @error('password')
                     <span class="error invalid-feedback d-block">{{ $message }}</span>
                  @enderror
               </div>

               <div class="row">
                  <div class="col-7">
                     <div class="icheck-primary">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">
                        Recuérdame
                        </label>
                     </div>
                  </div>
                  <!-- /.col -->
                  <div class="col">
                     <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                  </div>
                  <!-- /.col -->
               </div>
            </form>
      
            <p class="mb-1">
               <a href="#">Olvidé mi contraseña</a>
            </p>
         </div>
      <!-- /.login-card-body -->
      </div>
   </div>

   @include('components.ui.scripts')
</body>
</html>