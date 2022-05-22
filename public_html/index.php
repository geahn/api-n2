<?php
    header('Content-Type: application/json');

    //CORS HEADERS
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
    header("Cache-Control: no-cache, must-revalidate"); 
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

    // header("Access-Control-Allow-Origin", "*");
    // header("Access-Control-Allow-Credentials", "true");
    // header("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE");
    // header("Access-Control-Max-Age", "3600");
    // header("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me, Origin, Cache-Control, Pragma, Authorization, Accept-Encoding");
    // header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    // header("Cache-Control: no-cache, must-revalidate"); 

    require_once '../vendor/autoload.php';
    
    if ($_GET['url']) {
        $url = explode("/", $_GET['url']);

        if ($url[0] === 'api') {
            array_shift($url);
            $service = 'App\Services\\'.ucfirst($url[0]).'Service';
            array_shift($url);

            $method = strtolower($_SERVER['REQUEST_METHOD']);
            
            try {
                $response = call_user_func_array(array(new $service, $method), $url);
                http_response_code(200);
                echo json_encode(array('status' => 'sucess', 'data' => $response));
                exit;            
            } catch (\Exception $e) {
                http_response_code(404);
                echo json_encode(array('status' => 'error', 'data' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
                exit;            
            }
        }
    }