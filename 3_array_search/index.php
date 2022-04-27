<?php
session_start();
$array = array("Khulna", "dhaka", "rajshahi", "cumilla", "barisal", "jessore", "magura", "b.baria", "faridpur", "sylhet", "kisoregonj", "kazipur", "kushtia");

if( $_SERVER["REQUEST_METHOD"] == "POST"){
   

    if($_POST['first_character'] != "" &&  $_POST['how_many_character'] != ""){
        $_SESSION['first_character'] = $_POST['first_character'];
        $_SESSION['how_many_character'] = $_POST['how_many_character'];

        $new_array = array();

        foreach($array as $v){
            $input_first_character = $_POST['first_character'];
            $characters_range = $_POST['how_many_character'];

            $first_character_in_array_item =  $v[0];
            $leghth_of_array_item = strlen($v);

            if($input_first_character == $first_character_in_array_item && $characters_range == $leghth_of_array_item){
                array_push($new_array, $v);
            }
        }

        $output =  join(', ', $new_array);
    }    

   elseif($_POST['first_character'] != ""){
        $_SESSION['first_character'] = $_POST['first_character'];

        $new_array = array();
        foreach($array as $v){
            $input_first_character = $_POST['first_character'];
            $first_character_in_array_item =  $v[0];
            if($input_first_character == $first_character_in_array_item){
                array_push($new_array, $v);
            }
        }

        $output =  join(', ', $new_array);
   }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12 my-4">
                <h2>Array Search</h2>
                <p>Array Elements: [Khulna, dhaka, rajshahi, cumilla, barisal, jessore, magura, b.baria, faridpur, sylhet, kisoregonj, kazipur, kushtia]</p>
                <form action="" method="post" class="col-md-4">
                    
                    <div class="form-group my-3">
                        <label for="first_character">Enter first character: </label>
                        <input type="text" class="form-control" name="first_character" id="first_character" value="<?php if(isset($_SESSION['first_character'])){ echo $_SESSION['first_character']; } ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="how_many_character">How many characters?</label>
                        <input type="text" class="form-control" name="how_many_character" id="how_many_character" value="<?php if(isset($_SESSION['how_many_character'])){ echo $_SESSION['how_many_character']; } ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-5">Submit</button>
                </form>

                <h2 class="my-4">Output is:</h2>
                <p><?php if(isset($output)){ echo $output; } ?></p>
            </div>
        </div>
    </div>
</body>
</html>