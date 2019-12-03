<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: left;  
  vertical-align: top;  
}
</style>
<div>
    <p style="float: left;"><img src="http://localhost/capstone/public/images/logo.png" height="100px" width="100px"></p>
    <p style="float: right;"><img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px"></p>
    <br><p style="text-align: center">Republic of the Philippines<br> Department of Health<br>
     <b style="font-size: 15px">CEBU TREAMENT & REHABILITATION CENTER</b> for <b>FEMALES</b><br>
     Jagobiao, Mandaue City, Cebu<br>
     <font size="12px">Telefax #: (032) 238-0650/Cp #:09255548119/Email Add: cebu_trc@yahoo.com.ph</font><br>
     </p>
   <div style="border:solid black 0.7px;width: 100%"></div>

      <center><p><b>BMI MONITORING SHEET</b></p></center>

</div>
</head>
<body>

<label>Name:   <b>{{$pat->fname}} {{$pat->lname}}</b></label> 
  <br>
	<table style="width:100%;text-align: center">
    <thead>
  <tr style="text-align: center">
    <th width="20%">Date</th>
    <th width="8%">Weight (KG)</th>
    <th width="8%">BMI</th>
    <th>Remarks</th>
    <th width="25%">Nurse</th>
  </tr>
  </thead>
  <tbody>
   @foreach($notes as $note)
  <tr>
    <td>{{$note->date}}</td>
    <td>{{$note->weight}}</td>
    <td>{{$note->bmi}}</td>
    <td>{{$note->remarks}}</td>
    <td>{{$note->userxe->fname}} {{$note->userxe->lname}}</td>
  </tr>
  @endforeach 
  </tbody> 
</table>
</center>
</body>

</html>