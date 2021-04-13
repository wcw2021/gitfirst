<?php
include('SQLFunctions.php');

if ( !empty($_POST)) {
  // Store data from html form POST action into variables
  $tdTitle = $_POST['ToDoTitle'];
  $tdDate  = $_POST['ToDueDate'];
  $tdDescr = $_POST['ToDoDescription'];
         
/*Open the database connection based on config.php file settings*/
  $link = connectDB();

  /*Prepare the SQL INSERT Statement*/
  $sql = "INSERT INTO ToDos (ToDoTitle, ToDoDescription, ToDueDate, EntryTS) VALUES ('".$tdTitle."','".$tdDescr."','".$tdDate."', NOW());";
  /*Insert values into the database*/
  if (mysqli_query($link, $sql)) {
  /*    echo "<br>New record created successfully";*/
  } else {
      echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
  }

/*Close database connection*/
mysqli_close ( $link );

/*Forward User Back to Main View*/  
header("Location: ToDoApp.php");

}

?>