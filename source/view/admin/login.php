<?php include 'master.php' ?>
<?php startblock('title') ?>
    <title>Login room</title>
<?php endblock() ?>
<?php startblock('main') ?>
    <div class="wrapper">
        <div class="container">
            <div class="col-md-5">
                <h2>Manager Room</h2>
                <span id="loginError" class="text-danger"></span>
                <form name="formlogin" onkeyup="clearError()">
                    <div class="form-group">
                        <label for="email">Email:</label><span id="emailError" class="text-danger"></span>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label><span id="passwordError" class="text-danger"></span>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                    </div>
                    <button type="button" onclick="validate()" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
<?php endblock() ?>
<?php startblock('script') ?>
    <script>
        function validate(){
            var email = formlogin.email.value;
            var password = formlogin.password.value;
            var patternEmail = new RegExp("[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$");
            if (patternEmail.test(email) && password !=""){
                checkUser();
            } else {
                if (!patternEmail.test(email)) {
                    $("#emailError").html("invalid Email");
                }
                if (password =="") {
                    $("#passwordError").html("invalid Password");
                }

            }
        }
        function clearError(){
            $("#emailError").html("");
            $("#passwordError").html("");
            $("#loginError").html("");
        }
        function checkUser(){
            $.ajax({
                type: "POST",
                url: "?api=login",
                data: {
                    data:{
                        email: $('#email').val(),
                        password: $('#password').val(),
                    } 
                },
                statusCode: {
                    200: function( response ) {
                        // window.location.href = 
                    },
                    404: function(response) {
                        var message = response.responseJSON.meta.message;
                        $("#loginError").html(message);
                    },
                }
            });
        }
    </script>
<?php endblock() ?>

