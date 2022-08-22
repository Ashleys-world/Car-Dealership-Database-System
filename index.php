<?php
   require_once('data.php');
  
   if(isset($_POST['model-entered'])){
   $add_car = 
   'INSERT INTO car_info(info_brand,info_model,info_year_model,info_id) 
   VALUES (:info_brand,:info_model,:info_year_model,:info_id)';
   $statement_add = $db->prepare($add_car);
   $statement_add->bindValue(':info_brand' , $car_brand) ;
   $statement_add->bindValue(':info_model' , $model) ;
   $statement_add->bindValue(':info_year_model', $model_year);
   $statement_add->bindValue(':info_id', $unique_id);
   $statement_add->execute();
   $statement_add->closeCursor();
   };

   if(isset($_POST['unique-id-deleted'])){
   $delete_car = 'DELETE FROM car_info WHERE info_id = :info_id' ;
   $statement_delete = $db->prepare($delete_car);
   $statement_delete->bindValue(':info_id', $delete_id);
   $statement_delete->execute();
   $statement_delete->closeCursor();
   };

   if(isset($_POST['unique-id-updated'])){
   $update_car = 'UPDATE car_info SET info_brand = :info_brand 
    ,info_model = :info_model ,info_year_model = :info_year_model 
    WHERE info_id = :info_id' ;
   $statement_update = $db->prepare($update_car);
   $statement_update->bindValue(':info_brand' , $updated_brand) ;
   $statement_update->bindValue(':info_model' , $updated_model) ;
   $statement_update->bindValue(':info_year_model', $updated_year);
   $statement_update->bindValue(':info_id', $updated_id);
   $statement_update->execute();
   $statement_update->closeCursor();
   }

   $query_cars = 'SELECT * FROM car_info' ;
   $cars_statement = $db->prepare($query_cars);
   $cars_statement->execute(); 
   $cars = $cars_statement->fetchAll();
   $cars_statement->closeCursor();

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Car App</title>
</head>
<body>
    <div class="lg:h-screen lg:w-screen "><!--Main container-->
        <h3 class=" mx-3 text-3xl font-bold">Car Dealership Database System</h3>
        <div class="grid grid-cols-2 gap-2"><!-- Second Container inside main-->
            <div class="mx-2"><!--Left Section-->
                <h3 class="text-2xl font-bold">List of cars :</h3>
                <h4 class="text-2xl font-bold">Brand Model Year Id</h4>
                <?php foreach($cars as $car) : ?>
                <p><?php echo $car['info_brand']." ".$car['info_model'] . " ".
                $car['info_year_model'] . " ".$car['info_id'] ;?></p>
                <?php endforeach ; ?>
                <h3 class="text-2xl font-bold">Delete car details</h3>
                <form action="index.php" method="post">
                    <label>Car Unique ID :</label>
                    <input class="border-2 border-gray-500 rounded-md my-1" type="text" name="unique-id-deleted"/><br>
                    <input class="rounded-md border-2 h-7 font-bold bg-gray-500 text-white
                    px-20" type="submit" value="Delete car"/>
                </form>
            </div>
            <div><!-- Right Section -->
                <h3 class="text-2xl font-bold">Enter car details</h3>
                <form action="index.php" method="post">
                    <label>Car Brand :</label>
                    <input class="border-2 border-gray-500 rounded-md my-1" type="text" name="brand-entered"/><br>
                    <label>Model :</label>
                    <input class="border-2 border-gray-500 rounded-md my-1" type="text" name="model-entered"/><br>
                    <label>Model Year :</label>
                    <input class="border-2 border-gray-500 rounded-md my-1" type="text" name="model-year-entered"/><br>
                    <label>Car Unique ID :</label>
                    <input class="border-2 border-gray-500 rounded-md my-1" type="text" name="unique-id-entered"/><br>
                    <input class="rounded-md border-2 h-7 font-bold bg-gray-500 text-white
                    px-20" type="submit" value="Add new car"/>
                </form>
                <h3 class="text-2xl font-bold">Car details entered are : </h3>
                <p>The Brand of the car is : <?php
                    if(isset($_POST['brand-entered']))
                        echo $car_brand ?>
                </p>
                <p>The Model of the car is : <?php 
                    if(isset($_POST['model-entered']))
                        echo $model ?></p>
                <p>The Model Year of the car is : <?php
                    if(isset($_POST['model-year-entered']))
                        echo $model_year ?></p>
                <p>The Unique ID of the car is : <?php 
                    if(isset($_POST['unique-id-entered']))
                        echo $unique_id ?></p>
                <h3 class="text-2xl font-bold">Update car details</h3>
                <form action="index.php" method="post">
                    <label>Car Brand :</label>
                    <input class="border-2 border-gray-500 rounded-md my-1" type="text" name="brand-updated"/><br>
                    <label>Model :</label>
                    <input class="border-2 border-gray-500 rounded-md my-1" type="text" name="model-updated"/><br>
                    <label>Model Year :</label>
                    <input class="border-2 border-gray-500 rounded-md my-1" type="text" name="model-year-updated"/><br>
                    <label>Car Unique ID :</label>
                    <input class="border-2 border-gray-500 rounded-md" type="text" name="unique-id-updated"/><br>
                    <input class="rounded-md border-2 h-7 my-1 font-bold bg-gray-500 text-white
                    px-20" type="submit" value="Update car"/>
                </form>    
        </div>
        </div>
        
        <?php 
        $car_brand = NULL ;
        $model = NULL ;
        $model_year = NULL ;
        $unique_id = NULL ; 
        ?>
    </div>
</body>
</html>