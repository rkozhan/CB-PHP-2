<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <link rel="stylesheet" href="./css/output.css">
        <title>Customer Management System</title>
    </head>
    <body class="bg-stone-100 h-full">
        <div class="container min-h-dvh mx-auto flex flex-col shadow-2xl">
            <?php include 'components/header.php'; ?>

            <div class="flex-auto flex flex-col items-center justify-center p-2">
                <h3>User Login</h3>

                <form action="actions/login_process.php" method="post" class="flex flex-col gap-4 py-4 ">
                    <input type="email" id="email" name="email" required placeholder="email" class="px-2 border border-teal-400 focus:outline-none focus:border-teal-700">
                    <input type="password" id="password" name="password" required placeholder="password" class="px-2 border border-teal-400 focus:outline-none focus:border-teal-700">
                    <input type="submit" value="Login" class="bg-teal-700 px-2 py-1 hover:bg-teal-600 text-white">
                </form>
                <a href="pages/register.php" class="text-teal-700 hover:text-teal-500">Sign up</a>
            </div>
            
            <?php include 'components/footer.php'; ?>
        </div>
    </body>
</html>

