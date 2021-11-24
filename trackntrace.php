<!DOCTYPE html>
<html lang="en">
<style>

    body{
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
        color: red;
    }
</style>

<head>
    <meta charset="UTF-8">
    <title>CarArt - Track & Trace</title>
    <ul>
        <li><a  href="home.html">Home</a></li>
        <li><a href="listart.php">Listings</a></li>
        <li><a href="admin.php">Administrative</a></li>
        <li><a class="active" href="trackntrace.php">Track & Trace Log-in</a></li>
    </ul>
    <h1>CarArt - Track & Trace</h1>
</head>

<body>

    <form method = 'post' action='trackntrace.php'>
        <p>Name: </p><input type='text' name='name'>
        <p>Phone Number: </p><input type='text' name='phone'>
        <p>Date attending: </p><input id='login' type='date' name='attend' min = "<?php echo date("Y-m-d");?>" max = "<?php echo date("Y-m-d", strtotime( " +28 days")); ?>"><br><br>
        <input type='submit'>
    </form>


</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "devweb2021.cis.strath.ac.uk";
    $username = "tmb19188";
    $password = "beegi2eigh5P";
    $conn = new mysqli($servername, $username, $password, $username);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sqlname = mysqli_real_escape_string($conn, $_POST['name']);
    $sqlphone = mysqli_real_escape_string($conn, $_POST['phone']);
    $sqlattend = mysqli_real_escape_string($conn, $_POST['attend']);
    if($_POST['name'] != "" && $_POST['phone'] != "" && $_POST['attend'] != ""){
        $sql = "INSERT INTO trackntrace (name, phone, date) VALUES ('$sqlname','$sqlphone','$sqlattend')";
        if ($conn->query($sql) === TRUE) {
            echo "You have been signed in";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else{
        echo "<p class = 'error'>Please Fill in all fields</p>";
    }
}
?>
