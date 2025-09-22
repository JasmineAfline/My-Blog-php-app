<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../auth/login.php");
  exit();
}
include("../config.php");

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM posts WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Posts</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">
  <div class="container mx-auto p-6 flex-1">
    <h2 class="text-2xl font-bold mb-6">Your Posts</h2>

    <a href="create_post.php" 
       class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg mb-4">
       + Create New Post
    </a>

    <div class="overflow-x-auto shadow-md rounded-lg bg-white">
      <table class="w-full border-collapse">
        <thead class="bg-gray-200">
          <tr>
            <th class="py-3 px-4 text-left">ID</th>
            <th class="py-3 px-4 text-left">Title</th>
            <th class="py-3 px-4 text-left">Created</th>
            <th class="py-3 px-4 text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="border-b hover:bg-gray-50">
              <td class="py-2 px-4"><?php echo $row['id']; ?></td>
              <td class="py-2 px-4 font-medium"><?php echo htmlspecialchars($row['title']); ?></td>
              <td class="py-2 px-4"><?php echo $row['created_at']; ?></td>
              <td class="py-2 px-4 text-center space-x-2">
                <a href="edit_post.php?id=<?php echo $row['id']; ?>" 
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                   Edit
                </a>
                <a href="delete_post.php?id=<?php echo $row['id']; ?>" 
                   onclick="return confirm('Delete this post?');" 
                   class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                   Delete
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <p class="mt-6">
      <a href="dashboard.php" class="text-blue-600 hover:underline">← Back to Dashboard</a>
    </p>
  </div>
</body>
</html>
 