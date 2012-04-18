<?php
	/**
	* Search Cloud
	* 
	* @package searchcloud
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	global $CONFIG;
	
	function searchcloud_pagesetup(){
		
		if(get_context() == "search" && get_input("tag")){
			extend_view("metatags", "searchcloud/menu");
		}
	}
	
	function searchcloud_track($hook, $entity_type, $returnvalue, $tag)	{
		$statsObject = get_entities("object","searchstats");  
		$tag = urlencode($tag);
		if(empty($statsObject)){
			// Create new object
			$statsObject = new ElggObject();
			$statsObject->subtype = "searchstats";
			$statsObject->access_id = 2;
			// Before we can set metadata, we need to save the object
			$statsObject->save(); 
		} else { 
			$statsObject = $statsObject[0];
		}
		if(!$statsObject->getAnnotations($tag)){
			$statsObject->annotate($tag, 1, 2);
		} else {
			$tag = $statsObject->getAnnotations($tag);
			$tag[0]->value++;
			$tag[0]->save();
		}			
	
	}
	register_elgg_event_handler('pagesetup', 'system', 'searchcloud_pagesetup');
	
	register_plugin_hook('search','all','searchcloud_track');
	
	register_action("searchcloud/reset", true, $CONFIG->pluginspath . "searchcloud/actions/reset.php");
?>