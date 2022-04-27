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
        <h2 class="my-4">Operation: Summation of <?php echo $_SESSION['field_number']; ?> Numbers</h2>
        <form action="" method="post" class="col-md-4">

        <?php for($i = 0; $i < $_SESSION['field_number']; $i++){ ?>

            <input type="number" class="form-control my-4" name="number[]" required>

        <?php }?>

            <button type="submit" class="btn btn-sm btn-success mt-4">Submit</button>

        </form>
    </div>
</body>
</html>