<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body{
            position: center;
            background-color: #b489c7;
            color: black;
            font-family: sans-serif;

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
        .error{
            color: #7a0000;
        }
        .div1 {
            width: 270px;
            height: fit-content;
            padding: 5px;
            border:7px solid white;
            border-radius: 4px;
            background-color: #dedede;

        }
    </style>
    <title>CaraArt - Purchased</title>
    <ul>
        <li><a href="home.html">Home</a></li>
        <li><a class="active" href="listart.php">Listings</a></li>
        <li><a href="admin.php">Administrative</a></li>
        <li><a href="trackntrace.php">Track & Trace Log-in</a></li>
    </ul>

    <?php
    if($_POST['pid'] != "" &&
    $_POST['pname'] != "" &&
    $_POST['address'] != "" &&
    $_POST['email'] != "" &&
    $_POST['phone'] != "" &&
    $_POST['cName'] != "") {
        $pid = $_POST['pid'];
        $cName = $_POST["cName"];
        $servername = "devweb2021.cis.strath.ac.uk";
        $username = "tmb19188";
        $password = "beegi2eigh5P";
        $conn = new mysqli($servername, $username, $password, $username);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sqlcname = mysqli_real_escape_string($conn, $_POST['cName']);
        $sqlphone = mysqli_real_escape_string($conn, $_POST['phone']);
        $sqlemail = mysqli_real_escape_string($conn, $_POST['email']);
        $sqladdress = mysqli_real_escape_string($conn, $_POST['address']);
        $sqlpname = mysqli_real_escape_string($conn, $_POST['pname']);
        $sqlpid = mysqli_real_escape_string($conn, $_POST['pid']);
        $sql = "INSERT INTO Purchased (cname, phone, email, address, pname, id) VALUES ('$sqlcname','$sqlphone','$sqlemail','$sqladdress','$sqlpname','$sqlpid')";
        if ($conn->query($sql) === TRUE) {
            mail($_POST['email'],
                "CaraART Order Confirmation",
                "Dear " . $_POST['cName'] . "\n
            This message is to confirm your order " . $_POST['pname'] . " from CaraART.com");
            echo "Thank you for your purchase";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else{
        ?>
            <br>
    <div class='div1'>
            <p class="error">Input Missing, click the button below to attempt again</p><br>
            <button onclick="location.href = 'purchasing.php?pid=<?php echo $_POST['pid']; ?>';">Return</button>
    </div>
    <?php
    }
    ?>



    </form>
</head>
<body>

</body>
</html>
