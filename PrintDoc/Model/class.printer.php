<?php
	/**
	 * 
	 *This Class provides the PrinterBackend
	 * @package default
	 * @author  majuwa
	 */
	class Printer {
		/**
		 * Get the installed Printer at the System
		 *
		 * @return Array with Printer-Names
		 * @author  
		 */
		function getPrinters() {
			$printers =  shell_exec("lpstat -v");
			//$printers = str_replace("\n"," ",$printers);
			$printerArray = explode(" ", $printers);
			$back = array();
			$times = (count($printerArray)+1)/4;
			
			for($i = 0;$i<$times;$i++){
				array_push($back,str_replace(":", "", $printerArray[2+($i*3) ]));
			}
			
			return $back;
		}
	} // END
?>