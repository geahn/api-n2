<?php

    namespace App\Models;

    class Transaction {

        public static function select($user_id) {

            $con_string = 'host='.DBHOST.' port=5432 dbname='.DBNAME.' user='.DBUSER.' password='.DBPASS;
            $bdcon = pg_connect($con_string);

            $result = pg_query($bdcon, "select t.* from daniel_geahn.transactions t inner join daniel_geahn.user_releases ur on t.id = ur.transaction_id whereur.created_at between '2022-05-28' and '2022-05-28 23:59:59.999' and ur.user_id = ".$user_id);
            $numrows = pg_numrows($result);

            if (!$numrows) {
            throw new \Exception("Nenhuma transação encontrada");
            exit;
            } else {
                return $arr = pg_fetch_array($result, NULL, PGSQL_ASSOC);
            }
        }
    }