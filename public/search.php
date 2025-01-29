<html>

<head>

	<title> Search </title>

</head>


<body>
	<h1>Website Search</h1>
    		<form action="search.php" method="get">
        		<input type="text" name="keyword" placeholder="Enter search term..." required>
        		<button type="submit">Search</button>
    		</form>
<?php
	$somethingFound = false;
	$searchingFor = $_GET["keyword"];
	if (filter_var($searchingFor,FILTER_SANITIZE_STRING)) {
		$searchingFor = strip_tags($searchingFor); 
		echo "<h2> Showing Results for '" . $searchingFor . "'... </h2>";
		$pages = ["index.php", "proc_csv.php", "proc_Markdown.php"];
		foreach($pages as $page){
		
			$internal_url = "http://host.docker.internal:5555/" . $page;
			$external_url = "http://localhost:5555/" . $page;
			$html = file_get_contents($internal_url);
			$html = strip_tags($html);
			if(stripos($html,$searchingFor)){
				echo "<h3>Found '". $searchingFor . "' at <a href= " .$external_url. ">".$page." </a></h3>";
				$somethingFound = true;
			}

		}
		if($somethingFound == false){
			echo "<h3> No Results for '".$searchingFor."'... </h3>";
		}
	}
	else if($searchingFor == ''){
		continue;
	}
	else{
		$display = str_replace("<", "&lt", $searchingFor);
		echo "<h3> Please Enter a Valid Search. ".$display." is not a Valid Search </h3>";
	}	
?>

	<a href=http://localhost:5555> Back </a><br>
</body>


</html>
