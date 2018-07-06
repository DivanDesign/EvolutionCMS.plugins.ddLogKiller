//<?php
/**
 * ddLogKiller
 * @version 1.1 (2018-07-01)
 * 
 * @desc Плагин очищает лог событий, сохраняя минимальное заданное количество. Срабатывает раз в сессию каждого пользователя.
 * 
 * @param $rowsNumberToSave {integer} — Сколько записей лога сохранить. Default: 50.
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