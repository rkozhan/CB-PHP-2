<?php
require_once('db_connect.php');
include_once('test_input.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }
    
        //email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // Check if email address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    //  password
    //$password = $_POST['password'];
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
    

    //registration
    if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {
        try {
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
    
            echo "User registered successfully! <a href='../index.php'>Click here to login</a>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            echo '<br/><a href="../index.php">Back</a>';
        }
    } else {
        // If any error
        if (!empty($nameErr)) {
            echo "<p>$nameErr</p>";
        }
        if (!empty($emailErr)) {
            echo "<p>$emailErr</p>";
        }
        if (!empty($passwordErr)) {
            echo "<p>$passwordErr</p>";
        }

        echo '<br/><a href="../index.php">Back</a>';
    }
    
}
?>