<html>
 <nav class="navbar navbar-inverse">
  <ul class="nav navbar-nav">
    <li><a href="login.php">Logout</a></li>
    <li><a href="index.php">Home</a></li>
  </ul>
</nav>

  <div class="container">
<?php 
	$c = oci_connect("Milanes","milanes","localhost/xe");
	if (!$c) {
			$e = oci_error();
				trigger_error('Could not Connect to Database:'. $e['message'], E_USER_ERROR);
		}	

	$s = oci_parse($c,"select * from books");
	if (!$s) {
		$e = oci_error($c);
			trigger_error('Could not parse statement:'.$e ['message'], E_USER_ERROR);
	}

	$r = oci_execute($s);
	if (!$r) {
		$e = oci_error($s);
			trigger_error('Could not execute statement:'. $e['message'], E_USER_ERROR);
	}

	echo "<table border = '1'>\n";
	$ncols = oci_num_fields($s);
	echo "<tr>\n";

	for ($i = 1; $i<=$ncols; ++$i){
		$colname = oci_field_name($s, $i);
		echo "<th><b>" .htmlentities($colname,ENT_QUOTES)."</b></th>\n";
	}

	echo "<tr>\n";
	while (($row = oci_fetch_array($s,OCI_ASSOC + OCI_RETURN_NULLS))!=FALSE) {
		echo "<tr>\n";
		foreach ($row as $item) {
			echo "<td>".($item!==null?htmlentities($item,ENT_QUOTES):"&nbsp;")."</td>\n";
		}

		echo "</tr>\n";
	}
	echo "</table>\n"
 ?>
 </div>
 <style>
 div.container {
    background-color: white;
    color: red;
    margin: 50px 0 20px 200;
    padding: 20px;
}
body {
    background-image: url("library.jpg");
}
table, td, th {
    border: 1px solid black;
}

table {
    border-collapse: collapse;
    width: 98%;
}

th {
    height: 50px;
}

 </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<body>

</body>
 </html>