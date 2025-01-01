<!DOCTYPE html>
<html>

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
// Get the user ID from the query parameter
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Sanitize the ID to prevent SQL injection or other vulnerabilities
    $user_id = intval($user_id); // Converts to an integer

    // Use $user_id for further processing (e.g., fetching user data from the database)
} else {
    echo "No user ID provided.";
}
#6
//select==get from to TABLE
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'lab4';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

if (! $conn) {
    die('Could not connect: ' . mysqli_connect_error($conn));
}


$sql = "SELECT emp_id, emp_name, emp_mail , gender, mail_status FROM employee where emp_id = '$user_id' ";
mysqli_select_db($conn, $dbname);
$result = mysqli_query($conn, $sql);

if (! $result) {
    die('Could not get data: ' . mysqli_connect_error($result));
}


if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {

        $viewd_id = $row['emp_id'];
        $viewd_name =  $row['emp_name'];
        $viewd_mail =   $row['emp_mail'];
        $viewd_gender =   $row['gender'];
        $viewd_mailStatus =  ($row['mail_status'] ? "You will recive mails from us" : "You won't recive mails from us");
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="card-title mb-4">View Record</h2>

                <div class="mb-4">
                    <h6 class="text-muted mb-2">Name</h6>
                    <p class="fs-5"><?php echo $viewd_name ?></p>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted mb-2">Email</h6>
                    <p class="fs-5"><?php echo $viewd_mail ?></p>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted mb-2">Gender</h6>
                    <p class="fs-5"><?php echo $viewd_gender ?></p>
                </div>

                <div class="mb-4">
                    <p class="text-muted"><?php echo $viewd_mailStatus ?></p>
                </div>

                <div>
                    <a href="./index.php" class="btn btn-primary px-4">Back</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>