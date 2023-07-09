<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form fields are set
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Save the feedback to the database or perform any other necessary operations

        // Database connection (replace with your own credentials)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "port";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute SQL query to insert the feedback into the database
        $sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "Thank you for your feedback!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection

        // Display the collected feedback
        echo '<div style="background-color: #f5f5f5; padding: 20px; margin-bottom: 20px; border-radius: 4px;">';
        echo '<h3 style="font-size: 18px; margin-bottom: 10px;">' . $name . '</h3>';
        echo '<p style="margin-bottom: 5px;">Email: ' . $email . '</p>';
        echo '<p style="margin-bottom: 5px;">Message: ' . $message . '</p>';
        echo '</div>';
    } else {
        echo 'Please fill out all the form fields.';
    }
}

// Retrieve all feedback data from the database and display it
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);

// Display the feedback cards
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div style="background-color: #f5f5f5; padding: 20px; margin-bottom: 20px; border-radius: 4px;">';
        echo '<h3 style="font-size: 18px; margin-bottom: 10px;">' . $row['name'] . '</h3>';
        echo '<p style="margin-bottom: 5px;">Email: ' . $row['email'] . '</p>';
        echo '<p style="margin-bottom: 5px;">Message: ' . $row['message'] . '</p>';
        echo '</div>';
    }
} else {
    echo "No feedback yet.";
}
$conn->close();
?>
