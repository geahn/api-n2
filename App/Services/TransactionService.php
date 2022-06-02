<?php

    namespace App\Services;
    use App\Models\Transaction;

    class TransactionService {
        public function get($user_id = null, $transacao = null) {
            if (!$transacao) {
                return Transaction::selectAll($user_id);
            } else {
                return Transaction::select($transacao);
            }
        }

        public function post() {
            //$data = $_POST;
            $data = json_decode(file_get_contents('php://input'), true);
            return  Transaction::insert($data);
        }

        public function put() {
            $data = (array) json_decode(file_get_contents('php://input'), TRUE);
            return Transaction::update($data);
        }
    }