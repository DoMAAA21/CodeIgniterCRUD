<div class="container-fluid" style="margin-top: 70px;">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<h4 class="card-title">Users</h4>

<table id="usertable" class="table table-hover " style="width:100%;">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Action </th>
        </tr>
    </thead>
    <tbody id="userbody">
    </tbody>
</table>
</main>
</div>

<div class="modal" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
        <div class="modal-content">
            <div class="modal-header text-center">

                <h3 class="modal-title" id="labelUserCreate">ADD USER</h3>
                <h3 class="modal-title" id="labelUserUpdate">UPDATE USER</h4>
            </div>


            <?= csrf_field() ?>
            <form id="userForm" action="#" method="#" enctype="multipart/form-data">

            
                <div class="card pmd-card bg-info text-light">

                    <div class="card-body">
                        <!-- Regulat Input With Floating Label -->



                        <input type="hidden" class="form-control" id="userId" name="userId">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="inverse_regularfloating">First Name</label>
                            <input id="fname" class="form-control" type="text" name="fname" class="form-control @error('name') is-invalid @enderror"
                             value="" required autocomplete="fname" autofocus>

                        </div>

                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="inverse_regularfloating">Last Name</label>
                            <input id="lname" class="form-control" type="text" name="lname" class="form-control @error('desc') is-invalid @enderror"
                             value="" required autocomplete="desc" autofocus>

                        </div>

                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="inverse_regularfloating">Email </label>
                            <input id="email" class="form-control" type="text" name="email" class="form-control @error('main_office') is-invalid @enderror" 
                            value="" required autocomplete="email" autofocus>


                        </div>

                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="inverse_regularfloating"> Password</label>
                            <input id="password" class="form-control" type="password" name="password" class="form-control @error('founder') is-invalid @enderror" 
                             required autocomplete="password" autofocus>

                        </div>

                      




                            <button id="userSubmit" type="submit" class="btn btn-secondary">Save</button>
                            <button id="userUpdate" type="submit" class="btn btn-secondary">Update</button>
                            <button id="userClose" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>




                        </div>
            </form>
        </div>
    </div>
</div>
