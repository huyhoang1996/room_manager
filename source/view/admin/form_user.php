<?php include 'dashboard.php' ?>
<?php startblock('content') ?>
<div class="container">
  	<h2>User form</h2>
	<div class="col-md-6">
		<div class="error"></div>
		<form id="formUser" onkeyup="clearError()">
	        <?php if(isset($data)) { ?>
                <div class="form-group">
                    <label for="name">Username:</label>
                    <input type="name" value="<?php echo($data->username); ?>" class="form-control" id="username" placeholder="Enter name" name="name">
                </div>
                <div class="form-group">
                    <label for="name">Email:</label>
                    <input type="name" value="<?php echo($data->email); ?>" class="form-control" id="email" placeholder="Enter name" name="name">
                </div>
                <div class="form-group">
                    <label for="name">Phone:</label>
                    <input type="number" value="<?php echo($data->phone); ?>" class="form-control" id="phone" placeholder="Enter name" name="name">
                </div>
                <div class="form-group">
                    <label for="name">Password:</label>
                    <input type="password" class="form-control" id="password1" placeholder="Enter name" name="name">
                </div>
                <div class="form-group">
                    <label for="name">Confirm Password:</label>
                    <input type="password" class="form-control" id="password2" placeholder="Enter name" name="name">
                </div>
                <div class="form-group">
                    <label for="name">Address:</label>
                    <input type="name" value="<?php echo($data->address); ?>" class="form-control" id="address" placeholder="Enter name" name="name">
                </div>
            <?php } else {?>
                <div class="form-group">
                    <label for="name">Username:</label>
                    <input type="name" class="form-control" id="username" placeholder="Enter username" name="name">
                </div>
                <div class="form-group">
                    <label for="name">Email:</label>
                    <input type="name" class="form-control" id="email" placeholder="Enter email" name="name">
                </div>
                <div class="form-group create">
                    <label for="name">Password:</label>
                    <input type="password" class="form-control" id="password1" placeholder="Enter Password" name="name">
                </div>
                <div class="form-group create">
                    <label for="name">Confirm Password:</label>
                    <input type="password" class="form-control" id="password2" placeholder="Enter Password" name="name">
                </div>
                <div class="form-group">
                    <label for="name">Phone:</label>
                    <input type="number" class="form-control" id="phone" placeholder="Enter phone" name="name">
                </div>
                <div class="form-group">
                    <label for="name">Address:</label>
                    <input type="name" class="form-control" id="address" placeholder="Enter address" name="name">
                </div>
            <?php } ?>
        
	    <button type="button" class="btn btn-default"  id="submit_user">Submit</button>
	</form>
	</div>
</div>
<?php endblock()?>
<?php startblock('script') ?>
    <script>
        $( "#formUser" ).submit(function( event ) {
            event.preventDefault();
            handleForm();
        });
        $( "#submit_user" ).click(function( event ) {
            event.preventDefault();
            handleForm();
        });
        function handleForm(){
            var name = $('#email').val();
            var password1 = $('.create #password1').val();
            var password2 = $('.create #password1').val();
            if (name !="" || password1 != '' || password2 != ''){
                if (password1 != password2 ){
                    $(".error").html("Password don't match.");
                }
                var data_is_exist = '<?php if(isset($data)){ echo($data->id); }else{echo (null);} ?>';
                if(data_is_exist){
                    updateRoom();
                }else{
                    createRoom();
                }
            } else {
                $(".error").html("Field is required");
            }
        }
        function clearError(){
            $(".error").html("");
        }
        function createRoom(){
            $.ajax({
                type: "POST",
                url: "?api=add_user",
                data: {
                    data:{
                        username: $('#username').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val(),
                        address: $('#address').val(),
                        password: $('#password1').val(),
                    } 
                },
                statusCode: {
                    200: function( response ) {
                        window.location.href = window.BaseUrl + '/?web=list_user';
                    },
                    404: function(response) {
                        var message = response.responseJSON.meta.message;
                        $("#loginError").html(message);
                    },
                }
            });
        };
        function updateRoom(){
            $.ajax({
                type: "POST",
                url: "?api=update_user",
                data: {
                    data:{
                        id: <?php if(isset($data)){ echo($data->id); }else{echo ('null');} ?>,
                        username: $('#username').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val(),
                        address: $('#address').val(),
                        password: $('#password1').val(),
                    } 
                },
                statusCode: {
                    200: function( response ) {
                        if(User.is_admin == 1) {
                            window.location.href = window.BaseUrl + '/?web=list_user';
                        } else {
                            window.location.href = window.BaseUrl + '/?web=home';
                        }
                        
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


