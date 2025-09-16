<!-- 
// Run this block only when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["applyLoan"])) {
    // Collect and sanitize user inputs
    $name = htmlspecialchars($_POST["username"]); // User's name
    $salary = (float)$_POST["salary"];            // Monthly salary
    $loanAmount = (float)$_POST["loanAmount"];    // Requested loan amount
    $duration = (int)$_POST["duration"];          // Duration in months

    // --- Set loan limit based on salary bracket ---
    if ($salary < 20000) {
        $limit = 50000;          // If salary < 20,000 → max loan 50,000
    } elseif ($salary < 50000) {
        $limit = 150000;         // If salary < 50,000 → max loan 150,000
    } else {
        $limit = 300000;         // If salary >= 50,000 → max loan 300,000
    }

    echo "<h3>Loan Application Result</h3>";

    // --- Validation rules ---
    if ($loanAmount <= 0 || $salary <= 0 || $duration <= 0) {
        // Prevent negative or zero values
        echo "Invalid input. Please enter positive values.<br>";
    } elseif ($loanAmount > $limit) {
        // Reject if loan exceeds salary-based limit
        echo "Sorry $name, your loan request of KSh $loanAmount exceeds your limit of KSh $limit.<br>";
    } elseif ($loanAmount > $salary * $duration * 2) {
        // Extra rule: loan cannot exceed 2× (salary × duration)
        echo "Sorry $name, your salary and duration cannot support a loan of KSh $loanAmount.<br>";
    } else {
        // --- Loan Approved ---
        // Apply simple interest rate (10% yearly, proportional to months)
        $interestRate = 0.10; 
        $interest = $loanAmount * $interestRate * ($duration / 12);

        // Total to repay = loan + interest
        $totalPayback = $loanAmount + $interest;

        // Display loan approval details
        echo "Hello $name,<br>";
        echo "Your salary: KSh $salary<br>";
        echo "Approved Loan: KSh $loanAmount<br>";
        echo "Duration: $duration months<br>";
        echo "Total to pay back: KSh $totalPayback<br>";
        echo "Monthly Installment: KSh " . round($totalPayback / $duration, 2) . "<br>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan App</title>
</head>
<body>

<h2>Loan Application Form</h2>


//<form method="post">
    
    <label for="username">Name:</label>
    <input type="text" id="username" name="username" required><br><br>

    
    <label for="salary">Monthly Salary (KSh):</label>
    <input type="number" id="salary" name="salary" required><br><br>

    
    <label for="loanAmount">Loan Amount (KSh):</label>
    <input type="number" id="loanAmount" name="loanAmount" required><br><br>


    <label for="duration">Duration (months):</label>
    <input type="number" id="duration" name="duration" required><br><br>

    
    <button type="submit" name="applyLoan">Apply for Loan</button>
</form>

</body>
</html>


 -->

<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
try {
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";


  $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}



?>



