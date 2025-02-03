<?php

        echo "<h1> Gallery </h1>\n";

	function proc_gallery($image_list_filename, $mode, $sort_mode){
		// $mode == "list"	   : list of large images view
   		// $mode == "matrix"	   : image matrix view (3 columns)
   		// $mode == "details"	   : file details view (text)

  		// $sort_mode == "orig"  : original ordering in the CSV file
   		// $sort_mode == "date_newest"  : newest images first
   		// $sort_mode == "date_oldest"  : oldest images first
   		// $sort_mode == "size_largest" : largest file size first
   		// $sort_mode == "size_smallest": smallest file size first
   		// $sort_mode == "rand"  : random ordering
		

		//Arrage the list
		if($sort_mode == "orig"){
			
                }
                else if($sort_mode == "date_newest"){

                }
                else if($sort_mode == "date_oldest"){

                }



		//Output the List
		if($mode == "list"){

		}
		else if($mode == "matrix"){

		}
		else if($mode == "details"){

		}


	}

?>
