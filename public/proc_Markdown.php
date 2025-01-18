<?php

	function proc_markdown($filename){
	
		$handle = fopen($filename, "r") or die("Cannot Open MD file");
		$in_ulist = false;
		$in_usublist = false;
		while($data = fgets($handle))
		{
			if($data == "\n")
			{

				if ($in_ulist) 
				{
                			echo "</ul>";
                			$in_ulist = false;
            			}
				
				echo "</p> <p>";
				continue;			
			}

			$data = preg_replace("/^\s*# (.*)/", "<h1> $1 </h1>" , $data); //First Level Heading
			$data = preg_replace("/^\s*## (.*)/", "<h2> $1 </h2>" , $data); //Second Level Heading
			$data = preg_replace("/^\s*### (.*)/", "<h3> $1 </h3>" , $data); //Third Level Heading

			$data = preg_replace("/!\[(.+?)\]\((.+?)\)/", "<img src=$2 alt= $1 ></img>", $data); //Image
			$data = preg_replace("/\[(.+?)\]\((.+?)\)/", "<a href=$2> $1 </a>", $data); //URL


			$data = preg_replace("/\*\*(.+?)\*\*/", "<b>$1</b>", $data); //Bold Text
			$data = preg_replace("/_(.+?)_/", "<i>$1</i>", $data); //Italics Text


			if(preg_match("/^\s*\* (.*)/" , $data)) //Unordered List
			{
				if(!$in_ulist)
				{
					echo "<ul>";
					$in_ulist = true;
				}
				if(preg_match("/^ {4}\* (.*)/", $data))
				{
					if(!$in_usublist)
                                	{
                                        	echo "<ul>";
                                        	$in_usublist = true;
                                	}

				}
				else if($in_usublist)
				{
					echo "</ul>";
					$in_usublist = false;
				}
				$data = preg_replace("/^\s*\* (.*)/",  "<li>$1</li>" , $data);
			}

			echo $data;			
	


		}	
		fclose($handle);
		if($in_ulist)
                	echo "</ul>";
	}

?>
