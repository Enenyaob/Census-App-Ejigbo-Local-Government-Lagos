<?php
 require_once("php/session.php");
 require_once("php/register.php");
 include('php/secure.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Field Operator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php include('layout/header.php');?>

    <div class="container">
        <div class="form-container">
            <h2 class="mb-4 text-center">Register Field Operator</h2>
            <form method="post" action="">
                <?php if(!empty($success)): ?>
                <div class="mb-1 alert alert-success" role="alert">
                    <i class="fa fa-check" aria-hidden="true"></i> <strong>Perfect!</strong> <?php echo $success; ?>
                </div>
                <?php endif; ?>
                <?php if(!empty($error)): ?>
                <div class="mb-1 alert alert-danger" role="alert">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <strong>Attention!</strong>
                    <ul>
                        <li><?php echo $error; ?></li>
                    </ul>
                </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">Surname</label>
                    <input type="text" class="form-control" id="surname" name="surname" required>
                </div>
                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
                <div class="mb-3">
                    <label for="othername" class="form-label">Other Name</label>
                    <input type="text" class="form-control" id="othername" name="othername">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password2" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password2" name="password2" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="sex" class="form-label">Sex</label>
                    <select class="form-select" id="sex" name="sex" required>
                        <option value="">Choose..</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="state_of_origin" class="form-label">State of Origin</label>
                    <select id="state2" class="form-select" name="state_of_origin" onchange="updateLGAs2()" required>
                        <option value="">Choose..</option>
                        <option value="abia">Abia</option>
                        <option value="adamawa">Adamawa</option>
                        <option value="akwa_ibom">Akwa Ibom</option>
                        <option value="anambra">Anambra</option>
                        <option value="bauchi">Bauchi</option>
                        <option value="bayelsa">Bayelsa</option>
                        <option value="benue">Benue</option>
                        <option value="borno">Borno</option>
                        <option value="cross_river">Cross River</option>
                        <option value="delta">Delta</option>
                        <option value="ebonyi">Ebonyi</option>
                        <option value="edo">Edo</option>
                        <option value="ekiti">Ekiti</option>
                        <option value="enugu">Enugu</option>
                        <option value="gombe">Gombe</option>
                        <option value="imo">Imo</option>
                        <option value="jigawa">Jigawa</option>
                        <option value="kaduna">Kaduna</option>
                        <option value="kano">Kano</option>
                        <option value="katsina">Katsina</option>
                        <option value="kebbi">Kebbi</option>
                        <option value="kogi">Kogi</option>
                        <option value="kwara">Kwara</option>
                        <option value="lagos">Lagos</option>
                        <option value="nasarawa">Nasarawa</option>
                        <option value="niger">Niger</option>
                        <option value="ogun">Ogun</option>
                        <option value="ondo">Ondo</option>
                        <option value="osun">Osun</option>
                        <option value="oyo">Oyo</option>
                        <option value="plateau">Plateau</option>
                        <option value="rivers">Rivers</option>
                        <option value="sokoto">Sokoto</option>
                        <option value="taraba">Taraba</option>
                        <option value="yobe">Yobe</option>
                        <option value="zamfara">Zamfara</option>
                        <option value="abuja">Abuja</option>
                    </select
                </div>
                <div class="mb-3">
                    <label for="local_government_of_origin" class="form-label">Local Government of Origin</label>
                    <select class="form-select" id="lga2" name="local_government_of_origin" required>
                        <option value="">Choose..</option>
                        <!-- Local governments will be dynamically loaded based on state selection -->
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/lga.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
