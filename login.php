<?php
include('php/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
  if ($result && password_verify($password, $row['password'])) {
    session_start();
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['user_id'] = $row['user_id'];
    if($_SESSION['role'] == 'admin' ){
      header('Location: dashboard');
      exit;
    }elseif($_SESSION['role'] == 'field_operator'){
      header('Location: operator_dashboard');
      exit;
    }
  }else{
    $error = 'Enter correct email and password';
  }
}else {
        $error = 'Incorrect username or password.';
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Census App Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="form-container">
            <?php if(isset($error)) : ?>
          <div class="mb-1 alert alert-danger" role="alert">
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Attention! <?php echo $error; ?>
          </div>
          <?php else : ?>
          <?php endif; ?> 
            <h2 class="card-title">Census App Login</h2>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
    </div>
</div>
</body>
</html>
