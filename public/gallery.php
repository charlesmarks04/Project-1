<html>

<head>

  <title> Charles Marks' Website </title>

</head>

<body>

<?php

        echo "<h1> Charles' CSCE 331 Gallery </h1>\n";

	require_once("proc_gallery.php");
	require_once("proc_csv.php");
        echo "<h1><ins> Gallery </ins></h1>";
                proc_gallery("Image_CSV.csv", "list", "orig");
                proc_gallery("Image_CSV.csv", "matrix", "orig");
                proc_gallery("Image_CSV.csv", "list", "size_largest");
                proc_gallery("Image_CSV.csv", "list", "size_smallest");
                proc_gallery("Image_CSV.csv", "details", "size_smallest");
                proc_gallery("Image_CSV.csv", "details", "rand");
                proc_gallery("Image_CSV.csv", "matrix", "rand");
?>


	<a href=http://localhost:5555> Back </a><br>

</body

</html>
