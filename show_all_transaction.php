<?php
require_once("DB_connection.php");
$sql = "SELECT
    t.transaction_id,
    sender.first_name AS sender_first_name,
    sender.last_name AS sender_last_name,
    receiver.first_name AS receiver_first_name,
    receiver.last_name AS receiver_last_name,
    t.transaction_amount,
    t.send_at,
    t.transaction_status
FROM
    transaction AS t
JOIN
    users AS sender
ON
    t.sender_id = sender.user_id
JOIN
    users AS receiver
ON
    t.receiver_id = receiver.user_id;

";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="all_users.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Banking System - History</title>
<style>
  
 .logo {
    position: relative;
    left: 7%;
    padding-top: 3%;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 25px;
}

#logo-p1 {
    color: white;
    font-weight: bold;
}

#logo-p2 {
    color: rgb(233, 179, 41);
    font-weight: bold;
}
.links {
    position: relative;
    left: 45%;
    margin-top: -1.2%;
}

.links a {
    text-decoration: none;
    font-family: sans-serif;
    color: white;
    font-size:1.7rem;
    margin-left: 3%;
    font-weight: bold;
}

.links > a:hover {
    color: greenyellow;
}


</style>
</head>

<body>
<div class="logo"><span id="logo-p1">SmartEdge</span><span id="logo-p2">Bank</span></div>
    <div class="links">
        <a href="show_all_users.php">Users</a>
        <a href="show_all_transaction.php">History</a>
        <a href="index.html">Home</a>
    </div>
    <?php if ($result->num_rows < 1) { ?>
        <div class="msg-container">
            <p>Sorry, No Users Found</p>
            <button><a href="add_user.php">Add User</a></button>
        </div>
    <?php } else { ?>
        </p>
        </div>
        <table>
            <tr>
                <th>Id</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Transaction Amount</th>
                <th>Send At</th>
                <th>Transaction Status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?php echo $row["transaction_id"]; ?>
                    </td>
                    <td>
                        <?php echo $row["sender_first_name"] . "" . $row["sender_last_name"]; ?>
                    </td>
                    <td>
                        <?php echo $row["receiver_first_name"] . "" . $row["receiver_last_name"]; ?>
                    </td>
                    <td>
                        <?php echo $row["transaction_amount"]; ?>
                    </td>
                    <td>
                        <?php echo $row["send_at"]; ?>
                    </td>
                    <td id="transaction_status">
                        <?php echo $row["transaction_status"]; ?>
                    </td>
                </tr>
            <?php }
            $conn->close();
    } ?>

        </td>
        <tr>
    </table>

</body>

</html>