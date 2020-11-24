<?php
include("connection.php");
$conn = connection();
$query_municipios = "SELECT * FROM municipio";
$query_carreras = "SELECT * FROM carrera";
if($conn->connect_errno){
    echo "error...";
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
        <form class="row mt-5" action="alumno_Angel.php" method="post">
            <div class="offset-3 col-6">
                <div class="row">
                    <div class="col-12">
                        <h3>Alumno</h3>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="registro" class="form-label">Registro</label>
                        <input type="text" class="form-control" name="registro" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="nombre" class="form-label">Nombre(s)</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="apellido_p" class="form-label">Apellido paterno</label>
                        <input type="text" class="form-control" name="apellido_p" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="apellido_m" class="form-label">Apellido materno</label>
                        <input type="text" class="form-control" name="apellido_m" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="fecha_n" class="form-label">Fecha de nacimiento</label>
                        <input class="form-control" name="fecha_n" type="date" id="fecha_n"
                            value="<?php echo date("Y-m-d"); ?>"
                            min="2000-01-01" max="2020-01-01" required>
                    </div>
                    <div class="col-12 mb-3">
                        <p class="mb-0">Sexo:</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexo" id="sexo" value="M" required>
                            <label class="form-check-label" for="sexo">
                                Masculino
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexo" id="sexo" value="F" required>
                            <label class="form-check-label" for="sexo">
                                Femenino
                            </label>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <select name="municipio" class="form-select" required>
                            <option selected>Selecciona un municpio</option>
                            <?php
                                if($result = $conn->query($query_municipios)){
                                    while ($row = $result->fetch_assoc()) {
                                        print"<option value=" . $row['id_municipio'] . ">" . $row['nombre'] . "</option>";
                                    }
                                    $result -> free_result();
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <select name="id_carrera" class="form-select" required>
                            <option selected>Selecciona una carrera</option>
                            <?php
                                if($result = $conn->query($query_carreras)){
                                    while ($row = $result->fetch_assoc()) {
                                        print"<option value=" . $row['id_carrera'] . ">" . $row['nombre'] . "</option>";
                                    }
                                    $result -> free_result();
                                }
                            ?>
                        </select>
                        <hr class="mt-4 mb-0 py-0">
                    </div>
                    <div class="col-12">
                        <h3>Domicilio</h3>
                    </div>
                    <div class="col-9 mb-3">
                        <label for="calle" class="form-label">Calle</label>
                        <input type="text" class="form-control" name="calle" required>
                    </div>
                    <div class="col-3 mb-3">
                        <label for="cp" class="form-label">C.P.</label>
                        <input type="number" class="form-control" name="cp" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="colonia" class="form-label">Colonia</label>
                        <input type="text" class="form-control" name="colonia" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="num_ext" class="form-label">No. externo</label>
                        <input type="number" class="form-control" name="num_ext" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="num_int" class="form-label">No. interno</label>
                        <input type="number" class="form-control" name="num_int">
                    </div>
                    <div class="col-12 mb-3">
                        <!-- Este input de tipo hidden lo usamos para control de fomrularios, en el siguiente archivo vamos a ver cómo se usa -->
                        <input type="hidden" name="insert" value="insert">
                        <button class="btn btn-primary" type="submit">Enviar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>
  </body>
</html>
<?php
$conn->close();
?>
