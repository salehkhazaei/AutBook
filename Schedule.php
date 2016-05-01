<?php
require_once 'CourseController.php';
require_once 'config.php';

class Schedule {
	public $id;
	public $course_ids;// ye String az course id ha ke ba ; joda shodan
	public $student_id;

	public function __construct() {
	}
	public static function construct($_id, $_student_id, $_course_ids) {
		$ins = new self();
		if($_id==NULL){
			$ins->course_ids = $_course_ids;
			$ins->student_id = $_student_id;
			$value = "('" . $_student_id . "','" . $_course_ids . "')";
			Create ( $GLOBALS ['tbl_schedule'], "(student_id, course_ids)", "(?,?)",array ($_student_id,$_course_ids) );
			$rows = $GLOBALS['DBH']->query ( "SELECT id FROM ".$GLOBALS ['tbl_schedule']." ORDER BY id DESC" );
			$rows->setFetchMode(PDO::FETCH_NUM); 
			$row = $rows->fetch();
			if ( $row == null )
				$ins->id = -1 ;
			else 
				$ins->id = $row[0];
			return $ins;
		}
		$ins->id = $_id;
		$ins->course_ids = $_course_ids;
		$ins->student_id = $_student_id;
		$value = "('" . $_student_id . "','" . $_course_ids . "')";
		Create ( $GLOBALS ['tbl_schedule'], "(id, student_id, course_ids)", "(?,?,?)", array ($_id,$_student_id,$_course_ids ));
		return $ins;
	}
	

	public function returnAsArray() {
		$myArray = array ('id' => $this->id,'course_ids' => $this->course_ids,
				'student_id' => $this->student_id 
		);
		return $myArray;
	}
	
	public function UpdateSchedule($_newCourse){
		Update($GLOBALS['tbl_schedule'], "course_ids=?", "id=? and student_id=?" , array($_newCourse,$this->id,$this->student_id));
	}
}
?>
