<?php
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$idusuario = $_POST['idusuario'];
$token = $_POST['token'];

if ($password1 != "" && $password2 != "" && $idusuario != "" && $token != "") {
    include_once 'header.php';
    ?>

    <div class="col-md-2"></div>
    <div class="col-md-8">
        <?php
        $conexion = new mysqli('localhost', 'sperey_laraveled', 'laraveled', 'sperey_edsonlaravel');

        $sql = " SELECT * FROM tblreseteopass WHERE token = '$token' ";
        $resultado = $conexion->query($sql);
        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            if (sha1($usuario['idusuario'] === $idusuario)) {
                if ($password1 === $password2) {
                    $sql = "UPDATE user SET password = '" . sha1($password1) . "' WHERE id = " . $usuario['idusuario'];
                    $resultado = $conexion->query($sql);
                    if ($resultado) {
                        $sql = "DELETE FROM tblreseteopass WHERE token = '$token';";
                        $resultado = $conexion->query($sql);
                        ?>
                        <p class="alert alert-info"> La contraseña se actualizó con exito. </p>
                        <?php
                    } else {
                        ?>
                        <p class="alert alert-danger"> Ocurrió un error al actualizar la contraseña, intentalo más tarde </p>
                        <?php
                    }
                } else {
                    ?>
                    <p class="alert alert-danger"> Las contraseñas no coinciden </p>
                    <?php
                }
            } else {
                ?>
                <p class="alert alert-danger"> El token no es válido </p>
                <?php
            }
        } else {
            ?>
            <p class="alert alert-danger"> El token no es válido </p>
            <?php
        }
        ?>
    </div>
    <div class="col-md-2"></div>
    </div> <!-- /container -->

    <?php
    include_once 'footer.php';
} else {
    header('Location:index.html');
}
?>