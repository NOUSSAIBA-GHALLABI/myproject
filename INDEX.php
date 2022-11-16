
<!DOCTYPE html>
<html lang="en">
<head>
<?php
include ('db.php'); 
 session_start();
 if(empty($_SESSION['login']) or empty($_SESSION['password'])) 
 {
    header('Location:authentification.php');
 } 
  
  
      $result="";
      $user=$_SESSION["login"];
      if($user== "sana"){
        $result="Madame sana";
      }
      if($user== "chouaib"){
        $result="Monsieur chouaib";
      }
      if($user== "zouhair"){
        $result="Monsieur zouhir";
      }
    ?>
  <?php
$erreur="";
if($_SERVER['REQUEST_METHOD']=='POST')
{
 $login=strip_tags($_POST['login']);
 $pass=strip_tags($_POST['password']);
 $confirm=strip_tags($_POST['confirmation']);
  
 if(isset($_POST["enregister"])) 
   {
    if ( empty($pass) || empty($confirm)|| empty( $login))
    {         
       $erreur="Tout les champs sont obligatoire";
    }
    else{
         
          if($user!=$login)
          {
            $erreur="votre nom d'utilisateur est incorrect ";
          }
          else{
            if($pass==$confirm)
            {
              $sql = "UPDATE `compte` SET `password` = ? WHERE `compte`.`login` = ?";
              $pdo_statement = $pdo_conn->prepare( $sql );
              $pdo_statement->bindParam(1, $pass);
              $pdo_statement->bindParam(2, $login);
              $pdo_statement->execute();
              $erreur="votre mot de passe est modifié";                
            };
    
            if ($pass!=$confirm)
            {
              $erreur="le mot de passe et la confirmation doivent être identique";
            }
          }
          
    }
     
   
     
 }	
}


?>
    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <img src="logo.png" alt="logo" />
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="#" >
          <i class="fa-light fa-file-circle-plus "></i>
          <span class="links_name " >Abssence</span>
        </a>
         <span class="tooltip">Abssence</span>
      </li>
      <li>
       <a href="#">
        <i class="fa-light fa-file-magnifying-glass"></i>
         <span class="links_name">Recherche</span>
       </a>
       <span class="tooltip">Recherche</span>
     </li>
     <li>
       <a href="#">
        <i class="fa-light fa-percent"></i>
         <span class="links_name">Pourcentage</span>
       </a>
       <span class="tooltip">Pourcentage</span>
     </li>
     <li>
       <a href="#">
        <i class="fa-light fa-chalkboard-user"></i>
         <span class="links_name">Formateur</span>
       </a>
       <span class="tooltip">Formateur</span>
     </li>
     <li>
       <a href="#">
        <i class="fa-light fa-file-pen"></i>
         <span class="links_name">Note</span>
       </a>
       <span class="tooltip">Note</span>
     </li>
     <li>
       <a href="INDEX.php" class="active">
       <i class="fa-light fa-gear active"></i>
         <span class="links_name active">Parametre</span>
       </a>
       <span class="tooltip">Parametre</span>
     </li>
     <li class="profile">
         <div class="profile-details">
          <i class="fa-light fa-circle-user"></i>
           <div class="name_job">
             <div class="name"><?php echo $result; ?></div>
           </div>
         </div>
         <a href="deconexion.php"><i class="fa-light fa-right-from-bracket" id="log_out"></i></a>
     </li>
    </ul>
  </div>

  <div class="home-section" align="center"> 
    <form method="POST">
                <div class="parram">
                  
                    <div class="id">   
                        <i class="fa-light fa-circle-user fa-5x"></i>
                    </div>
                    <span ><?php echo $result; ?></span>
                    
                    <table>
                        <tr>
                            <td><label>Utilisateur :</label></td>
                            <div class="Set">  <td><input id='utl' type="text" name="login">
                            <label id='err'></label>
                          
                          
                          </td></div>
                          
                            
                        </tr>
                        <tr>
                            <td>
                                <label>Mot de passe :</label>
                                
                            </td>
                            <td>
                              <div class="Set">
                                <input type="password" id='pass' name="password">
                                <span class="eye" onclick="myfunction()">
                    <i id="hide1"  class="fa fa-eye fa-lg" ></i>
                    <i id="hide2"  class="fa fa-eye-slash fa-lg" ></i>
                </span>
                              </div>
                            </td>
                        </tr>
                        <tr><td>
                            <label>Confirmer mot de passe :
                            </label>
                            
                        </td>
                        <td>
                          <div  class="Set"> <input id='conf' type="password" name="confirmation">
                        <span class="eye" onclick="myfunction2()">
                    <i id="hide3"  class="fa fa-eye fa-lg" ></i>
                    <i id="hide4"  class="fa fa-eye-slash fa-lg" ></i>
                </span>
                      </div>
                           
                        </td>
                    </tr>
                       <tr>
                        <td colspan=2><div style="color:red;text-align:center ; font-weight:bold"><?php echo $erreur;?></div></td>
                       </tr>
                    </table>
                    <button class="Enrg" type="submit" onclick='checkpass(),CheckVide(),checkconf()' name="enregister">Enregistrer</button>

                </div>

            </div>

        </div>



    </form>
    


</div>
  
</body>
<script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");
  
    closeBtn.addEventListener("click", ()=>{
      sidebar.classList.toggle("open");
      menuBtnChange();//calling the function(optional)
    });
  
    searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
      sidebar.classList.toggle("open");
      menuBtnChange(); //calling the function(optional)
    });
  
    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
     if(sidebar.classList.contains("open")){
       closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
     }else {
       closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
     }
    }
    </script>
    <script>
      const utl=document.getElementById('utl');
      const pass=document.getElementById('pass');
      const conf=document.getElementById('conf');
      




      function CheckVide(){
        if(utl.value.trim()==''){
          utl.style.backgroundColor='red';

        }else{
          utl.style.backgroundColor='';
        

        }
      }
      function checkpass(){
       if(pass.value.trim()==''){
        pass.style.backgroundColor='red';


       }else{
        pass.style.backgroundColor='';
        }



       }
       function checkconf(){
       if(conf.value.trim()==''){
        conf.style.backgroundColor='red';


       }else{
        conf.style.backgroundColor='';
        


       }
    

      }

      
          </script>
           <script>
        function myfunction(){
            var x= document.getElementById('pass');
            var y =document.getElementById('hide1');
            var z=document.getElementById('hide2');

            if(x.type=='password'){
                x.type='text';
                y.style.display="block";
                z.style.display="none";

                }
             else{
                x.type='password';
                y.style.display="none";
                z.style.display="block";

                } } 


                function myfunction2(){
            var x= document.getElementById('conf');
            var y =document.getElementById('hide3');
            var z=document.getElementById('hide4');

            if(x.type=='password'){
                x.type='text';
                y.style.display="block";
          
                z.style.display="none";

                }
             else{
                x.type='password';
                y.style.display="none";
                z.style.display="block";

                } } 
    </script> 
    

    
</html>