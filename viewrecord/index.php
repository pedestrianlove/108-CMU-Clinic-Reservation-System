<?php
	$page = $_SERVER['PHP_SELF'];
	$sec = "10";
?>

<html>
<body>
<b>
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
<title>今日預約清單</title>
<img src="https://president.cmu.edu.tw/doc/download/cmulogo.jpg" style="width:100px;height:100px;">
<font size=24>健康中心諮商門診預約系統</font>

<fieldset>
<font size=5>
<?php

	function dayToNumber ($date) {
		$timestamp = strtotime ($date);
		$day = date ('D', $timestamp);

		switch ($day) {
			case 'Mon':
				return "1";
			case 'Tue':
				return "2";
			case 'Wed':
				return "3";
			case 'Thu':
				return "4";
			case 'Fri':
				return "5";
			case 'Sat':
				return "6";
			case 'Sun':
				return "7";
		}
	}

	function chineseDay ($date) {
		$timestamp = strtotime ($date);
		$day = date ('D', $timestamp);

		switch ($day) {
			case 'Mon':
				return "一";
			case 'Tue':
				return "二";
			case 'Wed':
				return "三";
			case 'Thu':
				return "四";
			case 'Fri':
				return "五";
			case 'Sat':
				return "六";
			case 'Sun':
				return "日";
		}
	}
	function printDailyList ($mysql, $date, $today) {
		$command = $mysql->prepare ("SELECT reserv_time, student_id, reserv_at FROM `reservation` WHERE reserv_date=? ORDER BY reserv_time;");
		$command->bind_param ("s", $date);
		$command->execute ();
		$result = $command->get_result();

		
		$day = chineseDay ($date);

		if ($date == $today)
			printf ("今天日期: $date ($day)<br />");
		else
			printf ("下次日期: $date ($day)<br />");
		printf ("時段 &nbsp&nbsp&nbsp 學號 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 預約時間<br />");
        
        while ($row = $result->fetch_array(MYSQLI_NUM))
        {
            foreach ($row as $r)
            {
                printf("$r &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp");
            }
            printf ("<br />");
        }
		
		$command->close ();
	}

	function todayPlus ($day) {
		$day_str = ' +'.$day.' day';
		return date("Y-m-d", strtotime($day_str));
	}



	require '../config/dbConfig.php';

	$today = todayPlus (0);
	printDailyList ($mysql, $today, $today);
	
	if (dayToNumber ($today) == 2) {
		$next_day = todayPlus (2);
		printDailyList ($mysql, $next_day, $today);
	}
	elseif (dayToNumber ($today) == 4) {
		$next_day = todayPlus (5);
		printDailyList ($mysql, $next_day, $today);
	}

	$mysql->close ();
?>
</font>
</fieldset>
</b>
</body>
</html>
