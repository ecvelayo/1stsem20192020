<!DOCTYPE html>
<html>
   <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Intake Form</title>
  </head>
<style>
  .word {
  border-bottom: 1px solid black;
  font-size: 16px;
  line-height: 13px;
 }

   .word1 {
  border-bottom: 1px solid black;
  font-size: 16px;
  line-height: 13px;
</style>
<body>

<div>
    <p style="float: left;"><img src="http://localhost/capstone/public/images/logo.png" height="100px" width="100px"></p>
    <p style="float: right;"><img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px"></p>
    <br><p style="text-align: center">Republic of the Philippines<br> Department of Health<br>
     <b style="font-size: 15px">DANGEROUS DRUGS ABUSE PREVENTION & TREATMENT PROGRAM</b><br>EVERSLEY CHILD SANITARIUM<br>
     <b style="font-size: 15px;margin-left: 100px">CEBU TREAMENT & REHABILITATION CENTER</b> for <b>FEMALES</b><br>
     Jagobiao, Mandaue City, Cebu<br>
     <font size="12px">Telefax #: (032) 238-0650/Cp #:09255548119/Email Add: cebu_trc@yahoo.com.ph</font><br>
     </p>
   <div style="border:solid black 0.7px;width: 100%"></div>
</div>
                  @foreach($pat as $pats)
            <center style="margin-bottom: 5px"><h5>INTAKE FORM</h5></center>
              <div class="row" style="margin-left: 20px;font-size: 14px">
                <div class="col-md-6"><p><b>Client's Name:</b><u style="font-size: 14px">
                  _____________{{$pats->fname}} {{$pats->lname}}_____________</u><span style="float: right;margin-right:100px"><b>Date: </b><u>_______{{$pats->date_admitted}}______</u></span></p></div>
              </div>
              <div class="row" style="margin-left: 20px;font-size: 14px">
                <div class="col-md-6"><p><b>Date of Birth:</b><u>_______{{$pats->birthdate}}_______</u><b><span style="margin-left:20px">Age:</b><u>_____{{\Carbon\Carbon::parse($pats->birthdate)->age}}______</u></span><span style="float: right;margin-right:80px"><b>Marital Status:</b><u>______{{$pats->civil_status}}_____</u></span></p>
              </div>
            </div>
              <div class="row" style="margin-left: 20px;font-size: 14px">
                <div class="col-md-6"><p class="word"><b>Home Address: </b><br><br>{{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p></div>
                @endforeach
                @if($patos != '[]')
                @foreach($patos as $patss)
              <div class="row" style="font-size: 14px">
                <div class="col-md-12"><p><b>Educational Attainment: </b><u>_______{{$patss ->eduatain->name}}__</u><span style="float: right;margin-right:50px"><b>Employement Status: </b><u style="font-size: 14px">_____{{$patss->estat->name}}____</u></span></p></div>
              </div>
              <div class="row" style="font-size: 14px">
                <div class="col-md-12"><p><b>Name of Spouse: </b><u>__________{{$patss->spouse}}__________</u></p></div>
              </div>
              <div class="row" style="font-size: 14px">
                <div class="col-md-12"><p><b>Parents: </b></p></div>
              </div>
              <div class="row" style="font-size: 14px">
                <div class="col-md-12"><p><b>Father's Name: </b><u>______________{{$patss->father}}______________</u></p></div>
                <div class="col-md-12"><p><b>Mother's Name: </b><u>______________{{$patss->mother}}______________</u></p></div>
              </div>
              <div class="row" style="font-size: 14px">
                <div class="col-md-12"><p><b>Whom to notify in case of emergency: </b><u>________{{$patss->eperson->name}}_______</u></p></div>
              </div>
              <div class="row" style="font-size: 14px">
                <div class="col-md-6"><p><b>Name: </b><u>________{{$patss->eperson->name}}________</u><span style="float: right;margin-right:120px"><b>Relationship: </b><u>________{{$patss->eperson->relationship}}________</u></span></p>
              </div>
              <div class="row" style="font-size: 14px">
                <div class="col-md-4"><p><b>Phone No. (Home): </b><u>___{{$patss->eperson->phone}}___</u><b>Cellphone No.:</b><u >___{{$patss->eperson->cellphone}}___</u><b>Email add: </b><u >{{$patss->eperson->email}}</u></p></div>
              </div>
               <div class="row" style="font-size: 14px">
                <div class="col-md-12"><p class="word"><b>Presenting Problems: </b><br><br>{{$patss->presenting_problems}}</p></div>
              </div>
               <div class="row" style="font-size: 14px">
                <div class="col-md-12"><p class="word"><b>Impression: </b><br><br>{{$patss->impression}}</p></div>
              </div>
              <div class="row" style="font-size: 14x">
                <div class="col-md-6"><p><b>Intake Officer Signature: </b><u>______________________</u><span style="float: right;margin-right:50px"><b>Date:</b> <u>_________________________</u></span></p></div>
              </div>
            </div>
            </div>
            @endforeach
            @elseif($patos == '[]')
                          <div class="row" style="font-size: 14px">
                <div class="col-md-6"><p><b>Educational Attainment: </b><u>_______________________</u><span style="float: right;margin-right:90px"><b>Employement Status: </b><u style="font-size: 14px">__________________</u></span></p></div>
              </div>
              <div class="row" style="font-size: 14px">
                <div class="col-md-12"><p><b>Name of Spouse: </b><u>_______________________________</u></p></div>
              </div>
              <div class="row" style="font-size: 14px">
                <div class="col-md-12"><p><b>Parents: </b></p></div>
              </div>
              <div class="row" style="font-size: 14px">
                <div class="col-md-12"><p><b>Father's Name: </b><u>________________________________________________________</u></p></div>
                <div class="col-md-12"><p><b>Mother's Name: </b><u>_______________________________________________________</u></p></div>
              </div>
              <div class="row" style="font-size: 14px">
                <div class="col-md-12"><p><b>Whom to notify in case of emergency: </b><u>______________________________</u></p></div>
              </div>
              <div class="row" style="font-size: 14px">
                <div class="col-md-6"><p><b>Name: </b><u>________________________________</u><span style="float: right;margin-right:90px"><b>Relationship: </b><u>________________________________</u></span></p>
              </div>
              <div class="row" style="font-size: 14px">
                <div class="col-md-4"><p><b>Phone No. (Home): </b><u>__________________</u><b>Cellphone No.:</b><u >________________</u><b>Email add: </b><u >______________________</u></p></div>
              </div>
               <div class="row" style="font-size: 14px">
                <div class="col-md-12"><p class="word"><b>Presenting Problems: </b><br><br></p></div>
              </div>
               <div class="row" style="font-size: 14px">
                <div class="col-md-12"><p class="word"><b>Impression: </b><br><br></p></div>
              </div>
              <div class="row" style="font-size: 14x">
                <div class="col-md-6"><p><b>Intake Officer Signature: </b><u>______________________</u><span style="float: right;margin-right:50px"><b>Date:</b> <u>_________________________</u></span></p></div>
              </div>
            </div>
            </div>
            @endif
          </fieldset>
      </div>
    </body>     
</html>
