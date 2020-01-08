<?php 
	include "api/connect.php";

	
	$id = $conn->real_escape_string($_POST['id']);

	$sql="DELETE FROM users WHERE id='$id';";
	$conn->query($sql);
	
	$sql1="SELECT *
	FROM users";
		
	if($q=$conn->query($sql1)) {
		?>
		<table class="table">
			<thead>
				<tr>
                    <th>ID</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Mail</th>
                    <th>Kontakt</th>
                    <th>Izbriši</th>
				</tr>
				</thead>
				<tbody>
					<?php while($line=$q->fetch_object()){  ?>
					<tr>
                    <td><?php echo $line->id; ?></td>
                        <td><?php echo $line->name; ?></td>
                        <td><?php echo $line->surname; ?></td>
                        <td><?php echo $line->mail; ?></td>
                        <td><?php echo $line->phone; ?></td>
                        <td><button onclick="del(<?php echo $line->id; ?>)">izbriši</button></td>
					</tr>
					<?php } ?>
				</tbody>

			</table>

		<?php
	} else {
		
		echo '<div class="alert alert-danger">Došlo je do greške sa bazom!</div>';
	}
	

 ?>