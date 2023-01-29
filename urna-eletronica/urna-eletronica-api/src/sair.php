<?php
    session_start();

    unset($_SESSION['usuario']);
    unset($_SESSION['nome']);
    unset($_SESSION['titulo']);

    header('Location: ./');
?>