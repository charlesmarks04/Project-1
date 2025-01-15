<html>

<!-- HEAD section ............................................................................ -->
<head>
  <title> Charles Marks' Website </title>

  <!-- style -->
 
  <!--
  <style>
    div.defaultFont {
        font-family: Helvetica, Arial, sans-serif;
    }
   
    div.secondaryFont {
        font-family: serif;
    }

    <link href="default.css" rel="stylesheet" type="text/css>
  </style> -->

  <LINK REL=StyleSheet HREF="simple.css" TYPE="text/css" MEDIA=screen>
 

</head>

<!-- BODY section ............................................................................. -->
<body>
<div class="defaultFont">

<!-- PHP testing area ................................ -->
<?php

   echo "<h1> Charles' CSCE 331 Docker Web Site </h1>\n";


   function proc_csv($filename, $delimiter, $quote, $columns_to_show) {
               $handle = fopen($filename, "r") or die("Cannot Open CSV file");
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
					echo "  <td> <b> ".preg_replace("/".$quote."/", "", $data_cols[$k] )." </td> </b>\n"; //prints the first item of each column in bold
				}
				else
                               		echo "  <td> ".preg_replace("/".$quote."/", "", $data_cols[$k] )." </td>\n";
		       }  
		       $firstPass = false; //boolean to keep track of if it is the first item in each column
     	               echo "</tr>\n";
               }
               fclose($handle);
               echo "</table>\n<p/>";
   }


   proc_csv("dat2-singlequote-tab.csv", "	" , "\'" , "ALL") 
?>
</body>
</html>
