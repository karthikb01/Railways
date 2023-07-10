function auth(){
    while(true){
        $var=document.getElementById('password').value();
        alert('$var');
        if($var=='root'){
                window.location.assign('admin.php');
                return true;
        }

        else{
            alert('Invalid password!');
            return false;
        }
       
    }
}

