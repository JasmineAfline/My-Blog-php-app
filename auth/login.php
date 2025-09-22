<?php
include("../config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user   = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Store user session data
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role']     = $user['role'];

        // Redirect based on role
        if ($user['role'] === 'admin') {
            header("Location: ../users/dashboard.php");
        } else {
            header("Location: ../users/dashboard.php");
        }
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-container {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      width: 350px;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
      color: #555;
    }
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }
    button {
      width: 100%;
      padding: 10px;
      background: #2ecc71;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }
    button:hover {
      background: #27ae60;
    }
    .register-link {
      display: block;
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }
    .register-link a {
      color: #2ecc71;
      text-decoration: none;
      font-weight: bold;
    }
    .register-link a:hover {
      text-decoration: underline;
    }
    .error {
      color: red;
      text-align: center;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>

    <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>

    <form method="post">
      <label>Email</label>
      <input type="email" name="email" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <button type="submit">Login</button>

      <div class="register-link">
        Don’t have an account? <a href="register.php">Register here</a>
      </div>
    </form>
  </div>
</body>
</html>
