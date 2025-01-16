<?php

	function proc_markdown($filename){
	
		$handle = fopen($filename, "r") or die("Cannot Open MD file");
		
		while($data = fgets($handle)) {
			echo $data . "<br>";
			$data = trim($data);
			if(preg_match("/^#\s/" , $data))
			{
				echo "<h1> ". preg_split("/^#\s/" , $data)[1] . "</h1>"; 
			}
			else if(preg_match("/^##\s/" , $data))
                        {
                                echo "<h2> ". preg_split("/^(##)\s/" , $data)[1] . "</h3>";
                        }
			else if(preg_match("/^###\s/" , $data))
                        {
                                echo "<h3> ". preg_split("/^(###)\s/" , $data)[1] . "</h3>";
                        }
			else if(preg_match("/^(\*\*)|(\*\*)/" , $data))
                        {
                                echo "<b> ". preg_split("/^(\*\*)|(\*\*)/" , $data)[1] . "</b>" . preg_split("/^(\*\*)|(\*\*)/" , $data)[2] ;
                        }
			else if(preg_match("/^(_)|(_)/" , $data))
                        {
                                echo "<i> ". preg_split("/^(_)|(_)/" , $data)[1] . "</i>" . preg_split("/^(_)|(_)/" , $data)[2] ;
                        }
			



		}	
		fclose($handle);
	}

?>
