<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../auth/login.php");
  exit();
}
include("../config.php");

if (!isset($_GET['id'])) {
    die("Post not found.");
}

$post_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch post to confirm
$sql = "SELECT * FROM posts WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $post_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    die("Unauthorized or post not found.");
}

// Handle delete confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm'])) {
        $sql = "DELETE FROM posts WHERE id=? AND user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $post_id, $user_id);
        $stmt->execute();
    }
    header("Location: manage_posts.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Delete Post</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex items-center justify-center">
  <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full text-center">
    <h2 class="text-2xl font-bold text-red-600 mb-4">Delete Post</h2>
    <p class="mb-6">Are you sure you want to delete this post?</p>
    <div class="bg-gray-50 border rounded-lg p-4 mb-6 text-left">
      <p class="font-medium">Title: <span class="text-gray-700"><?php echo htmlspecialchars($post['title']); ?></span></p>
      <p class="mt-2 text-sm text-gray-600"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
    </div>
    <form method="post" class="flex justify-center space-x-4">
      <button type="submit" name="confirm"
              class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
        Yes, Delete
      </button>
      <a href="manage_posts.php"
         class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
        Cancel
      </a>
    </form>
  </div>
</body>
</html>
