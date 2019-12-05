const required=(value,property)=>{return(value.length<1)?'The '+property+' is required':''}
const password=(password,repassword)=>{if(password===repassword){return''}else{return"The passwords doesn't match!"}}
export{required,password}