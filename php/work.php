<?php
require 'function.php';


if(isset($_GET['register'])){
  $data=registerUser($_POST);
  echo json_encode($data);  
}

if(isset($_GET['login'])){
    $data=userLogin($_POST);
    echo json_encode($data);  
  }

  if(isset($_GET['getmessages'])){
    $data=getMessages();
    foreach($data as $message){
      ?>
<div class="card m-2 <?=$message['id']==$_SESSION['userdata']['id']?'float-end bg-info  ':''?>" style="width: 18rem;">
<div class="card-body">
<?=$message['id']!=$_SESSION['userdata']['id']?'<h5 class="card-title"> <i class="fas fa-user-alt text text-success mr-2"></i>'.$message['full_name'].'</h5 class="card-subtitle mb-2">':'You : '.$message['full_name']?>
<h6 class="card-subtitle mb-2 text-danger"><?=date('d M Y, h:i A',strtotime($message['created_at']))?></h6>
<p class="card-text"><?=$message['message']?></p>
</div>
</div>
      <?php
    }
    
  }  

  if(isset($_GET['sendmessage']) && isset($_SESSION['user']) && $_SESSION['user']==true){

$data['user_id']=$_SESSION['userdata']['id'];
$data['message']=$_POST['message'];
if(!sendmessage($data)){
echo "<script>alert('enter something first')</script>";
}

  }


  if(isset($_GET['typing']) && isset($_SESSION['user']) && $_SESSION['user']==true){
$data['user_id']=$_SESSION['userdata']['id'];
$data['status']=$_POST['typing'];
updateTypingStatus($data);
  }

  if(isset($_GET['typingstatus']) && isset($_SESSION['user']) && $_SESSION['user']==true){
    $d['user_id']=$_SESSION['userdata']['id'];
    $data = getTypingStatus($d);
    foreach($data as $user){
     
      echo $user['full_name'];
      echo count($data)>1?',':'';
    }

    
if(count($data)>0){
  echo" is Active..";
 
  echo " is typing...";

}
    
    
    
}
//else
//{
//  echo '<p class="text text-danger mx-2"> Active</p>';
//}

