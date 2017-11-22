<!--
/**
* Copyright IBM Corp. 2014
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
* http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/
->


<?php
// Licensed under the Apache License. See footer for details.
//We need to pull in the Sag PHP library. SAG is an open API used to connect to the Cloudant database. 
//We only need to do this once!
require('vendor/autoload.php');
//Get Connection Variables from VCAPS_SERVICES. We first need to pull in our Cloudant database 
//connection variables from the VCAPS_SERVICES environment variable. This environment variable 
//will be put in your project by Bluemix once you add the Cloudant database to your Bluemix
//application. 
// vcap_services Extraction 
$services_json = json_decode(getenv('VCAP_SERVICES'),true);
$VcapSvs = $services_json["cloudantNoSQLDB"][0]["credentials"];
//Debug: If you want to see all the variables returned you can use this line of code. 
//var_dump($services_json); 
// Extract the VCAP_SERVICES variables for Cloudant connection.  
 $myUsername = $VcapSvs["username"];
 $myPassword = $VcapSvs["password"];
 

// Let's login to the database. 
$sag = new Sag($myUsername . ".cloudant.com");
$sag->login($myUsername, $myPassword);
// Now that we are logged in, we can create a database to use
$sag->createDatabase("mydatabase");
$sag->setDatabase("mydatabase");

?>