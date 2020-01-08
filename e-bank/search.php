<?php 
	include "api/connect.php";

	$name = $conn->real_escape_string($_POST['name']);

	if (empty($name)) {
		$sql = "select accounts.*, users.*, currency.cur FROM users 
			JOIN accounts ON accounts.id = users.account_id 
			JOIN currency ON currency.id = accounts.currency_id";
	} else {
		$sql = "select accounts.*, users.*, currency.cur FROM users 
			JOIN accounts ON accounts.id = users.account_id 
			JOIN currency ON currency.id = accounts.currency_id 
			WHERE users.name LIKE '%$name%'";
	}
	
	if($q=$conn->query($sql)) {
		?>
		<table class="table">
			<thead>
				<tr>
				<th>ID</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Mail</th>
                    <th>Broj Računa</th>
                    <th>Valuta kor.</th>
                    <th>Iznos</th>
                    <th>Prebaci novac</th>
                           
				</tr>
			</thead>
			<tbody>
				<?php while($line=$q->fetch_object()){  ?>
				<tr>
					<td><?php echo $line->account_id; ?></td>
                    <td><?php echo $line->name; ?></td>
                    <td><?php echo $line->surname; ?></td>
                    <td><?php echo $line->mail; ?></td>
                    <td><?php echo $line->number; ?></td>
                    <td><?php echo $line->cur; ?></td>
                    <td><input type="text" name="amount" id="amount<?php echo $line->account_id; ?>" size="4"></td>
                    <td><button onclick="transfer(<?php echo $line->account_id; ?>)">Pošalji</button></td>
				</tr>
				<?php  } ?>
			</tbody>

		</table>

		<?php
	} else {
		echo '<div class="alert alert-danger">Doslo je do greske sa bazom!</div>';
	}
	

 ?>