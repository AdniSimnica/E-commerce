function login() {
    debugger;
    const username = document.getElementById("username").value;
    const password = document.getElementById("passowrd").value;
  
    
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
    if (!username || !password) {
      alert("Please enter both username and password.");
    } else if (!emailPattern.test(username)) {
      alert("Please enter a valid email address.");
    } else {
      window.location.href = "home.php"; 
    }
  }