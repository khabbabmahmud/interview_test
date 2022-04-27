<?php
session_start();

    if( isset($_POST['number']) && $_POST['number'] != ''){
        for($i = 0; $i < $_SESSION['field_number']; $i ++ ){
            $_SESSION['number'] = $_POST['number'];
        }
        header("Location: index2.php");

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Output</h2>

        <p>Summation of <?php if(isset($_SESSION['number'])){
            echo join(', ', $_SESSION['number']);
            }?> are : <?php echo array_sum($_SESSION['number']); ?></p>

    </div>
</body>
</html>