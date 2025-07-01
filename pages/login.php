<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: cars.php");
            exit();
        } else {
            $_SESSION['error'] = "Incorrect password.";
        }
    } else {
        $_SESSION['error'] = "User not found.";
    }

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register</title>
  <style>

    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      /* background: #f7f9f9; */
      background: linear-gradient(180deg, rgba(12, 12, 22, 0.75) 10%);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      padding: 20px;
    }

    form {
      background: #fff;
      width: 450px;
      border-radius: 8px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.08);
      padding: 30px 35px;
    }

    .header-bar {
      background: #dff3ea;
      color: #444;
      font-weight: 600;
      text-align: center;
      padding: 10px 0;
      margin-bottom: 25px;
      border-radius: 4px;
      font-size: 20px;
      letter-spacing: 0.03em;
      font-weight: bold;
    }

    label {
      font-size: 12px;
      color: #777;
      font-weight: 600;
      display: inline-block;
      margin-bottom: 6px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px 14px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
      color: #333;
      transition: border-color 0.3s ease;
    }

    input::placeholder {
      color: #aaa;
      font-size: 13px;
    }

    input:focus {
      border-color: #2c9c69;
      outline: none;
      box-shadow: 0 0 8px rgba(44,156,105,0.3);
    }

    button {
      width: 100%;
      background-color: #2c9c69;
      border: none;
      color: white;
      font-size: 16px;
      font-weight: 700;
      padding: 12px;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #267a52;
    }
  </style>
</head>
<body>
  <form method="POST" novalidate>

    <?php
        if (isset($_SESSION['success'])) {
        echo '<div style="padding:10px; color:green; font-weight:bold;">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
        }

        if (isset($_SESSION['error'])) {
        echo '<div style="padding:10px; color:red; font-weight:bold;">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
        }
    ?>

    <div class="header-bar">
      Login Portal
    </div>

    <label for="username">UserName</label>
    <input id="username" name="username" type="text" placeholder="Username" required />

    <label for="password">Password</label>
    <input id="password" name="password" type="password" placeholder="Password" required />

    <div style="margin: -10px 0 20px;">
        <input type="checkbox" id="showPassword" />
        <label for="showPassword" style="font-size: 13px; color: #555;">Show Password</label>
    </div>


    <button type="submit">Login</button>

    <p style="text-align: center; margin-top: 16px; font-size: 14px; color: #555;">
        Create an account? <a href="register.php" style="color: #2c9c69; text-decoration: none;">Register</a><br><br>
        <a href="../index.php" style="color: #2c9c69; text-decoration: none;">Back to dashboard</a>
    </p>

    
  </form>

    <script>
        const passwordInput = document.getElementById("password");
        const showPassword = document.getElementById("showPassword");

        showPassword.addEventListener("change", function () {
            passwordInput.type = this.checked ? "text" : "password";
        });
    </script>
</body>
</html>
