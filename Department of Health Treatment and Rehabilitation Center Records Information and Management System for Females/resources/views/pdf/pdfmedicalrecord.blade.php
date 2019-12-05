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
</div>
        <center><p><b>Blood Sugar Daily Monitoring Sheet</b></p></center>

</head>
<body>
  <p></p>
  <label>Name:   <b>{{$pat->fname}} {{$pat->lname}}</b></label> 
  <p></p>
<table style="width:100%">
  <thead>
  <tr>
    <th width="15%" height="20">Intake Date</th>
    <th width="10%">Intake Time</th>
    <th width="25%">Medications</th>
    <th width="30%">Notes</th>
    <th width="20%">Nurse</th>
  </tr>
</thead>
<tbody>
     @foreach($notes as $note)
      <tr>
    <td width="15%">{{$note->intake_date}}</td>
    <td width="10%">{{$note->intake_time}}</td>
    <td width="25%">{{$note->medication}}</td>
    <td width="30%">{{$note->notes}}</td>
    <td width="20%">{{$note->userxe->fname}} {{$note->userxe->lname}}</td>
  </tr>
  @endforeach


</tbody>

</table>
</center>
</body>
</html>