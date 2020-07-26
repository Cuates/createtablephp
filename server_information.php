<?php
  /*
          File: server_information.php
       Created: 07/26/2020
       Updated: 07/26/2020
    Programmer: Cuates
    Updated By: Cuates
       Purpose: Define residing server
  */

  // Get Host name
  $ServerInfo = php_uname('n');

  // Initialize variables
  $ServerName = "https://development_server";

  // Define array of dev words
  $ServerType = array('dev');

  // Check if server info does not consist of server type
  if(!preg_match("/\b[a-zA-Z0-9(\W)(\_)(\s)]{0,}" . implode('|', $ServerType) . "[a-zA-Z0-9(\W)(\_)(\s)]{0,}\b/i", $ServerInfo))
  {
    // Set server name to production
    $ServerName = "https://production_server";
  }
?>