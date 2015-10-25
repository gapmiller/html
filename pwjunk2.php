<!DOCTYPE html>
<form action="" method="POST">
  <input type="text" name="a">
  <input type="text" name="b">
  <input type="submit" name="send" value="enviar">
</form>
<?php
// from http://code.runnable.com/VL9SpFmOkvp3f-qe/encriptar-contrase%C3%B1as-con-crypt-for-php
if(isset($_POST['send'])){
$str='$2a$07$usesomesillystringforsalt$';
$sr = crypt($_POST['a'],$str);
$rs = crypt($_POST['b'],$str);

echo $sr.'<br>'.$rs;
}
?>