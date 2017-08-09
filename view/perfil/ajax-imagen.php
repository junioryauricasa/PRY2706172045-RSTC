<?php
if (isset($_FILES["file"]))
{
    $file = $_FILES["file"];
    $nombre = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
    $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $carpeta = "../../datos/usuario/fotos/"; //enviado a la capa de datos
    
    if ($tipo !='image/jpg' && $tipo!= 'image/jpeg' && $tipo!= 'image/png' && $tipo!= 'image/gif') //definiendo si el formato es valido
    {
      echo "<span class='label label-danger'>Error, este no es un archivo valido</span>"; 
    }
    else if ($size > 1024*1024) //definiendo el tamaño maximo
    {
      echo "<span class='label label-warning'>Error, el tamaño máximo permitido es un 1MB</span>";
    }
    else if ($width > 250 || $height > 250) //dimensiones maximas
    {
        echo "<span class='label label-warning'>Error la anchura y la altura máxima permitida es 250px</span>";
    }
    else if($width < 60 || $height < 60) //dimensiones minimas
    {
        echo "<span class='label label-warning'>Error la anchura y la altura mínima permitida es 60px</span>";
    }
    else if($width = $height) //tamaño cuadrado
    {
        $src = $carpeta.$nombre;
        move_uploaded_file($ruta_provisional, $src);
        //agregar insert de la ruta y nombre a la base de datos

        echo "<img src='$src' width='120'></br>";
        echo "<span class='label label-success'>Se actualizo su Foto de Perfil!!</span>";
    }
    else
    {
        echo "
            <span class='label label-warning'>Tiene que ser de dimensiones iguales</span>
        ";
    }
}

?>