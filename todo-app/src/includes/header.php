<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TODO APP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">


</head>

<body class=" d-flex flex-column min-vh-100 bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-sm bg-secondary text-light">

    <ul class="navbar-nav m-auto">
      <?php

      if (!isset($_SESSION['id'])) {
        echo '<li class="nav-item">
        <a class="nav-link text-light" href="index.php">
          Login
        </a>
      </li>';
        echo '<li class="nav-item">
        <a class="nav-link text-light" href="register_user.php">
          Cadastre-se
        </a>
      </li>';
      } else {
        echo '<li class="nav-item">
        <a class="nav-link text-light" href="home.php">
          Home
        </a>
      </li>';
        echo '<li class="nav-item">
        <a class="nav-link text-light" href="logout.php">
          Logout
        </a>
      </li>';
      }

      ?>
    </ul>
  </nav>
  <!-- Navbar -->
  <div class="container">