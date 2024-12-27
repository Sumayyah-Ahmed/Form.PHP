       
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic PHP Form</title>
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h2>Dynamic PHP Form with Validation</h2>

    <?php
    // Initialize variables
    $name = $email = $message = "";
    $nameErr = $emailErr = $messageErr = "";
    $formSuccess = false;

    // Form validation and processing. This is the content of my first blog post. It's simple and doesn't use a database.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate Name
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = htmlspecialchars($_POST["name"]);
        }

        // Validate Email
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = htmlspecialchars($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        // Validate Message
        if (empty($_POST["message"])) {
            $messageErr = "Message is required";
        } else {
            $message = htmlspecialchars($_POST["message"]);
        }

        // If no errors, form is submitted successfully
        if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
            $formSuccess = true;
        }
    }
    ?>

    <!-- Display Form -->
    <form action="form.php" method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br>
        <span class="error"><?php echo $nameErr; ?></span><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br>
        <span class="error"><?php echo $emailErr; ?></span><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4"><?php echo $message; ?></textarea><br>
        <span class="error"><?php echo $messageErr; ?></span><br><br>

        <input type="submit" value="Submit">
    </form>

    <?php
    // Display success message if the form is valid
    if ($formSuccess) {
        echo "<h3 class='success'>Form Submitted Successfully!</h3>";
        echo "<strong>Name:</strong> $name<br>";
        echo "<strong>Email:</strong> $email<br>";
        echo "<strong>Message:</strong> $message<br>";
    }
    ?>

</body>
</html>
