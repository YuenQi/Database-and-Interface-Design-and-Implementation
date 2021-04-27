<?php
include('templates/header.php');
include('config/connect.php');
$table_id = 0;


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

    <h2 class="center"><b>Film</b></h2>

    <form action="read.php" method="POST">
        <input type="hidden" name="id" value="">
        <input type="submit" name="back" value="Go to view table page" class=" right btn brand z-depth-0">

    </form>

    <h5>Type in a film: </h5>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for film title..." title="Type in a film">

    <table id="myTable">
        <tr class="header">
            <th style="width:5%;">Film ID</th>
            <th style="width:10%;">Title</th>
            <th style="width:20%;">Description</th>
            <th style="width:10%;">Release Year</th>
            <th style="width:5%;">Language ID</th>
            <th style="width:15%;">Rental Duration</th>
            <th style="width:5%;">Rental Rate</th>
            <th style="width:5%;">Length</th>
            <th style="width:5%;">Replacement Cost</th>
            <th style="width:5%;">Rating</th>
            <th style="width:15%;">Last Update</th>
        </tr>

        <?php
        require "config/connect.php";

        $query = "SELECT * FROM film";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            echo '<tr><td>' . $row['film_id'] . '</td><td>' . $row['title'] . '</td><td>' . $row['description'] . '</td><td>' . 
                $row['release_year'] . '</td><td>' . $row['language_id'] . '</td><td>' . $row['rental_duration'] . '</td><td>' . 
                $row['rental_rate'] . '</td><td>' . $row['length'] . '</td><td>' . $row['replacement_cost'] . '</td><td>' . 
                $row['rating'] . '</td><td>' . $row['last_update'] . "</td></tr>";
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