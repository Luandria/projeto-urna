<?php
    require_once('..\class\db.class.php');
    $bancoDados = BD::conectar_bd();

    $sql = $bancoDados->query("SELECT COUNT(`id`) AS qnt FROM `votacao` WHERE `id_candidato`=3");
    $sql->execute();
    if($sql->rowCount()>0){
        $dados = $sql->fetch(PDO::FETCH_ASSOC);
        echo json_encode($dados['qnt']);
    }
?>