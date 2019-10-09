<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // $fichero_subido = $dir . basename($_FILES['fichero']['name']);´
    $fichero_dir = "/var/www/html/mesao/UF1/A3/uploads";
    $lengthtext=strlen($_REQUEST['mytextarea']);

    if(empty($_REQUEST['mytext'])){
        echo"Error el nombre no se ha introducido!";
    }else if(!isset($_REQUEST['mycheckbox'])){
        echo"No has seleccionado el sexo";
    }else if(!isset($_REQUEST['myradio'])){
        echo"No has seleccionado si estudias o trabajas";
    }else if(!isset($_REQUEST['myselect'])){
        echo"No has seleccionado tu edad";
    }else if($lengthtext<=30){
        echo"No has puesto mas de 30 caracteres sobre ti!!";
    }else if($_FILES['fichero']['name'][0]!=null){
        foreach ($_FILES["fichero"]["error"] as $clave => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $nombre_tmp = $_FILES["fichero"]["tmp_name"][$clave];
                // basename() puede evitar ataques de denegació del sistema de ficheros;
                // podría ser apropiado más validación/saneamiento del nombre de fichero
                $nombre = basename($_FILES["fichero"]["name"][$clave]);
                move_uploaded_file($nombre_tmp, "/var/www/html/mesao/UF1/A3/uploads/".$nombre);
                echo"Fichero movido ".$nombre."<br>";
            }
        }
    }
    
/*SI PASA LAS CONDICIONES IMPRIMES:*/    
    else{
        echo"<h2>IMPRIMIMOS LOS CAMPOS DEL FORMULARIO</h2>";
        /*VAR*/
        $check = implode(", ", $_REQUEST['mycheckbox']);
        $myfile = implode(", ", $_FILES['fichero']);
        /*IMPRIMIR*/
        echo"<br>";
        echo"Mi nombre: ". $_REQUEST['mytext']."<br>";
        echo"Mi sexo: ". $_REQUEST['myradio']."<br>";
        echo"Trabajo o estudio: ".$check."<br>";
        echo"Edad: ". $_REQUEST['myselect']."<br>";
        echo"Sobre mi: ". $_REQUEST['mytextarea']."<br>";
        echo"Nombre del fichero: ".$myfile."<br>";
    }
        
} else {?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Exemple de formulari</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
    <style>
        body{
            /* background-image: url("http://hts.jo/guinniss/assets/img/backgrounds/1.jpg"); */
            background-image: url("https://web.farroupilha.ifrs.edu.br/paginas/~diogo.zanco/planodefundo2.jpg");
            background-size: cover;        }
            }
    </style>
<body>
    <div style="margin: 30px 10%;">
        <h3>DIME ALGO BREVE SOBRE TI</h3>
        <form action="formulari.php" method="post" id="myform" name="myform" enctype="multipart/form-data">

            <label>Nombre:</label> <input type="text" value="" size="30" maxlength="100" name="mytext" id="" /><br /><br />

            <input type="radio" name="myradio" value="Hombre" /> Hombre
            <input type="radio" checked="checked" name="myradio" value="Mujer" /> Mujer<br /><br />

            <input type="checkbox" name="mycheckbox[]" value="Estudiante" /> Estudiante
            <input type="checkbox" checked="checked" name="mycheckbox[]" value="Trabajador" /> Trabajador<br /><br />

            <label>Select ... </label>
            <select name="myselect" id="">
                <optgroup label="group 1">
                    <option value="Menor de 30" selected="selected">Menor de 30</option>
                </optgroup>
                <optgroup label="group 2" >
                    <option value="Mayor de 30">Mayor de 30</option>
                </optgroup>
            </select><br /><br />

            <textarea name="mytextarea" id="" rows="3" cols="30">
                Algo sobre ti...
            </textarea> <br /><br />
            Enviar este fichero: <input name="fichero[]" type="file" multiple="multiple" /><br /><br />
            <button id="mysubmit" type="submit" onclick="">Enviar</button>
        </form>
    </div>
</body>
</html>
<?php 
};
?>