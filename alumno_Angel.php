<?php
include("connection.php");
$conn = connection();
if($conn){
    if (isset($_POST['insert'])) { // si pasa este if es que vamos a insertar algo
        $onQuerySuccess = FALSE;
        // Vamos a validar todos los inputs de un vergazo
        if(
            strlen($_POST['registro']) > 7 &&
            strlen($_POST['nombre']) > 3 &&
            strlen($_POST['apellido_p']) > 3 &&
            strlen($_POST['apellido_m']) > 3 &&
            ($_POST['sexo'] == 'M' || $_POST['sexo'] == 'F') &&
            isset($_POST['fecha_n']) &&
            isset($_POST['municipio']) &&
            isset($_POST['id_carrera']) &&
            strlen($_POST['calle']) > 3 &&
            isset($_POST['num_ext']) &&
            strlen($_POST['cp']) > 1 &&
            strlen($_POST['colonia']) > 3
        ){
            // por legibilidad y buenas practicas vamos a declarar
            // todas nuestras variables con nombres descriptivos
            $registro = $_POST['registro'];
            $nombre = $_POST['nombre'];
            $apellido_paterno = $_POST['apellido_p'];
            $apellido_materno = $_POST['apellido_m'];
            $sexo = $_POST['sexo'];
            $fecha_nacimiento = $_POST['fecha_n'];
            $id_municipio = $_POST['municipio'];
            $id_carrera = $_POST['id_carrera'];
            $id_domicilio = mt_rand(14030, 90000);
            $calle = $_POST['calle'];
            $num_int = $_POST['num_int'] ? $_POST['num_int'] : '';
            $num_ext = $_POST['num_ext'];
            $cp = $_POST['cp'];
            $colonia = $_POST['colonia'];
            // a continuación vamos a declarar nuestras poderosas queries
            $query = "INSERT INTO domicilio (
                id_domicilio,
                calle,
                num_int,
                num_ext,
                cp,
                colonia
            ) values (
                '$id_domicilio',
                '$calle',
                '$num_int',
                '$num_ext',
                '$cp',
                '$colonia'
            );";
            $query .= "INSERT INTO alumno (
                registro,
                nombre_alumno,
                ap_paterno,
                ap_materno,
                sexo,
                fecha_n,
                id_carrera,
                id_municipio,
                id_domicilio
            ) values (
                " . intval($registro) .",
                '$nombre',
                '$apellido_paterno',
                '$apellido_materno',
                '$sexo',
                '$fecha_nacimiento',
                '$id_carrera',
                '$id_municipio',
                '$id_domicilio'
            );";
            if($conn->multi_query($query) === TRUE){
                echo "Se creo el registro ...";
                $onQuerySuccess = TRUE;
            }else{
                echo "No se creo el registro...";
                var_dump(mysqli_error($conn));
            }
        }else{
            echo "Completa la info mi loco...";
        }
    }

}
?>
<!doctype html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
     <title>Form</title>
   </head>
   <body>
     <div class="container">
         <div class="row mt-5">
             <?php if ($onQuerySuccess == TRUE): ?>
                 <div class="col-12">
                     <table class="table mb-4 w-100">
                         <thead>
                             <tr>
                                 <th>Registro</th>
                                 <th>Nombre</th>
                                 <th>Apellido p.</th>
                                 <th>Apellido m.</th>
                                 <th>Fecha nacimiento</th>
                                 <th>Sexo</th>
                                 <th>Id municipio</th>
                                 <th>Id domicilio</th>
                                 <th>Id carrera</th>
                             </tr>
                         </thead>
                         <tbody>
                             <tr>
                                 <td><?php echo $_POST['registro']; ?></td>
                                 <td><?php echo $_POST['nombre']; ?></td>
                                 <td><?php echo $_POST['apellido_p']; ?></td>
                                 <td><?php echo $_POST['apellido_m']; ?></td>
                                 <td><?php echo $_POST['fecha_n']; ?></td>
                                 <td><?php echo $_POST['sexo']; ?></td>
                                 <td><?php echo $_POST['municipio']; ?></td>
                                 <td><?php echo $id_domicilio; ?></td>
                                 <td><?php echo $_POST['id_carrera']; ?></td>
                             </tr>
                         </tbody>
                     </table>

                     <table class="table mb-4 w-100">
                         <thead>
                             <tr>
                                 <th>ID Domicilio</th>
                                 <th>Calle</th>
                                 <th>C.P.</th>
                                 <th>Num. int.</th>
                                 <th>Num. ext.</th>
                                 <th>Colonia</th>
                             </tr>
                         </thead>
                         <tbody>
                             <tr>
                                 <td><?php echo $id_domicilio; ?></td>
                                 <td><?php echo $_POST['calle']; ?></td>
                                 <td><?php echo $_POST['cp']; ?></td>
                                 <td><?php echo $_POST['num_int'] ? $_POST['num_int'] : 'No hay'; ?></td>
                                 <td><?php echo $_POST['num_ext']; ?></td>
                                 <td><?php echo $_POST['colonia']; ?></td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             <?php else: ?>
                 <div class="col-4 offset-4">
                     <h1>Hubo un error en tu query...</h1>
                     <pre>
                         <?php echo var_dump(mysqli_error($conn)); ?>
                     </pre>
                 </div>
             <?php endif; ?>

         </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>
   </body>
 </html>
