<?php
session_start();
require_once "Database/Database.php";
if ($_SESSION['username'] == null) {
    echo "<script>alert('Please login.');</script>";
    header("Refresh:0 , url=index.html");
    exit();
}
$username = $_SESSION['username'];
$sql_fetch_todos = "SELECT * FROM product ORDER BY id ASC";
$query = mysqli_query($conn, $sql_fetch_todos);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <style>
        body {
            font-family: "Mitr", sans-serif;
            background-color: #0E0B16;
        }

        table th,
        tr,
        td {
            text-align: center;
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px 0px 10px 0px;
        }

        table {
            width: 100%;
        }

        th {
            color: white;
            background-color: #a239ca;
        }

        tr {
            background-color: white;
        }

        tr:nth-child(even) {
            background-color: grey;
        }


        .button {
            border: none;
            color: red;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #D9ddd4;
            color: red;
        }
    </style>
</head>

<body>
    <a href="./list.php" class="button">Return</a>
    <?php
    $query = $_GET['query'];


    if (strlen($query) > 0) {
        $query = htmlspecialchars($query);
        $query = mysqli_real_escape_string($conn, $query);
        $raw_results = mysqli_query($conn, "SELECT * FROM product
			WHERE `proname` LIKE '%" . $query . "%' ");
    ?>

        <?php if (mysqli_num_rows($raw_results) > 0) { ?>
            <div class="table-product">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">ID:Product</th>
                            <th scope="col">Items</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Date Regis:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $idpro = 1;
                        while ($row = mysqli_fetch_array($raw_results)) { ?>
                            <tr>
                                <td scope="row"><?php echo $idpro ?></td>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['proname'] ?></td>
                                <td><?php echo $row['amount'] ?></td>
                                <td><?php echo $row['price'] ?></td>
                                <td><?php echo $row['time'] ?></td>
                            </tr>
                        <?php
                            $idpro++;
                        } ?>
                    </tbody>
                </table>


            <?php } else { ?>
                <p style="color: white;">
                    <?php echo "No results!"; ?> </p><?php
                                                    }
                                                } else {
                                                        ?>
            <p style="color: white;">
                <?php echo "No query entered!"; ?> </p><?php
                                                    }

                                                        ?>

</body>

</html>