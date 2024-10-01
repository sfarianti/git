<?php

require __DIR__ . '../../../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function customHMAC($data, $key, $algorithm) {
    return hash($algorithm, $data . $key);
}

function decodeJWT($jwt, $secretKey) {
    list($headerEncoded, $payloadEncoded, $signatureEncoded) = explode('.', $jwt);

    $header = json_decode(base64_decode($headerEncoded), true);
    $payload = json_decode(base64_decode($payloadEncoded), true);
    $signature = base64_decode($signatureEncoded);
    
    $algorithm = $header['alg'];

    $calculatedSignature = customHMAC("$headerEncoded.$payloadEncoded", $secretKey, 'sha256');

    if (hash_equals($calculatedSignature, $signature)) {
        return $payload;
    } else {
        return $payload;
    }
}

$secretKey = 'rahasia';
$jwtAlgorithm = 'HS256';

$host = 'pqsql';
$dbname = 'pgdb';
$user = 'pguser';
$password = 'pgpass';
$port =  '5432';

// Membuat koneksi
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/') {
    if (!$conn) {
        echo "Koneksi gagal: " . pg_last_error();
    } else {
        echo "Koneksi berhasil!";
    }
}    

// Endpoint untuk login
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/login') {
//     $inputData = json_decode(file_get_contents('php://input'), true);
    
//     if (isset($inputData['email']) && $inputData['password']) {
//         $md5_pass = md5($inputData['password']);
//         $query = 'SELECT "Employee ID","Business Email Information Email Address" FROM data_pusat  WHERE "Business Email Information Email Address"=$1 AND "Password"=$2' ;
//         $result = pg_query_params($conn, $query, array( $inputData['email'], $md5_pass));
//         if(!$result){
//             http_response_code(401);
//             echo json_encode(['response code' => 401,
//                               'message' => 'unauthorized']);
//             exit();
//         }
//         $payload = [
//             'email' => pg_fetch_assoc($result)['Business Email Information Email Address'],
//             'id_employee' => pg_fetch_assoc($result)['Employee ID']
//         ];
//         // var_dump($payload);
//         $jwt = JWT::encode($payload, $secretKey, $jwtAlgorithm);

//         echo json_encode(['response code' => 201
//                         ,'message' => 'login berhasil'
//                         ,'token' => $jwt]);
//     } else {
//         http_response_code(401);
//         echo json_encode(['response code' => 401,
//                           'message' => 'unauthorized']);
//     }
// }

//endpoint untuk ambil session
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/getSession') {
    $inputData = json_decode(file_get_contents('php://input'), true);
    
    if (isset($inputData['user']) && $inputData['password']) {
        
        if(!($inputData['user'] == 'adminsync' && $inputData['password'] == 'passsync')){
            http_response_code(401);
            echo json_encode(['response code' => 401,
                              'message' => 'unauthorized']);
            exit();
        }
        $payload = [
            'token' => '123'
        ];
        // var_dump($payload);
        $jwt = JWT::encode($payload, $secretKey, $jwtAlgorithm);

        echo json_encode(['response code' => 201
                        ,'message' => 'berhasil mendapatkan session'
                        ,'token' => $jwt]);
    } else {
        http_response_code(401);
        echo json_encode(['response code' => 401,
                          'message' => 'unauthorized']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/getSession') {
    http_response_code(405);
    echo json_encode(['response code' => 405,
                    'message' => 'This endpoint only accepts POST requests']);
}

// Endpoint untuk mengambil data setelah login
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/getData') {
    $query = 'SELECT * FROM kmi.data_pusat' ;
    $result = pg_query($conn, $query);

    if(isset($_SERVER['HTTP_AUTHORIZATION'])){
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        $jwtToken = str_replace('Bearer ', '', $authHeader);
       
        try {
            $decodedToken = decodeJWT($jwtToken, $secretKey);
            
            if($decodedToken['token'] !== '123'){
                http_response_code(401);
                echo json_encode(['response code' => 401,
                                'message' => 'unauthorized']);
            }

            $query = 'SELECT * FROM kmi.data_pusat' ;
            $result = pg_query($conn, $query);
            $data = [];
            while($row = pg_fetch_assoc($result)){
                $data[] = $row;
            }
            // Data yang diambil sesuai dengan informasi dari token (pada kasus nyata, data ini akan diambil dari database)
            http_response_code(200);
            $payload = [
                'message' => 'Welcome to the protected area!',
                'data' => $data
            ];

            echo json_encode($payload);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['response code' => 401,
                            'message' => 'unauthorized']);
        }
    }else{
        http_response_code(401);
        echo json_encode(['response code' => 401,
                        'message' => 'unauthorized']);
    }
}

// Menutup koneksi
pg_close($conn);



?>