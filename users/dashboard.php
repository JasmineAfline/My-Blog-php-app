<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../auth/login.php");
  exit();
}

// Role-based control
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f8;
      margin: 0;
      padding: 0;
    }
    header {
      background: #2c3e50;
      color: #fff;
      padding: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header h1 {
      margin: 0;
      font-size: 1.5rem;
    }
    header a {
      background: #e74c3c;
      color: white;
      padding: 8px 15px;
      border-radius: 5px;
      text-decoration: none;
    }
    header a:hover {
      background: #c0392b;
    }
    .dashboard {
      display: grid;
      grid-template-columns: 200px 1fr;
      min-height: 100vh;
    }
    .sidebar {
      background: #34495e;
      color: #fff;
      padding: 20px;
    }
    .sidebar a {
      display: block;
      color: #fff;
      text-decoration: none;
      margin: 10px 0;
    }
    .sidebar a:hover {
      text-decoration: underline;
    }
    .main {
      padding: 20px;
    }
    .card {
      background: #fff;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .stats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 20px;
    }
    .stat-box {
      background: #3498db;
      color: #fff;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
    }
  </style>
</head>
<body>

<header>
  <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> (<?php echo ucfirst($role); ?>)</h1>
  <a href="../auth/logout.php">Logout</a>
</header>

<div class="dashboard">
  <!-- Sidebar -->
  <aside class="sidebar">
    <h3>Menu</h3>
    <a href="dashboard.php">Dashboard</a>

    <?php if ($role === "admin"): ?>
      <a href="manage_users.php">Manage Users</a>
    <?php endif; ?>

    <a href="create_post.php">Create Post</a>
    <a href="manage_posts.php">Manage Posts</a>
    <a href="profile.php">Profile</a>
  </aside>

  <!-- Main Content -->
  <main class="main">
    <div class="card">
      <h2>Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
      <p>This is your dashboard where you can manage your blog.</p>
    </div>

    <div class="stats">
      <div class="stat-box">
        <h3>5</h3>
        <p>Total Posts</p>
      </div>
      <div class="stat-box" style="background:#2ecc71;">
        <h3>12</h3>
        <p>Comments</p>
      </div>
      <div class="stat-box" style="back
