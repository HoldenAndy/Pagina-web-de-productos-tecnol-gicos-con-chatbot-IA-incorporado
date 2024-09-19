<?php
session_start(); // Start the session

// Include the database connection file
include ("bd.php");

// Check if the form is submitted
if (isset($_POST['login'])) {
    // Retrieve email and password from POST request
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    // Query to find the user by email
    $query = "SELECT * FROM usuario WHERE email = ?";
    if ($stmt = $conn->prepare($query)) {
        // Bind the email parameter
        $stmt->bind_param('s', $email);
        // Execute the query
        $stmt->execute();
        // Get the result
        $result = $stmt->get_result();

        // Check if a user with the given email exists
        if ($result->num_rows == 1) {
            // Fetch the user data
            $user = $result->fetch_assoc();
            // Verify the password
            if (password_verify($contrasena, $user['contrasena'])) {
                // Set session variables
                $_SESSION['nombreUser'] = $user['nombres'];

                // Redirect to a logged-in page (e.g., dashboard)
                header("Location: ../index.php"); // Change to your actual destination
                exit();
            } else {
                // Password is correct
                echo '
                <script>
                    alert("Acceso Accedido.");
                    window.location=" ../index.php";
                </script>
                ';
            }
        } else {
            // Email does not exist
            echo '
            <script>
                alert("El correo electrónico no está registrado.");
                window.location="../category/inicioSesion.php";
            </script>
            ';
        }

        // Close the statement
        $stmt->close();
    } else {
        // Query preparation failed
        echo "Error: " . $conn->error;
    }
}
?>
