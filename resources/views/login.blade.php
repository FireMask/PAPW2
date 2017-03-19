<!DOCTYPE html>
<html lang="es-mx">
<head>
    <title>CRM - Iniciar Sesión</title>
    @include('layouts.headers')
</head>
<body class="hold-transition skin-purple sidebar-mini">
    <header class="main-header">
        <a href="/login" class="logo">
            <span class="logo-lg"><b>Programación</b>Web</span>
        </a>
        <nav id="nee" class="navbar navbar-static-top" role="navigation"></nav>
    </header>
    <div class="container col-md-12">
        <div class="content">
            <div class="login">
                <div class="box box-primary" id="loginbody">
                    <form action="/index" method="GET">
                        <div class="form-group">
                            <label for="email">Correo:</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Contraseña:</label>
                            <input type="password" class="form-control" id="pass">
                        </div>
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
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
