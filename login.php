<html><body> 
<h2>Login Page</h2> 
<form action="login.php" method="POST"> 
    Username: <input type="text" name="username"><br> 
    Password: <input type="password" name="password"><br> 
    <input type="submit" value="Login"> 
</form> 
<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $username = $_POST['username']; 
        // In a real (bad) app, this would be part of a database query 
        echo "<p>Attempting login for user: " . htmlspecialchars($username) . "</p>"; 
    } 
?> 
</body></html>
