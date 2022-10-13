

<form action="" method="post" name="Login_Form">
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
    <?php if(isset($msg)){?>
    <tr>
      <td colspan="2" align="center" valign="top"><?php echo $msg;?></td>
    </tr>
    <?php } ?>
    <tr>
      <br><br><br>
      <td colspan="2" align="Center" valign="top"><h3>Visualisation des Stockes</h3></td>
    </tr>
    <tr>
      <td align="right" valign="top">Nom D'Utilisateur</td>
      <td><input name="Username" type="text" class="Input"></td>
    </tr>
    <tr>
      <td align="right">Mot De Passe</td>
      <td><input name="Password" type="password" class="Input"></td>
    </tr>
    <tr>
      <td> </td>
      <td><input name="Submit" type="submit" value="Login" class="Button3"></td>
    </tr>
  </table>
</form>

<?php session_start(); 
        
        if(isset($_POST['Submit'])){
                $logins = array('admin' => 'admin','yani' => 'yani','louis' => 'louis');
                
                
                $Username = isset($_POST['Username']) ? $_POST['Username'] : '';
                $Password = isset($_POST['Password']) ? $_POST['Password'] : '';
                
                if (isset($logins[$Username]) && $logins[$Username] == $Password){
                        $_SESSION['UserData']['Username']=$logins[$Username];
                        header("location:index.php");
                        exit;
                } else {
                        $msg="<span style='color:red'>Erreur dans le username ou le mot de passe</span>";
                }
        }
?>