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

// Fetch post
$sql = "SELECT * FROM posts WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $post_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    die("Unauthorized or post not found.");
}

// Update post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    $sql = "UPDATE posts SET title=?, content=? WHERE id=? AND user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $title, $content, $post_id, $user_id);
    $stmt->execute();

    header("Location: manage_posts.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Post</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">
  <div class="container mx-auto max-w-2xl p-6 flex-1">
    <h2 class="text-2xl font-bold mb-6">Edit Post</h2>

    <form method="post" class="bg-white shadow-md rounded-lg p-6 space-y-5">
      <div>
        <label class="block text-sm font-medium mb-2">Title</label>
        <input type="text" name="title" required
               value="<?php echo htmlspecialchars($post['title']); ?>"
               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <div>
        <label class="block text-sm font-medium mb-2">Content</label>
        <textarea name="content" rows="6" required
                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo htmlspecialchars($post['content']); ?></textarea>
      </div>

      <div class="flex items-center space-x-3">
        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
          Update Post
        </button>
        <a href="manage_posts.php"
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
          Cancel
        </a>
      </div>
    </form>
  </div>
</body>
</html>
