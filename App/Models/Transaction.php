<?php

    namespace App\Models;

    class Transaction {

        public static function select($user_id) {

            $date = date('Y-m-d');

            $con_string = 'host='.DBHOST.' port=5432 dbname='.DBNAME.' user='.DBUSER.' password='.DBPASS;
            $bdcon = pg_connect($con_string);

            //$result = pg_query($bdcon, "select t.* from daniel_geahn.transactions t inner join daniel_geahn.user_releases ur on t.id = ur.transaction_id where ur.created_at between '".$date."' and '".$date." 23:59:59.999' and ur.user_id = ".$user_id);
            $result = pg_query($bdcon, "select t.* from daniel_geahn.transactions t inner join daniel_geahn.user_releases ur on t.id = ur.transaction_id where ur.user_id = ".$user_id);
            $numrows = pg_numrows($result);

            if (!$numrows) {
            throw new \Exception("Nenhuma transação encontrada");
            exit;
            } else {
                return $arr = pg_fetch_all($result, PGSQL_ASSOC);
            }
        }

        public static function insert($data) {

            $user_id = $data['user_id'];
            $type = $data['type'];
            $description = $data['description'];
            $value = $data['value'];

                $con_string = 'host='.DBHOST.' port=5432 dbname='.DBNAME.' user='.DBUSER.' password='.DBPASS;
                $bdcon = pg_connect($con_string);

                $result = pg_query($bdcon, "INSERT INTO daniel_geahn.transactions (type, description, value, status) VALUES ('".$type."', '".$description."', '".$value."', '1')");

                if (!$result) {
                throw new \Exception("Falha ao inserir a Transação!");
                exit;
                }

                $result = pg_query($bdcon, "select * from daniel_geahn.transactions where id = (SELECT MAX(id) FROM daniel_geahn.transactions WHERE value = '".$value."')");
                $result = pg_fetch_assoc($result);
                $transaction_id = $result['id'];

                $result = pg_query($bdcon, "INSERT INTO daniel_geahn.user_releases (user_id, transaction_id, operation_type) VALUES ('".$user_id."', '".$transaction_id."', 'C')");

                if (!$result) {
                throw new \Exception("Falha ao inserir a Relação!");
                exit;
                } else {
                    return $data;
                }
            
        }

        public static function update($data) {
            
            $id = json_decode($data['id']);
            $value = $data['value'];

            $con_string = 'host='.DBHOST.' port=5432 dbname='.DBNAME.' user='.DBUSER.' password='.DBPASS;
            $bdcon = pg_connect($con_string);

            $result = pg_query($bdcon, "UPDATE daniel_geahn.".self::$table." SET value = '".$value."' WHERE id = '".$id."'");

            if (!$result) {
                throw new \Exception("Falha ao alterar transação!");
                exit;
                } else {
                    return $data;
                }

        }
    }