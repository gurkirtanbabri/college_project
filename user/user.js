

                                  //usercheck//
$(document).ready(function($) {
	$('#slide_info2').hide();

$('#hha').on('click',()=>{
		$("#slide").css({"left":"30vw"}).animate({"left":"50vw"}, "slow");
		$('#slide_info1').hide();
		$('#slide_info2').show();
		$('#slide').css({'background-color':'#1ABC9C'});
		$('#nha').css({'background-color':'#FA534E'});
		
});

$('#nha').on('click',()=>{
		$("#slide").css({"left":"50vw"}).animate({"left":"30vw"}, "slow");
	
			$('#slide_info2').hide();
			$('#slide_info1').show();
			$('#slide').css({'background-color':'#FA534E'});
			$('#nha').css({'background-color':'#1ABC9C'});
});



 var guest =$('#guestdata').html();

});

//cursor//


                         //validations//

                         //signup//
var alphacheck=/^[a-zA-z 0-9]{4,30}$/;
var numcheck=/^[0-9]{10,10}$/;
var onlyalphacheck=/^[a-zA-z ]{4,30}$/;
var boolph=false;
var boolname=false;
var booladdr=false;
var boolpass=false;
var userph=false;
var userpass=false;
$('#guestph').on('change',()=>{
	let val1=$('#guestph').val();
	if(numcheck.test(val1)){
		boolph=true;
	}
	else{
		alert('please enter valid number');
		boolph=false;

		$('#guestph').val('');
	}
});


$('#guestname').on('change',()=>{
	let val1=$('#guestname').val();
	if(onlyalphacheck.test(val1)){
		boolname=true;
	}
	else{
		alert('please enter valid name');
		boolname=false;

		$('#guestname').val('');
	}
});

$('#guestaddress').on('change',()=>{
	let val1=$('#guestaddress').val();
	if(alphacheck.test(val1)){
		booladdr=true;
		console.log('aa');
	}
	else{
		alert('symbols are not accepted');
		booladdr=false;

		$('#guestaddress').val('');
	}
});


$('#guestpass').on('change',()=>{
	let val1=$('#guestpass').val();
	if(alphacheck.test(val1)){
		boolpass=true;
	}
	else{
		alert('symbols are not accepted');
		boolpass=false;

		$('#guestpass').val('');
	}
});
                       //login//


$('#userph').on('change',()=>{
	let val1=$('#userph').val();
	if(numcheck.test(val1)){
		userph=true;
	}
	else{
		alert('please enter valid number');
		userph=false;

		$('#userph').val('');
	}
});


$('#userpass').on('change',()=>{
	let val1=$('#userpass').val();
	if(alphacheck.test(val1)){
	userpass=true;
	}
	else{
		alert('please enter valid number');
		userpass=false;

		$('#userpass').val('');
	}
});



//guest submit//
$('#guest_submit').on('click',()=>{

	console.log(boolph+''+boolpass+''+boolname+''+booladdr);
	if(boolph&&boolpass&&boolname&&booladdr){
		$('#guest_submit').prop('disable', 'value');

			$.post({
			type:'post',
			url:'usersupport.php',
			data:{
				
				guestph:$('#guestph').val(),
				guestnm:$('#guestname').val(),
				guestpass:$('#guestpass').val(),
				guestaddr:$('#guestaddress').val()
			},
			 success:function(data){
			 	console.log(data);
			 	
			 	let obj=JSON.parse(data);
			 	let can=obj.return;
			 	console.log(typeof(obj.return));
			 	if(obj.return){
			 		console.log('inif');

			 		htm=`	<div id='vdiv'>		<h2 class="loghead">verify otp</h2>

			 			<input type="text" id='otp' class='guestin' placeholder="phone number" class="guestin">
			 		<button id='otpsub' class='hvr-grow' onclick='votp()'>verify</button></div>`;
			 		$('#data').hide();
			 		$('#guestdata').append(htm);
			 	}
			 	else{
			 		alert("can't send otp");
			 	}
			 }

		});
	}
	else{
		alert('fill all fileds correctly');
	}
});

                  //verfiy the otp//
function votp(){
	$.post({
		type:'post',
		url:'usersupport.php',
		data:{
			verify_otp:$('#otp').val()

		},
		success:function(data){
			console.log(data);
			if(data=='account created'){$('#data').show();
			alert('account is created');
			
			$('#vdiv').remove();

			}
			else if(data=='notdone'){
				alert('already exist');
			}
			else if (data=='incorrect'){
				alert('incorrect otp');
			}
			else{
				alert('otp timeout')
			}
		}
	});

}


                                   //login check//
 $('#user_check').on('click',()=>{
 	console.log(userph+''+userpass);
 	if(userph&&userpass){
 		$.post({
		type:'post',
		url:'usersupport.php',
		data:{
			userph:$('#userph').val(),
			userpass:$('#userpass').val()

		},
		success:function(data){
			if(data=='logged in'){
				window.location.replace('user.php');

			}
			else{
				alert('wrong password or number');
			}
		
		}
	});


 	}
 });




                                            //userlogin//


         




