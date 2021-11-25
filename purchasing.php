<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            position: center;
            background-color: #b489c7;
            color: black;
            font-family: sans-serif;
            font-weight: bold;
        }
        .div1 {
            width: 300px;
            border: 3px solid black;
            padding: 10px;
        }
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            border: 3px solid white;
        }

        .button {
            background-color: #240050;
            border: white solid 4px;
            border-radius: 100px;
            color: #ffffff;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            max-width: 480px;
            min-height: 40px;
            padding-left: 40px;
            padding-right: 40px;
            text-align: center;
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

        .div1 {
            width: 270px;
            height: fit-content;
            padding: 5px;
            border:7px solid white;
            border-radius: 4px;
            background-color: #2c0050;
        }
    </style>
    <ul>
        <li><a href="home.html">Home</a></li>
        <li><a class="active" href="listart.php">Listings</a></li>
        <li><a href="admin.php">Administrative</a></li>
        <li><a href="trackntrace.php">Track & Trace Log-in</a></li>
    </ul>
    <meta charset="UTF-8">
    <title>CaraArt - Purchasing</title>

    <?php
    $pid = $_GET['pid'];
    $servername = "devweb2021.cis.strath.ac.uk";
    $username = "tmb19188";
    $password = "beegi2eigh5P";
    $conn = new mysqli($servername, $username, $password, $username);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `Paintings` WHERE ID = " .$pid;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row["name"];
        }
    }
    ?>


</head>
<body>
<br>
<div class='div1'>
    <form method = 'post' action='purchased.php'>
        <p>Name: <br><input type='text' name='cName'>

        <p>Phone Number: <br><input type='text' name='phone'>

        <p>Email: <br><input type='email' name='email'>

        <p>Address: <br><input type='text' name='address'>
            <br><br>

            <input type = 'hidden' name='pid' value = <?php echo $pid; ?>>
            <input type = 'hidden' name='pname' value = <?php echo $name; ?>>

            <input type='submit' class = 'button'>


    </form>
</div>

<br>
</body>
</html>
