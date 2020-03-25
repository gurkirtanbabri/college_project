<?php
session_start();
if(isset($_SESSION['admin'])){
    echo "<script>window.location.replace('admin.php')</script>";}
?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="../css/hover.css">
  
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../font.css">
</head>
    <body>
    <div class="login-div">
        <p class="login-heading">ADMIN LOGIN</p>
    <h3 id="error"></h3>
        <h3 id="sucess"></h3>
        <input type="text" id="admin-username" class="login-field" placeholder="Enter Username" onclick="value=''">
        <input type="password" id="admin-password" class="login-field" placeholder="password" onclick="value=''">
        <button type="button" id="admin-log" class="login-btn" onclick="send_admin()">SUBMIT</button>
        </div>
        <script type="application/javascript" src="../js/main.js"></script>
        <script type="text/javascript" src="../jq.js"></script>
        
        <script>
            var user_name=document.getElementById('admin-username');
            var pass=document.getElementById('admin-password');
            var uname=user_name.value;
            var upass=pass.value;
            var sucess=document.getElementById('sucess');
            var error=document.getElementById('error');
             user_name_bv=false;
            pass_bv=false;
            user_name.addEventListener('blur',()=>{
            var str = user_name.value;
                 let user_check= /^[a-zA-Z0-9]{2,30}$/;
                
                if(user_check.test(str)){
                   
                    user_name_bv = true;
                     error.innerHTML='';
                }
                else{
                    error.innerHTML="name only accept alphabets and numbers";
                }});
        pass.addEventListener('blur',()=>{
           var str1 = pass.value;
                 let pass_check= /^[a-zA-Z0-9_#@\.]{6,12}$/;
              
                if(pass_check.test(str1)){
                   
                    pass_bv = true;
                    error.innerHTML='';
                }
                else{
                    error.innerHTML="password should between 6-12 only -@# symbols accepted";
                }});

        function send_admin(){
        $.ajax({
            type:'post',
            url:'admin_check.php',
            data:{name:$('#admin-username').val(),
                pass:$('#admin-password').val()},
                
                success:function(data){
                    if(data==="logged in"){
                         $('#sucess').html('logged in');
                         
                        window.location.href='admin.php'


                        
                    }
                    else if(data==="wrong password"){
                        $('#error').html('wrong username or password');


                    }
                    else{$('#error').html(data);


                    }
                }
        });
        
            
        }

        </script>
    </body>
</html>