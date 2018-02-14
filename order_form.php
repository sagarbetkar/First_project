<?php
 include 'db.php'; //connect the connection page
 session_start();
if(!isset($_SESSION['usertype']))
{
   header("location: login.php");

}
$name=$_SESSION['usertype'];
$id=$_SESSION['id'];
$cid=$_SESSION['c_id'];
echo"$id";
echo "$cid";
/*if(empty($_SESSION)) // if the session not yet started 
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: login.php");// send to login page
   exit;
} */

//include('../connect.php');

if($_SESSION['usertype']=="Admin" && $_SESSION['id'] && $_SESSION['c_id'])
{

?>                                    
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/app.css"/>
    <link rel="stylesheet" type="text/css" href="css/order_form.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>
<body>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <!--<a class="navbar-brand" href="#"><img src="images/logo.png" class="title-img" alt="logo"></a>-->
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="order_form.php">Home</a></li>
            <li><a href="details1.php">List Of Agents</a></li>
            <li><a href="agent.php">Add Agents/Address</a></li>
            <li><a href="order_details.php">View Orders</a></li>
            <li><a href="invoice.php">Invoice</a></li>
            <li><a href="register.php">Add Company</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">How it Works</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php //echo $_SESSION['username']; ?><span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
    </div>
  </nav>
	<div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Order Form  <i id="demo"></i></div>
			<div class="panel-body">
                <form class="form-horizontal" action="order_placed.php" method="post" id="contact_form">
                    <div id="clonedInput1" class="clonedInput1 well">
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">Agent Name</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <select name="agent_name" id="agent_name" class="form-control" onchange="get_value(this)" required>
                                        <option value="0">Select Agent Name</option>
                                        <?php 
                               $res=mysqli_query($con,"SELECT * FROM agent where u_id='$id' and c_id='$cid'");
                                foreach ($res as $name) {
                                    ?>
                                    <option value="<?php echo $name['id'] ?>"><?php echo $name['agent_name']; ?></option>
                                    <?php
                                }
                                
                                ?>
                                    </select>
                                   <input type="hidden" class="form-control" name="agent_name_text" id="agent_name_text" value="" placeholder="Agent name"/>
                                </div>
                            </div>
                            <label class="col-sm-2 control-label">Agent Code</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <select name="agent_code" id="agent_code" class="form-control agent_code">
                                        <option value="">Select Agent Code</option>
                                        
                                    </select>
                                    <!--<input type="text" class="form-control" name="item[0][agent_code]" id="agent_code" placeholder="Agent Code"  />-->
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">Shipping Address</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                                    <select name="ship_address" id="ship_address" class="form-control ship_address" >
                                        <option value="0">Select Shipping Address</option>
                                    </select>
                                    <!--<input type="text" class="form-control" name="item[0][ship_address]" id="ship_address" placeholder="Select Shipping Address"/> -->  
                                </div>
                            </div>
                            <label class="col-sm-2 control-label">Billing Address</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                                    <select name="bill_address" id="bill_address" class="form-control bill_address" >
                                        <option value="0">Select Billing Address</option>                    
                                    </select>
                                  <!--<input type="text" id="bill_address" name="item[0][bill_address]" class="form-control" placeholder="Select Billing Address"/>-->
                               </div>
                            </div>
                        </div>
                        <div class="form-group after-add-more">
                            <label class="col-sm-2 control-label ">Product</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                    <select name="product[]" id="product" class="form-control" required>
                                        <option value="0">Select Product</option>
                                        <?php 
                               $res=mysqli_query($con,"SELECT * from product");
                                while($row=mysqli_fetch_array($res))
                                {
                                    ?>
                                    <option value="<?php echo $row["product_name"]; ?>"><?php echo $row["product_name"]; ?></option>
                                    <?php
                                }
                                
                                ?>
                                    </select>
                                    <!--<input type="hidden" class="form-control" name="product_text[]" id="product_text" /> -->
                                </div>
                            </div>
                            <label class="col-sm-2 control-label">Quantity</label>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="button" value="-" class="qtyminus" />
                                    <input type="text" name="quantity[]" value="0" class="qty" />
                                    <input type="button" value="+" class="qtyplus" />
                                </div>
                            </div>                       
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-sm btn-primary addMoreProduct" name="addMoreProduct" id="addMoreProduct"><span class="glyphicon glyphicon-plus"></span> Add Product </button>
                            </div>
                        </div> 
                        <div id="appendProduct1"></div>
                        <!--<div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4 actions">
                                <button type="button" class="btn btn-sm btn-success clone"><span class="glyphicon glyphicon-plus"></span> Agent </button>
                                <button type="button" class="btn btn-sm btn-danger remove"><span class="glyphicon glyphicon-remove"></span> Remove</button>
                            </div>
                        </div>-->
                    </div>
                   <!-- <div class="form-group">                          
                    <button type="submit" id="submit_form" class="btn btn-warning">Submit <span class="glyphicon glyphicon-send"></span></button>
                </div>-->
                </form>
                 <div id="addExtraAgents"></div>
                <div class="form-group">                          
                    <button type="submit" id="submit_form" class="btn btn-warning" data-toggle="modal" data-target="#myModal" onclick="myfunction()">Submit <span class="glyphicon glyphicon-send"></span></button>
                </div>
            </div>
        </div>
	</div>


      <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmation</h4>
        </div>
        <div class="modal-body">
          <p>Thank you. Order is placed.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>


<script type="text/javascript">
       $(document.body).on("click", ".addMoreProduct", function(e) {
                console.log('ds');;
                e.preventDefault();
                elem=$(this).closest('.form-group');
                console.log($(this));
                productelemt=elem.siblings().parent().find("[id^='appendProduct']");
                if(productelemt.prop('id') == undefined){
                    productelemt=$(this).parents().closest("[id^='appendProduct']");
                }
                console.log(productelemt);
                $clone=elem.clone(true, true);
                $clone.find('[name*="quantity"]').val(0);
                $clone.appendTo( "#"+productelemt.prop('id') );

                console.log($(this).text('Remove'));
                $(this).removeClass( "addMoreProduct" ).addClass( "removeProduct" );
                $(this).attr("id", "removeProduct");
                    // $(this).remove();

            });

            $(document.body).on("click", ".removeProduct", function(e) {
                e.preventDefault();
                $(this).closest('.form-group').remove();
            });
$('.qtyminus').click(function() {
    qty = $(this).next('input');
    var currentVal = parseInt(qty.val());
    var newVal = (!isNaN(currentVal) && currentVal > 0) ? currentVal - 1 : 0;
    qty.val(newVal);
});

$('.qtyplus').click(function() {
    qty = $(this).prev('input');
    var currentVal = parseInt(qty.val());
    var newVal = (!isNaN(currentVal)) ? currentVal + 1 : 0;
    qty.val(newVal);
});

/*function renumber_blocks() {
    $("[class^='clonedInput']").each(function(index) {
        var prefix = "item[" + index + "]";
        $(this).find("input").each(function() {
           this.name = this.name.replace(/item\[\d+\]/, prefix);
        });
        $(this).find("select").each(function() {
           this.name = this.name.replace(/item\[\d+\]/, prefix);
        });
    });
}


    var regex = /^(.+?)(\d+)$/i;
    var cloneIndex = $("[class^='clonedInput']").length;

    function clone(){


        $(this).parent(".clonedInput").clone()
            .appendTo("#addExtraAgents")
            .attr("id", "clonedInput" +  cloneIndex)
            .find("*")
            .each(function() {
                var id = this.id || "";
                var match = id.match(regex) || [];
                if (match.length == 3) {
                    this.id = match[1] + (cloneIndex);
                }
            })
            .on('click', 'button.clone', clone)
            .on('click', 'button.remove', remove);
        cloneIndex++;
        renumber_blocks();
    }

    function remove(){

        $(this).parents(".clonedInput").remove();
    }
    $("button.clone").on("click", function(e){

        // console.log(cloneIndex);
        e.preventDefault();
        cloneIndex++;

        $clone=$(this).parents(".clonedInput1").clone(true,true);

        if($clone.children().closest('.agentProduct').find('button').html()!=undefined){
            if($clone.children().closest('.agentProduct').find('button').hasClass('removeProduct')){
                 $clone.children().closest('.agentProduct').find('button').removeClass('removeProduct').addClass( "addMoreProduct" );
                 $clone.children().closest('.agentProduct').find('button').attr("id", "addMoreProduct");
                 $clone.children().closest('.agentProduct').find('button').text('Add Product');
            }
            $clone.find('[id*="appendProduct"]').html('');
            $clone.find('[name*="agentName"]').val('');

        }else{
            // console.log('coming herer');
            console.log($clone.find('[id*="appendProduct"]').children().not(':last-child').remove());
            // console.log($clone.children().closest('.agentProduct').append('<p>dssdsdfdsfsd</p>'));
            // $clone.find('[id*="appendProduct"]').not('div:last')
            // $clone.children().closest('.agentProduct').append($clone.find('[id*="appendProduct"]').find('div:last').parent('div').html());
        }

         // console.log($elem=$clone.parents().find('[class*="removeProduct"]'));
         // if($elem.length>=1){
         //    console.log($elem);
         //    $clone.parents().find('[class*="removeProduct"]').removeClass( "removeProduct" ).addClass( "addMoreProduct" );
         //    $clone.parents().find('[class*="removeProduct"]').attr("id", "addMoreProduct");
         //    $clone.parents().find('[class*="removeProduct"]').text('Add Product');
         // }
         //        $elem.removeClass( "removeProduct" ).addClass( "addMoreProduct" );
         //        $elem.attr("id", "addMoreProduct");
            $clone.appendTo("#contact_form")
            .attr("id", "clonedInput" +  cloneIndex)
            .find("*")
            .each(function() {

                var id = this.id || "";
                var match = id.match(regex) || [];

                if (match.length == 3) {
                    this.id = match[1] + (cloneIndex);

                }
            })


            .on('click', 'button.clone', clone)
            .on('click', 'button.remove', remove);
            renumber_blocks();
    });

    $("button.remove").on("click", function(e){
        e.preventDefault();

        $elem=$(this).parents().closest("[class^='clonedInput']");
        $id=$elem.prop('id');
        if($id!='clonedInput1'){
            $elem.remove();
        }
    });*/
    
function myfunction(){  
    $("#contact_form").submit();
    /*$("#contact_form").submit(function(e) {
        e.preventDefault(); // don't submit multiple times
        $("#contact_form").submit();
        $('#myModal').show();
     });*/
}



function get_value(val)
{

    document.getElementById('agent_name_text').value = val.options[val.selectedIndex].text;
    x = val.options[val.selectedIndex].value;
    console.log(x);

//console.log(val);
$.ajax({
    url: 'getshipadd.php',
    type: 'POST',
    data: 'id='+x,
    success: function(data){
         $("#ship_address").html(data);
    }
});


$.ajax({
    url: 'getbilladd.php',
    type: 'POST',
    data: 'id='+x,
    success: function(data){
         $("#bill_address").html(data);
    }
});

$.ajax({
    url: 'getcode.php',
    type: 'POST',
    data: 'id='+x,
    success: function(data){
         $("#agent_code").html(data);
    }
});



}
/*function get_product(product){
    document.getElementByName('product_text').value = product.options[product.selectedIndex].text;
    console.log(document.getElementsByName('product_text'));
}*/


</script>
</body>
</html>
<?php
}
if($_SESSION['usertype']=="User" && $_SESSION['id'] && $_SESSION['c_id'])
{


?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/app.css"/>
    <link rel="stylesheet" type="text/css" href="css/order_form.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>
<body>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <!--<a class="navbar-brand" href="#"><img src="images/logo.png" class="title-img" alt="logo"></a>-->
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="order_form.php">Home</a></li>
            <li><a href="details1.php">List Of Agents</a></li>
            <li><a href="agent.php">Add Agents/Address</a></li>
            <li><a href="order_details.php">View Orders</a></li>
            <li><a href="invoice.php">Invoice</a></li>
            <li><a href="#">Add Company</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">How it Works</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php //echo $_SESSION['username']; ?><span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
    </div>
  </nav>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Order Form  <i id="demo"></i></div>
            <div class="panel-body">
                <form class="form-horizontal" action="order_placed.php" method="post" id="contact_form">
                    <div id="clonedInput1" class="clonedInput1 well">
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">Agent Name</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <select name="agent_name" id="agent_name" class="form-control" onchange="get_value(this)" required>
                                        <option value="0">Select Agent Name</option>
                                        <?php 
                               $res=mysqli_query($con,"SELECT * FROM agent where u_id='$id' and c_id='$cid'");
                                foreach ($res as $name) {
                                    ?>
                                    <option value="<?php echo $name['id'] ?>"><?php echo $name['agent_name']; ?></option>
                                    <?php
                                }
                                
                                ?>
                                    </select>
                                   <input type="hidden" class="form-control" name="agent_name_text" id="agent_name_text" value="" placeholder="Agent name"/>
                                </div>
                            </div>
                            <label class="col-sm-2 control-label">Agent Code</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <select name="agent_code" id="agent_code" class="form-control agent_code">
                                        <option value="">Select Agent Code</option>
                                        
                                    </select>
                                    <!--<input type="text" class="form-control" name="item[0][agent_code]" id="agent_code" placeholder="Agent Code"  />-->
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">Shipping Address</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                                    <select name="ship_address" id="ship_address" class="form-control ship_address" >
                                        <option value="0">Select Shipping Address</option>
                                    </select>
                                    <!--<input type="text" class="form-control" name="item[0][ship_address]" id="ship_address" placeholder="Select Shipping Address"/> -->  
                                </div>
                            </div>
                            <label class="col-sm-2 control-label">Billing Address</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                                    <select name="bill_address" id="bill_address" class="form-control bill_address" >
                                        <option value="0">Select Billing Address</option>                    
                                    </select>
                                  <!--<input type="text" id="bill_address" name="item[0][bill_address]" class="form-control" placeholder="Select Billing Address"/>-->
                               </div>
                            </div>
                        </div>
                        <div class="form-group after-add-more">
                            <label class="col-sm-2 control-label ">Product</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                    <select name="product[]" id="product" class="form-control" required>
                                        <option value="0">Select Product</option>
                                        <?php 
                               $res=mysqli_query($con,"SELECT * from product");
                                while($row=mysqli_fetch_array($res))
                                {
                                    ?>
                                    <option value="<?php echo $row["product_name"]; ?>"><?php echo $row["product_name"]; ?></option>
                                    <?php
                                }
                                
                                ?>
                                    </select>
                                    <!--<input type="hidden" class="form-control" name="product_text[]" id="product_text" /> -->
                                </div>
                            </div>
                            <label class="col-sm-2 control-label">Quantity</label>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="button" value="-" class="qtyminus" />
                                    <input type="text" name="quantity[]" value="0" class="qty" />
                                    <input type="button" value="+" class="qtyplus" />
                                </div>
                            </div>                       
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-sm btn-primary addMoreProduct" name="addMoreProduct" id="addMoreProduct"><span class="glyphicon glyphicon-plus"></span> Add Product </button>
                            </div>
                        </div> 
                        <div id="appendProduct1"></div>
                        <!--<div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4 actions">
                                <button type="button" class="btn btn-sm btn-success clone"><span class="glyphicon glyphicon-plus"></span> Agent </button>
                                <button type="button" class="btn btn-sm btn-danger remove"><span class="glyphicon glyphicon-remove"></span> Remove</button>
                            </div>
                        </div>-->
                    </div>
                   <!-- <div class="form-group">                          
                    <button type="submit" id="submit_form" class="btn btn-warning">Submit <span class="glyphicon glyphicon-send"></span></button>
                </div>-->
                </form>
                 <div id="addExtraAgents"></div>
                <div class="form-group">                          
                    <button type="submit" id="submit_form" class="btn btn-warning" data-toggle="modal" data-target="#myModal" onclick="myfunction()">Submit <span class="glyphicon glyphicon-send"></span></button>
                </div>
            </div>
        </div>
    </div>


      <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmation</h4>
        </div>
        <div class="modal-body">
          <p>Thank you. Order is placed.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>


<script type="text/javascript">
       $(document.body).on("click", ".addMoreProduct", function(e) {
                console.log('ds');;
                e.preventDefault();
                elem=$(this).closest('.form-group');
                console.log($(this));
                productelemt=elem.siblings().parent().find("[id^='appendProduct']");
                if(productelemt.prop('id') == undefined){
                    productelemt=$(this).parents().closest("[id^='appendProduct']");
                }
                console.log(productelemt);
                $clone=elem.clone(true, true);
                $clone.find('[name*="quantity"]').val(0);
                $clone.appendTo( "#"+productelemt.prop('id') );

                console.log($(this).text('Remove'));
                $(this).removeClass( "addMoreProduct" ).addClass( "removeProduct" );
                $(this).attr("id", "removeProduct");
                    // $(this).remove();

            });

            $(document.body).on("click", ".removeProduct", function(e) {
                e.preventDefault();
                $(this).closest('.form-group').remove();
            });
$('.qtyminus').click(function() {
    qty = $(this).next('input');
    var currentVal = parseInt(qty.val());
    var newVal = (!isNaN(currentVal) && currentVal > 0) ? currentVal - 1 : 0;
    qty.val(newVal);
});

$('.qtyplus').click(function() {
    qty = $(this).prev('input');
    var currentVal = parseInt(qty.val());
    var newVal = (!isNaN(currentVal)) ? currentVal + 1 : 0;
    qty.val(newVal);
});

/*function renumber_blocks() {
    $("[class^='clonedInput']").each(function(index) {
        var prefix = "item[" + index + "]";
        $(this).find("input").each(function() {
           this.name = this.name.replace(/item\[\d+\]/, prefix);
        });
        $(this).find("select").each(function() {
           this.name = this.name.replace(/item\[\d+\]/, prefix);
        });
    });
}


    var regex = /^(.+?)(\d+)$/i;
    var cloneIndex = $("[class^='clonedInput']").length;

    function clone(){


        $(this).parent(".clonedInput").clone()
            .appendTo("#addExtraAgents")
            .attr("id", "clonedInput" +  cloneIndex)
            .find("*")
            .each(function() {
                var id = this.id || "";
                var match = id.match(regex) || [];
                if (match.length == 3) {
                    this.id = match[1] + (cloneIndex);
                }
            })
            .on('click', 'button.clone', clone)
            .on('click', 'button.remove', remove);
        cloneIndex++;
        renumber_blocks();
    }

    function remove(){

        $(this).parents(".clonedInput").remove();
    }
    $("button.clone").on("click", function(e){

        // console.log(cloneIndex);
        e.preventDefault();
        cloneIndex++;

        $clone=$(this).parents(".clonedInput1").clone(true,true);

        if($clone.children().closest('.agentProduct').find('button').html()!=undefined){
            if($clone.children().closest('.agentProduct').find('button').hasClass('removeProduct')){
                 $clone.children().closest('.agentProduct').find('button').removeClass('removeProduct').addClass( "addMoreProduct" );
                 $clone.children().closest('.agentProduct').find('button').attr("id", "addMoreProduct");
                 $clone.children().closest('.agentProduct').find('button').text('Add Product');
            }
            $clone.find('[id*="appendProduct"]').html('');
            $clone.find('[name*="agentName"]').val('');

        }else{
            // console.log('coming herer');
            console.log($clone.find('[id*="appendProduct"]').children().not(':last-child').remove());
            // console.log($clone.children().closest('.agentProduct').append('<p>dssdsdfdsfsd</p>'));
            // $clone.find('[id*="appendProduct"]').not('div:last')
            // $clone.children().closest('.agentProduct').append($clone.find('[id*="appendProduct"]').find('div:last').parent('div').html());
        }

         // console.log($elem=$clone.parents().find('[class*="removeProduct"]'));
         // if($elem.length>=1){
         //    console.log($elem);
         //    $clone.parents().find('[class*="removeProduct"]').removeClass( "removeProduct" ).addClass( "addMoreProduct" );
         //    $clone.parents().find('[class*="removeProduct"]').attr("id", "addMoreProduct");
         //    $clone.parents().find('[class*="removeProduct"]').text('Add Product');
         // }
         //        $elem.removeClass( "removeProduct" ).addClass( "addMoreProduct" );
         //        $elem.attr("id", "addMoreProduct");
            $clone.appendTo("#contact_form")
            .attr("id", "clonedInput" +  cloneIndex)
            .find("*")
            .each(function() {

                var id = this.id || "";
                var match = id.match(regex) || [];

                if (match.length == 3) {
                    this.id = match[1] + (cloneIndex);

                }
            })


            .on('click', 'button.clone', clone)
            .on('click', 'button.remove', remove);
            renumber_blocks();
    });

    $("button.remove").on("click", function(e){
        e.preventDefault();

        $elem=$(this).parents().closest("[class^='clonedInput']");
        $id=$elem.prop('id');
        if($id!='clonedInput1'){
            $elem.remove();
        }
    });*/
    
function myfunction(){  
    $("#contact_form").submit();
    /*$("#contact_form").submit(function(e) {
        e.preventDefault(); // don't submit multiple times
        $("#contact_form").submit();
        $('#myModal').show();
     });*/
}



function get_value(val)
{

    document.getElementById('agent_name_text').value = val.options[val.selectedIndex].text;
    x = val.options[val.selectedIndex].value;
    console.log(x);

//console.log(val);
$.ajax({
    url: 'getshipadd.php',
    type: 'POST',
    data: 'id='+x,
    success: function(data){
         $("#ship_address").html(data);
    }
});


$.ajax({
    url: 'getbilladd.php',
    type: 'POST',
    data: 'id='+x,
    success: function(data){
         $("#bill_address").html(data);
    }
});

$.ajax({
    url: 'getcode.php',
    type: 'POST',
    data: 'id='+x,
    success: function(data){
         $("#agent_code").html(data);
    }
});



}
/*function get_product(product){
    document.getElementByName('product_text').value = product.options[product.selectedIndex].text;
    console.log(document.getElementsByName('product_text'));
}*/


</script>
</body>
</html>
<?php
}
?>