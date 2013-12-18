<?php
	require_once 'Database/database.php';
	require_once 'class.html.output.php';
	require_once 'Model/class.printer.php';
	require_once 'Model/class.printjobs.php';
	class Content{
		/**
		 * Return a html-Content view
		 *
		 * @param String $user current user name
		 * @return void
		 * @author  majuwa
		 */
		function getPrintContent($user) {
			$array = DatabaseConnection::instance() -> getPrintjobs($user);
			if(count($array)!=0){
				$content = HTMLOutput::getHome();
				$content = str_replace("[%ENABLED%]", "", $content);
				for($i = 0;$i<count($array);$i++){
					$add = "<tr><td>" . $array[$i] -> getID() . "</td>";
					$add = $add . "<td>" . $array[$i] -> getFilename() . "</td><td></td></tr>[%CONTENT%]";
					$content = str_replace("[%CONTENT%]", $add, $content);
				}
				$content = str_replace("[%CONTENT%]", "", $content);
			}
			else {
				$content = HTMLOutput::getHome();
				$content = str_replace("[%ENABLED%]", "disabled", $content);
				$content = str_replace("[%CONTENT%]", "<tr><td></td><td>No files</td><td></td></tr>", $content);
			}
			$printer = new Printer();
			$array = $printer->getPrinters();
			for($i=0;$i<count($array);$i++){
				$content = str_replace("[%PRINTER%]", "<option>" . $array[$i] . "</option> [%PRINTER%]", $content);
				
			}
			$content = str_replace("[%PRINTER%]", "", $content);
			return $content;
		}
	}
?>