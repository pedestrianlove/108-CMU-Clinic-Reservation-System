<html>
<body style="background-color:powderblue;">
<b>
<title>預約門診</title>
<img src="https://president.cmu.edu.tw/doc/download/cmulogo.jpg" style="width:100px;height:100px;">
<font size=24>健康中心諮商門診預約系統</font>

<fieldset>
<form method="post" action="src/reservation.php">
	請輸入資料以預約：<a href="../cancellation/">點這裡取消預約</a><br />
	姓名:
	<input name="student_name" type = "text" required="required"> <br />
	學號:
	<input name="student_id" type = "text" required="required"> <br />
	預約日期:
	<input name="reserv_date" type = "date" value = "<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" required="required"> <br />
	預約時段:
	<select id="reserv_time" name="reserv_time" required="required">
		<option value=1>時段一</option>
		<option value=2>時段二</option>
		<option value=3>時段三</option>
		<option value=4>時段四</option>
		<option value=5>時段五</option>
		<option value=6>時段六</option>
	</select> <br />
	<input type="submit" value="預約" name="send">


	<table style="width:50%">
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

		function todayPlus ($day) {
			$day_str = ' +'.$day.' day';
			return date("Y-m-d", strtotime($day_str));
		}
		// render available time sections
		echo "<tr><td>日期</td><td>時段一</td><td>時段二</td><td>時段三</td><td>時段四</td><td>時段五</td><td>時段六</td></tr>";

		

		for ($i = 0; $i < 30; $i ++) {
			$day = todayPlus ($i);

			if ((dayToNumber ($day) != 2) && (dayToNumber ($day) != 4)) continue;


			echo "<tr>";
			$day = todayPlus ($i);
			echo "<td>".$day." (".chineseDay($day).")</td>";


			require '../config/dbConfig.php';

			// get input from mysql
			$command = $mysql->prepare ("SELECT reserv_time FROM `reservation` WHERE reserv_date=? ORDER BY reserv_time;");
			$command->bind_param ("s", $day);
			$command->execute ();
			$result = $command->get_result();

			
			
            	$r = $result->fetch_array(MYSQLI_NUM);
            	for ($j = 0; $j < 6; $j++) {
            		if ($r == null) {
                		printf("<td>0</td>");
                		
            		}
            		else {
            			printf ("<td>1</td>");
            			$r = $result->fetch_array(MYSQLI_NUM);
            		}
            	
        		}


			$command->close ();
			$mysql->close ();

			echo "</tr>";
		}
	?>
	</table>
	<?php echo "上表為30日內之掛號現況。" ?>
</form>
</fieldset>
<br /> 預約方式說明: <br />
1. 本預約系統於上班時間(08:00~17:00)開放使用。 <br />
2. 每次門診有六個時段可供預約，每個時段30分鐘，每日最高預約上限為6人。醫師駐診時段如下圖所示。 <br />
3. 如您預約失敗, 表示該時段有人或無法預約, 請改約其它時段。 <br /> <br />
<img src="../time.png" style="width:300px;height:300px;">
</b>
</body>

</html>
