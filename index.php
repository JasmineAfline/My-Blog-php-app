<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Blog</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      background: #f9f9f9;
      color: #333;
    }

    /* Hero section */
    .hero {
      background: url('https://picsum.photos/1200/400') no-repeat center center/cover;
      height: 300px;
      display: flex;
      flex-direction: column; /* stack h2 + button */
      align-items: center;
      justify-content: center;
      color: white;
      text-align: center;
    }
    .hero h2 {
      font-size: 2.5rem;
      background: rgba(0,0,0,0.5);
      padding: 10px 20px;
      border-radius: 5px;
      margin-bottom: 20px;
    }
    .register-btn {
      background: #e74c3c;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
    }
    .register-btn:hover {
      background: #c0392b;
    }

    /* Posts grid */
    .container {
      width: 80%;
      margin: 20px auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }
    .post {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      padding: 15px;
    }
    .post img {
      width: 100%;
      border-radius: 8px;
    }
    .post h3 {
      margin: 15px 0 10px;
    }
    .post p {
      color: #555;
      margin-bottom: 10px;
    }
    .post a {
      display: inline-block;
      text-decoration: none;
      color: #3498db;
      font-weight: bold;
    }
    .post a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <!-- Navbar include -->
  <?php include 'layouts/navbar.php'; ?>

  <!-- Hero Section -->
  <section class="hero">
    <h2>Welcome to My Blog</h2>
    <a href="auth/register.php" class="register-btn">Get Started – Register</a>
  </section>

  <!-- Posts -->
  <section class="container">
    <article class="post">
      <img src="https://picsum.photos/400/200" alt="Post Image">
      <h3>First Blog Post</h3>
      <p>This is a short description of the first blog post. Click below to read more.</p>
      <a href="#">Read More →</a>
    </article>

    <article class="post">
      <img src="https://picsum.photos/401/200" alt="Post Image">
      <h3>Second Blog Post</h3>
      <p>This is a short description of the second blog post. Click below to read more.</p>
      <a href="#">Read More →</a>
    </article>

    <article class="post">
      <img src="https://picsum.photos/402/200" alt="Post Image">
      <h3>Third Blog Post</h3>
      <p>This is a short description of the third blog post. Click below to read more.</p>
      <a href="#">Read More →</a>
    </article>
  </section>

  <!-- Footer include -->
  <?php include 'layouts/footer.php'; ?>

</body>
</html>
