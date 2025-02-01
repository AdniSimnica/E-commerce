<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    
    <div class="contaniner">
        <br>
        <h1 id="Login">Sign up</h1>
        <br>
        <p id="para">You already have an account? <a href="Login.php">Log in.</a></p>
        <form action="login_register.php" method="POST"> 
          <label for="username" class="pass"><b>Email:</b></label>
          <input type="email" name="username" id="username" placeholder="Enter your email" required />
          <label for="password" class="pass"><b>Password:</b></label>
          <input type="password" name="password" id="password" placeholder="Enter your password" required />
          <button type="submit" id="button" name="register">Sign up</button>
      </form>
      </div>
      <script src="signup.js"></script>
</body>
</html>