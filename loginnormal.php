<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$user = $_POST["user"];
$password = $_POST["pass"];
$conexion = new mysqli('localhost', 'sperey_laraveled', 'laraveled', 'sperey_edsonlaravel');
$sql = " SELECT * FROM user WHERE username = '$user' ";
$resultado = $conexion->query($sql);
if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    $db_hash = $usuario['password'];
    if ($db_hash === sha1($password)) {
        echo "user aceptado";
    }
} else
    echo "user no aceptado";