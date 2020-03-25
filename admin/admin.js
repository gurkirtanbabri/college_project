var alphacheck=/^[a-zA-z ]{4,30}$/;
var numcheck=/^[0-9]{1,10000}$/;
var order=/^[0-9]{20,20}$/;
jQuery(document).ready(function(){
//hide element////catagies load//

first();
});


//variables//

let request='';
let menucolor="item-1";
let submitb=false;
let imagebool=false;
let final_submit=false;
//replace div
function replace_div(ids,content){
	$('#empty').html(content);
}


//menu color//
function change_color(id){
	$('#'+menucolor).css({
	"background-color":"black"
});
	menucolor=id;
$('#'+menucolor).css({
	"background-color":"#8E44AD"
});
}
//menu action//
change_color('item-1');

                            //ajex portion//
 //logout
	$('#logout_btn').on('click',(function(event){
		$.post({
			type:'post',
			url:'admin_suport.php',
			data:{
				logout:request
			},
			 success:function(data){
			 	if(data='logout done'){
			 		window.location.replace('../index.php');
			 	}
			 }

		})
	}));                           
                //catagires//

                
                	
$('#item-1').on('click',(function(event) {
	console.log('done');

		change_color('item-1');
		first();


//

}));
                  // add item//
$('#item-2').on('click',(function(event) {
	
	change_color('item-2');
	$.post({
			type:'post',
			url:'admin_suport.php',
			data:{
				add_item:request
			},
			 success:function(data){
			 	$('#empty').html(data);
			 	
			 	
			 }

		})


//


}));
                  //update item//
$('#item-3').on('click',(function(event) {

	change_color('item-3');
	$.post({
			type:'post',
			url:'admin_suport.php',
			data:{
				update_item:request
			},
			 success:function(data){
			 	$('#empty').html(data);
			 	
			 }

		});


//

	
}));

                        //admins//
$('#item-4').on('click',(function(event) {
	change_color('item-4');
	$.post({
			type:'post',
			url:'admin_suport.php',
			data:{
				TRANSECTION:request
			},
			 success:function(data){

			 	$('#empty').html(data);
			 }

		})


//

/*$.post({
			type:'post',
			url:'../cart/paytm/Txnstatus.php',
			data:{
				ORDER_ID:'98771530941582624518'
			},
			 success:function(data){
			 	$('#empty').html(data);
			 	
			 }*/

}));


function getdetail(){
	$("html").css('cursor','progress');
	let val =$('#tran_id').val();
	if(order.test(val)){
	$.post({
		type:'post',
			url:'../cart/paytm/Txnstatus.php',
			data:{
				ORDER_ID:'98771530941582624518'
			},
			 success:function(data){
			 	$("html").css('cursor','default');
			 	$('.trandetail').html(data);
			 	}


});
}

}
	




                                              //

	
function first(){

	console.log('clicked');
	
		
		change_color('item-1');
			$.post({
			type:'post',
			url:'admin_suport.php',
			data:{
		            catagires:request
			},
			 success:function(data){
			 	var res=data;
			 	replace_div('empty',res);
			 }

		})

}




//cedit  //

$('.edit').on('click',(function(event) {
	/* Act on the event */
event.stopPropagatin();
event.stopPropagatin();
console.log('done cl');

}));
	

//cdel//



//



//cedit and delete and add//
var i=true;
function cat_edit(id){
	var ide=id;
	function makinkig_cat_div(){
	var edit_dev=`<div class='edit_cat_div' id="edit_cat_div">
	<h2 id='x-cat' onclick="x_cat()">x</h2>
	<br/>
	<input type='text'  placeholder='edit category' id='edit_cat_input' >
	<button id='edit_cat_btn' >edit</button>

	</div>`;
	$('#cats').append(edit_dev);
	$('#edit_cat_btn').on('click',function(){edit_final(ide)});
	
}
if(i){

	makinkig_cat_div();
	
	i=false;
}
else{

	$('#edit_cat_div').show();
}
	

}
//to hide the edit div//
function x_cat(){
	
	$('#edit_cat_div').hide();


}
//final submition//
function edit_final(ide){
	var va=ide;
	var edit_value=$('#edit_cat_input').val();
	if(alphacheck.test(edit_value)){
		
		$.post({
			type:'post',
			url:'admin_suport.php',
			data:{
				edit_cat:va,
				value:edit_value
			},
			 success:function(data){
			 	
			 	if(data=="edited"){
			 		$('#item-1').click();
			 		i=true;
			 	}
			 }

		});
	}
	else{
		alert('enter valid value');
	}
	}

////
function cat_del(value){
	
		$.post({
			type:'post',
			url:'admin_suport.php',
			data:{
				del_cat:value
			},
			 success:function(data){
			 
			 	first();
			 	
			 }

		});

}
function cat_add(value){

	if(alphacheck.test(value)){
		$.post({
			type:'post',
			url:'admin_suport.php',
			data:{
				add_cat:value
			},
			 success:function(data){
			 	console.log(data);
			 	if(data=="created"){
			 		$('#item-1').click();
			 	}
			 }

		});

	}
	else{
		alert('enter valid value');
	}

	
}

                                //add item//
//evt_lsn//

function alphacheckfun(el,elv){
var element=el;
var elementval=elv;
if(!alphacheck.test(elementval)){
	alert('only alphabets and space accepted');
	element.value='';
	submitb=false;

}
else{
	submitb=true;
}

}
function numcheckfun(el,elv){
var element=el;
var elementval=elv;
if(!numcheck.test(elementval)){
	alert('enter valid number');
	element.value='';
submitb=false;
}
else{submitb=true;

}
}
function add_item_final(){
	var set_ele=[$('#add_item_name').val(),$('#add_item_price').val(),$('#add_item_discount').val(),$('#add_item_ingredients').val()];
var i;
for (i = 0; i < set_ele.length; i++) {
	final_submit=false;
if(!(set_ele[i]='')){
	final_submit=true;

}
else{
	alert('all fileds are needed');
	final_submit=false;
}
}
if(submitb&&imagebool&&final_submit){
	formdata=new FormData();
	formdata.append('image', $('input[type=file]')[0].files[0]);
	formdata.append('item_name',$('#add_item_name').val());
formdata.append('item_ingredients',$('#add_item_ingredients').val());
formdata.append('item_price',$('#add_item_price').val());
formdata.append('item_discount',$('#add_item_discount').val());
formdata.append('item_type',$('#type').val());
formdata.append('item_cat',$('#cat').val());
console.log(formdata);
$.ajax({
    url: 'add_item.php',
    data: formdata,
    type: "POST", //ADDED THIS LINE
    // THIS MUST BE DONE FOR FILE UPLOADING
    contentType: false,
    processData: false,
    // ... Other options like success and etc
    success:function(data){$('#empty').append(data);}
})

}
else{
	alert('all fields are required')
}
}

//file preview//
function readURL(input) {
	
	    var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image_upload').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        imagebool=true;
    }else{
         alert('enter valid image');
    }
}





//



//delitem
function main_del_item(ids,idt){
	let name_t_del=ids;
	let item_id=idt;
	$.post({
			type:'post',
			url:'admin_suport.php',
			data:{
				subt_cat:name_t_del,
				del_item:item_id

			},
			 success:function(data){
			 	console.log(data);
			 	if(data=="deleted"){
			 		$('#item-3').click();
			 	}
			 }

		})

}

//edit_item//
function main_edit_item(idc,ide){
let cname=idc;
let item_id=ide;
	$.post({
			type:'post',
			url:'update_item.php',
			data:{
				edit_item:item_id,
				edit_item_cat:cname
			},
			 success:function(data){
			 	$('#update_main_div').append(data);
			
			 }

		});
}



	//edit item  last//
function eedit_item(id,cat){
	ide=id;
	ename=$('#ename').val();
	eprice=$('#eprice').val();
	eing=$('#eing').val();
	edis=$('#edis').val();

	set_ele=[ename,eprice,eing,edis];
	console.log(set_ele);
for (i = 0; i < set_ele.length; i++) {
	final_submit=false;
if(!(set_ele[i]='')){
	final_submit=true;

}
else{
	alert('all fileds are needed');
	final_submit=false;
}
}



if(final_submit==true){

		$.post({
			type:'post',
			url:'update_item.php',
			data:{
				edit_item_data:ide,
				name:ename,
				price:eprice,
				dis:edis,
				ing:eing,
				type:$('#etype').val()

			},
			 success:function(data){
			 
			 	if(data=="true"){
alert('edited successful');
			 		$('#item-3').click();
			 	}
			 	else{
			 		alert("can't apply these changes");
			 	}
			
			 }

		});
}
}