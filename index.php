<!--
/**
* Copyright 2015 IBM Corp. All Rights Reserved.
*
* Licensed under the Apache License, Version 2.0 (the “License”);
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
* https://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an “AS IS” BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/
->

<?php include 'nosql.php';?>
<?php
?>


<!DOCTYPE html>
<html>

<head>
    <title>PHP MySQL Sample Application</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="">
        <img class="newappIcon" src="images/newapp-icon.png" />
        <h1>
					Welcome to the <span class="blue">PHP MySQL Sample</span> on Bluemix!
				</h1>
        <p class="description">This introductory sample allows you to insert messages into a MySQL database. <br>


            <input type="button" class = "mybutton" onclick="window.location = 'init.php';" class="btn" value="(Re-)Create table"></input></p>
            </br>

    
    <table id='notes' class='records'><tbody>
        
        <?php        
        try {
          // Let's login to the database. 
          $sag = new Sag($myUsername . ".cloudant.com");
          $sag->login($myUsername, $myPassword);
          // Now that we are logged in, we can create a database to use
          $sag->createDatabase("mydatabase");
          $sag->setDatabase("mydatabase");
          if(!$sag->put("myId", '{"myKey":"Hello World from Cloudant!"}')->body->ok) {
            error_log('Unable to post a document to Cloudant.');
          } else {
        	  // We are now going to read a document from our cloudant database. We are going
        	  // to retrieve the value associated with myKey from the body of the document. 
          	  //The SAG PHP library takes care of all the gory details and only retrieves the value.
        	  $resp = $sag->get('myId')->body->myKey;
        	  echo $resp;  
            }
                 
          // Assuming everything above was executed without error, we now are connected to the 
          // database and have retrieved the value.
          
          //NOTE: Since we have a connection to the database, we can query the database for other
          //      documents and retrieve other variables at a later time. We do not need to connect 
          //      to the database again. 
        }
          catch(Exception $e) {
          //We sent something to Sag that it didn't expect.
          echo '<p>There Was an Error Getting Data from Cloudant!!!</p>';
          echo $e->getMessage();
        }

        ?>
        <tr>
            <form method = "POST"> <!--FORM: will submit to same page (index.php), and if ($_SERVER["REQUEST_METHOD"] == "POST") will catch it --> 
                <td colspan = "2">
                <input type = "text" style = "width:100%" name = "message" autofocus onchange="saveChange(this)" onkeydown="onKey(event)"></input>
                </td>
                <td>
                    <button class = "mybutton" type = "submit">Add New Message</button></td></tr>
                </td> 
            </form>
        </tr>
        </tbody>
    </table>
    </div>
</body>

</html>
