<?php
  session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
			
		<title>Tabelle</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</head>

	<body>
		<div class = "container">
		<h2>Kundenübersicht</h2>
			<?php
				$host = 'localhost';
				$database = 'medt3';
				//user = 'htluser';
				//pwd = '1234';
				$user = $_SESSION['user'];
				$pwd = $_SESSION['pw'];

				/*if (isset($_SESSION['user'])) {
				   echo "Herzlich Willkommen ".$_SESSION['user'];
				} else {
				   echo "Bitte erst einloggen!";
				}*/

				try
				{
					$pdo = new PDO ("mysql:host=$host;dbname=$database", $user, $pwd);
				}catch(PDOException $e){
					header("Location: http://127.0.0.1/medt/bsp4/login.php"); 
					//exit("<h3 class=\"bg-danger\">Nicht verfügbar!</h3>");
				}

				$sql = $pdo->query ("SELECT * FROM project");
				$temp = $sql->fetchAll(PDO::FETCH_ASSOC);
			?>

			<table class="table table-hover table-bordered">
				<thead>
				  <tr>
				  	<th>Name</th>
			        <th>Beschreibung</th>
			        <th>Datum</th>
			        <th>Operatoren</th>
				  </tr>
				</thead>

				<tbody>
				<?php
					foreach ($temp as $row) 
					{
						?>
							<tr>
								<td><?php echo $row['name'];?></td>
					            <td><?php echo $row['description'];?></td>
					            <td><?php echo $row['createDate'];?></td>
								<td>
				                	<span style="color: black;" class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				                    <span style="color: black;" class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				                </td>
							</tr>
						<?php
					}
				?>
				</tbody>
			</table>

			<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
				<button type="submit" class="btn btn-default btn-lg active" name="logoutBTN">Abmelden</button>
			</form>
			<?php
			if (isset($_POST['logoutBTN']))
      		{
				session_destroy();
				echo "Logout erfolgreich!";
			}
			?>
		</div>
	</body>
</html>