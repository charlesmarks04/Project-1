<?php

	function proc_markdown($filename){
	
		$handle = fopen($filename, "r") or die("Cannot Open MD file");
		$in_list = false;
		$list_data = null;
		while($data = fgets($handle)) {
			if($data == "\n")
				$data = "<p>";			

			$data = preg_replace("/^\s*# (.*)/", "<h1> $1 </h1>" , $data); //First Level Heading
			$data = preg_replace("/^\s*## (.*)/", "<h2> $1 </h2>" , $data); //Second Level Heading
			$data = preg_replace("/^\s*### (.*)/", "<h3> $1 </h3>" , $data); //Third Level Heading

			$data = preg_replace("/!\[(.+?)\]\((.+?)\)/", "<img src=$2 alt= $1 ></img>", $data); //Image
			$data = preg_replace("/\[(.+?)\]\((.+?)\)/", "<a href=$2> $1 </a>", $data); //URL


			$data = preg_replace("/\*\*(.+?)\*\*/", "<b>$1</b>", $data); //Bold Text
			$data = preg_replace("/_(.+?)_/", "<i>$1</i>", $data); //Italics Text



			//WORK IN PROGRESS LISTS
			$data = preg_replace("/^\* (.*)/",  "$1" , $data);


			echo $data;


		}	
		fclose($handle);
	}

?>
