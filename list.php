<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet/stil.css" media="screen" rel="stylesheet" type="text/css">
    <title>Lego</title>
</head>
	</head>
	  <body>
      <table>

        <tr>
          <th>Part name</th>
          <th>Color</th>
          <th>File name</th>
          <th>Quantity</th>
          <th>Picture</th>
        </tr>
      <?php

        $id = $_GET['ID'];
        print("<p>$id</p>");

        $connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
        if (!$connection) {
          die('MySQL connection error');
        }
        
        $sql = "SELECT 
          inventory.ItemID,
          inventory.Quantity,
          parts.Partname,
          inventory.ItemtypeID,
          colors.Colorname,
          inventory.ColorID,
          images.has_gif,
          images.has_jpg
        FROM 
          inventory, parts, colors, images
        WHERE
          inventory.SetID = '$id'
        AND
          inventory.ItemtypeID = 'P'
        AND
          inventory.ColorID = colors.ColorID
        AND
          inventory.ItemID = parts.PartID
        AND
          inventory.ItemID = images.ItemID
        AND
          inventory.ColorID = images.ColorID";

        // Ställ frågan  
        $result = mysqli_query($connection, $sql);

        
        while ($row = mysqli_fetch_array($result)) {

          $name = $row['Partname'];
          $color = $row['Colorname'];
          $quantity = $row['Quantity'];

          
          $itemtypeID = $row['ItemtypeID'];
          $colorID = $row['ColorID'];
          
          $url = $itemtypeID . "/" . $colorID . "/" . $row['ItemID'];

          if($row['has_gif']) {
            $url = $url . ".gif";
          }
          else if($row['has_jpg']) $url = $url . ".jpg";
          else {
            $url = "";
          }
          
          print("<tr>");
          print("<td><p>$name</p></td>");
          print("<td><p>$color</p></td>");
          print("<td><p>$url</p></td>");
          print("<td><p>$quantity</p></td>");
          print("<td><img src='https://weber.itn.liu.se/~stegu76/img.bricklink.com/$url'></td>");
          print("</tr>");
        }

      ?>
      
      </table>
    </body>
</html>
