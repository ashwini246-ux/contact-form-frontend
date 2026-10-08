<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Please submit the form from the Contact Us page.");
}

$host = "sql210.infinityfree.com";
$user = "if0_43122113";
$pass = "Ys1VJc6HbwJVc";
$db   = "if0_43122113_web_project";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$stmt = $conn->prepare(
    "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)"
);

$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    echo "Form submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>