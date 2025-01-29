<html>

<head>

	<title> Search </title>

</head>


<body>
	<a href=http://localhost:5555> Back </a><br>	
	<h1>Website Search</h1>
    		<form action="search.php" method="get">
        		<input type="text" name="keyword" placeholder="Enter search term..." required>
        		<button type="submit">Search</button>
    		</form>
<?php
$somethingFound = false;
$searchingFor = $_GET["keyword"];
if (filter_var($searchingFor,FILTER_DEFAULT)) {
	echo "<h2> Showing Results for '" . $searchingFor . "'... <h2>";
	$pages = ["/index.php", "/proc_csv.php", "/proc_markdown.php"];
	foreach($pages as $page){
		
		//$url = "http://localhost:5555/" . $page;
		$html = file_get_contents("http://host.docker.internal:5555/index.php");
		print_r($html);
		if(str_contains($html,$searchingFor)){
			echo "<h3> Found ". $searchingFor . " at <a " .$searchingFor. ">".$url." </a><h3>";
			$somethingFound = true;
		}

		


	}
	if($somethingFound == false){
		echo "<h3> No Results for '".$searchingFor."'... <h3";
	}
}	
?>

</body>


</html>
