<?php

//creacion de variables
    //variables de conexion
    $svr_crea_conexion=@mysqli_connect('localhost', 'root', '');
    $db_crea_conexion= mysqli_select_db($svr_crea_conexion, 'transanchez');

    //variables de información
    $user = check_input($_POST['user']);
    $passw = check_input($_POST['key']);

    if (empty($user)){
        echo "Debe ingresar usuario.";
    }
    if (empty($passw)){
        echo "Debe ingresar password.";
    }

    //sentencia que consulta usuario y clave de la base de datos
    $sentencia_validaCredenciales = "SELECT `ID_EMPLEADO`, `TIPO_EMPLEADO` FROM `CREDENCIAL_EMPLE` INNER JOIN `EMPLEADO` ON `ID_EMPLEADO` = `ID_EMPLE` WHERE `USUARIO` = '$user' AND `PASSWORD` = '$passw'";


//verificar conexiones de servidor y de base de datos
    if (!$svr_crea_conexion){
        echo "Servidor no encontrado.";
    }else{
        if (!$db_crea_conexion){
            echo "Base de Datos no encontrada.";
        }
        else{
            //ejecutar sentencia
            $ejecuta_Validacion = mysqli_query($svr_crea_conexion, $sentencia_validaCredenciales);
            //confirmar la ejecución
            if (!$ejecuta_Validacion){
                echo "Se presentó un error al verificar clave. <br><a href = 'login.html'>Volver</a> ";
            }else {
                if (mysqli_num_rows($ejecuta_Validacion)==0){
                    echo "Credenciales Invalidas. <br><a href = 'login.html'>Volver</a>";
                }
                else{
                    echo "<a href = 'registro.php'>Bienvenido</a>";
                }
                
            }
        }
    }

    function check_input($data, $problem = ""){
        $data = htmlentities(trim(strip_tags(stripslashes($data))), ENT_NOQUOTES, "UTF-8");
        if ($problem && strlen($data) == 0){
            show_error($problem);
        }

        return $data;
    };

    function show_error($myError) {
        echo $myError;
        exit();
    }
?>