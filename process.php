<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["emailid"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    
    // Database connection
    $dsn = 'mysql:host=localhost;dbname=bbdms';
    $username = 'root'; // Default username
    $password = ''; // Default password

    try {
        $dbh = new PDO($dsn, $username, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Database query execution for blood_banks table
        $sql = "SELECT * FROM blood_banks WHERE email = :email";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result1 = $stmt->fetch();

        // Database query execution for tblblooddonars table
        $sql = "SELECT * FROM tblblooddonars WHERE EmailId = :email";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result2 = $stmt->fetch();

        // Database query execution for tblcontactusquery table
        $sql = "SELECT * FROM tblcontactusquery WHERE EmailId = :email";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result3 = $stmt->fetch();

        // Check if email exists in any of the tables
        if ($result1 || $result2 || $result3) {
            $to = $email;
            $headers = "From: $email";
            if (mail($to, $subject, $message, $headers)) {
                echo '<div style="text-align: center; padding: 100px;">';
                echo '<img src="https://i.pinimg.com/originals/af/10/b0/af10b0661568f8aa2f98a43f7298224e.gif" /><br />';
                echo '<span style="color: green; font-size: 25px;">Email Sent Successfully 😀😀</span>';
                echo '</div>';
            } else {
                echo '<div style="text-align: center; ">';
                echo '<img src="https://cdn.dribbble.com/users/2469324/screenshots/6538803/comp_3.gif" /><br />';
                echo '<span style="color: red; font-size: 25px;">Email Sending Failed !!🙁🙁<br><br> Please Check Email Address and Try Again</span>';
                echo '</div>';
            }
        } else {
            // Email not found in any of the tables
            echo '<div style="text-align: center; ">';
            echo '<img src="https://cdn.dribbble.com/users/2469324/screenshots/6538803/comp_3.gif" /><br />';
            echo '<span style="color: red; font-size: 25px;">Email Address not found in the database !!🙁🙁<br><br> Please Check Email Address and Try Again</span>';
            echo '</div>';
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
