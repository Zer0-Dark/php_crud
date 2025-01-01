<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'e01278113288EE';
$dbname = 'lab4';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

mysqli_select_db($conn, $dbname);

// Get user data for editing
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employee WHERE emp_id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        die('User not found');
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $mailStatus = isset($_POST["mail_status"]) ? 1 : 0;

    $sql = "UPDATE employee SET 
            emp_name = '$name',
            emp_mail = '$email',
            gender = '$gender',
            mail_status = $mailStatus
            WHERE emp_id = $id";

    $retval = mysqli_query($conn, $sql);

    if (!$retval) {
        die('Could not update data: ' . mysqli_connect_error($conn));
    }

    mysqli_close($conn);
    header("Location: index.php");
    exit();
}
?>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit User Form</h2>
        <p class="text-center">Please update the form below to modify the user record.</p>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $user['emp_id']; ?>">

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="<?php echo $user['emp_name']; ?>" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?php echo $user['emp_mail']; ?>" required>
            </div>

            <!-- Gender -->
            <div class="mb-3">
                <label class="form-label">Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="genderFemale"
                        value="F" <?php if ($user['gender'] == 'F') echo 'checked'; ?> required>
                    <label class="form-check-label" for="genderFemale">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="genderMale"
                        value="M" <?php if ($user['gender'] == 'M') echo 'checked'; ?>>
                    <label class="form-check-label" for="genderMale">Male</label>
                </div>
            </div>

            <!-- Mail Status -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="mailStatus" name="mail_status"
                    value="1" <?php if ($user['mail_status'] == 1) echo 'checked'; ?>>
                <label class="form-check-label" for="mailStatus">
                    Receive E-Mails from us.
                </label>
            </div>

            <!-- Buttons -->
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>