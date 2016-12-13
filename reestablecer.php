<?php
$token = $_GET['token'];
$idusuario = $_GET['idusuario'];

$conexion = new mysqli('localhost', 'root', '', 'ejemplobd');

$sql = "SELECT * FROM tblreseteopass WHERE token = '$token'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    if (sha1($usuario['idusuario']) == $idusuario) {
        include_once 'header.php';
        ?>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="cambiarpassword.php" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading"> Restaurar contraseña </div>
                    <div class="panel-body">
                        <p></p>
                        <div class="form-group">
                            <label for="password"> Nueva contraseña </label>
                            < input type="password" class="form-control" name="password1" required>
                        </div>
                        <div class="form-group">
                            <label for="password2"> Confirmar contraseña </label>
                            <input type="password" class="form-control" name="password2" required>
                        </div>
                        <input type="hidden" name="token" value="<?php echo $token ?>">
                        <input type="hidden" name="idusuario" value="<?php echo $idusuario ?>">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Recuperar contraseña" >
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4"></div>
        </div> <!-- /container -->


        <?php
        include_once 'footer.php';
    } else {
        header('Location:index.html');
    }
} else {
    header('Location:index.html');
}
?>