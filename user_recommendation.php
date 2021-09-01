<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</head>

<div class="container">
<h2><div class="well text-center">Recommendation For User</div></h2>

</div>

<?php 

include("db.php");
include("recommend.php");

$products=mysqli_query($con,"select * from products");
$matrix=array();

while($product=mysqli_fetch_array($products))
{
    $users=mysqli_query($con,"select username from users where id=$product[user_id]");
    $username=mysqli_fetch_array($users);
    $matrix [$username['username']][$product['product_name']]=$product['product_purchase'];
}
$users=mysqli_query($con,"select username from users where id=$_GET[id]");
    $username=mysqli_fetch_array($users);




?>


<div class="container">
<div class="panel panel-default">
<div class="panel-heading">
        <h2>
        <a class="btn btn-success" href="add_users.php">Add User</a>
        <a class="btn btn-info pull-right" href="index.php"> Back</a>
        </h2>
    </div>

<div class="panel-body">
    <table class="table table-striped">
    <th>Product Name</th>
    <th>Products Purchash Quantity</th>
    

    <?php 
    $recommendation=array();
    $recommendation=getRecommendation($matrix,$username['username']);
    foreach($recommendation as $product=>$rating)
    {
    ?>
    <tr>
    <td><?php echo $product; ?></td>
    <td><?php echo $rating; ?></td>
    </tr>
    <?php } ?>
    
    </table>
</div>
</div>


</div>