<?php
include 'header.php';
include 'config.php';

// getting id from link 
$sid = $_GET['id'];

// fetch student data query 
$query1 = "SELECT * FROM `students` WHERE sid = '{$sid}' ";
$result1 = mysqli_query($conn, $query1);


// fetch class data query 
$class = "SELECT * FROM `class`";
$classResult = mysqli_query($conn, $class);
  
// update query 

if(isset($_POST['update'])){

    $id = $_POST['hidden'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $class = $_POST['class'];
    $phone = $_POST['phone'];


    $updateQuery = "UPDATE `students` SET sname = '{$name}', saddress = '{$address}', sclass = '{$class}', sphone = '{$phone}' WHERE sid = '{$id}' ";

    $updateResult =  mysqli_query($conn, $updateQuery);

    header("Location: index.php");
    mysqli_close($conn);
    
}
?>



<div class="container bg-body-tertiary py-3">
    <h2>Update Records</h2>
    <form action="" method="post" class="d-flex justify-content-center flex-column align-items-center">
        <?php
        if (mysqli_num_rows($result1) > 0) {
            while ($row1 = mysqli_fetch_assoc($result1)) {
                


        ?>
                <input type="hidden" class="form-control" name="hidden" value='<?php echo $row1['sid'] ?>'>
                <div class="form-floating mb-3 w-50">
                    <input type="text" class="form-control" name="name" id="floatingInput" placeholder="Your full name" autocomplete="off" value='<?php echo $row1['sname'] ?>'>
                    <label for="floatingInput">Name</label>
                </div>
                <div class="form-floating mb-3 w-50">
                    <input type="text" class="form-control" name="address" id="floatingPassword" placeholder="Your complete address" autocomplete="off" value='<?php echo $row1['saddress'] ?>'>
                    <label for="floatingPassword">Address</label>
                </div>
                <select class="form-select mb-3 w-50" name="class" aria-label="Default select example" required>
                    <option  disabled>Class</option>
                    <?php
                    while ($classRow = mysqli_fetch_assoc($classResult)) {
                        
                        if($row1['sclass'] == $classRow['cid']){
                            // $select = "selected";
                            
                            echo "<option selected value='{$classRow['cid']}'> {$classRow['cname']}</option>";
                        }else{
                            
                            // $select = "";
                            echo "<option value='{$classRow['cid']}'> {$classRow['cname']}</option>";
                        }

                        
                        //    print_r($classRow);
                    } ?>
                </select>


               
                
                <div class="form-floating mb-3 w-50">
                    <input type="tel" class="form-control" name="phone" id="floatingPhone" placeholder="Your phone number" autocomplete="off" value='<?php echo $row1['sphone'] ?>'>
                    <label for="floatingPhone">Phone</label>
                </div>

        <?php
            }
        }
        ?>

        <input type="submit" value="Update" name='update' class="btn btn-dark">
    </form>
</div>


</div>
</body>

</html>