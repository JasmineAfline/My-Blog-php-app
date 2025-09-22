<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../auth/login.php");
  exit();
}
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title   = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $user_id, $title, $content);

    if ($stmt->execute()) {
        $message = "Post saved successfully!";
        $status = "success";
    } else {
        $message = "Error saving post: " . $stmt->error;
        $status = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Save Post</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta http-equiv="refresh" content="2;url=manage_posts.php"> <!-- Auto redirect -->
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white shadow-md rounded-lg p-8 max-w-md text-center">
    <?php if ($status === "success"): ?>
      <h2 class="text-2xl font-bold text-green-600 mb-4">✅ Success</h2>
    <?php else: ?>
      <h2 class="text-2xl font-bold text-red-600 mb-4">❌ Error</h2>
    <?php endif; ?>
    <p class="mb-6 text-gray-700"><?php echo htmlspecialchars($message); ?></p>
    <a href="manage_posts.php"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
       Go to Manage Posts
    </a>
  </div>
</body>
</html>
