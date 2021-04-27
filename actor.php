<?php 
include('templates/header.php');
include('config/connect.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        #myInput {
            background-image: url('/css/searchicon.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        #myTable {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
            font-size: 18px;
        }

        #myTable th,
        #myTable td {
            text-align: left;
            padding: 12px;
        }

        #myTable tr {
            border-bottom: 1px solid #ddd;
        }

        #myTable tr.header,
        #myTable tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>

    <h2 class="center"><b>Actor</b></h2>

    <form action="read.php" method="POST">
        <input type="hidden" name="id" value="">
        <input type="submit" name="back" value="Go to view table page" class=" right btn brand z-depth-0">

    </form>
    


    
    <h5>Type in actor's first name: </h5>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for actor..." title="Type in actor's first name">

    <table id="myTable">
        <tr class="header">
            <th style="width:15%;">Actor ID</th>
            <th style="width:30%;">First Name</th>
            <th style="width:30%;">Last Name</th>
            <th style="width:25%;">Last Update</th>
        </tr>

        <?php
        require "config/connect.php";

        $query = "SELECT * FROM actor";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            echo '<tr><td>' . $row['actor_id'] . '</td><td>' . $row['first_name'] . '</td><td>' . $row['last_name'] . '</td><td>' . $row['last_update'] . "</td></tr>";
        }
        ?>
    </table>

    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

    

    <h2></h2>

</body>

</html>