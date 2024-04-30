<?php
session_start();
require_once('../actions/session_check.php');
include_once('../actions/test_input.php');
require_once('../actions/db_connect.php');

// Check permission to edit
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET['id'])) {
        header("Location: ../dashboard.php");
        exit();
    }

    $customer_id = $_GET['id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM clients WHERE company_id = :company_id");
        $stmt->bindParam(':company_id', $customer_id);
        $stmt->execute();
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check  permission to edit
        if ($_SESSION['user_id'] != $customer['created_by']) {
            echo "You do not have permission to edit this customer.";
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $company_name = test_input($_POST['company_name']);
    $contact_person = test_input($_POST['contact_person']);
    $phone = test_input($_POST['phone']);
    $address = test_input($_POST['address']);

    try {
        $stmt = $conn->prepare("UPDATE clients
                                SET company_name = :company_name,
                                    contact_person = :contact_person,
                                    phone = :phone, address = :address
                                WHERE company_id = :customer_id");
        $stmt->bindParam(':company_name', $company_name);
        $stmt->bindParam(':contact_person', $contact_person);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->execute();

        header("Location: dashboard.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <title>Edit Customer</title>
</head>

<body class="bg-stone-100 h-full">
    <div class="container min-h-dvh mx-auto flex flex-col shadow-2xl">
        <?php include '../components/header.php'; ?>

        <div class="flex-auto flex flex-col items-center justify-center p-2">

            <h3>Edit Customer</h3>
            <?php
                $submit_label = 'Update Customer';
                include '../components/customer_form.php';
            ?>

            <p><a href="dashboard.php" class="bg-teal-700 px-4 py-1 hover:bg-teal-600 text-white">Back to Dashboard</a></p>
        </div>
        <?php include '../components/footer.php'; ?>          
    </div>
</body>

</html>
