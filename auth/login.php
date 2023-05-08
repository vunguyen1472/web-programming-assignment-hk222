<div class="form">
    <h2>LOGIN</h2>
    <form action="auth/login_process.php" method="post">
        <input type="id" name="id" placeholder="Enter your id"></input>
        <input type="password" name="password" placeholder="Enter your password"></input>
        <button type="submit">Login</button>
        <span><?php echo isset($_SESSION['login-status']) ? $_SESSION['login-status'] : ""?></span>
    </form>
</div>