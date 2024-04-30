<?php
session_start();
require_once('../actions/session_check.php');
require_once('../actions/db_connect.php');

// =============================== Spaltennamen von DB-Tabelle 
$stmt = $conn->query("SHOW COLUMNS FROM clients");
$columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($columns);

// =============================== ORDER BY 
$orderBy = "";
if (isset($_GET['order_by']) && !empty($_GET['order_by'])) {
    $orderBy = "ORDER BY ".$_GET['order_by']. " ASC";
}

// =============================== SELECT *
try {
    $stmt = $conn->prepare("SELECT * FROM clients $orderBy");
    $stmt->execute();
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en" class="h-full w-full ">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/output.css">
        <title>Customer Management System - Dashboard</title>
    </head>

    <body class="bg-stone-100 h-full overflow-hidden">
        <div class="container min-h-dvh mx-auto flex flex-col shadow-2xl">
            <?php include '../components/header.php'; ?>

            <div class="flex-auto flex flex-col items-left justify-center p-2 overflow-hidden">

                <h2 class="text-2xl mb-2">Overview of All Customers:</h2>
                <div>
                    <a class="bg-teal-900 px-4 py-1 hover:bg-teal-800 text-white" href="dashboard.php">Default Order</a>
                    <?php echo $orderBy; ?>
                </div>

                <div class="overflow-x-auto">
                    <table class="text-center my-5 table-auto ">
                        <tr class="text-white border-white">
                            <?php
                                // ==== FOREACH Column name
                                foreach ($columns as $column) {                                    
                                    $colName = ucwords(str_replace("_", " ", $column['Field']));
                                    ?>
                                    <th class="border-r-2  bg-teal-900">
                                        <a class="block bg-teal-900 hover:bg-teal-800 h-full hover:underline" 
                                            href="dashboard.php?order_by=<?= $column['Field'] ?>"><?= $colName ?></a>
                                    </th>
                            <?php } ?>
                            <th class="bg-teal-900">Actions</th>
                        </tr>
                        <?php //  ==== FOREACH customer as ROW
                            foreach ($customers as $customer) : ?>
                            <tr class="odd:bg-teal-100 border-b-2 border-white">
                            <?php //  ==== FOREACH field in customer 
                                foreach ($columns as $column) : ?>
                                <td class="border-r-2 border-white"><?= $customer[$column['Field']] ?></td>
                            <?php endforeach; ?>
                                <td class="flex gap-3 flex-wrap">
                                    <?php //  ==== EDIT / DELETE
                                    if ($_SESSION['user_id'] == $customer['created_by']) : ?>            
                                        <a class="bg-orange-500 px-4 py-1 hover:bg-orange-600 text-white" href="edit_customer.php?id=<?= $customer['company_id'] ?>">Edit</a>
                                        <a class="bg-red-500 px-4 py-1 hover:bg-red-600 text-white"
                                            href="delete_confirm.php?id=<?= $customer['company_id']?>&name=<?= $customer['company_name']?>">Delete</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div>
                    <a href="add_customer.php" class="bg-teal-900 px-4 py-1 hover:bg-teal-800 text-white">Add New Customer</a>
                </div>
            </div>

            <?php include '../components/footer.php'; ?>
        </div>    
    </body>

</html>


