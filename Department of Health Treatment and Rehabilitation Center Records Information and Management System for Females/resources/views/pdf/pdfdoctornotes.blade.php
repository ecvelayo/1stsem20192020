<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: center;    
}
</style>
<div>
    <p style="float: left;"><img style="margin-top: 20px" src="http://localhost/capstone/public/images/logo.png" height="100px" width="100px"></p>
    <p style="float: right;"><img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px"></p>
    <br><p style="text-align: center">Republic of the Philippines<br> Department of Health<br>
	   <b style="font-size: 15px">DANGEROUS DRUGS ABUSE PREVENTION & TREATMENT PROGRAM</b><br>EVERSLEY CHILD SANITARIUM<br>
	   <b style="font-size: 15px">CEBU TREAMENT & REHABILITATION CENTER</b> for <b>FEMALES</b><br>
	   Jagobiao, Mandaue City, Cebu<br>
	   <font size="12px">Telefax #: (032) 238-0650/Cp #:09255548119/Email Add: cebu_trc@yahoo.com.ph</font><br>
	   </p>
	 <div style="border:solid black 0.7px;width: 720px"></div>
</div>
</head>
<body>
	<p style="text-align: center"><b>DOCTOR'S PROGRESS NOTES</b></p>
	<table style="width:100%">
  <tr>
    <th width="20%" height="20">Date/Time</th>
    <th width="70%">Notes</th>
  </tr>
  @foreach($notes as $note)
  <tr>
    <td height="25">{{$note->date_time}}</td>
    <td>{{$note->notes}}</td>
  </tr>
  @endforeach  
</table>
</body>

</html>