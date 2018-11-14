<!--
<
    ?php 
	include 'header.php'; 
?>-->
<div>
    <?php
    if(isset($_POST['submit-search'])){
        $search=mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT * FROM products WHERE name LIKE '%$search%' OR writer LIKE '%$search%'";
        $sql1 = "SELECT * FROM manga WHERE name LIKE '%$search%'";
        
        $resultbook = mysqli_query($conn, $sql);
        $resultmanga = mysqli_query($conn, $sql1);
        
        $queryResultbook = mysqli_num_rows($resultbook);
        $queryResultmanga = mysqli_num_rows($resultmanga);
        if($queryResultbook > 0){
            while($row = mysqli_fetch_assoc($resultbook)){
                echo    "<div class='rest'>
                        <div>".$row['name']."</div>
                        <div>".$row['writer']."</div>
                        <div>".$row['price']."</div>
                        <div>".$row['info']."</div>
                        </div>";
                        
            }
        }
        if ($queryResultmanga > 0){
                while($rowmanga = mysqli_fetch_assoc($resultmanga)){
                    echo    "<div class='rest'>
                    <div>".$rowmanga['name']."</div>
                    <div>".$rowmanga['price']."</div>
                    </div>";
                }
        }
        if($queryResultbook == 0 && $queryResultmanga == 0){
            echo "There are no result matching your search!";
        }
    }
    ?>
</div>