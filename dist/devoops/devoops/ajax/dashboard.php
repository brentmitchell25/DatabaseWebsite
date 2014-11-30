<?php
	$conn = mysql_connect('mysql.eecs.ku.edu','bmitchel','hello') or die('Could not connect: ' . mysql_error());
	mysql_select_db('bmitchel');
	
	$sql = "SELECT patient_id FROM Patient, Visit WHERE doctor_id = session;
	<td class="m-ticker"><b>BRDM</b><span>Broadem Inc.</span></td>
?>