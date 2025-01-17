<?php

	function proc_markdown($filename){
	
		$handle = fopen($filename, "r") or die("Cannot Open MD file");
		
		while($data = fgets($handle)) {
			echo $data . "<br>";
			$data = trim($data, " ");
			if(preg_match("/^# (.*)/" , $data, $matches))
			{
				echo "<h1> ". $matches[1] . "</h1>"; 
			}
			else if(preg_match("/^## (.*)/" , $data , $matches))
                        {
                                echo "<h2> ". $matches[1] . "</h3>";
                        }
			else if(preg_match("/^### (.*)/" , $data, $matches))
                        {
                                echo "<h3> ". $matches[1] . "</h3>";
                        }
			else if(preg_match("/\*\*(.+?)\*\*/" , $data, $matches))
                        {	
        	                echo "<b> ". $matches[1] . "</b>";
                        }
			else if(preg_match("/_(.+?)_/" , $data, $matches))
                        {
				echo "<i> ". $matches[1] . "</i>";
                        }
			//<a href="url">link text</a>
			else if(preg_match("/^###\s/" , $data))
			{


			}



		}	
		fclose($handle);
	}

?>
