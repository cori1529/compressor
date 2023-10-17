<?php

date_default_timezone_set('Asia/Seoul');

class DBC
{
	public $db;
	public $query;
	public $result;

	public function DBI()
	{
//		$this->db = new mysqli('localhost', 'gtech2014', 'gtech4070', 'gtech2014'); //host, id, pw, database 순서입니다.
		//$this->db = new mysqli('172.16.99.117', 'hellofarm_1400', 'hellofarm1400db', 'gi_1400'); //host, id, pw, database 순서입니다.
		$this->db = new mysqli('172.16.99.12', 'sugip8510', 'sugip8510db', 'compressor'); //host, id, pw, database 순서입니다.
		
		$this->db->query('SET NAMES UTF8');
		if(mysqli_connect_errno())
		{
			header("Content-Type: text/html; charset=UTF-8");
			echo "Error:66000 관리자에게 문의 바랍니다.";
			//echo "데이터 베이스 연동에 실패했습니다.";
			exit;
		}
	}

	public function DBQ()
	{
//		$ttt = mysqli_real_escape_string($this->db, $this->query);
//		echo '<script>alert("'.$ttt.'")</script>';
		$this->result = $this->db->query($this->query);
//		$this->result = $this->db->query($ttt);
	}

	public function DBO()
	{
		unset($this->result);	//free;
		$this->db->close();
	}

	public function RES($par)
	{
		return $this->db->real_escape_string($par);
	}

}

function dbQuery($sql) {
	$db = new DBC;
	$db->DBI();
	$db->query = $sql;
	$db->DBQ();
/*	
	var $row = $db->$result->fetch_assoc();
$num = $db->result->num_rows;
$data = $db->result->fetch_row();
*/

//	var_dump($db->result);
	$rows = array( array());

	if($db->result !== false)
	{
		$idx = 0;
		while($data = $db->result->fetch_assoc())
		{
			$rows[$idx++] = $data;
		}

//		var_dump($rows);

		$result = array('num' => $db->result->num_rows,
						'row' => $rows[0],
						'rows' => $rows
		);
	}
	else $result = false;

	$db->DBO();

	return $result;
}

function dbUpdate($sql) {
	$db = new DBC;
	$db->DBI();
	$db->query = $sql;
	$db->DBQ();

//	var_dump($db->result);

/*	
	var $row = $db->$result->fetch_assoc();

$num = $db->result->num_rows;
$data = $db->result->fetch_row();
*/
	$result = $db->result;

	$db->DBO();
	return $result;
}


function dbUpdateEscaping($sql,$par,$const) {

	$db = new DBC;
	$db->DBI();
	$db->query = $sql.$db->RES($par).$const;
///	$db->query = $sql.$par.$const;

//	echo '<script>alert("'.$sql.$par.$const.'")</script>';
//	echo '<script>alert("'.$db->query.'")</script>';

	$db->DBQ();

//	var_dump($db->result);
//	var $row = $db->$result->fetch_assoc();
//$num = $db->result->num_rows;
//$data = $db->result->fetch_row();

	$result = $db->result;

	if (!$result) {
		echo '<script>alert("'.$db->result.'")</script>';
    }

	$db->DBO();
	return $result;
}

function dbEscaping($par) {
	$db = new DBC;
	$db->DBI();
/*
	$cnt = count($par);
	for($iz=0; $iz<$cnt; $iz++)
	{
		$par[$iz] = $db->RES($par[$iz]);
	}
*/

	foreach($par as $key=>$value){
		$par[$key] = $db->RES($value); 
	}	

	$db->DBO();

	return $par;
}


?>
