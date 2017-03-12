<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CRM - Iniciar Sesión</title>

    <link rel="stylesheet" href="js/dist/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="js/dist/Font-Awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
          <div class="brand">
              LOGO
          </div>
      </div>
    </nav>
    <br>
    <br>
    <div class="content col-md-6 col-md-offset-3">
        <div class="login centered vertical-center" id="loginbody">
            <div>
                <div class="space-small-login"></div>
                <div class="login_wrapper">
                    <div Class="animate form login_form">
                        <section Class="login_content">
                            <div class="form">
                                <form action="/login" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input autocomplete="false" name="hidden" type="text" style="display:none;">
                                    <br>
                                    <div class="form-group">
                                        <label for="correo">Correo:</label>
                                        <input type="text" class="form-control input-lg" id="correo" name="mail" placeholder="Correo"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">Correo:</label>
                                        <input type="password" class="form-control input-lg" id="pass" name="pass" placeholder="Contraseña"/>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-default btn-success btn-block form-group input-lg">
                                            Iniciar Sesión
                                        </button>
                                    </div>
                                    <div Class="col-xs-12">
                                        <br/>
                                    </div>
                                    <div Class="clearfix"></div>
                                    <div Class="separator">
                                    <div Class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="container-fluid text-center bg-lightgray">
        <div class="copyrights" style="margin: 25px 0;">
            <p>Andres Lira @ 2017, All Rights Reserved
            <br>
            <span>Web Design By: Andres Lira - David Reyes</span></p>
        </div>
    </footer>
</body>

</html>
