
    <header class="flex flex-wrap gap-3 px-4 py-3 bg-teal-700 text-white items-center justify-between">
        <?php if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) : ?>
            <h1 class="text-2xl text-center">Dashboard</h1>
            <div>Welcome, <?php echo $_SESSION['username']; ?></div>
            <nav>
                <a href="../actions/logout.php" class="bg-red-900 px-6 py-2 hover:bg-red-800 text-white">Logout</a>
            </nav>
        <?php else: ?>
            <h1 class="text-2xl">Customer Management System</h1>
        <?php endif; ?>

    </header>
