<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <style>

        body {
            position: center;
            background-color: #b489c7;
            color: black;
            font-family: sans-serif;
            font-weight: bold;
        }
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            border: 3px solid white;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover:not(.active) {
            background-color: #111;
        }

        .active {
            background-color: #2c0050;
        }
    </style>
    <title>CaraArt - New Entry</title>
    <ul>
        <li><a href="home.html">Home</a></li>
        <li><a href="listart.php">Listings</a></li>
        <li><a class="active" href="admin.php">Administrative</a></li>
        <li><a href="trackntrace.php">Track & Trace Log-in</a></li>
    </ul>

    <br>
    <?php
    if($_POST['pName'] != "" &&
        $_POST['doc'] != "" &&
        $_POST['width'] != "" &&
        $_POST['height'] != "" &&
        $_POST['price'] != "" &&
        $_POST['description'] != "") {
        $servername = "devweb2021.cis.strath.ac.uk";
        $username = "tmb19188";
        $password = "beegi2eigh5P";
        $conn = new mysqli($servername, $username, $password, $username);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        $sqlpname = mysqli_real_escape_string($conn, $_POST['pName']);
        $sqldoc = mysqli_real_escape_string($conn, $_POST['doc']);
        $sqlwidth = mysqli_real_escape_string($conn, $_POST['width']);
        $sqlheight = mysqli_real_escape_string($conn, $_POST['height']);
        $sqlprice = mysqli_real_escape_string($conn, $_POST['price']);
        $sqldescription = mysqli_real_escape_string($conn, $_POST['description']);
        $filename = basename($_FILES['image']['name']);
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        $allowed = array('jpg', 'png', 'jpeg', 'gif');
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        $rid = rand(1, 99999);
        $sql = "INSERT INTO Paintings (name, dateOfCompletion, width, height, price, description, imgData, ID) VALUES 
            ('$sqlpname','$sqldoc','$sqlwidth','$sqlheight','$sqlprice','$sqldescription','$imgContent','$rid')";
        if ($conn->query($sql) === TRUE) {
            echo "<br><p>New Entry added to Database</p><br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else{
        echo "Input incorrect, please try again, you don't want to post something missing crucial data and having to log into the phpMyAdmin and change it";

    }

    ?>
    <br>
    <form method = 'post' action = 'admin.php'>
        <input type = 'hidden' name='password' value = '<?php echo $_POST['password']; ?>'>
        <input type='submit' value = 'Return'>
    </form>

</head>
<body>

</body>
</html>
