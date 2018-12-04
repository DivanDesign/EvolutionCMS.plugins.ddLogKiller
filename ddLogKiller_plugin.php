//<?php
/**
 * ddLogKiller
 * @version 1.1.1 (2018-12-04)
 * 
 * @desc Clears the Event Log, preserve needed minimum number of items. Will be working once per session of each user.
 * 
 * @param $rowsNumberToSave {integer} — Log items number to save. Default: 50.
 * 
 * @internal @properties {"rowsNumberToSave": [{"label": "Log items number to save", "desc": "", "type": "string", "default": "", "value": 50}]}
 * 
 * @event OnWebPageInit
 * 
 * @copyright 2018 DivanDesign {@link http://www.DivanDesign.biz }
 */

//Run only 1 time per session
if (!isset($_SESSION['ddLogKiller'])){
	//Defaults
	$rowsNumberToSave = isset($rowsNumberToSave) ? intval($rowsNumberToSave) : 50;
	
	$logsTableName = $modx->getFullTableName('event_log');
	
	//Total log rows
	$rowsTotal = intval($modx->db->getValue($modx->db->select(
		//Fields
		'COUNT(id)',
		//From
		$logsTableName,
		//Where
		'type != 3'
	)));
	
	if ($rowsTotal > $rowsNumberToSave){
		$modx->db->delete(
			//FROM
			$logsTableName,
			//WHERE
			'type != 3',
			//ORDER BY
			'createdon DESC',
			//LIMIT
			$rowsTotal - $rowsNumberToSave
		);
	}
	
	//Latch
	$_SESSION['ddLogKiller'] = true;
}
//?>