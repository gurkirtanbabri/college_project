//event lisners

jQuery(document).ready(function($) {
	cart_value();
});
function remove_c(id) {
	var id_to_remove=id;
$.ajax({
	url: 'cart_support.php',
	type: 'POST',
	data: {remove:id_to_remove},
	success:function(data){
		data=data.trim(data);
		if(data=='removed'){
			window.location.reload(true);
		}
		else{
			alert('an error occer');
		}
	}
})

}

$('.counter_btn_plus').click(function(event) {
let id = this.id;
let $td = $(this).closest('td');

 $ele = $td.find('input');
let quantity =parseInt($ele.val());

if(quantity<20){
	quantity=quantity+1;
qty(id,quantity);

}

});


$('.counter_btn_minus').click(function(event) {
let id = this.id;
let $td = $(this).closest('td');

 $ele = $td.find('input');
let quantity =parseInt($ele.val());
console.log(quantity);
if(quantity>1){
	quantity=quantity-1;
qty(id,quantity);

}

});
function chekout(){
	let mode= $('#t_mode').val();
	if(mode=='cash on delivery'){
$.ajax({
	url: 'cart_support.php',
	type: 'POST',
	
	data: {cod: 0},
	success:function(data){
		console.log(data);
		data=data.trim();
		if(data=='order_placed'){
			alert('order placed');

location.reload();
		}
	}
});
		////
	}
	else {
		window.location.replace('onlinepay.php')
	}
}







//ajax function//
function cart_value(){
    $.ajax({
        url: 'cart_support.php',
        type: 'POST',
        data: {cart_value: ''},
        success:function(data){
            
            var d=data;
                        console.log(data);
          $('#count').text(data);
        }
    });

    
}

function qty(id,value){
	var id_to_update=id;
	let quantity=value;
	$.ajax({
	url: 'cart_support.php',
	type: 'POST',
	data: {update:id_to_update,
		value:quantity


	},
	success:function(data){
		data=data.trim(data);
		console.log(data);
		if(data=='updated'){
			window.location.reload(true);
		}
		else{
			alert('an error occer');
		}
	}
})
}










