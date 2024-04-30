<?php
require_once('db_connect.php');
include_once('test_input.php');
include_once('../components/error.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
          
            if (password_verify($password, $user['password'])) {
                // redirect to dashboard.php
                session_start();
                $_SESSION['username'] = $user['name'];
                $_SESSION['user_id'] = $user['user_id'];

                header("Location: ../pages/dashboard.php");
                exit();
            } else {
                $error_msg = "Invalid password!";
                onError($error_msg);
            }
        } else {
            $error_msg = "User not found!";
            onError($error_msg);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>