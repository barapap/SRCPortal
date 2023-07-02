<?php
// Database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'webdevproject';

// Create a connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die('Error: Unable to connect to the database');
}

// Query to retrieve data from the table
$query = "SELECT * FROM programs_update";

// Execute the query
$result = mysqli_query($connection, $query);

// Check if the query was successful
if ($result) {
    // Display the table content
    echo '<style>
        body {
            font-size: 14px;
            padding-top: 100px;
            padding-bottom: 100px;
        }

        h1 {
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 70%;
            margin: 0 auto;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
        }

        th {
            background-color: #e6e6e6;
            font-weight: bold;
            font-size: 16px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .poster-img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>';
    echo '<form method="post" action="">';
    echo '<table>
            <tr>
                <th>UPDATE_id</th>
                <th>EXCO_id</th>
                <th>UPDATE_title</th>
                <th>UPDATE_content</th>
                <th>UPDATE_poster</th>
            </tr>';

    // Loop through the rows of the result
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td><input type="text" name="UPDATE_id[]" value="' . $row['UPDATE_id'] . '"></td>';
        echo '<td><input type="text" name="EXCO_id[]" value="' . $row['EXCO_id'] . '"></td>';
        echo '<td><input type="text" name="UPDATE_title[]" value="' . $row['UPDATE_title'] . '"></td>';
        echo '<td><input type="text" name="UPDATE_content[]" value="' . $row['UPDATE_content'] . '"></td>';
        echo '<td><img class="poster-img" src="data:image/jpeg;base64,' . base64_encode($row['UPDATE_poster']) . '"></td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '<input type="submit" value="Update">
    </form>';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the updated values
        $updateIds = $_POST['UPDATE_id'];
        $excoIds = $_POST['EXCO_id'];
        $updateTitles = $_POST['UPDATE_title'];
        $updateContents = $_POST['UPDATE_content'];

        // Prepare and execute the update statements
        for ($i = 0; $i < count($updateIds); $i++) {
            $updateId = $updateIds[$i];
            $excoId = $excoIds[$i];
            $updateTitle = $updateTitles[$i];
            $updateContent = $updateContents[$i];

            $updateQuery = "UPDATE programs_update SET
                            EXCO_id = '$excoId',
                            UPDATE_title = '$updateTitle',
                            UPDATE_content = '$updateContent'
                            WHERE UPDATE_id = '$updateId'";

            mysqli_query($connection, $updateQuery);
        }

        // Redirect to the page to display the updated content
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
} else {
    // Display an error message if the query fails
    echo 'Error: ' . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
?>
