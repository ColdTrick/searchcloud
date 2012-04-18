<?php
	/**
	* Search Cloud
	* 
	* @package searchcloud
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	admin_gatekeeper();
	$statsObject = get_entities("object","searchstats");
	foreach($statsObject as $object){
		if(!$object->delete()){
			register_error(elgg_echo('searchcloud:reset:error'));
		} else {
			system_message(elgg_echo('searchcloud:reset:success'));
		}
	}
	forward($_SERVER['HTTP_REFERER']);
	
?>