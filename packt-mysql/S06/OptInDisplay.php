<?php
include('SQLFunctions.php');

/*Open the database connection based on config.php file settings*/
  $link = f_sqlConnect();
  
/*Set Source Table*/  
  $table = 'OptIn';
  echo '<br>Source Table: ' . $table;
  
/*check to see if the table exists*/
  if (!f_tableExists($link, $table, DB_NAME) ) {
    die('<br>Destination Table Does Not Exist:'.$table);
  }

/*Query contents of source table*/
  $sql="SELECT * FROM $table ";
  echo '<br>sql :'.$sql;
    if ($result = mysqli_query($link,$sql)){
      echo "<table border=''1'' style=''width:100%''>";
        //header
        echo "<tr>";
          echo "<td>OptInID</td>";
          echo "<td>formID</td>";
          echo "<td>First Name</td>";
          echo "<td>Last Name</td>";
          echo "<td>Email Addess</td>";
          echo "<td>Date/Time</td>";
          echo "<td>Source IP</td>";
          echo "<td>SuccessUrl</td>";
          echo "<td>RejectUrl</td>";          
        echo "</tr>";
      
      //for each row returned in the query, separate them into <td> tags
      while ($row = mysqli_fetch_array($result))  {
        echo "<tr>";
          echo "<td>{$row[0]}</td>";
          echo "<td>{$row[1]}</td>";
          echo "<td>{$row[2]}</td>";
          echo "<td>{$row[3]}</td>";
          echo "<td>{$row[4]}</td>";
          echo "<td>{$row[5]}</td>";
          echo "<td>{$row[6]}</td>";
          echo "<td>{$row[7]}</td>";
          echo "<td>{$row[8]}</td>";          
        echo "</tr>";
      } 
      echo "</table>";
    }
    /*mysqli_free_result() clears the $result variable*/
    mysqli_free_result($result);

/*display any sql error encountered */
  if (mysqli_error($link)) {
    echo '<br>Error: ' . mysqli_error($link);
  }else echo '<br>Success';

/*Close database connection*/
  mysqli_close ( $link );
  
?>