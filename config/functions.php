<?php

// phpinfo();
// die;
// var_dump($host);
// Function to generate a random encryption key
function generateKey($length = 32)
{
    return bin2hex(random_bytes($length));
}

// Function to encrypt data
function encryptData($plaintext, $key)
{
    // Cipher method
    $cipher = "AES-256-CBC";

    // Generate a random initialization vector (IV)
    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($iv_length);

    // Encrypt the data
    $encrypted = openssl_encrypt($plaintext, $cipher, hex2bin($key), 0, $iv);

    // Combine IV and encrypted data (base64-encoded)
    return base64_encode($iv . $encrypted);
}

// Function to decrypt data
function decryptData($encryptedData, $key)
{
    // Cipher method
    $cipher = "AES-256-CBC";

    // Decode the base64-encoded data
    $data = base64_decode($encryptedData);

    // Extract the IV and the encrypted text
    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = substr($data, 0, $iv_length);
    $encryptedText = substr($data, $iv_length);

    // Decrypt the data
    return openssl_decrypt($encryptedText, $cipher, hex2bin($key), 0, $iv);
}


// Global variable for the database connection
$globalDbConnection = null;

// $host = '127.0.0.1';
// $username = 'root';
// $password = '';
// $database = 'nativeconn';
// Function to initialize and return the global database connection
function getDbConnection()
{
    require_once 'db.php';

    global $globalDbConnection;

    // var_dump($globalDbConnection);
    if (!$globalDbConnection) {
        // Database credentials
        $server = $host;
        $db_user = $username;
        $db_pass = $password;
        $database = $database;

        // Create a new mysqli connection
        $globalDbConnection = new mysqli($server, $db_user, $db_pass, $database);

        // Check the connection
        if ($globalDbConnection->connect_error) {
            die("Connection failed: " . $globalDbConnection->connect_error);
        }
    }

    return $globalDbConnection;
}

function timeAgo($datetime)
{


    // $timestamp = '2024-02-04 12:00:00'; // Example timestamp from the database
    // $timeAgo = time() - strtotime($timestamp);

    // if ($timeAgo < 60) {
    //     echo "$timeAgo seconds ago";
    // } elseif ($timeAgo < 3600) {
    //     echo floor($timeAgo / 60) . " minutes ago";
    // } elseif ($timeAgo < 86400) {
    //     echo floor($timeAgo / 3600) . " hours ago";
    // } else {
    //     echo floor($timeAgo / 86400) . " days ago";
    // }

    $now = new DateTime();
    $past = new DateTime($datetime);
    $diff = $now->diff($past);

    if ($diff->y > 0) {
        return $diff->y . " years ago";
    } elseif ($diff->m > 0) {
        return $diff->m . " months ago";
    } elseif ($diff->d > 0) {
        return $diff->d . " days ago";
    } elseif ($diff->h > 0) {
        return $diff->h . " hours ago";
    } elseif ($diff->i > 0) {
        return $diff->i . " minutes ago";
    } else if ($diff->s < 60) {
        return $diff->s . " seconds ago";
    } else {
        return "Just now";
    }
}


function getRandomParagraphFromAPI()
{
    $apiUrl = "https://loripsum.net/api/1/short/plaintext";
    return file_get_contents($apiUrl);
}

function getRandomParagraph()
{
    $paragraphs = [
        "The quick brown fox jumps over the lazy dog. This is a classic pangram used for testing fonts and keyboards.",
        "Technology is rapidly evolving, changing the way we interact with the world. Artificial intelligence and automation are playing a major role in shaping the future.",
        "In the middle of difficulty lies opportunity. Every challenge presents a chance to learn and grow, making resilience an essential trait for success.",
        "Nature is an endless source of inspiration. The beauty of the mountains, rivers, and forests reminds us of the wonders of the world.",
        "Reading books opens the door to countless worlds. Each page turns into an adventure, allowing the reader to travel through time and space.",
        "HAHAHAHAHHAHAHAHA so weird"
    ];

    return $paragraphs[array_rand($paragraphs)];
}


function isMobile()
{
    return preg_match('/(android|iphone|ipad|ipod|blackberry|opera mini|windows phone)/i', $_SERVER['HTTP_USER_AGENT']);
}

function canMobileOrDesktop($md, $user)
{
    /* default Desktop */
    $layout = "<div class='card-body'>
                                        <div class='d-flex align-items-center'>
                                            <img src='../assets/img/profile-img.jpg' class='rounded-circle me-2 border' style='width: 50px; height: 50px; object-fit: cover;' alt='User'>
                                            <textarea class='form-control border-0' id='postInput' data-bs-toggle='modal' data-bs-target='#largeModal' rows='2' placeholder=\"What's on your mind, $user ?\" style='resize: none;' readonly></textarea>
                                        </div>
                                        <hr>
                                        <div class='d-flex justify-content-between px-2'>
                                            <button class='btn btn-light text-primary fw-semibold fs-6'><i class='bi bi-camera-video-fill me-1'></i> Live Video</button>
                                            <button class='btn btn-light text-success fw-semibold fs-6'><i class='bi bi-images me-1'></i> Photo/Video</button>
                                            <button class='btn btn-light text-warning fw-semibold fs-6'><i class='bi bi-emoji-smile me-1'></i> Feeling/Activity</button>
                                        </div>
                                    </div>";
    if ($md == "Mobile") {
        $layout = "<div class='card-body'>
                                        <div class='d-flex align-items-center'>
                                           
                                            <img src='../assets/img/profile-img.jpg' class='rounded-circle me-2 border' style='width: 50px; height: 50px; object-fit: cover;' alt='User'>
                                            <textarea class='form-control border-0' id='postInput' data-bs-toggle='modal' data-bs-target='#largeModal' rows='2' placeholder=\"What's on your mind, $user ?\" style='resize: none; ' readonly></textarea>&nbsp;&nbsp;
                                             <button class='btn btn-light text-success fw-semibold fs-6'><i class='bi bi-images me-1'></i>Photo</button>
                                        </div>
                                        
                                        <!-- <div class='d-flex justify-content-between px-2'>
                                            <button class='btn btn-light text-primary fw-semibold fs-6'><i class='bi bi-camera-video-fill me-1'></i> Live Video</button>
                                            <button class='btn btn-light text-success fw-semibold fs-6'><i class='bi bi-images me-1'></i> Photo/Video</button>
                                            <button class='btn btn-light text-warning fw-semibold fs-6'><i class='bi bi-emoji-smile me-1'></i> Feeling/Activity</button>
                                        </div> -->
                                    </div>";
    }

    return $layout;
}

function dynamicdataTable($isModalType, $subMod, $data)
{
    // var_dum
    $connection = getDbConnection(); // Get the global DB connection

    // $query = "SELECT * FROM tblMain";
    // $emailCheckStmt = $connection->prepare($query);
    // $emailCheckStmt->execute();

    // $results = $emailCheckStmt->fetchAll(PDO::FETCH_ASSOC);


    // var_dump('<pre>',$data);


    // var_dump('<pre>',$isModalType,$subMod,in_array($subMod,array('useraccount')))
    // var_dump('<pre>',$connection);die;
    if (!empty($subMod)) {

        $query = "SELECT * FROM tblMain WHERE Link='{$subMod}'";
        $emailCheckStmt = $connection->prepare($query);
        $emailCheckStmt->execute();

        // Get metadata to dynamically bind results
        $meta = $emailCheckStmt->result_metadata();

        $params = array();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }


        call_user_func_array([$emailCheckStmt, 'bind_result'], $params);

        $data = array();
        while ($emailCheckStmt->fetch()) {
            $rowData = [];
            foreach ($row as $key => $val) {
                $rowData[$key] = $val;
            }
            $data[] = $rowData;
        }
    }

    // var_dump('<pre>',count($data));

    if ($isModalType) {
        if (count($data) > 0) {
            $table = "<table class='table datatable'>
                        <thead>
                            <tr>
                                <th>Fullname</th>
                
                                <th>Usertype</th>
                                <th>Permission</th>
                            
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Unity Pugh</td>
                
                                <td>Admin</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Theodore Duran</td>
                                <td>Admin</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Kylie Bishop</td>
                                <td>User</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>";
        } else {

        }
    } else {
        $table = "<table class='table datatable'>
        <thead>
            <tr>
                <th>Fullname</th>

                <th>Usertype</th>
                <th>Permission</th>
            
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Unity Pugh</td>

                <td>Admin</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Theodore Duran</td>
                <td>Admin</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Kylie Bishop</td>
                <td>User</td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
        </table>";
    }


    return $table ?? '';
}


function getModalErrorMessage() {
    return "<div class='col-xxl-12 col-md-6'>
                                            <div class='modal fade' id='restrictedModal' tabindex='-1' aria-labelledby='restrictedModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog modal-dialog-centered'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header bg-danger text-white'>
                                                            <h5 class='modal-title' id='restrictedModalLabel'>🚫 Access Denied</h5>
                                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <p>You do not have permission to access this page. Please contact the administrator if you believe this is an error.</p>
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <a href='../site' class='btn btn-primary'>Return to Dashboard</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
}
