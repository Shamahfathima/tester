<?php
$conn = mysqli_connect("localhost" , "root" , "", "hana");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = "INSERT INTO users(name, email_id) VALUES (?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $_POST["fname"], $_POST["email"]);
    $stmt->execute();

    // TODO: include password hashing

    $result = $stmt->get_result();
        
    if ($result) {
        if ($data_type == "object") {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Return the result count
            return $result->num_rows;
        }
    } else {
        // Return true if the query executed successfully with no result set
        header("Location: dashboard.php");
        // todo done
        return true;
    }
}