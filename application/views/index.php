<html>

<head>
    <title>CURD REST API in Codeigniter</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        input,
        #add_button {
            margin: 0 8px;
        }

        .error,
        .error-valid,
        .error-user-already,
        .success-insert,
        .success-update,
        .success-delete,
        #cancel_btn {
            display: none;
        }

        #gender {
            display: inline;
            width: 110px;
            height: 32px;
        }
    </style>
</head>

<body>
    <div class="container">
        <br />
        <h3 align="center">CRUD REST API in Codeigniter</h3>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="form_add">
                    <div class="alert alert-danger error" role="alert">
                        All fields are required!
                    </div>
                    <div class="alert alert-danger error-valid" role="alert">
                        Values are invalid!
                    </div>
                    <div class="alert alert-success success-insert" role="alert">
                        Data inserted successfully!
                    </div>
                    <div class="alert alert-success success-update" role="alert">
                        Data updated successfully!
                    </div>
                    <div class="alert alert-success success-delete" role="alert">
                        Data deleted successfully!
                    </div>
                    <div class="alert alert-success error-user-already" role="alert">
                        User already exists!
                    </div>
                    <form>
                        <input type="text" id='name' placeholder="Enter Name">
                        <input type="text" id='age' placeholder="Enter Age">
                        <select name="gender" id="gender" class="form-control">
                            <option value="" selected disabled hidden>Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <input type="hidden" name="id" id='id' />
                        <button type="submit" id="add_button" class="btn btn-info ">Add</button>
                        <button id="cancel_btn" class="btn btn-danger ">Cancel</button>
                    </form>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        fetch_data();
        $("#name").focus();

        //retrieve all data
        function fetch_data() {
            $.ajax({
                url: "<?php echo base_url('api'); ?>",
                method: "GET",
                dataType: 'json',
                contentType: 'application/json',
                success: function(response, textStatus) {
                    $data = JSON.parse(JSON.stringify(response)); //data is a JavaScript object
                    $('tbody').html($data);
                },
                error: function(request, error) {
                    console.log(arguments)
                    console.log("Can't do because: " + error);
                }
            });
        }

        //insertion of data
        $(document).on('click', '#add_button', function(e) {
            e.preventDefault();
            $('.alert').hide();
            //if fields are empty
            if ($('#name').val() == '' || $('#gender').val() == '' || $('#age').val() == '') {
                $('.error').show()
            } else { //if fields are not valid
                if (($('#gender').val() != 'male' && $('#gender').val() != 'female') ||
                    (isNaN($('#age').val())) || (!isNaN($('#name').val()))) {
                    $('.error-valid').show()
                } else { //success
                    var name = $('#name').val();
                    var age = $('#age').val();
                    var gender = $('#gender').val();

                    $.ajax({
                        url: "<?php echo base_url(); ?>api/",
                        method: "POST",
                        data: {
                            name: name,
                            age: age,
                            gender: gender
                        },
                        success: function(data) {
                            $("#name").focus();
                            $('.success-insert').show()
                            fetch_data();
                        },
                        error: function(request, error) {
                            console.log(arguments)
                            console.log("Can't do because: " + error);
                            $('.error-user-already').show();
                            fetch_data();
                        }
                    })
                    $("form")[0].reset()
                    $('#add_button').text('Add');
                }
            }
            
        })

        //edit (single fetch data) single data
        $(document).on('click', '.edit', function() {
            $('.alert').hide();
            var id = $(this).attr('data-id');
            $('#add_button').text('Update');
            $('#add_button').attr('id', 'update');
            $('#cancel_btn').show();

            $.ajax({
                url: "<?php echo base_url(); ?>api/" + id,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $data = JSON.parse(JSON.stringify(data));
                    $('#id').val(id);
                    $('#name').val($data[0].name);
                    $('#age').val($data[0].age);
                    $('#gender').val($data[0].gender);
                },
                error: function(request, error) {
                    console.log(arguments)
                    console.log("Can't do because: " + error);
                }
            })
        });

        //updation of edited data
        $(document).on('click', '#update', function(e) {
            e.preventDefault();
            $('.alert').hide();
            $('#cancel_btn').hide();
            //if fields are empty
            if ($('#name').val() == '' || $('#gender').val() == '' || $('#age').val() == '') {
                $('.error').show()
            } else { //if fields are not valid
                if (($('#gender').val() != 'male' && $('#gender').val() != 'female') ||
                    (isNaN($('#age').val())) || (!isNaN($('#name').val()))) {
                    $('.error-valid').show()
                } else { //success
                    var name = $('#name').val();
                    var age = $('#age').val();
                    var gender = $('#gender').val();
                    var id = $('#id').val();
                    var jsonData = {
                        name: name,
                        age: age,
                        gender: gender
                    };
                    var jsonData = JSON.stringify(jsonData);

                    $.ajax({
                        url: "<?php echo base_url(); ?>api/" + id,
                        method: "PUT",
                        data: {
                            jsonData
                        },
                        success: function(data) {
                            $("#name").focus();
                            $('.success-update').show();
                            fetch_data();
                        },
                        error: function(request, error) {
                            console.log(arguments)
                            console.log("Can't do because: " + error);
                            fetch_data();
                        }
                    })
                    $("form")[0].reset()
                    $('#update').text('Add');
                    $('#update').attr('id', 'add_button');
                }
            }
        })

        $(document).on('click', '#cancel_btn', function(e) {
            e.preventDefault();
            $('.alert').hide();
            $('form')[0].reset();
            $('#cancel_btn').hide();
            $('#update').text('Add');
            $('#update').attr('id', 'add_button');
        })

        //delete data
        $(document).on('click', '.delete', function() {
            $('.alert').hide();

            if (confirm("Do you want to delete!")) {
            $('.success-delete').show();
            var id = $(this).attr('data-id');

            $.ajax({
                url: "<?php echo base_url(); ?>api/" + id,
                method: "DELETE",
                success: function(data) {
                    fetch_data();
                },
                error: function(request, error) {
                    console.log(arguments)
                    console.log("Can't do because: " + error);
                    fetch_data();
                }
            })
        }
        });
    })
</script>