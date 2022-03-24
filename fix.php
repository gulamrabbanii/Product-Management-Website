<?php
session_start();
require_once "Database/Database.php";
if ($_SESSION['username'] == null) {
    echo "<script>alert('Please login.');</script>";
    header("Refresh:0 , url=index.php");
    exit();
}
$username = $_SESSION['username'];
$sql_fetch_todos = "SELECT * FROM product ORDER BY id ASC";
$query = mysqli_query($conn, $sql_fetch_todos);

?>
<!doctype html>
<html lang="en">

<head>
    <title>Modify Page</title>
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

        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        button:hover {
            opacity: 1;
        }

        .cancelbtn,
        .deletebtn {
            float: left;
            width: 50%;
        }

        .cancelbtn {
            background-color: #ccc;
            color: black;
        }

        .deletebtn {
            background-color: #f44336;
        }

        .container {
            padding: 16px;
            text-align: center;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: #474e5d;
            padding-top: 50px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto 15% auto;
            border: 1px solid #888;
            width: 80%;
        }

        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }


        .close:hover,
        .close:focus {
            color: #f44336;
            cursor: pointer;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
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

        .form-group {
            margin-left: 600px;
        }

        label {
            color: white;
        }

        [type=text] {
            font-family: "Mitr", sans-serif;
            border-radius: 15px;
            border: transparent;
            padding: 7px 200px 7px 5px;
        }

        .return {
            border-radius: 15px;
            background-color: #ffcc33;
            color: black;
            text-decoration: none;
            padding: 4px 40px 4px 40px;
            margin: 0px 0px 50px 100px;
            font-size: 20px;
            transition: 0.5s;
        }

        .return:hover {
            background-color: #fdb515;
            color: white;
        }

        .modify {
            border-radius: 15px;
            border: transparent;
            color: white;
            padding: 4px 40px 4px 40px;
            margin: 0px 50px 50px 100px;
            font-size: 20px;
            border-collapse: collapse;
            background-color: #00A600;
            font-family: "Mitr", sans-serif;
            transition: 0.5s;
        }

        .modify:hover {
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
        <h1>List of product:</h1>
        <h2>Welcome Back <?php echo ucwords($username) ?></h2>
    </div>
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
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td scope="row"><?php echo $idpro ?></td>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['proname'] ?></td>
                        <td><?php echo $row['amount'] ?></td>
                        <td><?php echo $row['price'] ?></td>
                        <td class="timeregis"><?php echo $row['time'] ?></td>
                    </tr>
                <?php
                    $idpro++;
                } ?>
            </tbody>
        </table>
        <br>
    </div>
    <div class="fixproduct">
        <form method="POST" action="main/fix.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Item : </label>
                <br>
                <input type="text" class="form-control" name="name" value="<?php echo $_GET['message']; ?>" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Quantity : </label>
                <br>
                <input type="text" value="<?php echo $_GET['amount'] ?>" class="form-control" name="value" required>
                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id" />
            </div>
            <div class="form-group">
                <label for="exampleInputPrice">Price : </label>
                <br>
                <input type="text" value="<?php echo $_GET['price'] ?>" class="form-control" name="price" required>
                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id" />
            </div>
            <br>
            <div class="form-button">
                <a onclick="document.getElementById('id01').style.display='block'" style="float: right; cursor:pointer" class="modify" role="button">
                    Modify
                </a>

                <div id="id01" class="modal">
                    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
                    <div class="modal-content">
                        <div class="container">
                            <h1>You are modifying content</h1>
                            <p>Are you sure? you want to edit content.</p>

                            <div class="clearfix">

                                <button type="button" onclick="location.replace('./list.php')" class="cancelbtn">Cancel</button>
                                <button type="submit" class="deletebtn">Modify</button>
                            </div>
                        </div>
                    </div>
                </div>
                <a name="" id="" class="return" href="list.php" role="button" style="float:left">Return</a>
            </div>
        </form>
    </div>
    <?php
    mysqli_close($conn);
    ?>
</body>

</html>
