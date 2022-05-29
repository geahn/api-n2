<?php

    namespace App\Models;

    class Transaction {

        public static function select($user_id) {

            if (!$date) {
                $date = date('Y-m-d');
            }

            $con_string = 'host='.DBHOST.' port=5432 dbname='.DBNAME.' user='.DBUSER.' password='.DBPASS;
            $bdcon = pg_connect($con_string);

            $result = pg_query($bdcon, "select t.* from daniel_geahn.transactions t inner join daniel_geahn.user_releases ur on t.id = ur.transaction_id where ur.created_at between '".$date."' and ''".$date."' 23:59:59.999' and ur.user_id = ".$user_id);
            $numrows = pg_numrows($result);

            if (!$numrows) {
            throw new \Exception("Nenhuma transação encontrada");
            exit;
            } else {
                return $arr = pg_fetch_all($result, PGSQL_ASSOC);
            }
        }
    }