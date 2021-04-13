<?php
/*Bring in our custom library of php and functions, we will create this next*/
include('SQLFunctions.php');

/*First we are going to handle what is being submitted in the form by displaying it, so we display what is in the _POST*/
/*echo simply means write the following out to the page, adding this description and the line breaks will make the output legible */
/*The echo statements aren�t actually needed, but they are really helpful in troubleshooting*/
  echo '<br>Display full contents of the _POST: <br>';
/*var_dump is a function that write all of names and values from the post*/
  var_dump($_POST);

/*We need to esatblish a connection with the database
   f_sqlConnect() is a function we will create in SLQFunctions.php and will to the database based on config.php file settings. $link is a variable where we store the connection so we can reference it*/
  $link = f_sqlConnect();
  
/*We are going to pull out the destination table for this data*/
/*isset() is a function that checks whether or not anything is stored under the name formID from $_POST, if so, we are storing that as the table name*/
    if(isset($_POST['formID'])){ $table = $_POST['formID']; } 
    echo '<br>Destination Table: ' . $table;

/*We are going to divide the values from the form in an array that we will use later*/  
/*implode a function that reads through _POST and divides the names into an array, we will call it keys, and then we use it again for the _POST values, put them into an array call values.*/
  $keys = implode(", ", (array_keys($_POST)));
  echo '<br>Parsed Key :'.$keys;
  $values = implode("', '", (array_values($_POST)));
  echo '<br>Parsed Values :'.$values;

/*We now want to record the source IP as well as date/time 
PHP offers some really cool features like detecting the IP that the _POST came from and recording the time that the transaction happened.*/    
  $x_fields = 'ENTRY_TimeStamp, SOURCE_IP';
  $x_values = date("Y-m-d H:i:s") . "', '" . f_getIP();  /*f_getIP() is a custom function from SQLFunctions.php*/
  echo '<br>x_values :'.$x_values;

/*Then we want to confirm that the destination table exists prior to actually attempting to insert the data.  We use another custom function from SQLFunctions.php, f_tableExists*/
/*check to see if the table exists*/
  if (!f_tableExists($link, $table, DB_NAME) ) {
    die('<br>Destination Table Does Not Exist:'.$table);
  }

/*Grab the success and reject URLs from the _POST and store them in variables that we can use later.*/
  if(isset($_POST['rejectredirecturl'])){ 
    $rejectredirecturl = $_POST['rejectredirecturl']; 
    echo '<br>rejectredirecturl :'.$rejectredirecturl;
  } 
  if(isset($_POST['successredirecturl'])){ 
    $successredirecturl = $_POST['successredirecturl']; 
    echo '<br>successredirecturl :'.$successredirecturl;
  }   

/*We now assemble the SQL that will insert our values into the database.*/
  $sql="INSERT INTO $table ($keys, $x_fields) VALUES ('$values', '$x_values')";
  echo '<br>sql :'.$sql;

/*We attempt the SQL Insert, mysqli_query() actually tries to execute the sql against the database connection provided. mysqli_error() is a function that stores any MySQL errors that occurred when the script was run*/
  if (!mysqli_query($link,$sql)) {
    echo '<br>Error: ' . mysqli_error($link);
    if (!empty ($rejectredirecturl)) {
                  /*header Location with a url will redirect the user to the url specified.
                    We have this row commented out so we can review the troubleshooting 
                    text written above*/
                  /*header("Location: $rejectredirecturl?msg=1");*/
               }
  }else if (!empty ($successredirecturl)) {
                 /*header("Location: $successredirecturl?msg=1");*/
               }

/*Lastly - It�s always good practice to close the database connection*/
  mysqli_close ($link);
?>