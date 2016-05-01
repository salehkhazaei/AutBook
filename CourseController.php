<?php
require_once 'config.php';

class Course {
	public $id;// code : gorooh e dars : gorooh e TA
	public $name;
	public $groups;
	public $wday1;
	public $start_time1;
	public $end_time1;
	public $wday2;
	public $start_time2;
	public $end_time2;
	public $wday3;
	public $start_time3;
	public $end_time3;
	public $teacher;
	public $exam_date;
	public $exam_time_start;
	public $exam_time_end;
	public $code;
	public $unit;
	public $category;
	public $wday_ta;
	public $start_time_ta;
	public $end_time_ta;
	public $zarfiat;
	public $khali;
	public $ta_groh;
	public $ta_zarf;
	public $TA;
	public $jensiat;

	public function __construct($_name, $_groups, 
	                            $_wday1, $_start1, $_end1, 
								$_wday2, $_start2, $_end2,
								$_wday3, $_start3, $_end3, 
								$_wday_ta, $_start_ta, $_end_ta, 
								$_teacher, 
								$_exam_date, $_exam_time_start, $_exam_time_end, 
								$_code, $_unit,$_category, $_zarfiat, $_khali, $_ta_zarf, $_TA, $_ta_groh,$_sex) {
		$this->name = $_name;
		$this->groups = $_groups;
		$this->wday1 = $_wday1;
		$this->start_time1 = $_start1;
		$this->end_time1 = $_end1;
		$this->wday2 = $_wday2;
		$this->start_time2 = $_start2;
		$this->end_time2 = $_end2;
		$this->wday3 = $_wday3;
		$this->start_time3 = $_start3;
		$this->end_time3 = $_end3;
		$this->teacher = $_teacher;
		if ( $_exam_date != NULL )
		{
			$arr = explode ('/',$_exam_date);
			$this->exam_date ['day'] = $arr[0];
			$this->exam_date ['month'] = $arr[1];
			$this->exam_date ['year'] = $arr[2];
		}
		else
		{
			$this->exam_date = NULL;
		}
		$this->exam_time_start = $_exam_time_start;
		$this->exam_time_end = $_exam_time_end;
		$this->code = $_code;
		$this->unit = $_unit;
		$this->category = $_category;
		$this->wday_ta = $_wday_ta;
		$this->start_time_ta = $_start_ta;
		$this->end_time_ta = $_end_ta;
		$this->TA = $_TA;
		$this->ta_zarf = $_ta_zarf;
		$this->ta_groh = $_ta_groh;
		$this->zarfiat = $_zarfiat;
		$this->khali = $_khali;
		$this->jensiat=$_sex;
		$this->id = $this->code . ":" . $this->groups . ":" . $this->ta_groh;
	}

	/**
	 *
	 * @return the class as an array, each attribute's index is it's name;
	 */
	function toString()
	{
		return join("~@",returnAsArray());
	}
	function returnAsArray() {
		$course = array ();
		$course ["id"] = $this->id;
		$course ["name"] = $this->name;
		$course ["groups"] = $this->groups;
		$course ["wday1"] = $this->wday1;
		$course ["start_time1"] = $this->start_time1;
		$course ["end_time1"] = $this->end_time1;
		$course ["wday2"] = $this->wday2;
		$course ["start_time2"] = $this->start_time2;
		$course ["end_time2"] = $this->end_time2;
		$course ["wday3"] = $this->wday3;
		$course ["start_time3"] = $this->start_time3;
		$course ["end_time3"] = $this->end_time3;
		$course ["teacher"] = $this->teacher;
		$course ["exam_date"] ["day"] = $this->exam_date ['day'];
		$course ["exam_date"] ["month"] = $this->exam_date ['month'];
		$course ["exam_date"] ["year"] = $this->exam_date ['year'];
		$course ["exam_time_start"] = $this->exam_time_start;
		$course ["exam_time_end"] = $this->exam_time_end;
		$course ["code"] = $this->code;
		$course ["unit"] = $this->unit;
		$course ['category'] = $this->category;
		$course ["wday_ta"] = $this->wday_ta;
		$course ["start_time_ta"] = $this->start_time_ta;
		$course ["end_time_ta"] = $this->end_time_ta;
		$course ["TA"] = $this->TA;
		$course ["ta_groh"] = $this->ta_groh;
		$course ["ta_zarf"] = $this->ta_zarf;
		$course ["zarfiat"] = $this->zarfiat;
		$course ["khali"] = $this->khali;
		$course["jensiat"]=$this->jensiat;
		return $course;
	}

	function doesOverLapTime(Course $_c2) {
		$times = array ( array ( $this->wday1 , $this->start_time1 , $this->end_time1 ) , 
						 array ( $this->wday2 , $this->start_time2 , $this->end_time2 ) , 
						 array ( $this->wday3 , $this->start_time3 , $this->end_time3 ) , 
						 array ( $this->wday_ta , $this->start_time_ta , $this->end_time_ta ) , 
						 array ( $_c2->wday1 , $_c2->start_time1 , $_c2->end_time1 ) , 
						 array ( $_c2->wday2 , $_c2->start_time2 , $_c2->end_time2 ) , 
						 array ( $_c2->wday3 , $_c2->start_time3 , $_c2->end_time3 ) , 
						 array ( $_c2->wday_ta , $_c2->start_time_ta , $_c2->end_time_ta ) );
		for ( $i = 0 ; $i < 8 ; $i ++ )
		{
			for ( $j = 0 ; $j < 8 ; $j ++ )
			{
				if ( $i == $j )
					continue;
				if ($times[$i][0] == null || $times[$j][0] == null || $times[$i][0] == false || $times[$j][0] == false )
					continue;
				if ($times[$i][0] == $times[$j][0]) 
				{
					if ( $times[$i][1] < $times[$j][2] && $times[$i][1] >= $times[$j][1] && 
					     $times[$j][1] < $times[$i][2] && $times[$j][1] >= $times[$i][1] ) 
					{
						return true;
					}
				}
			}
		}
		if ($this->exam_date['day'] == null || $this->exam_date['day'] == false ||
		    $_c2->exam_date['day'] == null || $_c2->exam_date['day'] == false )
			return false ;
		if (($_c2->exam_date ['day'] == $this->exam_date ['day']) && ($_c2->exam_date ['month'] == $this->exam_date ['month']) &&
			($_c2->exam_date ['year'] == $this->exam_date ['year'])) 
		{
			if (($_c2->exam_time_start < $this->exam_time_end && $_c2->exam_time_start >= $this->exam_time_start) ||
				($this->exam_time_start < $_c2->exam_time_end && $this->exam_time_start >= $_c2->exam_time_start)) 
			{
				return true;
			}
		}
		return false;
	}
}
?>

