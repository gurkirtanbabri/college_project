jQuery(document).ready(function($) {
		$('#o1').click();
});

var per='o1'

function color(id){

	$('#'+per).css('background', 'var(--dark)');

	$('#'+id).css('background', 'var(--purple)');
	per=id;

}


$('#o1').click(function(event) {
	/* Act on the event */
	color('o1');
		let v= '';
	$.ajax({
		url: 'ordersupport.php',
		type: 'POST',

		data: {con:v},
		success:function(data){
			$('#main').html(data);
		}

	});
	
});

$('#o2').click(function(event) {
	/* Act on the event */
	color('o2');
	let v=''
	$.ajax({
		url: 'ordersupport.php',
		type: 'POST',
		
		data: {bake:''},
		success:function(data){
			$('#main').html(data);
		}

	});
});

$('#o3').click(function(event) {
	/* Act on the event */
	color('o3');
	$.ajax({
		url: 'ordersupport.php',
		type: 'POST',
		
		data: {daliver: 'value1'},
		success:function(data){
			
			$('#main').html(data);
		}

	});
});

                                     //actions //



        function conform_order(id){
        	
        	let v=id.trim();

	$.ajax({
		url: 'ordersupport.php',
		type: 'POST',
		
		data: {conform:v},
		success:function(data){
			$('#o1').click();
		}

	});

        }
        function cancel_order(id){

        	let v=id.trim();
	$.ajax({
		url: 'ordersupport.php',
		type: 'POST',
		
		data: {cancel:v},
		success:function(data){
			console.log(data);
			$('#o1').click();
			
		}

	});
        }




        function com(id){
        	
        	let v=id.trim();
	$.ajax({
		url: 'ordersupport.php',
		type: 'POST',
		
		data: {completed:v},
		success:function(data){
			$('#o2').click();
		}

	});

        }


        function deliver(id){

      	let v=id.trim();
	$.ajax({
		url: 'ordersupport.php',
		type: 'POST',
		
		data: {Delivered:v},
		success:function(data){
			$('#o3').click();
		}

	});


        }