<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != "admin") {
    header("Location: ../login");
    exit();
}
?>

<?php
require_once 'header.php';
?>
<div class="container">
    <div class="jumbotron">
        <h1>Administrator</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
</div>
<p><a href="../logout.php">Logout</a></p>
<?php
require_once 'footer.php';
?>
