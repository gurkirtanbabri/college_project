

jQuery(document).ready(function($) {
    cart_value();
});



//bar vstars hare//
$('#check_btn').click(()=>{
    if($('#check_btn').is(':checked')){
        $('.non-veg').hide();
    }
    else{
          $('.non-veg').show();
    }
});


                                                       //cart starts hare//



function addtocart(id){
    $.ajax({
        url: 'cart/cart_support.php',
        type: 'POST',
        data: {addtocart: id},
        success:function(data){
            
            var d=data;
            data= data.trim();
            console.log(data);
cart_value();
            if(data=='signin'){
                console.log('inside if');
                window.location.replace('user/useraccount.php');
            }
            else{
                
            }
        }
    });

    
}

function cart_value(){
    $.ajax({
        url: 'cart/cart_support.php',
        type: 'POST',
        data: {cart_value: ''},
        success:function(data){
            
            var d=data;
                        console.log(data);
          $('#count').text(data);
        }
    });

    
}