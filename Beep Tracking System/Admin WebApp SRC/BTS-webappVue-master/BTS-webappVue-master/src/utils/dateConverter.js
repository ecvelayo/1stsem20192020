const timeStampset=(getDate)=>{var setDate=new Date(getDate*1000)
var month=setDate.getMonth()
var setMonth
if(month==0){setMonth='Jan'}else if(month==1){setMonth='Feb'}else if(month==2){setMonth='Mar'}else if(month==3){setMonth='Apr'}else if(month==4){setMonth='May'}else if(month==5){setMonth='Jun'}else if(month==6){setMonth='Jul'}else if(month==7){setMonth='Aug'}else if(month==8){setMonth='Sep'}else if(month==9){setMonth='Oct'}else if(month==10){setMonth='Nov'}else if(month==11){setMonth='Dec'}
var date=setMonth+' '+setDate.getDate()+' '+setDate.getFullYear();var time=setDate.getHours()+":"+setDate.getMinutes()+":"+setDate.getSeconds();var getDay=setDate.getDay()
var day
if(getDay==0){day='Sunday'}else if(getDay==1){day='Monday'}else if(getDay==2){day='Tueday'}else if(getDay==3){day='Wednesday'}else if(getDay==4){day='Thursday'}else if(getDay==5){day='Friday'}else if(getDay==6){day='Saturday'}
var dateTime=day+' '+date+' '+time;return dateTime}
export{timeStampset}