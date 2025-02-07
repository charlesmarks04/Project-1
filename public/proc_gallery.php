<?php

        //echo "<h1> Gallery </h1>\n";


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
		
		$handle = fopen($image_list_filename, 'r') or die("Cannot Open CSV file");

		$image_data = [];
		while($data = fgets($handle)) {
			$parts = explode(",", $data);
			$filename = $parts[0];
			$description = $parts[1];
            		if (file_exists($filename) or die("no file found")) {
                		$image_data[] = [
                    			'filename' => $filename,
                    			'description' => $description,
                    			'size' => filesize($filename), // File size in bytes
                    			'date' => filemtime($filename) // Last modified timestamp
                		];
            		}
    		}
		//Arrage the list
		if($sort_mode == "orig"){
			//do nothing
                }
                else if($sort_mode == "date_newest"){
   			usort($image_data, fn($a, $b) => $b['date'] - $a['date']);
                }
                else if($sort_mode == "date_oldest"){
			usort($image_data, fn($a, $b) => $a['date'] - $b['date']);
                }
		else if($sort_mode == "size_largest"){
                        usort($image_data, fn($a, $b) => $b['size'] - $a['size']);
                }
                else if($sort_mode == "size_smallest"){
                        usort($image_data, fn($a, $b) => $a['size'] - $b['size']);
                }
		else if($sort_mode == "rand"){
			shuffle($image_data);
                }
		else{
			die("Invalid Sorting Mode");
                }

		$output_file = "formatted_gallery.csv";
    		$output = fopen($output_file, 'w'); //make a csv for proc_csv
		
		//Output the List
		if($mode == "list"){
			foreach ($image_data as $img) {
                        	fputcsv($output, [$img['filename']]);
			}
			
		}
		else if($mode == "matrix"){
			$row = [];
    			foreach ($image_data as $index => $img) {
        			$row[] = $img['filename'];
        
			        if (($index + 1) % 3 == 0) { //making every 3 stay on one row
            				fputcsv($output, $row);
            				$row = []; // Reset row
        			}
    			}

			if (!empty($row)) {
        			fputcsv($output, array_pad($row, 3, ""));
    			}	
		}
		else if($mode == "details"){
                        foreach ($image_data as $img) {
                                fputcsv($output, [
                                        'Filename: '. $img['filename'] . '. Description: ' . $img['description']
                                ]);
                        }
		}
		else{
			die("Invalid Display Mode");
		}
		
		proc_csv("formatted_gallery.csv", $mode , "" , "ALL"); //using the delimiter to be able to pass the format type
	}

?>
