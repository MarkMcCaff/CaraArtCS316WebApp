<!DOCTYPE html>
<html lang="en">

<style>

    body {
        position: center;
        background-color: #b489c7;
        color: black;
        font-family: sans-serif;
        font-weight: bold;
    }
    .outerDiv {
        color: #fff;
        height: 400px;
        width: 600px;
        margin: 0px auto;
        padding: 5px;
    }

    .leftDiv {
        background-color: #b0b0b0;
        color: #000;
        width: 25%;
        float: left;
        border: 1px solid black;
        margin: 5px;
        padding: 5px;
    }

    .rightDiv {
        background-color: #a9a9a9;
        color: #000;
        width: 22%;
        float: left;
        border: 1px solid black;
        margin: 5px;
        padding: 5px;
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

    .proof {
        background-color: #a9a9a9;
        color: #000;
        width: fit-content;
        float: left;
        border: 1px solid black;
        margin: 5px;
        padding: 5px;
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

    img{
        width:600px;
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
<ul>
    <li><a href="home.html">Home</a></li>
    <li><a href="listart.php">Listings</a></li>
    <li><a class="active" href="admin.php">Administrative</a></li>
    <li><a href="trackntrace.php">Track & Trace Log-in</a></li>
</ul>
<head>
    <meta charset="UTF-8">
    <title>CaraArt - Admin</title>

</head>
<body>

<form method='post' action='admin.php'>
    <p>Password:</p><input type='password' name='password'>
        <input class = 'button' type='submit'>
</form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $password = $_POST["password"];

            if ($password == "caraART21") {
                $servername = "devweb2021.cis.strath.ac.uk";
                $username = "tmb19188";
                $password = "beegi2eigh5P";
                $conn = new mysqli($servername, $username, $password, $username);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM `Purchased`";
                $result = $conn->query($sql);
                echo "<div class='leftDiv'>";
                echo "<h1>Current Orders!</h1>";
                while ($row = $result->fetch_assoc()) {
                    echo "Name: " . $row["cname"] . "<br>";
                    echo "Phone Number: " . $row["phone"] . "<br>";
                    echo "Email: " . $row["email"] . "<br>";
                    echo "Address: " . $row["address"] . "<br>";
                    echo "Picture's Name: " . $row["pname"] . "<br>";
                    echo "Picture's ID: " . $row["id"] . "<hr><br>";
                }
                echo "</div>";

                $sql = "SELECT * FROM `trackntrace`";
                $result = $conn->query($sql);
                echo "<div class='rightDiv'>";
                echo "<h1>Track & Trace Bookings!</h1>";
                while ($row = $result->fetch_assoc()) {
                    echo "Name: " . $row["name"] . "<br>";
                    echo "Phone Number: " . $row["phone"] . "<br>";
                    echo "Date: " . $row["date"] . "<br>";
                    echo "Time Slot: " . $row["Time"] . "<hr><br>";
                }
                echo "</div>";
                echo "<div class='rightDiv'><h1>Add New Entry</h1><form method = 'post' action='newEntry.php' enctype='multipart/form-data'>";
                echo "<p>Painting Name: <br><input type='text' name='pName'>";
                echo "<p>date Completed: <br><input type='date' name='doc'>";
                echo "<p>Width: <br><input type='number' name='width'>";
                echo "<p>Height: <br><input type='number' name='height'>";
                echo "<p>Price: <br><input type='text' name='price'>";
                echo "<p>Description: <br><input type='text' name='description'>";
                echo "<p>Image: <input type='file' name='image'>";
                echo "<br><br>";

                echo "<input type = 'hidden' name='password' value = 'caraART21'>";
                echo "<input class='button' type='submit'>";
                echo "</div>";

                $sql = "SELECT imgData FROM `Paintings` WHERE ID <= 1";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <div class="proof"><h1>Proof of Permission to use Images</h1>
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['imgData']); ?>" /></div> <br>
<?php
                    }
            } else {
                echo "<br>Incorrect Password, please attempt again";

            }

        }
        ?>
</body>
</html>
