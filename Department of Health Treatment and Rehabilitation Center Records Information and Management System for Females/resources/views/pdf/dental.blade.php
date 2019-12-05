<html>
<head>
<style>
table {
    border:none;
    border-collapse: collapse;
}

table td{
    border-left: 1px solid #000;
    border-right: 1px solid #000;
}

th {
  border: 1px solid black;
  border-collapse: collapse;
}



table tr:last-child {
    border-top: 1px solid #000;
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
     <b style="font-size: 15px">CEBU TREAMENT & REHABILITATION CENTER</b> for <b>FEMALES</b><br>
     Jagobiao, Mandaue City, Cebu<br>
     <font size="12px">Telefax #: (032) 238-0650/Cp #:09255548119/Email Add: cebu_trc@yahoo.com.ph</font><br>
     </p>
   <div style="border:solid black 0.7px;width: 720px"></div>
</div>
</head>
<body>
  <p style="text-align: center"><b>DENTAL SERVICE RECORD</b></p>

  <label>Name:   <b>{{$pat->fname}} {{$pat->lname}}</b></label> 

  <table style="width:100%">
  <tr>
         <th width="15%">Date</th>
         <th width="25%">Diagnosis</th>
         <th width="5%">Tooth No.</th>
        <th width="22%">Service Rendered</th>
        <th width="15%">Dentist</th>
        <th width="22%">Remarks</th>
  </tr>
  @foreach($notes as $note)
  <tr>
    <td>{!! \Carbon\Carbon::parse($note->date_time)->format('Y-m-d') !!}</td>
    <td style="font-size:12px">{{$note->diagnose}}</td>
    <td>{{$note->tooth_no}}</td>
    <td style="font-size:12px">{{$note->service_rendered}}</td>
    <td style="font-size:12px">{{$note->userx->lname}}, {{$note->userx->fname}}</td>
    <td style="font-size:12px">{{$note->notes}}</td>
  </tr>
  @endforeach  
</table>
</body>

</html>