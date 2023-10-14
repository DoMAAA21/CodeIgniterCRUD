<div class="container-fluid" style="margin-top: 70px;">
    <main class="px-md-4">
        <h4 class="card-title">Products</h4>

        <table id="producttable" class="table table-hover " style="width:100%;">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Cost Price</th>
                    <th>Sell Price</th>
                    <th>Image</th>
                    <th>Action </th>
                </tr>
            </thead>
            <tbody id="productbody">
            </tbody>
        </table>
    </main>
</div>

<div class="modal" id="productModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
        <div class="modal-content">
            <div class="modal-header text-center">

                <h3 class="modal-title" id="labelProductCreate">ADD PRODUCT</h3>
                <h3 class="modal-title" id="labelProductUpdate">UPDATE PRODUCT</h4>
            </div>


            <?= csrf_field() ?>
            <form id="productForm" action="#" method="#" enctype="multipart/form-data">


                <div class="card pmd-card bg-info text-light">

                    <div class="card-body">
                        <!-- Regulat Input With Floating Label -->



                        <input type="hidden" class="form-control" id="productId" name="productId">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="inverse_regularfloating">Name</label>
                            <input id="name" class="form-control" type="text" name="name" class="form-control" value="" required autocomplete="fname" autofocus>

                        </div>

                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="inverse_regularfloating">Description</label>
                            <input id="desc" class="form-control" type="text" name="desc" class="form-control" value="" required autocomplete="desc" autofocus>

                        </div>

                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="inverse_regularfloating">Cost Price </label>
                            <input id="costPrice" class="form-control" type="number" name="costPrice" class="form-control" value="" required autocomplete="costPrice" autofocus>
                        </div>

                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="inverse_regularfloating">Sell Price </label>
                            <input id="sellPrice" class="form-control" type="number" name="sellPrice" class="form-control" value="" required autocomplete="costPrice" autofocus>
                        </div>


                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="inverse_regularfloating">Image</label>
                            <input id="inverse_regularfloating" class="form-control" type="file" name="upload" class="form-control" required autocomplete="image" autofocus>

                        </div>






                        <button id="productSubmit" type="submit" class="btn btn-secondary">Save</button>
                        <button id="productUpdate" type="submit" class="btn btn-secondary">Update</button>
                        <button id="productClose" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>




                    </div>
            </form>
        </div>
    </div>
</div>