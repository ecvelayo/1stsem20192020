<!DOCTYPE html>
<html>
   <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Drug Dependency Examination Form</title>
  </head>
<style>
table {
  border-collapse: collapse;
   padding: 8px;
}

table, th, td {
  border: 1px solid black;
  padding: 5px;
  vertical-align: top;
  text-align: left;
}
</style>
<body>
<div class="container">
  <div style="margin-top:30px;">
    <img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px" style="float:left;">
                          <p style="text-align:center;position:relative;"><b style="font-size: 20px">TREATMENT & REHABILITATION CENTER - CEBU</b><br><span style="font-size:20px">Drug Dependency Examination Report</span></p>
                        </div><br><br>
@foreach($pat as $pats) 
  <?php $count = 0 ?>
  @foreach($history as $hist)
     @if($hist->type == 'Enrolled')
       @if($hist->deps->department_name == $pats->departments->department_name)
         <?php $count++; ?>
       @endif 
    @endif
  @endforeach
<table style="width:100%" cellspacing="10">
  <tr>
    <th width="50%" colspan="2"><br>
    <input style="margin-top: 6.5px; margin-left: 10px" type="checkbox" class="custom-control-input" id="new case" name="casetype" value="New Case" {{ ($count != 1)? "checked" : "" }} disabled="true">
    <label class="custom-control-label" for="new case"><b>Old Case</b></label><br>
    <input style="margin-top: 6.5px; margin-left: 10px" type="checkbox" class="custom-control-input" id="old case" name="casetype" value="Old Case" {{ ($count == 1)? "checked" : "" }} disabled="true"> 
    <label class="custom-control-label" for="old case"><b>New Case</b></label><br>
    <input style="margin-top: 6.5px; margin-left: 10px" type="checkbox" class="custom-control-input" id="case" name="casetype" value="With Court Case" {{ ($pats->caseno != NULL)? "checked" : "" }} disabled="true">
    <label class="custom-control-label" for="case"><b>With Court Case:</b><br>
    <span style="margin-left: 30px;">  @if($pats->caseno != NULL)
                    <b><u>{{$pats->caseno}}</u></b>
                  @elseif($pats->caseno == NULL)
                  _______________________________
                  @endif</span>
    </label>
    </th>
    <th style="margin-top: 100px" colspan="2">
      <input style="margin-top: 6.5px; margin-left: 10px" type="checkbox" class="custom-control-input" id="Voluntary Submission" name="type" value="Voluntary Submission" {{ ($pats->type->case_name == 'Voluntary Submission' || $pats->type->case_name == 'Voluntary with Court Order')? "checked" : "" }}  disabled="true">
      <label class="custom-control-label" for="Voluntary Submission"><b>Voluntary Submission</b></label><br>
      <input style="margin-top: 6.5px; margin-left: 10px" type="checkbox" class="custom-control-input" id="Compulsory Submission" name="type" value="Compulsory Submission" {{ ($pats->type->case_name == 'Plea Bargain' || $pats->type->case_name == 'Plea Bargain with Court Order')? "checked" : "" }} disabled="true">
      <label class="custom-control-label" for="Compulsory Submission"><b>Compulsory Submission</b></label><br>
      <input style="margin-top: 6.5px; margin-left: 10px" type="checkbox" class="custom-control-input" id="others" name="type" value="Others" {{ (old('type') == 'Others') ? 'checked' : '' }} disabled="true">
      <label class="custom-control-label" for="others"><b>Others: _________________</b></label>
    </th> 
  </tr>
  <tr>
    <td>Last Name:</td>
    <td>{{$pats->lname}}</td>
    <td rowspan="2" colspan="2">Address:<br>{{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</td>
  </tr>
    <tr>
    <td>First Name:</td>
    <td>{{$pats->fname}}</td>
  </tr>
  <tr>
    <td>Middle Name:</td>
    <td>{{$pats->mname}}</td>
    <td>Contanct Number:</td>
    <td>{{$pats->contact}}</td>
  </tr>
    <tr>
    <td>Age:</td>
    <td>{{\Carbon\Carbon::parse($pats->birthdate)->age}}</td>
    <td>Gender:</td>
    @if($pats->gender != NULL) 
    <td>{{$pats->genders->name}}</td>
    @else
  <td></td>
  @endif
  </tr>
    <tr>
    <td>Birthdate:</td>
    <td>{{$pats->birthdate}}</td>
    <td>Civil Status:</td>
    <td>{{$pats->status}}</td>
  </tr>
    <tr>
    <td>Birth Order:</td>
    @if($pats->birthorder != NULL)
    <td>{{NumConvert::numberOrdinal($pats->birthorder)}}</td>
    @else
    <td></td>
    @endif
    <td>Nationality:</td>
    <td>{{$pats->nationality}}</td>
  </tr>
    <tr>
    <td></td>
    <td></td>
    <td>Religion:</td>
    <td>{{$pats->religion}}</td>
  </tr>
</table>
     @endforeach
<br>
@if($patis != '[]')
@foreach($patis as $patin)
<table width="100%">
  <tr>
    <td width="30%">Referred by:</td>
    <td></td>
  </tr>
  <tr>
    <td width="30%">Accompanied by/Informant:</td>
    <td>Name: {{$patin->informants->name}}<br>
      Address: {{$patin->informants->address}}<br>
      Signature:______________________<br>
      Contanct Number: {{$patin->informants->contact}}
    </td>
  </tr>
  <tr>
    <td width="30%" height="3%">Drug Abused(Present):</td>
    <td>{{$patin->dabused->name}}</td>
  </tr>
  <tr>
    <td width="30%" height="3%">Cheif Complaint:</td>
    <td>{{$patin->chief_complaint}}</td>
  </tr>
  <tr>
    <td width="30%" height="3.5%">History of Present Illness:</td>
    <td>{{$patin->h_present_illness}}</td>
  </tr>
  <tr>
    <td width="30%" height="3.5%">History of Drug Use:</td>
    <td>{{$patin->h_drug_abuse}}</td>
  </tr>
  <tr>
    <td width="30%" height="3.5%">Family/Personal History:</td>
    <td>{{$patin->famper_history}}</td>
  </tr>
</table>
 @endforeach
 @elseif($patis == '[]')
 <table width="100%">
  <tr>
    <td width="30%">Referred by:</td>
    <td></td>
  </tr>
  <tr>
    <td width="30%">Accompanied by/Informant:</td>
    <td>Name: <br>
      Address: <br>
      Signature:______________________<br>
      Contanct Number: 
    </td>
  </tr>
  <tr>
    <td width="30%" height="3%">Drug Abused(Present):</td>
    <td></td>
  </tr>
  <tr>
    <td width="30%" height="3%">Cheif Complaint:</td>
    <td></td>
  </tr>
  <tr>
    <td width="30%" height="3.5%">History of Present Illness:</td>
    <td></td>
  </tr>
  <tr>
    <td width="30%" height="4.5%">History of Drug Use:</td>
    <td></td>
  </tr>
  <tr>
    <td width="30%" height="4.5%">Family/Personal History:</td>
    <td></td>
  </tr>
</table>  
@endif
</div>
</body>
</html>