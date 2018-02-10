<?php
$con=mysqli_connect('localhost','root','','tag8_local')
    or die("connection failed".mysqli_errno());

$request=$_REQUEST;
$col =array(
    0   =>  'id',
    1   =>  'agent_code',
    2   =>  'agent_name',
    3   =>  'company_name',
    4   =>  'email_id',
    5   =>  'contact_no',
    6   =>  'ship_address',
    7   =>  'bill_address'
);  //create column like table in database

$sql ="SELECT * FROM agent_details";
$query=mysqli_query($con,$sql);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="SELECT * FROM agent_details WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" AND (id Like '".$request['search']['value']."%' ";
    $sql.=" OR agent_code Like '".$request['search']['value']."%' ";
    $sql.=" OR agent_name Like '".$request['search']['value']."%' ";
    $sql.=" OR company_name Like '".$request['search']['value']."%' ";
    $sql.=" OR email_id Like '".$request['search']['value']."%' ";
    $sql.=" OR contact_no Like '".$request['search']['value']."%' ";
    $sql.=" OR ship_address Like '".$request['search']['value']."%' ";
    $sql.=" OR bill_address Like '".$request['search']['value']."%' )";
}
$query=mysqli_query($con,$sql);
$totalData=mysqli_num_rows($query);



//Order
$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
    $request['start']."  ,".$request['length']."  ";

$query=mysqli_query($con,$sql);

$data=array();

while($row=mysqli_fetch_array($query)){
    $subdata=array();
    $subdata[]=$row[0]; //id
    $subdata[]=$row[1]; //agent_code
    $subdata[]=$row[2]; //agent_name
    $subdata[]=$row[3]; //company_name
    //$subdata[]=$row[4]; //bill_company
    $subdata[]=$row[4]; //emailid
    $subdata[]=$row[5]; //contactadd
    $subdata[]=$row[6]; //shipping adddress
    $subdata[]=$row[7];//billing_address1           //create event on click in button edit in cell datatable for display modal dialog           $row[0] is id in table on database
    $subdata[]='<button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row[0].'"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</button>
                <a href="details1.php?delete='.$row[0].'" onclick="return confirm(\'Are You Sure ?\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash">&nbsp;</i>Delete</a>';
    $data[]=$subdata;
}

$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);

?>