<?php

session_start();
include_once('config.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Emprestar</title>
</head>

<body>



    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Emprestar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }

                $result_realizar = "SELECT * FROM item";
                $resultado_realizar = mysqli_query($conexao, $result_realizar);
                while ($row_item = mysqli_fetch_assoc($resultado_realizar)) {

                    echo "<tr>";
                    echo "<td>" . $row_item['id'] . "</td>";
                    echo "<td>" . $row_item['name'] . "</td>";
                    echo "<td>" . $row_item['description'] . "</td>";
                    echo "<td> 
                        <a class='btn btn-sm btn-primary' href='realizar.php?id=$row_item[id]'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-briefcase'>
                            <rect x='2' y='7' width='20' height='14' rx='2' ry='2'>
                            </rect>
                        <path d='M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16'>
                        </path>
                        </svg> 
                        <a class='btn btn-sm btn-danger btn-primary '  href='realizar.php?id=$row_item[id]'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='24'  color='white'  height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'  class='feather feather-trash-2'><polyline  points='3 6 5 6 21 6'></polyline><path  d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line>
                        </svg>
                    </td>";
                    echo "</tr>";
                }


                ?>
            </tbody>
        </table>
    </div>
</body>

</html>