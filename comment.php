<?php error_reporting(0); ?>

<html>
  <head>
    <title>
      Comment
    </title>
    <link rel="icon" href="img/logo_1.png">
  </head>

  <style type="text/css"> 

    /* Add some styling to the messages */
    .message {
      margin: 10px 0;
      font-family: sans-serif;
      font-size: 16px;
    }

    .message b {
      font-weight: bold;
    }

    /* Add some styling to the form */
    form {
      margin: 20px 0;
      display: flex;
      flex-direction: column;
    }
 
    input[type="text"], textarea {
      font-family: sans-serif;
      font-size: 16px;
      padding: 5px;
      border: 1px solid #ccc;
    }

    input[type="submit"] {
      font-family: sans-serif;
      font-size: 16px;
      padding: 5px 10px;
      background-color: #4caf50;
      color: white;
      border: none;
      cursor: pointer;
    }

    h1{
      color: #00FF55;
    }
  
    body{
      font-family: Arial;
      letter-spacing: 2px;
      color: #666666;
    }

    .present2{
      letter-spacing: 4px;
      font-size: 12px;
      font-family: Verdana;
    }

    .button{
      padding: 20px;
      background-color: #AAA;
      border: 2px solid #000:
      border-radius: 15px 15px 15px 15px;
      letter-spacing: 4px;
      font-size: 12px;
      font-family: Verdana;
      color: #FFFFFF;
      text-decoration: none;      
    }

    .button:hover{
      background-color: #666;
    }
   
    input{
    padding: 10px;
    }

  </style>

  <body>

    <div align='center'>
      <table width='80%' style='text-justify: justify;' class='present2'>
        <tr>
          <td>
            <div style='text-align: justify;'>                         
<?php

echo '<h1>' . $_GET['comment_file'] . '</h1>';
$filename_hash = sha1($_GET['comment_file']);
$comment_file = $_GET['comment_file'];
if(!file_exists("comments")){
  mkdir("comments");
}

// Display the message form
echo "<form method='post' action=''>";
echo "<input type='text' name='name' placeholder='Name'>";
echo "<textarea name='message' placeholder='Message'></textarea>";
echo "<input type='submit' name='submit' value='Submit'>";
echo "</form>";

// Check if the form has been submitted
if (isset($_POST['submit'])) {

  // Get the form data
  $name = $_POST['name'];
  $message = $_POST['message'];

  $avoid_chars = array ('<', '>', "//");
  $name = str_replace($avoid_chars, "", $name); 
  $message = str_replace($avoid_chars, "", $message);

  $day = date("d");

  $month = date("m");

  $year = date("y");




  $date = $day . '/' . $month . '/' . $year; 
  $sha1_msg = sha1("$name $message $date");

  // Format the message as a string
  $messageString = "<a href='comment.php?comment_file=$sha1_msg' target='_blank'>[comment]</a> $date - $name: $message\n";

  // Append the message to the messages file
  file_put_contents("comments/$filename_hash", $messageString, FILE_APPEND);
}

// Read the messages file
$messages = file_get_contents("comments/$filename_hash");

// Split the messages into an array
$messages = explode("\n", $messages);

// Display the messages
foreach ($messages as $message) {
  echo "$message<br>";
}

?>
              </div>
            </td>
          </tr>
        </table>

      <br><br><br><br>
 
      <a href='index.php' class='button'>&nbsp; Back &nbsp;</a>

      <br><br><br><br>
    </div>
  </body>
</html>