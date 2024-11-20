<?php    
function connectDatabase() {
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "dct-ccs-finals";

    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function validateLogin($email, $password) {
    $conn = connectDatabase();

    $email = $conn->real_escape_string($email);
    $password = md5($password);

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

?>