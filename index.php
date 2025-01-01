<!DOCTYPE html>
<html>

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>



<body class="p-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Users Details</h2>
            <button class="btn btn-success">
                <a class="nav-link" href="./userRegister.php">
                    <i class="fas fa-plus me-2"></i>Add New User
                </a>
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Mail Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr>
                        <td>7</td>
                        <td>user1</td>
                        <td>supervisor@iti.com</td>
                        <td>F</td>
                        <td>yes</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr> -->
                    <?php
                    #6
                    //select==get from to TABLE
                    $dbhost = 'localhost';
                    $dbuser = 'root';
                    $dbpass = 'e01278113288EE';
                    $dbname = 'lab4';
                    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

                    if (! $conn) {
                        die('Could not connect: ' . mysqli_connect_error($conn));
                    }


                    $sql = 'SELECT emp_id, emp_name, emp_mail , gender, mail_status FROM employee';
                    mysqli_select_db($conn, $dbname);
                    $result = mysqli_query($conn, $sql);

                    if (! $result) {
                        die('Could not get data: ' . mysqli_connect_error($result));
                    }


                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['emp_id'] . "</td>";
                            echo "<td>" . $row['emp_name'] . "</td>";
                            echo "<td>" . $row['emp_mail'] . "</td>";
                            echo "<td>" . $row['gender'] . "</td>";
                            echo "<td>" . ($row['mail_status'] ? "Yes" : "No") . "</td>";
                            echo '<td>
                                <div class="btn-group">
                                    <a href="view.php?id=' . $row['emp_id'] . '"  class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="edit.php?id=' . $row['emp_id'] . '" class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="delete.php?id=' . $row['emp_id'] . '" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>';

                            echo "<tr>";
                        }
                    } else {
                        echo "0 results";
                    }

                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>