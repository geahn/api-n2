<?php

    namespace App\Services;
    use App\Models\User;

    class UserService {
        public function get($username = null) {
            if ($username){
                return User::select($username);
            } else {
                return User::selectAll();
            }
        }

        public function post() {
            $data = json_decode(file_get_contents('php://input'), true);
            return  User::insert($data);
        }

        public function patch() {
            $data = json_decode(file_get_contents('php://input'), $_PATCH);

            //parse_str(file_get_contents('php://input'), $_PATCH);
            return  User::update($data);
        }
    }