<html>

<head>

  <title> CSV Tables </title>

</head>

<body>


<?php
   echo "<h1><ins> CSV Tables </ins></h1>";
   function proc_csv($filename, $delimiter, $quote, $columns_to_show) {
               $handle = fopen($filename, "r") or die("Cannot Open CSV file");
               $column_numbers = preg_split("/:/", $columns_to_show); //creates an array of column values
               echo "<table  border=\"1\">\n";
               if($delimiter == "\t")
                    $delimiter = '\t(?=(?:[^"]*"[^"]*")*[^"]*$)'; //delimiter to select all tabs that arent included in quotes
               if($delimiter == ",")
                    $delimiter = ',(?=(?:[^"]*"[^"]*")*[^"]*$)'; //delimiter to select all commas that arent included in quotes
               $firstPass = true;
               while($data = fgets($handle)) {
                       echo "<tr>\n";
                       $data_cols = preg_split("/" . $delimiter . "/", $data); //splits $data (horizontal lines of csv file) into individual array elements split by delimiter
                       for($k=0; $k<count($data_cols); ++$k) {
                                if($firstPass == true) {
					if(in_array((string)($k+1), $column_numbers) || $columns_to_show === "ALL") //checks if $k+1 (column number) is equal to some value in $column_numbers (array of columns to show values) or if columns to show is ALL
						echo " <td> <b> ".preg_replace("/".$quote."/", "", $data_cols[$k] )." </b> </td>\n"; //prints the first item of each column in bold
                                }
                                else {
					if(in_array((string)($k+1), $column_numbers) || $columns_to_show === "ALL")
                                        	echo "  <td> ".preg_replace("/".$quote."/", "", $data_cols[$k] )." </td>\n";
                       		}
		       }
                       $firstPass = false; //boolean to keep track of column headers for them to be bold
                       echo "</tr>\n";
               }
               fclose($handle);
               echo "</table>\n<p/>";
	}
	
	echo "<h3> Single Quote, Tab CSV, Displaying Columns 2 and 4 </h3>\n";
        proc_csv("dat2-singlequote-tab.csv", "\t" , "\'" , "2:4"); //calling proc_csv
        echo "<h3> Double Quote, Tab CSV, Displaying Columns 1 and 3 </h3>\n";
        proc_csv("dat2-doublequote-tab.csv", "\t" , "\"" , "1:3"); //calling proc_csv
        echo "<h3> Double Quote, Comma CSV, Displaying ALL Columns </h3>\n";
        proc_csv("dat-doublequote-comma.csv", "," , "\"" , "ALL"); //calling proc_csv
	
?>
	<a href=http://localhost:5555> Back </a><br>
</body>

</html>
