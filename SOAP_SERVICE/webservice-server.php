<?php

 /** 

  @Description: Book Information Server Side Web Service:
  This Sctript creates a web service using NuSOAP php library. 
  fetchBookData function accepts ISBN and sends back book information.

  @Author:  http://programmerblog.net/

  @Website: http://programmerblog.net/

 */

 require_once('dbconn.php');

 require_once('lib/nusoap.php'); 

 $server = new nusoap_server();

/* Fetch 1 book data */
function fetchStudentData($id){

  global $dbconn;

  $sql = "SELECT id, title, author_name, price, isbn, category FROM books where id = :id";

  // prepare sql and bind parameters
    $stmt = $dbconn->prepare($sql);

    $stmt->bindParam(':id', $id);

    // insert a row
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    return json_encode($data);

    $dbconn = null;

}

$server->configureWSDL('booksServer', 'urn:book');

$server->register('fetchStudentData',
      array('id' => 'xsd:string'),  //parameter
      array('data' => 'xsd:string'),  //output
      'urn:book',   //namespace
      'urn:book#fetchStudentData' //soapaction
      );  

$server->service(file_get_contents("php://input"));

?>