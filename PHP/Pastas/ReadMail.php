<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>READ MESSAGE</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <!-- git Tag -->
    <?php 
        include ($_SERVER['DOCUMENT_ROOT'].'/gitTag.php'); 
        git(str_replace($_SERVER['DOCUMENT_ROOT'], "", __DIR__)); 
    ?>
    <!--  -->
    <h1>Inbox</h1>
    <Table>
        <tr>
            <td>
                Nr. | data | žinutė
            </td>
        </tr>
        <?php
            if(!file_exists("m.txt")){//jei failo m.txt nera, isvedame texta
                exit("No messages!");
            } else {//jei failas m.txt egzistuoja, nuskaitome jo turiny
                $fp = fopen("m.txt", "r+");
                $n = file("m.txt");;
                fclose($fp);
                //i lentele isvedame zinutes
                for ($i = 0; $i<count($n); $i++) {
                    echo "<tr><td>".$n[$i]."</td></tr>";
                }
                unlink("n.txt"); //pasalina fiala n.txt
                unlink("m.txt"); //pasalina faila m.txt
                exit;
            }
        ?>
    </Table>
</body>
</html>