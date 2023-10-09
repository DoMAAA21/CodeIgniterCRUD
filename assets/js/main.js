$(document).ready(function () {
alert('hatdog')
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
            text: "Add Product",
            className: "btn btn-info",
            action: function (e, dt, node, config) {
                $("#prodform").trigger("reset");
                $("#prodModal").fadeIn("show");
                $('#prodSubmit').show();
                $('#produpdate').hide();
                $("#prodform")[0].reset();

                $('#leupdate').hide();
                $('#lecreate').show();

            },
        },
        ],


        columns: [{
            data: "id",
          
        },
        {
            data: "name",
           
        },
        {
            data: "desc",
           
        },
        {
            data: "cost_price",
            
        },
        {
            data: "sell_price",
           
        },
        {
            data: null,
            class: "preview-img-lg",
            render: function (data, type, JsonResultRow, row) {
                return '<img src="/storage/' + JsonResultRow.img_path + '" height="100%" width="100%">';
            }
        },
        {
            data: null,
           
            render: function (data, type, row) {
                return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                    data.id +
                    "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
            },
        },


        ],
    });

});