function validate(){

    var passwordregex=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?#&])[A-Za-z\d@$!%*?#&]{8,}$/;
    var age=document.form.age.value;
    var phone=document.form.phone.value;
    var pass1=document.getElementById("password").value;
    var pass2=document.getElementById("re-password").value;
    // console.log(age);
    // console.log(phone);
    // console.log(pass1);
    // console.log(pass2);
    if(age<18 || age>100){
        // alert("Your age is outside the limit!");
        document.getElementById("err").innerHTML="Invalid age!";
        document.form.password.focus();
        return false;
    }

    
    
    else if(phone.length<10){
        // alert("Enter a valid mobile number");
        document.getElementById("err").innerHTML="Invalid Phone number!";
        document.form.password.focus();
        return false;
    }

    var match=passwordregex.test(pass1);
    if(!match){
        
        document.getElementById("err").innerHTML="Invalid password!";
        document.form.password.focus();
        // alert("Invalid password!");
        return false;
    }

    else if(pass1!=pass2){
        document.getElementById("err").innerHTML="Passwords donot match!";
        document.form.password.focus();
        // alert("Passwords doesnt match!");
        return false;
    }

    return true;
}