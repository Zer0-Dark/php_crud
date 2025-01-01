
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


$sql = "DELETE FROM employee WHERE emp_id = $user_id";
mysqli_select_db($conn, $dbname);
$result = mysqli_query($conn, $sql);

if (! $result) {
    die('Could not get data: ' . mysqli_connect_error($result));
}




mysqli_close($conn);


header("Location:index.php");
exit();
?>