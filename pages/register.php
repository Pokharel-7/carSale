<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
   //$password = password_hash($password, PASSWORD_DEFAULT);  //  for password hashing

     if (empty($name) || empty($address) || empty($phone) || empty($email) || empty($username) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
    } else {
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['error'] = "Email already registered.";
    } else {

        $stmt = $conn->prepare("INSERT INTO users (name, address, phone, email, username, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $address, $phone, $email, $username, $password);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Registration successful.";
        } else {
            $_SESSION['error'] = "Error: " . $stmt->error;
        }
    }
    }
    header("Location: " . $_SERVER['PHP_SELF']);
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
      background: #f7f9f9;
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
      Online Registration
    </div>

    <label for="name">Name</label>
    <input id="name" name="name" type="text" placeholder="First and Last Name" required />

    <label for="address">Address</label>
    <input id="address" name="address" type="text" placeholder="Your address" required />

    <label for="phone">Contact</label>
    <input id="phone" name="phone" type="text" placeholder="Phone number" required />

    <label for="email">Email</label>
    <input id="email" name="email" type="email" placeholder="Email Address" required />

    <label for="username">UserName</label>
    <input id="username" name="username" type="text" placeholder="Username" required />

    <label for="password">Password</label>
    <input id="password" name="password" type="password" placeholder="Password" required />

    <div style="margin: -10px 0 20px;">
        <input type="checkbox" id="showPassword" />
        <label for="showPassword" style="font-size: 13px; color: #555;">Show Password</label>
    </div>


    <button type="submit">Register</button>

    <p style="text-align: center; margin-top: 16px; font-size: 14px; color: #555;">
        Already registered? <a href="login.php" style="color: #2c9c69; text-decoration: none;">Login</a><br><br>
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
