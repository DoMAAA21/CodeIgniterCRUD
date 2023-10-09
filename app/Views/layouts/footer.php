<script src="assets/js/main.js"></script>
<!-- Include jQuery -->


<script>
    $(document).ready(function() {

        $("#usertable").DataTable({
            ajax: {
                url: "/api/users",
                dataSrc: "",
            },
            dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
            buttons: [{
                    extend: 'pdf',
                    className: 'btn btn-info glyphicon glyphicon-file'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-info glyphicon glyphicon-list-alt'
                },
                {
                    text: "Add User",
                    className: "btn btn-info",
                    action: function(e, dt, node, config) {
                        $("#userForm").trigger("reset");
                        $("#userModal").fadeIn("show");
                        $('#userSubmit').show();
                        $('#userUpdate').hide();
                        $("#userForm")[0].reset();

                        $('#labelUserUpdate').hide();
                        $('#labelUserCreate').show();

                    },
                },
            ],


            columns: [{
                    data: "id",

                },
                {
                    data: "fname",

                },
                {
                    data: "lname",

                },
                {
                    data: "email",

                },

                {
                    data: null,

                    render: function(data, type, row) {
                        return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                            data.id +
                            "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
                    },
                },


            ],
        });



        $("#userClose").on("click", function(e) {
            e.preventDefault();
            $("#userModal").fadeOut("fast");

        });
        $("#userSubmit").on("click", function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Collect form data
            var formData = {
                fname: $("#fname").val(),
                lname: $("#lname").val(),
                email: $("#email").val(),
                password: $("#password").val()
            };

            // Send the POST request
            $.ajax({
                type: "POST",
                url: "/api/user/create", // Replace with your actual API endpoint
                data: formData, // Send the form data
                dataType: "json", // Specify the expected data type of the response
                success: function(response) {
                    // Handle the successful response here
                    console.log(response);
                    $("#userModal").fadeOut("fast");
                    var $usertable = $('#usertable').DataTable();
                    $usertable.ajax.reload();

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '<h3 class="text-dark">User Added Succesfully</h3>',
                        showConfirmButton: false,
                        timer: 2000

                    })

                },
                error: function(xhr, textStatus, errorThrown) {
                    // Handle errors here
                    console.error("AJAX Error:", textStatus, errorThrown);

                    Swal.fire({
                        icon: textStatus,
                        title: `Oops... Error ${errorThrown}`,
                        text: 'Something went wrong!',

                    })
                }
            });
        });


        $("#usertable tbody").on("click", 'a.deletebtn', function(e) {



            var table = $('#usertable').DataTable();
            var id = $(this).data("id");
            var $row = $(this).closest("tr");


            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: `/api/user/${id}`,
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            $row.fadeOut(4000, function() {
                                table.row($row).remove().draw(false);
                            });
                            Swal.fire(
                                'Deleted!',
                                'Product Deleted',
                                'success'
                            )
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',

                            })

                        },
                    });




                }
            })

        });


        $("#usertable tbody").on("click", 'a.editBtn', function(e) {
            e.preventDefault();
            $("#userModal").fadeIn("slow");
            var id = $(this).data("id");
            var $save = $('#userSubmit').hide();
            $('#userUpdate').show();
            $('#labelUserUpdate').show();
            $('#labelUserCreate').hide();



            $.ajax({
                type: "GET",
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                url: `/api/user/edit/${id}`,
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#userId').val(data.id);
                    $('#fname').val(data.fname);
                    $('#lname').val(data.lname);
                    $('#email').val(data.email);



                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',

                    })
                },
            });
        });

        $("#userUpdate").on("click", function(e) {
            var id = $("#userId").val();
            e.preventDefault();
            var data = $('#userForm')[0];
            console.log(data);
            let formData = new FormData(data);
            console.log(formData);
            for (var pair of formData.entries()) {
                console.log(pair[0] + ',' + pair[1]);
            }

            var crow = $("tr td:contains(" + id + ")").closest("tr");
            var table = $('#usertable').DataTable();

            table.ajax.reload();
            console.log(data);
            console.log(crow);
            $.ajax({
                type: "POST",
                url: `/api/user/update/${id}`,
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#userModal').fadeOut("slow");

                    $('#usettable').DataTable().ajax.reload();

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '<h3 class="text-dark">Product Info Updated Succesfully</h3>',
                        showConfirmButton: false,
                        timer: 2000

                    })



                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',

                    })
                }


            })

        });


    });
</script>