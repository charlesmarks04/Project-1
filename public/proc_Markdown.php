<html>

<head>

  <title> Git Markdown </title>

</head>

<body>
	
<?php

	function proc_markdown($filename){
	
		$handle = fopen($filename, "r") or die("Cannot Open MD file");
		$in_ulist = false;
		$in_usublist = false;
		$in_olist = false;
		while($data = fgets($handle))
		{
			if($data == "\n")
			{

				if ($in_ulist) 
				{
                			echo "</ul>";
                			$in_ulist = false;
            			}
				if($in_usublist)
				{
					echo "</ul>";
					$in_usublist = false;
				}
				if ($in_olist)
                                {
                                        echo "</ol>";
                                        $in_olist = false;
                                }

				
				echo "</p> <p>";
				continue;			
			}

			if(preg_match("/^\s*\* (.*)/" , $data)) //Unordered List (LOOKING FOR "* ")
                        {
                                if(!$in_ulist) //If not currently in a list create one
                                {
                                        echo "<ul>";
                                        $in_ulist = true;
                                }
                                if(preg_match("/^ {4}\* (.*)/", $data)) //checking for nest keywords
                                {
                                        if(!$in_usublist) //creates a new list for nested list
                                        {
                                                echo "<ul>";
                                                $in_usublist = true;
                                        }

                                }
                                else if($in_usublist) //if there was no math for another sublisted item close the sublist
                                {
                                        echo "</ul>";
                                        $in_usublist = false;
                                }

                                $data = preg_replace("/^\s*\* (.*)/",  "<li>$1</li>" , $data); 
                        }

			if(preg_match("/(^\s*\d*\. (.*))|(^\s*- (.*))/" , $data)) //Ordered List (LOOKING FOR "#. " or "- ")
			{
                                if(!$in_olist) //if not in an ordered list make one
                                {
                                        echo "<ol>";
                                        $in_olist = true;
                                }
                                if(preg_match("/^\s*- (.*)/", $data)) //looks for nest keyword
                                {
                                        if(!$in_usublist) //if a sublist doesnt already exist create one
                                        {
                                                echo "<ul>"; 
                                                $in_usublist = true;
                                        }

                                }
                                else if($in_usublist) //if there was no more nested values close the sublist
                                {
                                        echo "</ul>";
                                        $in_usublist = false;
                                }

                                $data = preg_replace("/^\s*\d*\. (.*)/",  "<li>$1</li>" , $data);
				$data = preg_replace("/^\s*\- (.*)/",  "<li>$1</li>" , $data);
                        }

			$data = preg_replace("/^\s*# (.*)/", "<h1> $1 </h1>" , $data); //First Level Heading
			$data = preg_replace("/^\s*## (.*)/", "<h2> $1 </h2>" , $data); //Second Level Heading
			$data = preg_replace("/^\s*### (.*)/", "<h3> $1 </h3>" , $data); //Third Level Heading

			$data = preg_replace("/!\[(.+?)\]\((.+?)\)/", "<img src=$2 alt= $1 ></img>", $data); //Image
			$data = preg_replace("/\[(.+?)\]\((.+?)\)/", "<a href=$2> $1 </a>", $data); //URL


			$data = preg_replace("/\*\*(.+?)\*\*/", "<b>$1</b>", $data); //Bold Text
			$data = preg_replace("/_(.+?)_/", "<i>$1</i>", $data); //Italics Text


			echo $data;			
	


		}	
		fclose($handle); //close file
		if($in_ulist) //if unordered list is open at end of file close it
                	echo "</ul>";
		if($in_olist) //if ordered list is open at end of file close it
                        echo "</ol>";
	}
		echo "<h1><ins> Git Markdown </ins></h1>";
        	proc_markdown("markdown.md");
?>
	<a href=http://localhost:5555> Back </a><br>
</body>
</html>
