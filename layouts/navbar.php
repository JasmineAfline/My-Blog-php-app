 <!-- <header class="navbar">
  <h1>My Blog</h1>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="posts.php">Posts</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
  </nav>
</header> -->

<?php
session_start();
?>

<nav style="display:flex; justify-content:space-between; align-items:center; background:#2c3e50; padding:10px 20px; color:white;">
  <!-- Logo -->
  <div style="font-size:1.2rem; font-weight:bold;">My Blog</div>

  <!-- Links -->
  <ul style="list-style:none; display:flex; gap:15px; margin:0; padding:0;">
    <li><a href="/myapp/index.php" style="color:white; text-decoration:none;">Home</a></li>
    <li><a href="#" style="color:white; text-decoration:none;">About</a></li>
    <li><a href="#" style="color:white; text-decoration:none;">Blog</a></li>
    <li><a href="#" style="color:white; text-decoration:none;">Contact</a></li>
  </ul>

  <!-- Auth button -->
  <div>
    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="/myapp/auth/logout.php" style="background:#e67e22; color:white; padding:6px 12px; border-radius:4px; text-decoration:none; font-size:0.9rem;">Logout</a>
    <?php else: ?>
      <a href="/myapp/auth/login.php" style="background:#27ae60; color:white; padding:6px 12px; border-radius:4px; text-decoration:none; font-size:0.9rem;">Login</a>
    <?php endif; ?>
  </div>
</nav>


<style>
.navbar {
  background: #2c3e50;
  color: #fff;
  padding: 20px 0;
  text-align: center;
}

.navbar h1 {
  margin-bottom: 10px;
}

.navbar nav ul {
  list-style: none;
  display: flex;
  justify-content: center;
  gap: 20px;
}

.navbar nav ul li a {
  color: #fff;
  text-decoration: none;
  font-weight: bold;
}

.navbar nav ul li a:hover {
  text-decoration: underline;
}
</style>

  