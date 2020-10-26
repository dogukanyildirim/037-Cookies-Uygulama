    <?php  
    session_start();

    if(isset($_SESSION["admin_name"])){
     header("location:home.php");
    }

    $connect = mysqli_connect("localhost", "root", "root","cookieDB");  

    if(isset($_POST["login"])){

     if(!empty($_POST["member_name"]) && !empty($_POST["member_password"])){

      $name = mysqli_real_escape_string($connect, $_POST["member_name"]);
      $password = mysqli_real_escape_string($connect, $_POST["member_password"]);

      $sql = "SELECT * from admin_login WHERE admin_name = '" . $name . "' and admin_password = '" . $password . "'";  

      $result = mysqli_query($connect,$sql);  
      $user = mysqli_fetch_array($result);  

      if($user){  

  $_SESSION["admin_name"] = $name;
  $_SESSION["admin_password"] = $password;
  
       if(!empty($_POST["remember"])){  

        setcookie ("member_login",$name, strtotime("+1 day") );  
        setcookie ("member_password",$password, strtotime("+1 day"));
        

      }else{  

        setcookie ("member_login",$name, strtotime("-1 day"));  
        setcookie ("member_password",$password, strtotime("-1 day"));
        
   }  
    header("location:home.php"); 
    }  
    else{ 

     $message = "Kullanıcı Adı veya Şifre Yanlış!";  

   }
 }else{

      $message = "Lütfen Kullanıcı Adı veya Şifre alanlarını boş bırakmayınız!";
    }
    }  
    ?>  
    <html>  
    <head>  
      <title>PHP Cookie Uygulaması</title>  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      <style>  
        body  
        {  
         margin:0;  
         padding:0;  
         background-color:#f1f1f1;  
       }  
       .box  
       {  
         width:700px;  
         padding:20px;  
         background-color:#fff;  
       }  
     </style>  
    </head>  
    <body>  
      <div class="container box">  
       <form action="" method="post" id="frmLogin"> 
        <h3 align="center">PHP Login - Beni Hatırla Örnek Uygulama</h3><br />

        <div class="text-danger"><?php if(isset($message)) { echo $message; } ?></div>  


        <div class="form-group">  
         <label for="login">Kullanıcı Adı</label>  
         <input name="member_name" type="text" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" class="form-control" />  
       </div>  
       <div class="form-group">  
         <label for="password">Şifre</label>  
         <input name="member_password" type="password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" class="form-control" />   
       </div>  
       <div class="form-group">  
         <input type="checkbox" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />  
         <label for="remember-me">Beni Hatırla</label>  
       </div>  
       <div class="form-group">  
         <div><input type="submit" name="login" value="Giriş" class="btn btn-success"></span></div>  
       </div>   
     </form>  
     <br />  
    </div>  
    </body>  
    </html>
