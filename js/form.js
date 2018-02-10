function getState(val) //javascript fucntion for shipping country and state
{
	console.log(val);
	document.getElementById('ship_country_text').value = val.options[val.selectedIndex].text;
    x = val.options[val.selectedIndex].value;
    console.log(x);
	$.ajax({
		type:"POST",
		url:"states.php",
		data:'country_id='+x,
		success: function(data){
			$("#ship_state").html(data);
		}
	});
}


function getStat(val)   //javascript fucntion for billing country and state
{
	$.ajax({
		type:"POST",
		url:"states.php",
		data:'country_id='+val,
		success: function(data){
			$("#bill_state").html(data);
			document.getElementById('bill_state').selectedIndex = document.getElementById('ship_state').selectedIndex; 
			
		}
	});
}

function copy() //fuction which copies shipping address to billing address
{
	if(ship_checkbox.checked==true)
	{
		
		document.getElementById('billing_company_name').value = document.getElementById('shipping_company_name').value;
		document.getElementById('bill_address').value = document.getElementById('ship_address').value;
		//document.getElementById('bill_add2').value = document.getElementById('ship_add2').value;
		document.getElementById('bill_city').value = document.getElementById('ship_city').value;
		document.getElementById('bill_country').value = document.getElementById('ship_country').value;
		getStat(document.getElementById('bill_country').value);
		document.getElementById('bill_zipcode').value = document.getElementById('ship_zipcode').value;
		
	}
	else
	{
	
	}
}