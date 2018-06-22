<?php include 'dashboard.php' ?>
<?php startblock('content') ?>
<div class="btn btn-success pull-right"><a href="/?web=add_room">Add Room</a></div>
<table class="table">
    <thead>
      	<tr>
	        <th>ID</th>
	        <th>Name</th>
	        <th></th>
	        <th></th>
      	</tr>
	   </thead>
    <tbody>
        <?php
            foreach ($data as $row){
                echo "<tr>
                    <td>".$row->id."</td>
                    <td>".$row->name."</td>
                    <td><a href='/?web=update_room&id=".$row->id."'>EDIT</a></td>
                    <td><a href='/?web=delete_room&id=".$row->id."'>DELETE</a></td>
                </tr>";
            }
        ?>
    </tbody>
	</table>
<?php endblock()?>



