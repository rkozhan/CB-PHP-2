<footer class="bg-teal-100 text-center px-4 py-2 bg-teal-700 text-white">
        <?php if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) : ?>
            <div>Welcome, <?php echo $_SESSION['username']; ?></div>
        <?php else: ?>
            <div >Lorem ipsum 2024</h2>
        <?php endif; ?>

</footer>