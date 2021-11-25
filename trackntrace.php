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

    .error {
        color: red;
    }

    .vacant {
        background-color: #c5fdb7;
        color: black;
    }

    .spots {
        background-color: #ffdb9b;
    }

    .full {
        background-color: #d0d0d0;
        color: #868686;
        text-decoration: line-through;
    }

    table{
        border: 3px solid white;
        padding: 15px;
        font-size: 30px;
        background-color: #3d005e;
    }
    td,tr{
        border: 3px solid black;
        padding: 3px;
    }

    .div1 {
        width: 30%;
        height: fit-content;
        padding: 5px;
        border: 4px white solid;

    }
</style>
<script>
    function showDiv(divId, element) {
        document.getElementById(divId).style.display = element.value != '2021-mm-dd' ? 'block' : 'none';
    }
</script>

<head>
    <meta charset="UTF-8">
    <title>CaraArt - Track & Trace</title>
    <ul>
        <li><a href="home.html">Home</a></li>
        <li><a href="listart.php">Listings</a></li>
        <li><a href="admin.php">Administrative</a></li>
        <li><a class="active" href="trackntrace.php">Track & Trace Log-in</a></li>
    </ul>
    <h1>CarArt - Track & Trace</h1>
</head>

<body>
<div class = 'div1'>
<form method='post' action='trackntrace.php' id='tracking'>
    <p>Date attending: </p><input type='date' name='attend' min="<?php echo date("Y-m-d"); ?>"
                                  max="<?php echo date("Y-m-d", strtotime(" +28 days")); ?>" onchange="showDiv('time',this)">

    <div style="display:none" id='time'>
    <p>Please Select a time to attend:</p>
    <select name="timeslot" onchange="showDiv('division',this)">
        <option value="10:00-11:00">10:00:11:00</option>
        <option value="11:00-12:00">11:00:12:00</option>
        <option value="12:00-13:00">12:00:13:00</option>
        <option value="13:00-14:00">13:00:14:00</option>
        <option value="14:00-15:00">14:00:15:00</option>
        <option value="15:00-16:00">15:00:16:00</option>
    </select>
    </div>
    <div id='division' style="display:none">
        <p>Name: </p><input type='text' name='name'>
        <p>Phone Number: </p><input type='text' name='phone'>
    </div>
    <br><br>
    <input type='submit'><br><br>
</form>
</div>


</body>
</html>

<?php
$servername = "devweb2021.cis.strath.ac.uk";
$username = "tmb19188";
$password = "beegi2eigh5P";
$conn = new mysqli($servername, $username, $password, $username);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$day = date("d");
$date = date("Y-m-d");
$counter = 0;
echo "<table><tr>";
?>
 <h1>Calendar for the next few weeks of available dates</h1>
<?php

for ($i = 0;$i < 28;$i++){

$counter = $counter + 1;

$sql = "SELECT 
                count(date) as attendees,
                date 
            FROM 
                trackntrace 
            WHERE
                date = '" . $date . "'
            GROUP BY
                date";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if (empty($row)) {
    echo "<td class='vacant'>" . $day . "</td>";
} elseif ($row['attendees'] < 10) {
    echo "<td class='spots'>" . $day . "</td>";
} else {
    echo "<td class='full'>" . $day . "</td>";
}


if ($counter > 6) {
    echo "</tr><tr>";
    $counter = 0;
}
$day = date("d", strtotime("+ " . ($i + 1) . " days"));
$date = date("Y-m-d", strtotime("+ " . ($i + 1) . " days"));
?>
<tabel>
    <?php

    }
    echo "</tabel>";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $sqlname = mysqli_real_escape_string($conn, $_POST['name']);
        $sqlphone = mysqli_real_escape_string($conn, $_POST['phone']);
        $sqlattend = mysqli_real_escape_string($conn, $_POST['attend']);
        $sqltime = mysqli_real_escape_string($conn, $_POST['timeslot']);
        if ($_POST['name'] != "" && $_POST['phone'] != "" && $_POST['attend'] != "" && $sqltime != "") {
            $sql = "INSERT INTO trackntrace (name, phone, date, Time) VALUES ('$sqlname','$sqlphone','$sqlattend','$sqltime')";
            if ($conn->query($sql) === TRUE) {
                echo "You have been signed in";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<p class = 'error'>Please Fill in all fields</p>";
        }
    }
    ?>
