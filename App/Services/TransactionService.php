<?php

    namespace App\Services;
    use App\Models\Transaction;

    class TransactionService {
        public function get($user_id = null) {
            return Transaction::select($user_id);
        }


        public function post() {
            $data = json_decode(file_get_contents('php://input'), true);
            return  Transaction::insert($data);
        }
    }