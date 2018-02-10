<?php 

$link = mysqli_connect("localhost", "root", "", "sagar");

if($link === false){
	die("ERROR: Could not connect." . myqli_connect_error());
}

//Get user's posts.
/*$posts = get_user_posts($item);

if(is_array($posts)){
    foreach($posts as $item)
 //$values = array();
 //$i = 0;

 //foreach($_GET['item'] as $item) 
 {
    $values[] = '(' . $item['agent_name'] . ',' . $item['agent_code'] . ','. $item['ship_address'].','. $item['bill_address'] .','. $item['product'][$i] .','. $item['quantity'][$i] .')';
    $i++;
}
}
   /* for($i=0 ;$i < count($_POST['item']); $i++) {
        $values[] = '("' . $_POST['item']['agent_name'][$i] . '","' . $_POST['item']['agent_code'][$i] . '","' . $_POST['item']['ship_address'][$i] . '","' . $_POST['item']['bill_address'][$i] . '","' . $_POST['item']['product'][$i] . '","'. $_POST['item']['quantity'][$i] .'")';
    }*/
    /*$sql = "INSERT INTO order_details (agent_name, agent_code, ship_address, bill_address, product, quantity) VALUES " . implode(',', $values);

/*$agent_name = mysqli_real_escape_string($link,$_REQUEST['agent_name']);
$agent_code = mysqli_real_escape_string($link,$_REQUEST['agent_code']);
$ship_address = mysqli_real_escape_string($link,$_REQUEST['ship_address']);
$bill_address = mysqli_real_escape_string($link,$_REQUEST['bill_address']);
$product = mysqli_real_escape_string($link,$_REQUEST['product']);
$quantity = mysqli_real_escape_string($link,$_REQUEST['quantity']);

$sql = "INSERT INTO order_details (agent_name,agent_code,ship_address,bill_address,product,quantity) VALUES ('$agent_name','$agent_code','$ship_address','$bill_address','$product','$quantity')";
*/
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
?>