<html>
<head>
<style>
table, th, td {
  border-collapse: collapse;
  border: 1px solid black;

}

table{
  table-layout:fixed;
  width: 990px;

}

td {
  padding: 5px;
  text-align: left;  
  vertical-align: top;  
  display: inline-block;
  word-wrap:break-word;
  width: 120px;
  height: 60px;

}

</style>
<div>
    <p style="float: left;"><img src="http://localhost/capstone/public/images/logo.png" height="100px" width="100px"></p>
    <p style="float: right;"><img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px"></p>
    <br><p style="text-align: center">Republic of the Philippines<br> Department of Health<br>
     <b style="font-size: 15px">DANGEROUS DRUGS ABUSE PREVENTION & TREATMENT PROGRAM</b><br>EVERSLEY CHILD SANITARIUM<br>
     <b style="font-size: 15px">CEBU TREAMENT & REHABILITATION CENTER</b> for <b>FEMALES</b><br>
     Jagobiao, Mandaue City, Cebu<br>
     <font size="12px">Telefax #: (032) 238-0650/Cp #:09255548119/Email Add: cebu_trc@yahoo.com.ph</font><br>
     </p>
   <div style="border:solid black 0.7px;width: 100%"></div>
</div>
</head>
<body>
<p>After-Care Attendance Record</p>
<p>Name:   <b>{{$pat->fname}} {{$pat->lname}}</b>   </p>
<p>Address:   <b>{{$pat->address->street}}, {{$pat->address->barangay}}, {{$pat->address->city}}</b></p>
<p>Date Discharged from CTRC: </p>


<table>
   
    @foreach($patos as $event)

          <td>Date:{{$event->date}} <br>Signature:</td>

    @endforeach
</table>

</body>
</html>

