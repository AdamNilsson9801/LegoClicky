<?php error_reporting(E_ALL);
  ini_set("display_error",1);
?>

<!DOCTYPE html>
<html lang="sv">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet/stil.css" media="screen" rel="stylesheet" type="text/css">
    <title>Lego</title>
  </head>
	<body>

    <h1>Search:</h1>
     <!-- <a href="writeblog.php">Nytt inlägg</a><br><br>

      <a href="readblog.php?limit=5">Visa 5 senaste inläggen</a> <a href="readblog.php?limit=2">Visa 2 senaste inläggen</a> -->
      
      
    
      <form action="<?php $_SERVER['PHP_SELF']?>" method="get">     
        <input type="text" name="search" id="search" required>
      </form>
      <?php

        //Koppla upp mpt databasen
        $connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
        if (!$connection) {
          die('MySQL connection error');
        }

        $search = $_GET['search'];

        
        $sql = "SELECT
          SetID,
          Setname
        FROM 
          sets
        WHERE
          Setname LIKE '%$search%'
        OR 
          SetID LIKE '%$search%'";
        
        // Ställ frågan  
        $result = mysqli_query($connection, $sql);    
        
        // Skriv ut alla poster i svaret    
        while ($row = mysqli_fetch_array($result)) {  
          $text = $row['SetID'];                          
          $heading = $row['Setname'];                                
          print("<a href='list.php?ID=$text'>");                            
          print("<h3>$heading</h3>\n");                                 
                                  
          print("<p>$text</p>\n");                                       
          print("<hr/>");                                
          print("</a>");                                                   
        } // end while
        
      mysqli_close($connection);
      ?>
    </body>
</html>
