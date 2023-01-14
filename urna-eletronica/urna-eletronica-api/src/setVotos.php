<?php
    require_once('..\class\db.class.php');
    $bancoDados = BD::conectar_bd();

    $nTit = $_GET['nTitEleitor'];
    $fk_candidato = $_GET['nNum'];

    if(empty($id)){
        $sql = $bancoDados->prepare("INSERT INTO `votacao` (`num_titulo`, `fk_candidato`)
                                            VALUES($nTit, $fk_candidato)");
        $sql->execute();
        $id = $bancoDados->lastInsertId();
    }
?>