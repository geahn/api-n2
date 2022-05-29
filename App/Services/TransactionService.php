<?php

    namespace App\Services;
    use App\Models\Transaction;

    class TransactionService {
        public function get($user_id = null) {
            return Transaction::select($user_id);
        }

        public function post() {

            return $data = json_decode(file_get_contents('php://input'), true);
            //$data = json_decode(file_get_contents('php://input'), true);
            //vaireturn  Transaction::insert($data);
        }
    }