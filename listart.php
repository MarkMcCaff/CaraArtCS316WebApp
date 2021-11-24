<!DOCTYPE html>
<html lang="en">
<style>
    body {
        position: center;
        background-color: #b489c7;
        color: black;
        font-family: sans-serif;

    }

    .div1 {
        width: 270px;
        height: fit-content;
        padding: 5px;

    }

    table {
        color: white;
        margin-left: auto;
        margin-right: auto;
        border: 7px solid white;
        border-radius: 4px;
        background-color: #2c0050;
    }

    th, td {
        margin-left: auto;
        margin-right: auto;
        border: 2px solid white;
        border-radius: 4px;
        background-color: #2c0050;
    }

    img {
        border: 3px solid #ffffff;
        border-radius: 4px;
        width: 250px;
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

    .pagination a {
        background-color: #ebc2ff;
        border-radius: 10px;
        border: 5px solid white;
        display: block;
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        font-size: 30px;
    }

    h1 {
        text-align: center;
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

</style>
<ul>
    <li><a href="home.html">Home</a></li>
    <li><a class="active" href="listart.php">Listings</a></li>
    <li><a href="admin.php">Administrative</a></li>
    <li><a href="trackntrace.php">Track & Trace Log-in</a></li>
</ul>
<head>
    <meta charset="UTF-8">
    <title>CaraArt - Listings</title>


    <?php
    $servername = "devweb2021.cis.strath.ac.uk";
    $username = "tmb19188";
    $password = "beegi2eigh5P";
    $conn = new mysqli($servername, $username, $password, $username);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        mysqli_select_db($conn, 'Paintings');
    }


    $limit = 12;
    $query = "select * from Paintings";
    $result = mysqli_query($conn, $query);
    $noResult = mysqli_num_rows($result);
    // ceil = Rounds up value
    $noPages = ceil($noResult / $limit);
    echo "<table>";
    if (!isset ($_GET['page'])) {
        echo "<h1>CaraArt Listed Art | Page 1</h1>";
        $page = 1;
    } else {
        $page = $_GET['page'];
        echo "<h1>CaraArt Listed Art | Page " . $_GET['page'] . "</h1>";
    }
    $start = ($page - 1) * $limit;

    $query = "SELECT *FROM Paintings WHERE ID > 1 ORDER BY dateOfCompletion DESC LIMIT " . $start . "," . $limit;
    $result = mysqli_query($conn, $query);
    echo "<tr>";
    $column = -1;
    while ($row = mysqli_fetch_array($result)) {

        if ($column == 3) {
            echo "</tr><tr>";
            $column = 0;
        } else {
            $column++;
        }
        echo "<td><div class='div1'>";
        ?>

        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['imgData']); ?>"/> <br>
        <?php
        echo "Name: " . $row['name'] . " <br> Price: £" . $row['price'] . "<br>"; ?>
        <button onclick="location.href = 'More.php?pid=<?php echo $row['ID'] ?>';">More</button></div></td>
        <?php
    }
    echo "</tr></table>";
    echo "<div class ='pagination'>";
    for ($page = 1; $page <= $noPages; $page++) {
        if ($start = $page) {
            echo '<a href = "listart.php?page=' . $page . '">' . $page . ' </a>';
        } else {
            echo "<a class = 'active' href = 'listart.php?page=' . $page . ''>' . $page . ' </a>";
        }
    }
    echo "</div>";
    ?>

</head>
<body>

</body>
</html>
