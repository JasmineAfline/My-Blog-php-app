<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    // Password confirmation check
    if ($password !== $confirm) {
        echo "<p style='color:red; text-align:center;'>Passwords do not match!</p>";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        // Default role = admin
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'admin')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashed);

        if ($stmt->execute()) {
            echo "<p style='color:green; text-align:center;'>Registration successful! <a href='login.php'>Login here</a></p>";
        } else {
            if ($conn->errno == 1062) { // Duplicate email error
                echo "<p style='color:red; text-align:center;'>That email is already registered. <a href='login.php'>Login instead</a></p>";
            } else {
                echo "<p style='color:red; text-align:center;'>Error: " . $stmt->error . "</p>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(120deg, #6a11cb, #2575fc);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .card {
      background: #fff;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.15);
      width: 350px;
      text-align: center;
    }

    .card h2 {
      margin-bottom: 20px;
      color: #333;
    }

    label {
      display: block;
      text-align: left;
      margin-bottom: 5px;
      font-size: 0.9rem;
      color: #555;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      outline: none;
      transition: border 0.3s ease;
    }

    input:focus {
      border-color: #2575fc;
    }

    button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 6px;
      background: #2575fc;
      color: #fff;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background: #6a11cb;
    }

    .card p {
      margin-top: 15px;
      font-size: 0.9rem;
    }

    .card a {
      color: #2575fc;
      text-decoration: none;
      font-weight: 600;
    }

    .card a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>Create Account</h2>
    <form method="post">
      <label>Username:</label>
      <input type="text" name="username" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <label>Confirm Password:</label>
      <input type="password" name="confirm_password" required>

      <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
  </div>
</body>
</html>
