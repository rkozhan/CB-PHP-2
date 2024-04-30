<?php
session_start();
require_once('../actions/session_check.php');
include_once('../actions/test_input.php');
require_once('../actions/db_connect.php');
// // ========== ON SUBMIT
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = test_input($_POST['company_name']);
    $contact_person = test_input($_POST['contact_person']);
    $phone = test_input($_POST['phone']);
    $address = test_input($_POST['address']);
    $created_by = $_SESSION['user_id'];

    try {
        // ========== SQL INSERT
        $stmt = $conn->prepare("INSERT INTO clients (company_name,
                                                    contact_person,
                                                    phone,
                                                    address,
                                                    created_by,
                                                    created_at,
                                                    edited_at) VALUES (:company_name,
                                                                        :contact_person,
                                                                        :phone,
                                                                        :address,
                                                                        :created_by,
                                                                        CURRENT_TIMESTAMP,
                                                                        CURRENT_TIMESTAMP)");
        $stmt->bindParam(':company_name', $company_name);
        $stmt->bindParam(':contact_person', $contact_person);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':created_by', $created_by);
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
        <title>Add New Customer</title>
    </head>
    <body class="bg-stone-100 h-full">
        <div class="container min-h-dvh mx-auto flex flex-col shadow-2xl">
            <?php include '../components/header.php'; ?>
            <div class="flex-auto flex flex-col items-center justify-center p-2">

                <h3>Add New Customer</h3>

                <?php
                    $submit_label = 'Add Customer';
                    include '../components/customer_form.php';
                ?>
                <a href="dashboard.php" class="bg-teal-700 px-4 py-1 hover:bg-teal-600 text-white">Back to Dashboard</a>
            </div>
            <?php include '../components/footer.php'; ?>  
        </div>        
    </body>
</html>
