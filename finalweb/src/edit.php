<?php
// Database configuration
$host = "localhost"; // Change this if your database is hosted on a different server
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "webdevproject"; // Change this to your database name

// Establishing connection to the database
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to fetch all records from the "mpp_acc" table
function fetchAllRecords()
{
    global $conn;
    $query = "SELECT * FROM mpp_acc";
    $result = mysqli_query($conn, $query);
    $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $records;
}

// Function to delete a row from the "mpp_acc" table
function deleteRecord($MPP_id)
{
    global $conn;

    // Prepare the delete statement
    $query = "DELETE FROM mpp_acc WHERE MPP_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, 's', $MPP_id);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    // Reorganize the ID column sequentially
    reorganizeIDs();
}

// Function to update an existing row in the "mpp_acc" table
function updateRecord($MPP_id, $columnName, $columnValue)
{
    global $conn;

    // Prepare the update statement with placeholders
    $query = "UPDATE mpp_acc SET $columnName = ? WHERE MPP_id = ?";

    // Create a prepared statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, 'ss', $columnValue, $MPP_id);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    // Reorganize the ID column sequentially
    reorganizeIDs();
}

// Function to reorganize the ID column sequentially
function reorganizeIDs()
{
    global $conn;

    // Create a temporary table with the desired ID sequence
    $query = "CREATE TEMPORARY TABLE temp_mpp_acc AS SELECT * FROM mpp_acc ORDER BY MPP_id ASC";
    mysqli_query($conn, $query);

    // Clear the original table
    $query = "TRUNCATE TABLE mpp_acc";
    mysqli_query($conn, $query);

    // Copy the records from the temporary table to the original table
    $query = "INSERT INTO mpp_acc SELECT * FROM temp_mpp_acc";
    mysqli_query($conn, $query);

    // Drop the temporary table
    $query = "DROP TABLE temp_mpp_acc";
    mysqli_query($conn, $query);
}

// Function to insert a new row into the "mpp_acc" table
function createRecord($MPP_name, $MPP_password, $EXCO_id, $FACULTY_id)
{
    global $conn;
    $query = "INSERT INTO mpp_acc (MPP_name, MPP_password, EXCO_id, FACULTY_id) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssii', $MPP_name, $MPP_password, $EXCO_id, $FACULTY_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Fetch all records from the "mpp_acc" table
$records = fetchAllRecords();

// Close the database connection
mysqli_close($conn);
?>


<!-- HTML code to display the records and provide a form for editing and deleting -->

<!DOCTYPE html>
<html>
<head>
    <title>MPP Records</title>
    <link rel="stylesheet" href="allexco.css" />
</head>
<style>
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

input[type="text"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #5e0c0c;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    
}

input[type="submit"]:hover {
    background-color: #7f1616;
}

label {
    margin-top: 10px;
    display: block;
    
}

</style>
<header>
    <nav>
      <div class="navbar">
        <i class="fas fa-bars"></i>
        <div class="logo">
          <a href="#">
            <img src="MPP_Logo.png" alt="MPP Logo" />
          </a>
        </div>
        <div class="nav-links">
          <ul class="menus">
            <li>
              <a class="waves" href="http://localhost/finalweb/Home/Home/visitor_homepage.html">
                <span style="--spell: 1">H</span>
                <span style="--spell: 2">o</span>
                <span style="--spell: 3">m</span>
                <span style="--spell: 4">e</span>
              </a>
            </li>
            <li>
              <a class="waves" href="http://localhost/finalweb/Exco/all exco/allexco.html">
                <span style="--spell: 1">E</span>
                <span style="--spell: 2">X</span>
                <span style="--spell: 3">C</span>
                <span style="--spell: 4">O</span>
              </a>
            </li>
            <li>
              <a class="waves" href="http://localhost/finalweb/news/newsupd.html" >
                <span style="--spell: 1;">N</span>
                <span style="--spell: 2; ">e</span>
                <span style="--spell: 3; ">W</span>
                <span style="--spell: 4; ">S</span>
              </a>
            </li>
            <li>
              <a class="waves" href="http://localhost/finalweb/feedback/form.html">
                <span style="--spell: 1">C</span>
                <span style="--spell: 2">O</span>
                <span style="--spell: 3">M</span>
                <span style="--spell: 4">P</span>
                <span style="--spell: 5">L</span>
                <span style="--spell: 6">A</span>
                <span style="--spell: 7">I</span>
                <span style="--spell: 8">N</span>
              </a>
            </li>
            <li>
              <a class="waves" href="http://localhost/finalweb/src/login.php" style="background-color: #5e0c0c;" >
                <span style="--spell: 1; color: white;">S</span>
                <span style="--spell: 2; color: white;">R</span>
                <span style="--spell: 3; color: white;">C</span>
                <span style="--spell: 4; color: white;">-</span>
                <span style="--spell: 5; color: white;">L</span>
                <span style="--spell: 6; color: white;">O</span>
                <span style="--spell: 7; color: white;">G</span>
                <span style="--spell: 8; color: white;">I</span>
                <span style="--spell: 9; color: white;">N</span>
                
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>    
  <body style="background-image: url('bg.png'); background-size: cover;">
<h1 style="text-align: center;">MPP RECORDS</h1>

    <!-- Display the records -->
    <?php if (!empty($records)) : ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="action" value="update">
           <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table>
        <tr>
            <th>MPP ID</th>
            <th>MPP Name</th>
            <th>MPP Password</th>
            <th>EXCO ID</th>
            <th>FACULTY ID</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($records as $record) : ?>
            <tr>
                <td><?php echo $record['MPP_id']; ?></td>
                <td>
                    <input type="hidden" name="columns[<?php echo $record['MPP_id']; ?>][MPP_id]" value="<?php echo $record['MPP_id']; ?>">
                    <input type="text" name="columns[<?php echo $record['MPP_id']; ?>][MPP_name]" value="<?php echo $record['MPP_name']; ?>">
                </td>
                <td>
                    <input type="text" name="columns[<?php echo $record['MPP_id']; ?>][MPP_password]" value="<?php echo $record['MPP_password']; ?>">
                </td>
                <td>
                    <input type="text" name="columns[<?php echo $record['MPP_id']; ?>][EXCO_id]" value="<?php echo $record['EXCO_id']; ?>">
                </td>
                <td>
                    <input type="text" name="columns[<?php echo $record['MPP_id']; ?>][FACULTY_id]" value="<?php echo $record['FACULTY_id']; ?>">
                </td>
                <td>
                    <input type="hidden" name="delete_ids[]" value="<?php echo $record['MPP_id']; ?>">
                    <button type="button" onclick="confirmDelete(this)">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <input type="submit" name="update" value="Update" style="margin-left: 237px;">
</form>

<script>
    function confirmDelete(button) {
        if (confirm('Are you sure you want to delete this record?')) {
            button.parentNode.parentNode.remove();
        }
    }
</script>



<script>
    function deleteRow(button) {
        // Get the row element
        var row = button.parentNode.parentNode;
        // Remove the row
        row.parentNode.removeChild(row);
    }
</script>

            
        </form>
    <?php else : ?>
        <p>No records found.</p>
    <?php endif; ?>

    <!-- Form for creating a new record -->
    <div style="margin: 250px;">
    <h2>Create New Record</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="action" value="create">
        <label for="MPP_name">MPP Name:</label>
        <input type="text" name="new_record[MPP_name]" required>
        <label for="MPP_password">MPP Password:</label>
        <input type="text" name="new_record[MPP_password]" required>
        <label for="EXCO_id">EXCO ID:</label>
        <input type="text" name="new_record[EXCO_id]" required>
        <label for="FACULTY_id">FACULTY ID:</label>
        <input type="text" name="new_record[FACULTY_id]" required>
        <input type="submit" value="Create">
    </form>
    </div>
</body>

</html>
