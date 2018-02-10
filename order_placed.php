<?php 

$link = mysqli_connect("localhost", "root", "", "tag8_local");

if($link === false){
	die("ERROR: Could not connect." . myqli_connect_error());
}

 $values = array();

    $agent_name = mysqli_real_escape_string($link, $_REQUEST['agent_name_text']);
    $agent_code = mysqli_real_escape_string($link, $_REQUEST['agent_code']);
    $ship_address =  mysqli_real_escape_string($link,$_REQUEST['ship_address']);
    $bill_address =  mysqli_real_escape_string($link,$_REQUEST['bill_address']);
    $product= $_POST['product'];
    $quantity= $_POST['quantity'];
   // $cproduct = count($_POST['product']);
    $cquantity = count($_POST['quantity']);
    print_r($_POST['product']);
   // print_r($cquantity);
    

    if($cproduct == $cquantity)
    {  
      for($x = 0; $x < $cproduct; $x++)
      {    
        $values[] = '("' . $agent_name . '","' . $agent_code . '","' . $ship_address. '","' . $bill_address . '","' . $product[$x] . '","'. $quantity[$x] .'")'; 
       // print_r($product[$x]); 
      } 
    }
    /*foreach($_POST['product_text'] as $product => $name) 
    {
      print_r($product);
      print_r($quantity);
    }*/
     /* foreach (array_combine($_POST['product_text'], $_POST['quantity']) as $product => $quantity) {

      	print_r($product_text);

      	 $values[] = '("' . $agent_name . '","' . $agent_code . '","' . $ship_address. '","' . $bill_address . '","' . $product . '","'. $quantity .'")';
      
    }*/

    
    $sql = ("INSERT INTO order_details (agent_name, agent_code, ship_address, bill_address, product, quantity) VALUES " . implode(',', $values));

 

if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// close connection
mysqli_close($link);
header("location:order_form.php");
?>