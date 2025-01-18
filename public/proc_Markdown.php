<?php

	function proc_markdown($filename){
	
		$handle = fopen($filename, "r") or die("Cannot Open MD file");
		$in_list = false;
		$list_data = null;
		while($data = fgets($handle)) {
			$data = trim($data, " ");
			if($data == "\n")
				$data = "<p>";			
			if(preg_match("/^# (.*)/" , $data, $matches))
			{
				$data = "<h1>$matches[1]</h1>"; 
			}
			if(preg_match("/^## (.*)/" , $data , $matches))
                        {
                                $data = "<h2>$matches[1]</h3>";
                        }
			if(preg_match("/^### (.*)/" , $data, $matches))
                        {
                                $data = "<h3>$matches[1]</h3>";
                        }

			if(preg_match("/!\[(.+?)\]\((.+?)\)/" , $data, $matches)) //images
                        {
	                       $data = preg_replace("/!\[(.+?)\]\((.+?)\)/", "<img src=$matches[2] alt= $matches[1] ></img>", $data);
                        }
                        if(preg_match("/(?<!\!)\[(.+?)\]\((.+?)\)/" , $data, $matches)) //URL
                        {
                                $data = preg_replace("/\[(.+?)\]\((.+?)\)/", "<a href= $matches[2]> $matches[1] </a>", $data);
                        }

			if(preg_match("/\*\*(.+?)\*\*/" , $data, $matches))
                        {	
				$data = preg_replace("/\*\*(.+?)\*\*/", "<b>$matches[1]</b>", $data);
                        }
			if(preg_match("/_(.+?)_/" , $data, $matches))
                        {
				$data = preg_replace("/_(.+?)_/", "<i>$matches[1]</i>", $data);
                        }
			if(preg_match("/^\* (.*)/" , $data , $matches))
			{
				$data = preg_replace("/^\* (.*)/",  "$matches[1]" , $data);
			}


			echo $data;


		}	
		fclose($handle);
	}

?>
