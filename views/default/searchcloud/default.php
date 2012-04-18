<?php
	/**
	* Search Cloud
	* @param $vars['searchcloudlimit']
	* 
	* @package searchcloud
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	$keyWordsCount = count_annotations(0,"object","searchstats");
	$keyWords = get_annotations(0,"object","searchstats","","", "",$keyWordsCount);
	
	if($keyWords){
	
		$limit = 10;
		if($vars['searchcloudlimit']){
			$limit = $vars['searchcloudlimit'];
		}
		
		$orderedList = array();
		foreach($keyWords as $keyword){
			$orderedList[urldecode($keyword->name)] = $keyword->value;
		}
		arsort($orderedList);
		$orderedList = array_slice($orderedList,0,$limit);
				
		$cloud = "";
		$max = 0;
		
        foreach($orderedList as $count) {
        	if ($count > $max) {
        		$max = $count;
        	}
        }
		
		foreach(array_rand($orderedList,count($orderedList)) as $searchword) {	
			$count = $orderedList[$searchword];
			
            if (!empty($cloud)) $cloud .= ", ";
            $size = round((log($count) / log($max)) * 100) + 30;
			if ($size < 60) $size = 60;
            $cloud .= "<a href=\"" . $vars['url'] . "search/?tag=". $searchword . "\" style=\"font-size: {$size}%; text-decoration:none;\" title=\"".addslashes($searchword)." ({$count})\">" . urldecode($searchword) . "</a>";
        }
		echo $cloud;
	}
?>