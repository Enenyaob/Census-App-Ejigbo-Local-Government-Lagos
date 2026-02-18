<?php
require_once('php/session.php');
require_once('php/add_census_data.php');

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Census</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<style>
label.required::after {
  content: " *";
  color: red;
}
</style>
</head>

<body>
<?php include('layout/header.php');?>

<div class="container my-4">
<div class="card shadow-sm">
<div class="card-body">

<h3 class="mb-3">Add Census Data</h3>

<form method="post" autocomplete="off">

<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

<?php if(!empty($success)): ?>
<div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($error as $e): ?>
                <li><?php echo htmlspecialchars($e); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- ================= PERSONAL ================= -->

<h5 class="text-primary mt-3">Personal Information</h5>

<div class="row">
<div class="col-md-6 mb-3">
<label class="required">Household ID</label>
<input type="text" class="form-control" name="household_id"
maxlength="30"
value="<?= htmlspecialchars($_POST['household_id'] ?? '') ?>" required>
</div>

<div class="col-md-6 mb-3">
<label class="required">Ward</label>
<select class="form-select" name="ward" required>
<option value="">Choose..</option>
<?php
$wards = ["Aigbaka","Ailegun","Fadu","Ifoshi","Ilamose","Oke-Afa"];
foreach ($wards as $w) {
$sel = ($_POST['ward'] ?? '')==$w?'selected':'';
echo "<option $sel>$w</option>";
}
?>
</select>
</div>
</div>

<div class="row">
<div class="col-md-4 mb-3">
<label class="required">Surname</label>
<input type="text" class="form-control"
pattern="[A-Za-z\s\-']+"
maxlength="50"
name="surname"
value="<?= htmlspecialchars($_POST['surname'] ?? '') ?>" required>
</div>

<div class="col-md-4 mb-3">
<label class="required">First Name</label>
<input type="text" class="form-control"
pattern="[A-Za-z\s\-']+"
maxlength="50"
name="firstname"
value="<?= htmlspecialchars($_POST['firstname'] ?? '') ?>" required>
</div>

<div class="col-md-4 mb-3">
<label>Other Name</label>
<input type="text" class="form-control"
maxlength="50"
name="othername"
value="<?= htmlspecialchars($_POST['othername'] ?? '') ?>">
</div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
    <label class="required">Current Age</label>
    <input type="number" class="form-control"
    id="current_age"
    name="current_age"
    min="0" max="120"
    value="<?= htmlspecialchars($_POST['current_age'] ?? '') ?>" required>
    </div>

    <div class="col-md-4 mb-3">
    <label class="required">Sex</label>
    <select class="form-select" name="sex" required>
    <option value="">Choose..</option>
    <option value="Male" <?= ($_POST['sex']??'')=='Male'?'selected':'' ?>>Male</option>
    <option value="Female" <?= ($_POST['sex']??'')=='Female'?'selected':'' ?>>Female</option>
    </select>
    </div>

    <div class="col-md-4 mb-3">
    <label class="required">Date of Birth</label>
    <input type="date" class="form-control"
    id="date_of_birth"
    name="date_of_birth"
    value="<?= htmlspecialchars($_POST['date_of_birth'] ?? '') ?>" required>
    </div>


    <!-- ================= OCCUPATION ================= -->

    <div class="col-md-6 mb-3">
    <label class="required">Occupation</label>
    <select class="form-select" name="occupation" required>
    <option value="">Choose..</option>
    <?php
    $occ = ["Agriculture","Education","Healthcare","Construction","Information Technology",
    "Manufacturing","Retail","Finance","Transport","Hospitality","Government",
    "Self-Employed","Unemployed","Student","Other"];
    foreach ($occ as $o) {
    $sel = ($_POST['occupation'] ?? '')==$o?'selected':'';
    echo "<option $sel>$o</option>";
    }
    ?>
    </select>
    </div>

    <div class="col-md-6 mb-3">
    <label class="required">Disability Status</label>
    <select class="form-select" name="disability_status" required>
    <option value="">Choose..</option>
    <option value="No" <?= ($_POST['disability_status']??'')=='No'?'selected':'' ?>>No</option>
    <option value="Yes" <?= ($_POST['disability_status']??'')=='Yes'?'selected':'' ?>>Yes</option>
    </select>
    </div>
</div>

<!-- ================= ORIGIN ================= -->

<h5 class="text-primary mt-4">Origin Details</h5>

<div class="mb-3">
<label class="required">State of Birth</label>
<select id="state" class="form-select" name="state_of_birth" onchange="updateLGAs()" required>
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
</select>
</div>

<div class="mb-3">
<label class="required">LGA of Birth</label>
<select class="form-select" id="lga" name="local_government_of_birth" required>
<option value="">Choose..</option>
</select>
</div>

<div class="mb-3">
<label class="required">State of Origin</label>
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
</select>
</div>

<div class="mb-3">
<label class="required">LGA of Origin</label>
<select class="form-select" id="lga2" name="local_government_of_origin" required>
<option value="">Choose..</option>
</select>
</div>

<!-- ================= IDENTITY ================= -->

<h5 class="text-primary mt-4">Identity & Location</h5>

<div class="mb-3">
<label>NIN (Only if 18+)</label>
<input type="text"
class="form-control"
id="nin"
name="national_identity_number"
pattern="[0-9]{11}"
maxlength="11"
inputmode="numeric"
value="<?= htmlspecialchars($_POST['national_identity_number'] ?? '') ?>">
</div>

<div class="mb-3">
<label class="required">Address</label>
<input type="text"
class="form-control"
maxlength="150"
name="address"
value="<?= htmlspecialchars($_POST['address'] ?? '') ?>" required>
</div>

<input type="hidden" id="latitude" name="latitude">
<input type="hidden" id="longitude" name="longitude">
<input type="hidden" id="gps_accuracy" name="gps_accuracy">

<div id="gps-status" class="form-text text-success"></div>

<button type="submit" class="btn btn-primary w-100"
onclick="this.disabled=true; this.form.submit();">
Submit Census Record
</button>

</form>
</div>
</div>
</div>



<script>
document.getElementById("current_age").addEventListener("input", function() {
document.getElementById("nin").required = this.value >= 18;
});

document.getElementById("gps-status").innerText =
"Location captured automatically when allowed.";
</script>
<script src="js/cal_age.js"></script>
<script src="js/lga.js"></script>
<script src="js/getLocation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>