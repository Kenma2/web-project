<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Expense Tracker</title>
    <link rel="stylesheet" href="style.css">
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

  <button type="submit" >Submit</button>
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbprefix = "expenses_"; // Prefix for database name
$dbname = $dbprefix . $_SESSION['user_id']; // Append user ID to prefix for database name

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Create user-specific database
$sql = "CREATE DATABASE IF NOT EXISTS " . $dbname;
if(mysqli_query($conn, $sql)){
  echo "Database created successfully.";
} else{
  echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
}

// Connect to user-specific database
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

</body>
</html> 