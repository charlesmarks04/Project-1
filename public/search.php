<html>

<head>

	<title> Search </title>

</head>


<body>
	<!-- Creating the bar for user typed input -->
	<h1>Website Search</h1> 
    		<form action="search.php" method="get">
        		<input type="text" name="keyword" placeholder="Enter search term..." required>
        		<button type="submit">Search</button>
    		</form>
<?php
	$somethingFound = false; //boolean for if a search finds something
	$searchingFor = $_GET["keyword"]; //initializing a variable equal to the typed keyword
	if (filter_var($searchingFor,FILTER_SANITIZE_STRING)) { //sanitizing input
		$searchingFor = strip_tags($searchingFor); //removing html tags from the input
		echo "<h2> Showing Results for '" . $searchingFor . "'... </h2>"; //heading for if the search is valid
		$pages = ["index.php", "proc_csv.php", "proc_Markdown.php"]; //array of web pages
		foreach($pages as $page){ //for loop to go through each page
		
			$internal_url = "http://host.docker.internal:5555/" . $page; //interal url to be used when searching because file_get_contents didnt like the localhost url
			$external_url = "http://localhost:5555/" . $page; //url to be used when creating links
			$html = file_get_contents($internal_url);
			$html = strip_tags($html);//stripping the page of html tags so they arent able to be searched for
			if(stripos($html,$searchingFor)){ //searching the page for the keyword (Caps doesnt matter)
				echo "<h3>Found '". $searchingFor . "' at <a href= " .$external_url. ">".$page." </a></h3>"; //printing results along with the link to the page
				$somethingFound = true;
			}


		}
		if($somethingFound == false){ //if nothing is found let the user know
			echo "<h3> No Results for '".$searchingFor."'... </h3>";
		}
	}
	else if($searchingFor == ''){ //if the keyword is empty do nothing
	}
	else{ //if the search consists of only html tags let the user know its not a valid search. (EDGE CASE bc users dont really attempt to search html tags)
		$display = str_replace("<", "&lt", $searchingFor);
		echo "<h3> Please Enter a Valid Search. ".$display." is not a Valid Search </h3>";
	}	
?>

	<a href=http://localhost:5555> Back </a><br>
</body>


</html>
