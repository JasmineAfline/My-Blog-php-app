<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../auth/login.php");
  exit();
}
include("../config.php");

$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email, role, created_at FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
</head>
<body>
  <h2>Your Profile</h2>
  <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
  <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
  <p><strong>Role:</strong> <?php echo $user['role']; ?></p>
  <p><strong>Joined:</strong> <?php echo $user['created_at']; ?></p>

  <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
