<?php
session_start();
require_once('../actions/session_check.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/output.css">
        <title>Confirmation</title>
    </head>

    <body class="bg-stone-100 h-full">
        <div class="container min-h-dvh mx-auto flex flex-col shadow-2xl">
            <?php include '../components/header.php'; ?>

            <div class="flex-auto flex  gap-4 flex-col items-center justify-center p-2 border-2 border-teal-400">

                <h2 class="text-2xl">Delete <?php echo $_GET['name']." (ID: ".$_GET['id'].")" ?> ?</h2>

                <a href="../actions/delete_customer.php?id=<?= $_GET['id'] ?>"
                    class="bg-teal-900 px-6 py-2 hover:bg-red-800 text-white">Yes</a>
                <a href="dashboard.php" class="text-teal-700 hover:text-teal-500">No, back to dashboard</a>
            </div>
            <?php include '../components/footer.php'; ?>
        </div>
    </body>
</html>