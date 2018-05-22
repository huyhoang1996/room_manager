<?php include 'dashboard.php' ?>
<?php startblock('content') ?>
<div class="btn btn-success pull-right"><a href="/?web=add_user">Add User</a></div>
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
                    <td>".$row->username."</td>
                    <td><a href='/?web=update_user&id=".$row->id."'>EDIT</a></td>
                    <td><a href='/?web=delete_user&id=".$row->id."'>DELETE</a></td>
                </tr>";
            }
        ?>
    </tbody>
	</table>
<?php endblock()?>



