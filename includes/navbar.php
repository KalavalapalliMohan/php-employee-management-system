<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand"> PHP User Management </a>
        <div>
            <span class="text-white">
                <?php echo $_SESSION['name']; ?>
            </span>
            <a href="../logout.php" class="btn btn-danger btn-sm"> Logout </a>
        </div>
    </div>
</nav>