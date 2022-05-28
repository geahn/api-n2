<?php

    namespace App\Models;

    class Transaction {

        public static function select($user_id) {

            $con_string = 'host='.DBHOST.' port=5432 dbname='.DBNAME.' user='.DBUSER.' password='.DBPASS;
            $bdcon = pg_connect($con_string);

            $result = pg_query($bdcon, "SELECT * FROM daniel_geahn.transactions INNER JOIN daniel_geahn.user_releases ON daniel_geahn.transactions.id = daniel_geahn.user_releases.user_id WHERE daniel_geahn.transactions.id =".$user_id);
            $numrows = pg_numrows($result);

            if (!$numrows) {
            throw new \Exception("Nenhum usuário encontrado");
            exit;
            } else {
                return $arr = pg_fetch_array($result, NULL, PGSQL_ASSOC);
            }
        }
    }