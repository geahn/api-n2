<?php

    namespace App\Services;
    use App\Models\Transaction;

    class TransactionService {
        public function get($user_id = null) {
            return Transaction::select($user_id);
        }
    }