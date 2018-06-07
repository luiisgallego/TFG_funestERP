<?php
print("<pre>");
print_r($_SESSION["prueba"]);
print("</pre>");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Luis Gallego Quero">
        <title>Servicios Funerarios Gallego </title>
        <link rel="icon" href="../img/favicon.ico">

        <!-- Bootstrap -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- CSS -->
        <link href="css/estilosLOGIN.css" rel="stylesheet">
        <!-- FontAwesome Icons (http://fontawesome.io) -->
        <link href="../bootstrap/fontAwesome/css/font-awesome.min.css" rel="stylesheet"> <!-- Icons -->
        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <!-- https://bootsnipp.com/snippets/featured/register-page -->
        <div class="container">
            <div class="row main">

                <div class="panel-heading">
                    <div class="panel-title text-center">
                        <h1 class="title">FUNERARIA GALLEGO ERP</h1>
                        <hr />
                    </div>
                </div>

                <div class="main-login main-center">
                    <form id="form-login" class="form-horizontal" method="post" action="procesa.php">
                        <input type="hidden" name="op" value="login">

                        <div class="form-group">
                            <label class="cols-sm-2 control-label">Username</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="username" value="admin" placeholder="Enter your Username"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="cols-sm-2 control-label">Password</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="password" value="admin" placeholder="Enter your Password"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-lg btn-block login-button" value="Login">
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <script src="js/alertify/alertify.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>

