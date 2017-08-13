<?php
if(isset($_POST['user'])){
  echo json_encode(array('token' => 'supertoken'));
}
