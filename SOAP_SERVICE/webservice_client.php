<div class='row'>

 	<form class="form-inline" method = 'post' name='form1'>

 		<?php if($error) 
    { ?> 

     	<div class="alert alert-danger fade in">

   			<a href="#" class="close" data-dismiss="alert">&times;</a>
   			<strong>Error!</strong>&nbsp;
        <?php echo $error; 
        ?> 

      </div>

        <?php } 
        ?>

     <div class="form-group">

       <label for="email">ID:</label>

       <input type="text" class="form-control" name="isbn" id="isbn" placeholder="Enter ID">

     </div>

     <button type="submit" name='sub' class="btn btn-default">Fetch Student Information</button>

   </form>

  </div>


  <?php

  ini_set('display_errors', true);
  
  error_reporting(E_ALL);

  require_once('lib/nusoap.php');
  
  $error  = '';
  
  $result = array();
  
  $wsdl = "http://localhost:8888/php-webservices/webservice-server.php?wsdl";
  
  if(isset($_POST['sub'])){

    $id = trim($_POST['id']);

    if(!$id){

      $error = 'id cannot be left blank.';
    }

    if(!$error){

      //create client object
      $client = new nusoap_client($wsdl, true);

      $err = $client->getError();

      if ($err) {

        echo '<h2>Constructor error</h2>' . $err;

          exit();
      }

      try {

        $result = $client->call('fetchStudentData', array('PR-123-456'));

        $result = json_decode($result);

        }catch (Exception $e) {

          echo 'Caught exception: ',  $e->getMessage(), "\n";
       }
    }
  }

?>