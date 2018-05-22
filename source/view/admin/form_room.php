<?php include 'dashboard.php' ?>
<?php startblock('content') ?>
<div class="container">
  	<h2>Vertical (basic) form</h2>
	<div class="col-md-6">
		<div class="error"></div>
		<form id="formRoom" onkeyup="clearError()">
	    <div class="form-group">
	      <label for="name">Name:</label>
	        <?php if(isset($data)) { ?>
                <input type="name" value="<?php echo($data->name); ?>" class="form-control" id="name" placeholder="Enter name" name="name">
            <?php } else {?>
                <input type="name" class="form-control" id="name" placeholder="Enter name" name="name">
            <?php } ?>
        </div>
	    <button type="button" class="btn btn-default"  id="submit">Submit</button>
	</form>
	</div>
</div>
<?php endblock()?>
<?php startblock('script') ?>
    <script>
        $( "#formRoom" ).submit(function( event ) {
            event.preventDefault();
            handleForm();
        });
        $( "#submit" ).click(function( event ) {
            event.preventDefault();
            handleForm();
        });
        function handleForm(){
            var name = $('#name').val();
            if (name !=""){
                var data_is_exist = '<?php echo($data->name); ?>';
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
                url: "?api=add_room",
                data: {
                    data:{
                        name: $('#name').val(),
                    } 
                },
                statusCode: {
                    200: function( response ) {
                        window.location.href = window.BaseUrl + '/?web=list_data';
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
                url: "?api=update_room",
                data: {
                    data:{
                        id: <?php if(isset($data)){ echo($data->id); }else{echo ('null');} ?>,
                        name: $('#name').val(),
                    } 
                },
                statusCode: {
                    200: function( response ) {
                        window.location.href = window.BaseUrl + '/?web=list_data';
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


