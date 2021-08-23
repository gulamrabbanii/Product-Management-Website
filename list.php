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
<!doctype html>
<html lang="en">

<head>
    <title>CRUD Operation</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="dp.png">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Mitr", sans-serif;
            background-color: #0E0B16;
        }



        .header {
            position: fixed;
            top: 0px;
            left: 0px;
            right: 0px;
            height: 50px;
            padding: 5px 13px 11px 0px;
            width: 100%;
            color: white;
            font-family: "Mitr", sans-serif;
            margin-top: 0px;
            bottom: 0;
            background-color: #4717f6;
        }

        .header p {
            margin-left: 20px;
            text-align: left;
        }


        .container {
            margin: 90px auto;
            margin-bottom: 50px;
            border-radius: 30px;
            text-align: center;
            background-color: #e7dfdd;
            width: 40%;
            padding-bottom: 10px;
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



        .modify {
            text-align: center;
        }

        .delete {
            text-align: center;
        }

        .modify .bfix {
            border-radius: 15px;
            background-color: #ffcc33;
            color: black;
            text-decoration: none;
            padding: 4px 20px 4px 20px;
            transition: 0.5s;
        }

        .modify .bfix:hover {
            background-color: #fdb515;
            color: white;
        }

        .delete .bdelete {
            border-radius: 15px;
            background-color: #e60000;
            text-decoration: none;
            color: white;
            padding: 4px 20px 4px 20px;
            transition: 0.5s;
            cursor: pointer;
        }

        .delete .bdelete:hover {
            background-color: #D9ddd4;
            color: red;
        }

        .Addlist {
            margin-right: 100px;
            padding: 5px 30px 5px 30px;
            border-radius: 15px;
            text-decoration: none;
            color: white;
            background-color: #00A600;
            transition: 0.5s;
        }

        .Addlist:hover {
            color: black;
            background-color: #BBFFBB;
        }
    </style>
</head>

<body>

    <div class="header">
        <a href="./login.php" class="button">Log out</a>
    </div>

    <div class="container">
        <form action="./search.php" method="GET">
            <input type="text" name="query" placeholder="Search" />
            <input type="submit" value="Search" />
        </form>
        <h1>LIST OF THE PRODUCTS</h1>
        <h2>Welcome Back <?php echo ucwords($username) ?></h2>
    </div>
    <div class="table-product">
        <table>
            <tr>
                <th scope="col">S/N</th>
                <th scope="col">ID:Product</th>
                <th scope="col">Items</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Date Regis:</th>
                <th scope="col">Modify</th>
                <th scope="col">Delete</th>
            </tr>
            <tbody>
                <?php
                $idpro = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td scope="row"><?php echo $idpro ?></td>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['proname'] ?></td>
                        <td><?php echo $row['amount'] ?></td>
                        <td><?php echo $row['price'] ?></td>
                        <td class="timeregis"><?php echo $row['time'] ?></td>
                        <td class="modify"><a name="edit" id="" class="bfix" href="fix.php?id=<?php echo $row['id'] ?>&message=<?php echo $row['proname'] ?>&amount=<?php echo $row['amount'] ?>&price=<?php echo $row['price'] ?>" role="button">
                                Modify
                            </a></td>
                        <td class="delete">
                            <?php echo "<a class='bdelete' onclick=\"return confirm('Do you really want to delete this record?')\" href=\"main\delete.php?id=" . $row['id'] . " \">Delete</a>"; ?>
                            <script>
                                document.getElementById('a.delete').on('click', function() {
                                    var choice = confirm('Delete this record?');
                                    if (choice === true) {
                                        return true;
                                    }
                                    return false;
                                });
                            </script>


                        </td>
                    </tr>
                <?php
                    $idpro++;
                } ?>
            </tbody>
        </table>
        <br>
        <a name="" id="" class="Addlist" style="float:right" href="addlist.php" role="button">Add Item</a>
    </div>
    <?php
    mysqli_close($conn);
    ?>
</body>

</html>