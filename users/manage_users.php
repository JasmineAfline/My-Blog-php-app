<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../auth/login.php");
  exit();
}

include("../config.php");

// Only admins should manage users
if ($_SESSION['role'] !== 'admin') {
  echo "Access denied.";
  exit();
}

// Fetch all users
$sql = "SELECT id, username, email, role, created_at FROM users";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">
  <div class="container mx-auto p-6 flex-1">
    <h2 class="text-2xl font-bold mb-6">Manage Users</h2>


    <div class="overflow-x-auto shadow-md rounded-lg bg-white">
      <table class="w-full border-collapse">
        <thead class="bg-gray-200">
          <tr>
            <th class="py-3 px-4 text-left">ID</th>
            <th class="py-3 px-4 text-left">Username</th>
            <th class="py-3 px-4 text-left">Email</th>
            <th class="py-3 px-4 text-left">Role</th>
            <th class="py-3 px-4 text-left">Created</th>
            <th class="py-3 px-4 text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="border-b hover:bg-gray-50">
              <td class="py-2 px-4"><?php echo $row['id']; ?></td>
              <td class="py-2 px-4"><?php echo htmlspecialchars($row['username']); ?></td>
              <td class="py-2 px-4"><?php echo htmlspecialchars($row['email']); ?></td>
              <td class="py-2 px-4">
                <span class="px-2 py-1 rounded-full text-sm 
                  <?php echo $row['role'] === 'admin' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600'; ?>">
                  <?php echo htmlspecialchars($row['role']); ?>
                </span>
              </td>
              <td class="py-2 px-4"><?php echo $row['created_at']; ?></td>
              <td class="py-2 px-4 text-center space-x-2">
                <a href="edit_user.php?id=<?php echo $row['id']; ?>" 
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                   Edit
                </a>
                <a href="delete_user.php?id=<?php echo $row['id']; ?>" 
                   onclick="return confirm('Delete this user?');" 
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
