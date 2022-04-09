<?php
session_start();


// print_r($_SESSION['userdata']['id']);
if(isset($_SESSION['user']) && $_SESSION['user']==true){
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    <title>Chatting Web App</title>

    <style>
.footer {
position: fixed;

bottom: 5px;

width: 100%;
font-size:25px;
text-decoration:none;
background-color: black ;
color: white;
text-align: center;
}


.footer a{
    text-decoration:none;
}




</style>

    


        </style>
</head>


<body class="bg-secondary">

   
    <h1 class="text-center display-1" style="color: #ffc107;background: black;"><em>Realtime<span class="text-primary font-weight-bold"> Chatting </span>Application</em>
    <i class="fa fa-comments"style="color: blue aria-hidden="true"></i> </h1>
    

    <div class="container position-absolute top-50 start-50 translate-middle  ">
        
        <div class="card col-6 mx-auto mt-2 signup shadow">
       
            <div class="card-body">
                
                
                <h5 class="card-title">Signup</h5>
                <img class="rounded-circle mx-auto d-block"  src="./2.jpg" height="100px" width="100px">
                <hr>
                <p id="error" class="alert alert-danger text-center shadow-sm" style="display:none"></p>
                <form id="register_form">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        
                    </div>
<div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-warning">Register</button>
                    <a href="#" id="gotologin" style="text-decoration:none">Already Have An Account !</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card col-6 mx-auto mt-2 login shadow" style="display: none;">
            <div class="card-body">
                <h5 class="card-title">Login</h5>
                <img class="rounded-circle mx-auto d-block"  src="./2.jpg" height="100px" width="100px">
                <hr>
                <p id="error" class="alert alert-danger text-center shadow-sm" style="display:none"></p>
                <form id="login_form">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        
                    </div>

                    <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-warning">Login</button>
                    <a href="#" id="gotosignup" style="text-decoration:none">Create New Account !</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="card col-6 mx-auto mt-2 chat shadow" style="display: none;">
            <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">Group Chat </h5>
                
                <a href="php/logout.php" class="btn btn-sm btn-warning">Logout</a>
                </div>
                <hr>
                <div class="m-2 p-2" id="messages" class="" style="height:350px;overflow-y: scroll">
                
                    
                   
                </div>
                <div class="mb-2 p-2 text-danger ts"></div>

                <div class="input-group mb-3">

                    <input type="text" id="msg" class="form-control" placeholder="Message..." aria-label="Recipient's username"
                        aria-describedby="button-addon2">
                    <button class="btn btn-outline-warning sendmsg" type="button" id="button-addon2">Send message</i>
</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    var mget = false;
$(document).ready(function(){
var user = <?= isset($_SESSION['user'])?$_SESSION['user']:0 ?>;
if(user){
$('.signup').remove();
$('.login').remove();
$('.chat').show();
getMessages();
mgetf();

}
});

function mgetf(){
    if(!mget){
    setInterval(getMessages, 1000);
    setInterval(typingoff, 700);
    setInterval(typing_status, 500);
    mget=true;
}
}
// register ajax
    $('#register_form').submit(function(e){
        e.preventDefault();
        var url = 'php/work.php?register=true';
        var data = $(this).serialize();
        $.ajax({
  method: "POST",
  url: url,
  data:data,
  dataType:'json'
})
  .done(function( data ) {
      if(data.status){
        $(".signup #error").hide('10');
        $('#register_form').trigger('reset');
        $(".signup").hide('fast',function(){
            $('.signup').remove();
            $('.login').show('fast');
        
        });
 
        

      }else{
          $(".signup #error").show('10');
$(".signup #error").text(data.message);

      }
   
  });
    });
        


//login ajax
$('#login_form').submit(function(e){
        e.preventDefault();
        var url = 'php/work.php?login=true';
        var data = $(this).serialize();
        $.ajax({
  method: "POST",
  url: url,
  data:data,
  dataType:'json'
})
  .done(function( data ) {
      console.log(data);
      if(data.status){
        $(".login #error").hide('10');
        $('#login_form').trigger('reset');
        $(".login").hide('fast',function(){
            $('.login').remove();
            $('.chat').show('fast');
            getMessages();
            mgetf();
        
        });
 
        

      }else{
          $(".login #error").show('10');
$(".login #error").text(data.message);

      }
   
  });
    });

    $("#gotologin").click(function(){
$('.signup').hide('fast');
$('.login').show('fast');
    });

    $("#gotosignup").click(function(){
$('.login').hide('fast');
$('.signup').show('fast');
    });

    var prev;
function getMessages(){

    var url = 'php/work.php?getmessages=true';

    $.ajax({
  method: "POST",
  url: url,
})
  .done(function( data ) {
    $('#messages').html(data);
    if(prev!==data){
        $('#messages').scrollTop(1E10);

    }
      prev=data;
 
});
}

$('.sendmsg').click(function(){
    var url = 'php/work.php?sendmessage=true';
var msg = $('#msg').val();
    $.ajax({
  method: "POST",
  data:{message:msg},
  url: url,
})
  .done(function( data ) {
    $('#msg').val('');
    

 
});
});

function typingoff(){
    var url = 'php/work.php?typing=true';
    $.ajax({
  method: "POST",
  data:{typing:false},
  url: url,
})
  .done(function( data ) {
    
});
}

function typing_status(){
    var url = 'php/work.php?typingstatus=true';
    $.ajax({
  method: "POST",
  url: url,
})
  .done(function( data ) {
      $('.ts').text(data);
    console.log(data);
});
}

$('#msg').keydown(function(){
    var url = 'php/work.php?typing=true';
    $.ajax({
  method: "POST",
  data:{typing:true},
  url: url,
})
  .done(function( data ) {
    console.log(data);
});
});

    </script>


<div class="footer">
@Copyright <a href="https://github.com/Sush1223"> Sushant Pal </a> 2022- All Right Reserved. 
</div>



</body>







</html>