<?php
 session_start();
 if(!isset( $_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
 }

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>DriveDeal - Cars</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    /* Reset and base */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #2b5876, #4e4376);
      color: #fff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      padding-bottom: 40px;
    }
    header {
      background-color: rgba(30, 30, 47, 0.95);
      padding: 20px 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 2px 10px rgba(0,0,0,0.4);
      position: sticky;
      top: 0;
      z-index: 100;
    }
    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
      cursor: default;
      user-select: none;
    }
    .car-icon {
      position: relative;
      width: 36px;
      height: 20px;
    }
    .car-body {
      position: absolute;
      top: 6px;
      left: 0;
      width: 36px;
      height: 8px;
      background-color: #ff6a00;
      border-radius: 4px 8px 6px 6px;
      box-shadow: 0 2px 5px rgba(255,106,0,0.6);
    }
    .wheel {
      position: absolute;
      bottom: 0;
      width: 8px;
      height: 8px;
      background-color: #1e1e2f;
      border-radius: 50%;
      box-shadow: inset -2px -2px 4px rgba(255,106,0,0.8);
    }
    .wheel-front {
      left: 4px;
    }
    .wheel-back {
      right: 4px;
    }
    .logo h1 {
      font-weight: 700;
      font-size: 1.8rem;
      letter-spacing: 2px;
      color: #ff6a00;
      text-shadow: 0 0 8px #ff6a00aa;
      margin: 0;
    }
    nav a {
      color: #fff;
      margin-left: 30px;
      text-decoration: none;
      font-weight: 600;
      font-size: 1rem;
      padding: 8px 15px;
      border-radius: 6px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }
    nav a:hover {
      background-color: #ff6a00;
      color: #1e1e2f;
      box-shadow: 0 4px 15px #ff6a00cc;
    }

    /* Page Title */
    .page-title {
      text-align: center;
      margin: 40px 20px 20px;
      font-size: 2.8rem;
      font-weight: 700;
      color: #ffb347;
      text-shadow: 0 3px 10px rgba(255, 180, 71, 0.9);
    }

    /* Car Listings Grid */
    .car-listings {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 30px;
      padding: 0 20px;
      color: #222;
    }
    .car-card {
      background: #fff;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    .car-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0,0,0,0.25);
    }
    .car-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-bottom: 5px solid #ff6a00;
      transition: transform 0.3s ease;
    }
    .car-card:hover img {
      transform: scale(1.05);
    }
    .car-card h3 {
      margin: 15px 0 10px;
      font-size: 1.3rem;
      color: #333;
    }
    .car-card p {
      color: #666;
      font-size: 0.95rem;
      padding: 0 15px 20px;
      flex-grow: 1;
    }

    footer {
      background-color: rgba(30, 30, 47, 0.95);
      color: #ccc;
      padding: 25px 20px;
      text-align: center;
      font-size: 0.9rem;
      box-shadow: inset 0 1px 3px rgba(255, 255, 255, 0.1);
      margin-top: 40px;
    }

    /* Responsive */
    @media (max-width: 600px) {
      nav a {
        margin-left: 15px;
        font-size: 0.9rem;
      }
      .page-title {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>

  <header>
    <div class="logo">
      <div class="car-icon">
        <div class="car-body"></div>
        <div class="wheel wheel-front"></div>
        <div class="wheel wheel-back"></div>
      </div>
      <h1>DriveDeal</h1>
    </div>
    <nav>
      <a href="../index.php" aria-label="Home">Home</a>
      <a href="cars.php" aria-label="Cars">Cars</a>
      <a href="about.php" aria-label="About">About</a>
      <a href="#" aria-label="Logout" onclick="confirm_logout()">Logout</a>
    </nav>
  </header>

  <h2 class="page-title">Available Cars</h2>

  <section class="car-listings" aria-label="All Cars for Sale">
    <div class="car-card" tabindex="0">
      <img src="assets/images/toyota1.jpg" alt="Red sports car" />
      <h3>2023 Mustang GT</h3>
      <p>Powerful V8 engine with sleek design and top performance.</p>
    </div>
    <div class="car-card" tabindex="0">
      <img src="assets/images/sizuki2.jpg" alt="Luxury sedan" />
      <h3>2024 Mercedes-Benz S-Class</h3>
      <p>Luxury meets technology with premium comfort and advanced features.</p>
    </div>
    <div class="car-card" tabindex="0">
      <img src="assets/images/mercedes5.jpg" alt="Electric SUV" />
      <h3>Tesla Model X</h3>
      <p>Innovative electric SUV with impressive range and autopilot features.</p>
    </div>
    <div class="car-card" tabindex="0">
      <img src="assets/images/mustang4.jpg" alt="Blue hatchback" />
      <h3>2022 Honda Civic</h3>
      <p>Compact and reliable with modern design and fuel efficiency.</p>
    </div>
    <div class="car-card" tabindex="0">
      <img src="assets/images/honda3.jpg" alt="White SUV" />
      <h3>2023 Toyota RAV4</h3>
      <p>Versatile SUV with advanced safety and spacious interior.</p>
    </div>
    <!-- Add more car cards as you want -->
  </section>

  <footer>
    &copy; 2025 DriveDeal. All rights reserved. | Designed with ❤️
  </footer>

  <script>
    function confirm_logout(){
      if(confirm("Are you sure you want to logout?")){
          window.location.href = "logout.php";
      }

    }
  </script>

</body>
</html>
