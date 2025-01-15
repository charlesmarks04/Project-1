<html>

<head>

  <title> Charles Marks' Website </title>

</head>

<body>

<?php

	echo "<h1> Charles' CSCE 331 Docker Web Site </h1>\n";
	
	require_once("proc_csv.php");   	
	echo "<h3> Single Quote, Tab CSV, Displaying Columns 2 and 4 </h3>\n";
	proc_csv("dat2-singlequote-tab.csv", "\t" , "\'" , "2:4"); //calling proc_csv
	echo "<h3> Double Quote, Tab CSV, Displaying Columns 1 and 3 </h3>\n";
	proc_csv("dat2-doublequote-tab.csv", "\t" , "\"" , "1:3"); //calling proc_csv
	echo "<h3> Double Quote, Comma CSV, Displaying ALL Columns </h3>\n";
	proc_csv("dat-doublequote-comma.csv", "," , "\"" , "ALL"); //calling proc_csv


?>
</body>
</html>
