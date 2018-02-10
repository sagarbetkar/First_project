 <?php 
	include('db.php');
 		
 		$sqltran = mysqli_query($con, "SELECT * FROM order_details ORDER BY id DESC")or die(mysqli_error($con));
		$arrVal = array();
 		
		$i=1;
 		while ($rowList = mysqli_fetch_array($sqltran)) {
 								 
						$name = array(
								'num' =>$i,
 	 		 	 				'first'=> $rowList['agent_name'],
 	 		 	 				'second'=> $rowList['agent_code'],
 	 		 	 				'third'=> $rowList['ship_address'],
 	 		 	 				'fourth'=> $rowList['bill_address'],
 	 		 	 				'fifth'=> $rowList['product'],
 	 		 	 				'last'=> $rowList['quantity'],
 	 		 	 			);		


							array_push($arrVal, $name);	
			$i++;			
	 	}
	 		 echo  json_encode($arrVal);		
 

	 	mysqli_close($con);
?>   


