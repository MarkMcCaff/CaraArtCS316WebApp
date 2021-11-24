<!DOCTYPE html>
<html lang="en">
<head>

    <style>
        body {
            position: center;
            background-color: #b489c7;
            color: black;
            font-family: sans-serif;

        }

        .div1 {
            width: 300px;
            border: 3px solid white;
            padding: 10px;
            background: #dddddd;
        }

        table, th {
            border: 3px solid white;
            padding: 5px;
            background-color: #2c0050;

        }

        td {
            border: 3px solid white;
            color: black;
            font-weight: bold;
            background-color: #b489c7;
            padding: 5px;
        }

        img {
            border: 6px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 40%;
            float: top;
            background-color: black;
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

        button {
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

        }
    </style>
    <ul>
        <li><a href="home.html">Home</a></li>
        <li><a class="active" href="listart.php">Listings</a></li>
        <li><a href="admin.php">Administrative</a></li>
        <li><a href="trackntrace.php">Track & Trace Log-in</a></li>
    </ul>
    <meta charset="UTF-8">
    <title>CaraArt - More</title>

    <?php
    $pid = $_GET['pid'];
    $servername = "devweb2021.cis.strath.ac.uk";
    $username = "tmb19188";
    $password = "beegi2eigh5P";
    $conn = new mysqli($servername, $username, $password, $username);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `Paintings` WHERE ID = " . $pid;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<br><table><tr>";
            $name = $row["name"];
            echo "<tr><td>Name           : </td><td>" . $name . "</td></tr>";
            echo "<tr><td>Date Completed (YYYY/MM/DD) :</td><td> " . $row["dateOfCompletion"] . "</td></tr>";
            echo "<tr><td>Width  (mm)    : </td><td>" . $row["width"] . "</td></tr>";
            echo "<tr><td>Height (mm)    : </td><td>" . $row["height"] . "</td></tr>";
            echo "<tr><td>Price          : </td><td>£" . $row["price"] . "</td></tr>";
            echo "<tr><td>Description    : </td><td>" . $row["description"] . "</td></tr>";
            echo "</table></tr><br>";
            ?>
            <button onclick="location.href = 'purchasing.php?pid=<?php echo $row['ID'] ?>';">Purchase
            </button></div></td><br><br><br>
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['imgData']); ?>"/>


            <?php
        }
    }

    ?>
    <br>
</head>
<body>

</body>
</html>
