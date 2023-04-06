<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Expense Tracker</title>
    <link rel="stylesheet" href="style.css">
    <style>
  button {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
    cursor: pointer;
  }

  button:hover {
    background-color: #0069d9;
  }
</style>

  </head>
  <body>
    <h1>Expense Tracker</h1>
    <form id="expense-form" method="post" action="">
      <label for="date">Date:</label>
      <input type="date" name="date" required>
	  <label for="category">Category:</label>
  <input type="text" name="category" required>

  <label for="amount">Amount:</label>
  <input type="number" name="amount" step="0.01" required>

  <label for="description">Description:</label>
  <input type="text" name="description" required>

  <button type="submit", id="hbd" >Submit</button>
  
  
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Prepare statement
  $stmt = mysqli_prepare($conn, "INSERT INTO expenses (date, category, amount, description) VALUES (?, ?, ?, ?)");
  mysqli_stmt_bind_param($stmt, "ssds", $_POST['date'], $_POST['category'], $_POST['amount'], $_POST['description']);
  
  // Execute statement
  if(mysqli_stmt_execute($stmt)){
    echo "Record added successfully.";
  } else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
  }
  
  // Close statement
  mysqli_stmt_close($stmt);

  header( "Location: tt.php" );
}
// Retrieve data from database
$sql = "SELECT * FROM expenses";
$result = mysqli_query($conn, $sql);


?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["action"] == "clear") {
    // Delete all records from the expenses table
    $sql = "DELETE FROM expenses";
    if (mysqli_query($conn, $sql)) {
      echo "All records deleted successfully.";
    } else {
      echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
    }
  }
}

// Retrieve data from database
$sql = "SELECT * FROM expenses";
$result = mysqli_query($conn, $sql);

// Check if any data is returned
if (mysqli_num_rows($result) > 0) {
  echo "<table>";
  echo "<tr><th>Date</th><th>Category</th><th>Amount</th><th>Description</th></tr>";
  // Output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row["date"]. "</td><td>" . $row["category"]. "</td><td>" . number_format($row["amount"], 2) . "</td><td>" . $row["description"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
?>
<form method="post" action="">
  <input type="hidden" name="action" value="clear">
  <button type="submit" style="width: 100% ; hight:100% ">Clear</button>
</from>
</body>
</html> 