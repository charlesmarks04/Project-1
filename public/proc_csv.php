<?php
   function proc_csv($filename, $delimiter, $quote, $columns_to_show) {
               $handle = fopen($filename, "r") or die("Cannot Open CSV file");
               $column_numbers = explode(":", $columns_to_show);
               echo "<table  border=\"1\">\n";
               if($delimiter === "\t")
                    $delimiter = '\t(?=(?:[^"]*"[^"]*")*[^"]*$)'; //delimiter to select all tabs that arent included in quotes
               if($delimiter === ",")
                    $delimiter = ',(?=(?:[^"]*"[^"]*")*[^"]*$)'; //delimiter to select all commas that arent included in quotes
               $firstPass = true;
               while($data = fgets($handle)) {
                       echo "<tr>\n";
                       $data_cols = preg_split("/" . $delimiter . "/", $data);
                       for($k=0; $k<count($data_cols); ++$k) {
                                if($firstPass === true) {
					if(in_array((string)($k+1), $column_numbers) || $columns_to_show === "ALL")
                                        echo " <td> <b> ".preg_replace("/".$quote."/", "", $data_cols[$k] )." </b> </td>\n"; //prints the first item of each column in bold
                                }
                                else {
					if(in_array((string)($k+1), $column_numbers) || $columns_to_show === "ALL")
                                        echo "  <td> ".preg_replace("/".$quote."/", "", $data_cols[$k] )." </td>\n";
                       		}
		       }
                       $firstPass = false; //boolean to keep track of if it is the first item in each column
                       echo "</tr>\n";
               }
               fclose($handle);
               echo "</table>\n<p/>";
	}
?>
