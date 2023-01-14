<?php
    class BD{
        public static function conectar_bd(){
            try{
                $banco_de_dados = new PDO('mysql: host=localhost;
                                        dbname=urna_eletronica',
                                        'root','');
            }catch(PDOException $e){
                echo $e->getMessage();
            }

            return $banco_de_dados;
        }
    }
?>