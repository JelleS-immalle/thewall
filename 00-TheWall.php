<?php


if(isset($_POST["contents"])) {
  // store in database
  include 'db_credentials.php';

    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT inhoud, tijdstip
            FROM messages;
        )";
        
        $result = $conn->query($sql);

        for($i=0; $i<$result->rowCount(); $i++) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        echo "<tr>";
        print_r($row);            
	       $html = '<div class="TheWallMessage">';
	       $html .= '<div class="TheWallMessageHeader">';
	       $html .= $msg["tijdstip"];
            $html .= "</div>";
            $html .= '<div class="TheWallMessageContent">';
            $html .= $msg["inhoud"];
            $html .= "</div>";
            $html .= "</div>";
        echo $html;
        echo "</tr>";
    }

  echo $_POST["contents"];
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>The Wall</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        
        /*\
        |*|
        |*| color scheme:   
        |*| http://paletton.com/#uid=33y080k8tjbhRGYb1rG3-bj013A
        |*|
        |*| fixed bottom:
        |*| http://www.cssreset.com/demos/layouts/how-to-keep-footer-at-bottom-of-page-with-css/
        |*|
        \*/
        html, body {
            background-color: #998A70;
            text-align: center;
            color: #DDB891;
            font-size: 80%;
            font-family: Georgia, serif;
            margin: 0;
            padding: 0;
            height: 100%;
        }
        #wrapper {
            min-height: 100%;
            position: relative;
        }
        .container {
            padding-bottom: 120px;
        }
        #header, #footer {
            background-color: #34373A;
            background-image: 
                linear-gradient(335deg, #998A70 23px, transparent 23px), 
                linear-gradient(155deg, #5A5650 23px, transparent 23px), 
                linear-gradient(335deg, #998A70 23px, transparent 23px), 
                linear-gradient(155deg, #5A5650 23px, transparent 23px);
            background-size: 58px 58px;
            background-position: 0px 2px, 4px 35px, 29px 31px, 34px 6px;
        }
        #header {
            width: 100%;
            height: 92px;
        }
        #footer {
            width: 100%;
            height: 92px;
            position: absolute;
            bottom: 0;
            left: 0;    
        }
        .jumbotron {
            background-color: #4A5863;           
            padding: 0.3em;
            margin-top: 1em;
            border-radius: 5px;
            box-shadow: rgba(0,0,0,0.2) 0.6em 0.6em;
        }
        #TheWallMessages {
            background-color: #4A5863;
            border-radius: 5px;
            margin-top: 0.2em;
            padding: 0.1em;
            box-shadow: rgba(0,0,0,0.2) 0.6em 0.6em;
        }
        .TheWallMessage {
            font-size: large;
            margin: 1em;
            background-color: #34373A;
            border-radius: 5px;
            box-shadow: rgba(0,0,0,0.2) 0.3em 0.3em;
        }
        .TheWallMessageHeader {
            font-family: 'Lucida Console';
            font-size: 0.6em;
            color: #998570;
            background-color: #121212;
            border-radius: 5px;
        }
        .TheWallMessageContent {
            padding: 0.5em 0;
        }
        #TheWallInputForm {
            background-color: #FFBB71;
            margin-top: 4em;
            border: solid 1em #4A5863;
            border-radius: 5px;
            box-shadow: rgba(0,0,0,0.2) 0.6em 0.6em;
        }
        .btn-primary {
            background-color: #5F97C6;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="header"></div>

        <div class="container">

            <div class="jumbotron">
                <h1>The Wall</h1>
            </div>

            
            <div id="TheWallMessages">
            <?php
            
            // TODO: uit database halen
            
            $message1 = array(
              "tijdstip" => date("Y-m-d H:i:s"),
              "message" => "Hallo!"
            );
            
            $message2 = array(
              "tijdstip" => date("Y-m-d H:i:s"),
              "message" => "Gij ook!"
            );
            
            $messages = array(
              $message1,
              $message2
            );

            foreach($messages as $msg) {
            
	       $html = '<div class="TheWallMessage">';
	       $html .= '<div class="TheWallMessageHeader">';
	       $html .= $msg["tijdstip"];
               $html .= "</div>";
               $html .= '<div class="TheWallMessageContent">';
               $html .= $msg["inhoud"];
               $html .= "</div>";
               $html .= "</div>";
               
               echo $html;
            }
            
            
            
            ?>

            <div id="TheWallInputForm">
                <form role="form" method="post">
                    <textarea name="contents" class="form-control" rows="3" placeholder="Scribble on The Wall!" required></textarea>
                    <button type="submit" class="btn btn-block btn-primary">
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        &nbsp; Post it! &nbsp;
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    </button>
                </form>
            </div>

        </div>

        <div id="footer"></div>
    </div>
</body>
</html>