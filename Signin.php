<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    
    <div class="container">
        <br>
        <h1 id="Login">Sign up</h1>
        <br>
        <p id="para">You already have an account? <a href="Login.php">Log in.</a></p>
        <form action="login_register.php" method="POST"> 
          <label for="name" class="pass"><b>Full Name:</b></label>
          <input type="text" name="name" id="name" placeholder="Enter your full name" required />
          
          <label for="email" class="pass"><b>Email:</b></label>
          <input type="email" name="email" id="email" placeholder="Enter your email" required />
          
          <label for="password" class="pass"><b>Password:</b></label>
          <input type="password" name="password" id="password" placeholder="Enter your password" required />
          
          <label for="role" class="pass"><b>Role:</b></label>
          <select name="role" id="role">
              <option value="user">User</option>
              <option value="admin">Admin</option>
          </select>
          
          <button type="submit" id="button" name="register">Sign up</button>
      </form>
    </div>
    <script src="signup.js"></script>
</body>
</html>
