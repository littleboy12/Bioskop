<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Film List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
  <style>
    /* Sidebar Styling */
    .sidebar {
      height: 100vh;
      width: 250px;
      background-color: #343a40;
      color: white;
      position: fixed;
      top: 0;
      left: -250px;
      transition: all 0.3s ease;
      z-index: 1040;
    }

    .sidebar.active {
      left: 0;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar ul li {
      padding: 15px 20px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar ul li a {
      text-decoration: none;
      color: white;
      display: flex;
      align-items: center;
    }

    .sidebar ul li a i {
      margin-right: 10px;
    }

    .sidebar ul li a:hover {
      color: #007bff;
    }

    /* Header Styling */
    .header {
      width: 100%;
      background-color: #007bff;
      color: white;
      padding: 15px 20px;
      position: fixed;
      top: 0;
      z-index: 1050;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .header h1 {
      margin: 0;
      font-size: 1.5rem;
    }

    .header .menu-btn {
      font-size: 1.5rem;
      background: none;
      border: none;
      color: white;
      cursor: pointer;
    }

    /* Main Content Styling */
    .main-content {
      margin-left: 0;
      padding: 80px 20px;
      background-color: #f8f9fa;
      min-height: 100vh;
      transition: margin-left 0.3s ease;
    }

    .main-content.collapsed {
        margin-left: 250px;
    }

    .card img {
      object-fit: cover;
    }

    .search-bar {
      margin-bottom: 20px;
    }

    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
      }

      .sidebar {
        width: 100%;
        left: -100%;
      }

      .sidebar.active {
        left: 0;
      }
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar" style="margin-top: 60px;" id="sidebar">
    <ul class="mt-2">
      <li><a href=""><i class="bi bi-house"></i> Home</a></li>
      <li><a href="./view_movie.php"><i class="bi bi-film"></i> Film List</a></li>
      <li><a href="./view_daftar_beli.php"><i class="bi bi-ticket"></i> Tickets</a></li>
      <li><a href="#"><i class="bi bi-person"></i> Profile</a></li>
      <li><a href="../services/Logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
    </ul>
  </div>

  <!-- Header -->
  <div class="header">
    <button class="menu-btn" onclick="toggleSidebar()">
      <i class="bi bi-list"></i>
    </button>
    <h1>Film List</h1>
  </div>

  <!-- Main Content -->
  <div class="main-content" id="mainContent">
   
  