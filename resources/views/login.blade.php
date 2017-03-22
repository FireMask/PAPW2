<!DOCTYPE html>
<html lang="es-mx">
<head>
    <title>CRM - Iniciar Sesión</title>
    @include('layouts.headers')
</head>
<body class="hold-transition skin-purple sidebar-mini">
    <img id="bgLogin" src="img/background2.jpg"></img>
    <header class="main-header">
        <a href="/login" class="logo">
            <span class="logo-lg"><b>Programación</b>Web</span>
        </a>
        <nav id="nee" class="navbar navbar-static-top" role="navigation"></nav>
    </header>
    <div class="container col-md-12">
        <div class="content">
            <div class="login">
                <div class="login-logo">
                    <b>CRM</b>Lite
                </div>
                <div class="box box-primary" id="loginbody">
                    <form action="/login" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <p id="idplogin" >Inicia Sesión</p>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control input-lg" id="email" name="email" placeholder="Correo">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control input-lg" id="pwd" name="pass" placeholder="Contraseña">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-flat btn-lg">Iniciar Sesión</button>
                        </div>
                        <div class="form-group">
                            <label class="helpbuttons"><a><i class="fa fa-question-circle" aria-hidden="true"></i> Olvidé mi contraseña</a></label>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="container-fluid text-center bg-lightgray">
        <div class="copyrights">
            <p>Andres Lira @ 2017, All Rights Reserved
            <br>
            <span>Web Design By: Andres Lira - David Reyes</span></p>
        </div>
    </footer>
</body>

</html>
