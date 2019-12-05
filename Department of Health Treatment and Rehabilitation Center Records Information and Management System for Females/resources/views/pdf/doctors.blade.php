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
  .footer{ 
       position: fixed;     
       text-align: center;    
       bottom: 0px; 
       width: 100%;
   }
</style>
<div>
    <p style="float: left;"><img style="margin-top: 20px" src="http://localhost/capstone/public/images/logo.png" height="100px" width="100px"></p>
    <p style="float: right;"><img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px"></p>
    <br><p style="text-align: center">Republic of the Philippines<br> Department of Health<br>
	   <b style="font-size: 15px">CEBU TREAMENT & REHABILITATION CENTER</b> for <b>FEMALES</b><br>
	   Jagobiao, Mandaue City, Cebu<br>
	   </p>
      <p style="text-align: center"><b>DOCTOR'S ORDER NOTES</b></p>

</div>
</head>
<body>

  <label>Name:   <b>{{$pat->fname}} {{$pat->lname}}</b></label> 
</br>
	<table style="width:100%;margin-top: 10px" >
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
<p class="footer">CopyRight 2019 - Jose Miguel Bojos</p>
</body>

</html>