<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/caraguino.png')}}" />
    <title>QUIZ ST CFT | Registro</title>

    <link rel="stylesheet" href="{{ asset('css/formulario.css')}}">
</head>

<body>
    <div class="position">
        <!--Contenedor formulario-->
        <form class="container" action="{{route('register')}}" method="POST">
            @csrf
            <div class="centering-wrapper">
                <div class="section1 text-center">
                    <!--Titulo-->
                    <div class="primary-header">QUIZ ST CFT</div>
                    <div class="secondary-header">Registro</div>
                    <!--Inicio preguntas-->
                    <div class="input-position">
                        <!--Contenedor de pregunta-->
                        <div class="form-group">
                            <h5 class="input-placeholder" id="rut-txt">RUT<span class="error-message" id=""></span></h5>
                            <input type="text" required name="regrut" class="form-style" id="reg_rut" autocomplete="off" style="margin-bottom: 20px;" maxlength="13" onblur="handleBlur(this)">
                            <i class="input-icon uil uil-at"></i>
                        </div>

                        <div class="form-group">
                            <h5 class="input-placeholder" id="nombre-txt">Nombre<span class="error-message" id=""></span></h5>
                            <input type="text" required="true" name="name" class="form-style" id="reg_nombre" autocomplete="off" style="margin-bottom: 20px;" maxlength="43">
                            <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group">
                            <h5 class="input-placeholder" id="ap-txt">Apellido Paterno<span class="error-message" id=""></span></h5>
                            <input type="text" required="true" name="regap" class="form-style" id="reg_ap" autocomplete="off" style="margin-bottom: 20px;" maxlength="35">
                            <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group">
                            <h5 class="input-placeholder" id="am-txt">Apellido Materno<span class="error-message" id=""></span></h5>
                            <input type="text" required="true" name="regam" class="form-style" id="reg_am" autocomplete="off" style="margin-bottom: 20px;" maxlength="35">
                            <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group">
                            <h5 class="input-placeholder" id="email-txt">Correo Electrónico<span class="error-message" id="email-error"></span></h5>
                            <input type="email" required="true" name="email" class="form-style" id="reg_email" autocomplete="off" style="margin-bottom: 20px;" maxlength="200">
                            <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group">
                            <h5 class="input-placeholder" id="pword-txt">Contraseña<span class="error-message" id="password-error"></span></h5>
                            <input type="password" required="true" name="password" class="form-style" id="reg_pass" autocomplete="off" style="margin-bottom: 20px;" maxlength="200">
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <div class="form-group">
                            <h5 class="input-placeholder" id="pcword-txt">Confirmar contraseña<span class="error-message" id="password-error"></span></h5>
                            <input type="password" required="true" name="password_confirmation" class="form-style" id="reg_pass_conf" autocomplete="off" style="margin-bottom: 20px;" maxlength="200">
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        @if ($errors->any())
                        <ul>
                            @if ($errors->has('regrut'))
                            <li style="color: #FF5757;">{{ $errors->first('regrut') }}</li>
                            @endif
                            @if ($errors->has('name'))
                            <li style="color: #FF5757;">{{ $errors->first('name') }}</li>
                            @endif
                            @if ($errors->has('regap'))
                            <li style="color: #FF5757;">{{ $errors->first('regap') }}</li>
                            @endif
                            @if ($errors->has('regam'))
                            <li style="color: #FF5757;">{{ $errors->first('regam') }}</li>
                            @endif
                            @if ($errors->has('email'))
                            <li style="color: #FF5757;">{{ $errors->first('email') }}</li>
                            @endif
                            @if ($errors->has('password'))
                            <li style="color: #FF5757;">{{ $errors->first('password') }}</li>
                            @endif
                            @if ($errors->has('password_confirmation'))
                            <li style="color: #FF5757;">{{ $errors->first('password_confirmation') }}</li>
                            @endif
                        </ul>
                        @endif

                    </div>
                    <!--Boton-->
                    <div class="btn-position">
                        <button class="btn" type="submit" name="action">Registrarse
                        </button>
                    </div>
                    <!--Subtexto-->
                    <div class="down-text">¿Ya tienes cuenta? <a href="{{route('login')}}" class="link">Inicia sesión</a></div>
                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/registro.js')}}"></script>
</body>

</html>