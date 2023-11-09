<?php
include 'connect.php'; // Include your database connection configuration

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $password = $_POST['Pw'];

    $query = "INSERT INTO user_acc (Username, Email, Pw) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $stmt->close();
        header('Location: login.html');
        exit();
    } else {
        echo "Error while saving data to the database.";
    }
}
?>
