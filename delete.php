<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <input type="text" name="City">
<input type="submit" value="Delete Account" name="submit2">
</body>
</html>
<?php
    include("Conn.php");

    if(isset($_POST['submit2']))
    {
        $City = $_POST['City'];

        $sql="delete from register where City='Botad";
        $query=mysqli_query($conn,$sql);
 
        if($query)
        {
            echo "Delete Data ";
        }
        else
        {
            echo "Not Delete Data ";
        }
}
?>
