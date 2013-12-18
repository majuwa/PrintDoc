<?php
class HTMLOutput {
	public static function getHome() {
		$text = <<<EOT
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Filename</th>
						<th>Actions</th>
				</thead>
				<tbody>
					[%CONTENT%]
				</tbody>
			</table>
			<a href="index.php?type=print" class="btn btn-primary btn [%ENABLED%]" role="button">Print</a>
			<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Add Job</button>
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  				<div class="modal-dialog">
    				<div class="modal-content">
      					<div class="modal-header">
        					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        					<h4 class="modal-title" id="myModalLabel">Add Printjob</h4>
      					</div>
      					<form enctype="multipart/form-data" action="index.php?type=upload" method = "post" role="form">
      						<div class="modal-body">
	      						<ul class="nav nav-tabs">
  									<li><a href="#home" data-toggle="tab">File</a></li>
  									<li><a href="#option" data-toggle="tab">Options</a></li>
								</ul>
								<div class="tab-content">
	  								<div class="tab-pane active" id="home">
  										<br />
	  									
      										<div class="form-group">
	    										<label for="labelFileInput">File input</label>
    											<input type="file" name="fileupload" id="fileInput">
    											<input type="hidden" name="type" value="upload" />
    											<p class="help-block">Select your PDF</p>
  											</div>
      										<div class="form-group">
	      										<label for="labelPrinter">Printer:</label>
	      										<select name="printer" class="form-control">
		      										[%PRINTER%]
	      										</select>
	      										<span class="help-block">
			      									Choose the printer.
	      										</span>
	      									</div>
	      				
  								</div>
  								<div class="tab-pane" id="option">...</div>
							</div>
      					
      					
      					
      						
						</div>
      					<div class="modal-footer">
	        				<button type="abort" class="btn btn-default" data-dismiss="modal">Close</button>
    	    				<button type="submit" class="btn btn-primary">Save changes</button>
      					</div>
      					</form>
    				</div><!-- /.modal-content -->
  				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
EOT;
		return $text;
	}

}
?>