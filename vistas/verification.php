<?php
    ob_start();
    session_start();
    
    //  si la ariable de sesion no existe
    if (!isset($_SESSION["idpersonal"])) {
        header("Location: login.html");
    } else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar accesso</title>
    <!-- bootstrap 5.2.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="../public/css/sweetalert.min.css" />
    <link rel="stylesheet" href="./css/verification.css">
</head>
<body>
    <div class="container">
        <div class="verification-container">
            <form id="verificationForm" class="verificationForm text-center" action="">
                <h3 class="pb-4 text-center title">Ingrese el código de verificación</h3>
                <input class="w-100 mb-2 codeInput" type="text" id="verification_code" name="verification_code" placeholder="Ingresar código">
                <div class="w-100 text-center py-2">
                    <button class="btnSubmit text-center" type="submit">Envíar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- bootstrap 5.2.2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <!-- sweetalert2 -->
    <!-- <script src="../public/js/sweetalert.min.js"></script> -->  
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="./js/verification.js"></script>
</body>
</html>

<?php
    } 
?>