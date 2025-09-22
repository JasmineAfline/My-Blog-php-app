<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../auth/login.php");
  exit();
}
include("../config.php");

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title   = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $user_id, $title, $content);

    if ($stmt->execute()) {
        header("Location: manage_posts.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Post</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">
  <div class="container mx-auto max-w-2xl p-6 flex-1">
    <h2 class="text-2xl font-bold mb-6">Create New Post</h2>

    <form method="post" class="bg-white shadow-md rounded-lg p-6 space-y-5">
      <div>
        <label class="block text-sm font-medium mb-2">Title</label>
        <input type="text" name="title" required
               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <div>
        <label class="block text-sm font-medium mb-2">Content</label>
        <textarea name="content" rows="6" required
                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
      </div>

      <button type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
        Save Post
      </button>
    </form>

    <p class="mt-6">
      <a href="dashboard.php" class="text-blue-600 hover:underline">← Back to Dashboard</a>
    </p>
  </div>
</body>
</html>
