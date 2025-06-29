<?php
// You can add session check here in real apps: session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard - DriveDeal</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Poppins', sans-serif;
      display: flex;
      background-color:rgb(74, 78, 72);
    }
    aside {
      width: 240px;
      height: 100vh;
      background-color: #1e1e2f;
      color: white;
      padding: 20px;
      position: fixed;
      overflow-y: auto;
    }
    aside h2 {
      color: #ff6a00;
      margin-bottom: 30px;
      text-align: center;
    }
    aside a {
      display: block;
      color: #fff;
      text-decoration: none;
      padding: 12px;
      border-radius: 6px;
      margin-bottom: 10px;
      transition: 0.3s;
      cursor: pointer;
    }
    aside a:hover {
      background-color: #ff6a00;
    }
    /* Submenu container */
    .submenu {
      margin-left: 15px;
      margin-bottom: 10px;
      display: none;
      flex-direction: column;
    }
    /* Submenu links */
    .submenu a {
      padding: 8px 12px;
      background-color: #2a2a42;
      font-size: 0.9rem;
      margin-bottom: 6px;
      border-radius: 5px;
    }
    .submenu a:hover {
      background-color: #ff6a00;
      color: #1e1e2f;
    }
    /* Show submenu when active */
    .submenu.show {
      display: flex;
    }
    /* Arrow icon for dropdown */
    .dropdown-arrow {
      float: right;
      transition: transform 0.3s ease;
    }
    .dropdown-arrow.rotate {
      transform: rotate(90deg);
    }
    main {
      margin-left: 240px;
      padding: 30px;
      flex: 1;
    }
    .card {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    .card h3 {
      margin-bottom: 10px;
      color: #333;
    }
    .stats {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }
    .stat-box {
      flex: 1 1 200px;
      background: #ff6a00;
      color: white;
      border-radius: 10px;
      padding: 20px;
      text-align: center;
    }
    .stat-box h4 {
      font-size: 1.2rem;
    }
    .stat-box span {
      font-size: 2rem;
      font-weight: bold;
      display: block;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <aside>
    <h2>Admin Panel</h2>
    <a href="dashboard.php">Dashboard</a>
    <a id="manageCarToggle">Manage Car
      <span class="dropdown-arrow">&#9656;</span>
    </a>
    <div class="submenu" id="manageCarSubmenu">
      
      <a href="view_cars.php">View Cars</a>
      <a href="edit_car.php">Edit Car</a>
      <a href="delete_car.php">Delete Car</a>
    </div>
    <a href="users.php">View Users</a>
    <a href="logout.php">Logout</a>
  </aside>
  <main>
   
    <div class="stats">
      <div class="stat-box">
        <h4>Total Cars</h4>
        <span>25</span>
      </div>
      <div class="stat-box">
        <h4>Registered Users</h4>
        <span>120</span>
      </div>
      <div class="stat-box">
        <h4>New Messages</h4>
        <span>4</span>
      </div>
    </div>
  </main>

  <script>
    const toggleBtn = document.getElementById('manageCarToggle');
    const submenu = document.getElementById('manageCarSubmenu');
    const arrow = toggleBtn.querySelector('.dropdown-arrow');

    toggleBtn.addEventListener('click', () => {
      submenu.classList.toggle('show');
      arrow.classList.toggle('rotate');
    });
  </script>
</body>
</html>
