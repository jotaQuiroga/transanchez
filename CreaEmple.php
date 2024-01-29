<?php

//creacion de variables
    //variables de conexion
    $svr_crea_conexion=@mysqli_connect('localhost', 'root', '');
    $db_crea_conexion= mysqli_select_db($svr_crea_conexion, 'transanchez');

    //creacion de variables de información
    $docum = check_input($_POST['docum']);
    $nombre = check_input($_POST['nombre']);
    $apell_1 = check_input($_POST['apell_1']);
    $apell_2 = check_input($_POST['apell_2']);
    $email = check_input($_POST['email']);
    $telef = check_input($_POST['telef']);
    $direc = check_input($_POST['direc']);
    $tipEmpl = check_input($_POST['tipEmpl']);
    $cargo = check_input($_POST['cargo']);
    $sentencia_emple = "INSERT INTO `empleado`(`Cod_Identifica`, `Cargo_Id_Cargo`, `Nombres`, `Primer_Apellido`, `Segundo_Apellido`, `telefono`, `Direccion`, `E_mail`, `Tipo_Empleado`) VALUES ('$docum','$cargo','$nombre','$apell_1','$apell_2','$telef','$direc','$email','$tipEmpl')";

    //por defecto se crea un usuario que corresponde a 
    $sentencia_user = "INSERT INTO `credencial_emple`(`id_emple`, `usuario`, `password`, `default_pass`) SELECT `ID_EMPLEADO`, `Cod_Identifica`, `Cod_Identifica`, TRUE FROM `EMPLEADO` WHERE `Cod_Identifica` = '$docum'";
//verificar conexiones de servidor y de base de datos
    if (!$svr_crea_conexion){
        echo "Servidor no encontrado.";
    }else{
        if (!$db_crea_conexion){
            echo "Base de Datos no encontrada.";
        }
        else{
            //ejecutar sentencia de creación de empleado
            $ejecuta_Insert = mysqli_query($svr_crea_conexion, $sentencia_emple);
            //confirmar la ejecución
            if (!$ejecuta_Insert){
                echo "Se presentó un error en la creación del empleado.";
            }else {
                //se realiza la sentencia de creación de usuario con clave por defecto
                $ejecuta_user = mysqli_query($svr_crea_conexion, $sentencia_user);
                if (!$ejecuta_user){
                    echo "Se presentó un error en la generación del usuario.";
                }else{
                    echo "Se generó correctamente usuario para el nuevo empleado.";
                }

                echo " Empleado creado correctamente. <br><a href = 'registro.php'>Volver</a> ";
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
    };
?>