<?php
  /*
          File: createtable.php
       Created: 07/26/2020
       Updated: 07/26/2020
    Programmer: Cuates
    Updated By: Cuates
       Purpose: Create tables
  */

  // Create the class structure
  class createtable
  {
    // PHP 5+ Style constructor
    public function __construct()
    {
      // This function needs to be here so the class can be executed when called

      // Include the server address
      include ("path/server_info.php");

      // Initialize parameter
      $this->url = $ServerName;

      // // Initialize parameter
      // $this->url = $_SERVER['HTTP_HOST'];
    }

    // PHP 4 Style constructor
    public function createtable()
    {
      // Call the constructor
      self::__construct();
    }

    // Create a table based on a single column with not export feature
    function createGenericTableDownload ($recData, $columnNames, $columnSortable, $tableNumber, $captionValue, $tableName, $inputFieldArray, $dateFieldArray, $selectFieldArray, $checkboxFieldArray, $textareaFieldArray)
    {
      // Initialize variables
      $returnString = "";

      // Check if record count is greater than 0
      if(count($recData) > 0)
      {
        // Initialize variables
        $rowPos = 0;

        // Begin table
        $returnString = "<br /><table id=\"" . $tableName . $tableNumber . "\" name=\"" . $tableName . $tableNumber. "\" class=\"ManageTable\">";

        // Display an export button for exporting
        $returnString .= "<input type=\"button\" id=\"downloadRecords" . $tableNumber . "\" name=\"downloadRecords" . $tableNumber . "\" class=\"downloadRecords\" value=\"Download\" /><input type=\"hidden\" id=\"currentTable" . $tableNumber . "\" name=\"currentTable" . $tableNumber . "\" class=\"currentTable\" value=\"" . $tableName . $tableNumber . "\" />";

        // Display caption
        $returnString .= "<caption>" . $captionValue . "</caption>";

        // Begin table head
        $returnString .= "<thead>";

        // Begin row
        $returnString .= "<tr>";

        // Loop through all column header
        foreach($columnNames as $vals3)
        {
          // Initialize variables and remove white space and slashes from column string
          $previousValue = $vals3;
          $tempValue = "";
          $tempValue = preg_replace('/\s+/', '', $vals3);
          $tempValue = preg_replace('/\//', '', $tempValue);

          // Check if value exist in the column sortable array
          if(in_array($vals3, $columnSortable))
          {
            // Display the table headers
            $returnString .= "<th><input type=\"button\" id=\"" . $tempValue . "\" name=\"" . $tempValue . "\" class=\"columnSortable\" value=\""  . $previousValue . "\" /></th>";
          }
          else if (trim($vals3) === "Download")
          {
            // Else if value is download then replace
            $returnString .= "<th><input type=\"checkbox\" id=\"" . $tempValue . "\" name=\"" . $tempValue . "\" class=\"columnSortable\" value=\""  . $previousValue . "\" /></th>";
          }
          else
          {
            // Else do not display button for sorting
            $returnString .= "<th>" . $previousValue . "<input type=\"hidden\" id=\"" . $tempValue . "\" name=\"" . $tempValue . "\" class=\"columnSortable\" value=\""  . $previousValue . "\" /></th>";
          }
        }

        // End row
        $returnString .= "</tr>";

        // End table head
        $returnString .= "</thead>";

        // Begin table body
        $returnString .= "<tbody>";

        // Loop through all data records
        foreach($recData as $vals)
        {
          // Initialize position to the first column
          $columnPos = 0;

          // Clear previous EvenOdd value
          $EvenOdd = "";

          // If h is even
          if(($rowPos % 2) == 0)
          {
            // EvenOdd is even
            $EvenOdd .= "even";
          }
          else
          {
            // Else EvenOdd is odd
            $EvenOdd .= "odd";
          }

          // Begin the row
          $returnString .= "<tr id=\"row" . $rowPos . "\" name=\"row" . $rowPos . "\" class=\"row" . $EvenOdd . "\">";

          // Loop through all columns in the array
          foreach($vals as $vals2)
          {
            // Initialize variables and remove white space and slashes from column string
            $tempValue = "";
            $tempValue2 = "";
            $tempValue = preg_replace('/\s+/', '', $columnNames[$columnPos]);
            $tempValue = preg_replace('/\//', '', $tempValue);

            // Check if value is not empty or NULL
            $tempValue2 = (isset($vals2) && trim($vals2) !== "" && $vals2 != null) ? utf8_encode($vals2) : $columnNames[$columnPos];

            // Check if position is in array input field
            if(in_array($columnPos, $inputFieldArray))
            {
              // Display the current
              $returnString .= "<td><span id=\"" . $tempValue . $rowPos . "\" name=\"" . $tempValue . $rowPos . "\" class=\"txtToInput\">" . $tempValue2 . "</span></td>";
            }

            // Check if position is in array text area field
            if(in_array($columnPos, $textareaFieldArray))
            {
              // Display the current
              $returnString .= "<td><span id=\"" . $tempValue . $rowPos . "\" name=\"" . $tempValue . $rowPos . "\" class=\"txtToTextArea\">" . $tempValue2 . "</span></td>";
            }

            // Check if position is in array input date field
            if(in_array($columnPos, $dateFieldArray))
            {
              // Display the current
              $returnString .= "<td><span id=\"" . $tempValue . $rowPos . "\" name=\"" . $tempValue . $rowPos . "\" class=\"txtToDate\">" . $tempValue2 . "</span></td>";
            }

            // Check if position is in array select field
            if(in_array($columnPos, $selectFieldArray))
            {
              // Display the current
              $returnString .= "<td><span id=\"" . $tempValue . $rowPos . "\" name=\"" . $tempValue . $rowPos . "\" class=\"txtToSelect\">" . $tempValue2 . "</span></td>";
            }

            // Check if position is in array check box field
            if(in_array($columnPos, $checkboxFieldArray))
            {
              // Display the current
              $returnString .= "<td><span id=\"" . $tempValue . "\" name=\"" . $tempValue . "\"><input type=\"checkbox\" id=\"" . $tempValue . $rowPos . "\" name=\"" . $tempValue . $rowPos . "\" class=\"reportAction\" /><span id=\"aloader" . $rowPos . "\" name=\"aloader" . $rowPos . "\" class=\"aloader\"><img src=\"path/ajax-loader-small.gif\" alt=\"loader\" title=\"loader\" /></span></span></td>";
            }

            // Check if all of the above do not exist
            if(!in_Array($columnPos, $inputFieldArray) && !in_Array($columnPos, $textareaFieldArray) && !in_Array($columnPos, $dateFieldArray) && !in_Array($columnPos, $selectFieldArray)  && !in_Array($columnPos, $checkboxFieldArray))
            {
              // Display the current
              $returnString .= "<td><span id=\"" . $tempValue . $rowPos . "\" name=\"" . $tempValue . $rowPos . "\">" . $tempValue2 . "</span></td>";
            }

            // Increment column position
            $columnPos++;
          }

          // End row
          $returnString .= "</tr>";

          // Increment row position
          $rowPos++;
        }

        // End table body
        $returnString .= "</tbody>";

        // End table
        $returnString .= "</table>";
      }
      else
      {
        // State that there were no records to display for this table
        $returnString = "There are no records to display.";
      }

      // Return string
      return $returnString;
    }
  }
?>