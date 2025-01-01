<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
$name = $email = $gender = $mailStatus = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $mailStatus = isset($_POST["mail_status"]) ? 1 : 0;


    //insert data to TABLE
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = 'e01278113288EE';
    $dbname = 'lab4';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

    if (! $conn) {
        die('Could not connect: ' . mysqli_connect_error($conn));
    }


    //select
    mysqli_select_db($conn, $dbname);

    //create table
    $sql = "INSERT INTO employee(emp_name,emp_mail, gender, mail_status) 
VALUES ( '$name', '$email', '$gender', $mailStatus)";

    $retval = mysqli_query($conn, $sql);

    if (! $retval) {
        die('Could not insert to table: ' . mysqli_connect_error($retval));
    }

    mysqli_close($conn);


    header("Location:index.php");
    exit();
}





?>

<body>
    <div class="container mt-5">
        <h2 class="text-center">User Registration Form</h2>
        <p class="text-center">Please fill this form and submit to add a user record to the database.</p>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" required>
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>" required>
            </div>
            <!-- Gender -->
            <div class="mb-3">
                <label class="form-label">Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="F" required>
                    <label class="form-check-label" for="genderFemale">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="genderMale" value="M">
                    <label class="form-check-label" for="genderMale">Male</label>
                </div>
            </div>
            <!-- Mail Status -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="mailStatus" name="mail_status" value="1">
                <label class="form-check-label" for="mailStatus">
                    Receive E-Mails from us.
                </label>
            </div>
            <!-- Buttons -->
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>