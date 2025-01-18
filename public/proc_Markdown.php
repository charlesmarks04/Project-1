<?php

	function proc_markdown($filename){
	
		$handle = fopen($filename, "r") or die("Cannot Open MD file");
		$in_list = false;
		$list_data = null;
		while($data = fgets($handle)) {
			$data = trim($data, " ");
			if($data == "\n")
				$data = "<p>";			

			$data = preg_replace("/^# (.*)/", "<h1> $1 </h1>" , $data);
			$data = preg_replace("/^## (.*)/", "<h2> $1 </h2>" , $data);
			$data = preg_replace("/^### (.*)/", "<h3> $1 </h3>" , $data);

			$data = preg_replace("/!\[(.+?)\]\((.+?)\)/", "<img src=$2 alt= $1 ></img>", $data);
			$data = preg_replace("/\[(.+?)\]\((.+?)\)/", "<a href=$2> $1 </a>", $data);


			$data = preg_replace("/\*\*(.+?)\*\*/", "<b>$1</b>", $data);
			$data = preg_replace("/_(.+?)_/", "<i>$1</i>", $data);

			$data = preg_replace("/^\* (.*)/",  "$1" , $data);


			echo $data;


		}	
		fclose($handle);
	}

?>
