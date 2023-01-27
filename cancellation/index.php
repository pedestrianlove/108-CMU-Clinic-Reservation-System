<html>
<b>
<body style="background-color:powderblue;">
<title>取消預約門診</title>
<img src="https://president.cmu.edu.tw/doc/download/cmulogo.jpg" style="width:100px;height:100px;">
<font size=24>健康中心諮商門診預約系統</font>
<fieldset>
<form method="post" action="src/reservation.php">
	請輸入資料以取消預約：<br />
	姓名:
	<input name="student_name" type = "text" required="required"> <br />
	學號:
	<input name="student_id" type = "text" required="required"> <br />
	原預約日期:
	<input name="reserv_date" type = "date" value = "<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" required="required"> <br />
	原預約時段:
	<select id="reserv_time" name="reserv_time" required="required">
		<option value=1>時段一</option>
		<option value=2>時段二</option>
		<option value=3>時段三</option>
		<option value=4>時段四</option>
		<option value=5>時段五</option>
		<option value=6>時段六</option>
	</select> <br />
	<input type="submit" value="取消預約" name="send">
</form>
</fieldset>
<br /> 預約方式說明: <br />
1. 本預約系統於上班時間(08:00~17:00)開放使用。 <br />
2. 每次門診有六個時段可供預約，每個時段30分鐘，每日最高預約上限為6人。醫師駐診時段如下圖所示。 <br />
3. 如您預約失敗, 表示該時段有人或無法預約, 請改約其它時段。 <br /> <br />
<img src="../time.png" style="width:300px;height:300px;">
</body>
</b>
</html>
