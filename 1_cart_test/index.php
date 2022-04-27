<?php
    session_start();
    
    // please uncomment below code and run for first time and comment it again
    
    // $_SESSION['cart'] = array(
    //     array("product_id" => 1, "product_name" => "Shoe" , "quantity" =>2, "unit_price" => 10 ),
    //     array("product_id" => 2, "product_name" => "T-Shirt" , "quantity" =>4, "unit_price" => 15 ),
    //     array("product_id" => 3, "product_name" => "Pant" , "quantity" => 5, "unit_price" => 5)
    // ); 
    
    // get all cart data from session start
    if( isset($_POST['allData']) ){

        //re-index the array
        $_SESSION['cart'] = array_values($_SESSION['cart']);

        $data = "";
        $total = 0;
        for($i = 0 ; $i < count($_SESSION['cart']) ; $i++) {
            $serial = $i+1;
            $total = $total + $_SESSION['cart'][$i]['quantity'] *  $_SESSION['cart'][$i]['unit_price'];
            $data.='<tr id="'.$i.'">
                        <td>'.$serial.'</td>
                        
                        <input type="hidden" class="product_id" value="'.$_SESSION['cart'][$i]['product_id'].'">
                        
                        <td>'.$_SESSION['cart'][$i]['product_name'].'</td>
                        
                        <td><input type="number" class="form-control quantity" value="'.$_SESSION['cart'][$i]['quantity'].'"></td>
                        
                        <td>'.$_SESSION['cart'][$i]['unit_price'].'</td>
                        
                        <td>'.$_SESSION['cart'][$i]['quantity'] *  $_SESSION['cart'][$i]['unit_price'].'</td>
                        
						<td><a class="btn btn-sm btn-danger" onclick="deleteData('.$i.')">Delete</a></td>
						
					</tr>';
        }
        $data.='<tr>
                    <td colspan="4">Total : </td>
                    <td>'.$total.'</td>
                    <td></td>
					</tr>';
        echo $data;
        exit;
    }
    // get all cart data from session end



    // updateCard Start
    if( isset($_POST['quantity']) && $_POST['quantity'] != ''){
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        
        for($count = 0; $count < count($quantity); $count++ ){
            $_SESSION['cart'][$count]['quantity'] = $quantity[$count]; 
            
        }
        exit;
    }
    // updateCard end

    // delete-card-item Start
    if( isset($_POST['id']) ){
        $id = $_POST['id'];
        unset($_SESSION['cart'][$id]);
        exit;
    }
    // delete-card-item end




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test1</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

<p id="test"></p>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
            <h2>Shopping Cart</h2>
                <form action="">
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- tr will append here from ajax response -->
                        </tbody>
                    </table>
                    <a title="Update" onclick="updataData()" class="btn btn-sm btn-success">Update Cart</a>
                </form>
            </div>
        </div>
    </div>
    

<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
// ==== get all cart data from session start=====//
    function allData(){
        var allData = "allData";
		$.ajax({
            type: 'post',
            data: {allData: allData},
            success: function(response){
                $('tbody').html(response);
            }
            });	
        }
	allData();
// ==== get all cart data from session end=====//

//=== update-cart-item start=====//
function updataData(){
    var product_id = [];
    $('.product_id').each(function(){
        product_id.push($(this).val());
    });

    var quantity = [];
    $('.quantity').each(function(){
        quantity.push($(this).val());
    });

    $.ajax({
        type: 'post',
        data: {product_id:product_id, quantity: quantity},
        success: function(response){
            $('tbody').html(response);
            allData();
        }
    });	
	}
//==== update-cart-item end =====//


//==== delete-cart-item start =====//
    function deleteData(id){
        var id = id;
        $.ajax({
            type: "post",
            data: {id:id},
            success: function(responseData){
                allData();
            }
        });

    }
//==== delete-cart-item end =====//
</script>


</body>
</html>