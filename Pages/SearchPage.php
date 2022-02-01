<?php include ("../header.php"); ?>
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">SEARCH</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="../index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Search</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Search Start -->
    
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Technical Specs</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
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