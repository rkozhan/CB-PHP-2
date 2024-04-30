<?php
session_start();
require_once('../actions/session_check.php');
require_once('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET['id'])) {
        header("Location: ../pages/dashboard.php");
        exit();
    }

    $customer_id = $_GET['id']; 

    // Check permission to delete
    try {
        $stmt = $conn->prepare("SELECT created_by FROM clients WHERE company_id = :company_id");
        $stmt->bindParam(':company_id', $customer_id);
        $stmt->execute();
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check permission
        if ($_SESSION['user_id'] != $customer['created_by']) {
            echo "You do not have permission to delete this customer.";
            exit();
        }

        // Delete the customer
        $stmt = $conn->prepare("DELETE FROM clients WHERE company_id = :company_id");
        $stmt->bindParam(':company_id', $customer_id);
        $stmt->execute();

        header("Location: ../pages/dashboard.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
