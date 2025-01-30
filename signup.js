function signup() {
    debugger;
    const firstName = document.getElementById("firstName").value.trim();
    const lastName = document.getElementById("lastName").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
  
    // Email validation pattern
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
    if (!firstName || !lastName || !email || !password) {
      alert("Please fill out all fields.");
    } else if (!emailPattern.test(email)) {
      alert("Please enter a valid email address.");
    } else if (password.length < 6) {
      alert("Password must be at least 6 characters long.");
    } else {
      window.location.href = "home.php"; 
    }
  }