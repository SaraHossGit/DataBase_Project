<?php include ("../header.php"); ?>

    <!-- Search Start -->
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ProdName</th>
                            <th>ProdImage</th>
                            <th>ProdTechSpecs</th>
                            <th>ProdPrice</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $searchData=getSearchData();
                            if(mysqli_num_rows($searchData) > 0)
                            {
                                foreach($searchData as $items)
                                {

                                    ?>
                                    <tr>
                                        <td> <a href="detail.php? id=<?php echo $items['ProdID'] ?>" class= "nav-link" > <?= $items['ProdName']; ?> </a> </td>
                                        <td class="align-middle"> <img src="<?php echo $items['ProdImageLink']?>" alt="" style="width: 200px;"> </td>
                                        <td><?= $items['ProdTechnicalSpecs']; ?></td>
                                        <td> $ <?= $items['ProdPrice']; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                    <tr>
                                        <td colspan="4">No Items Found</td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <!-- Search End -->
    
<?php include ("../footer.php"); ?>