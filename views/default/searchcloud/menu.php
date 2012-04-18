<?php
	/**
	* Search Cloud
	* 
	* @package searchcloud
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	$title = elgg_view_title(elgg_echo("searchcloud:title"));
	$cloud = elgg_view("searchcloud/default", array("searchcloudlimit"=>"25"));
	if($cloud){
		?>
		<script type="text/javascript">

		$(document).ready(function(){
			$('#owner_block_submenu .submenu_group').after('<div><?php echo $title . $cloud;?></div>');
			
		});
		</script>
		<?php
	}
?>