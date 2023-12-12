<?php
include '../db.inc.php';
include "adminHead.php";
$result = $conn->query("SELECT * FROM `user`;");

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
	<title>dashboard</title>
</head>

<body class="bg-gray-100 text-gray-900 tracking-wider leading-normal">
	<div class="container w-full md:w-4/5 xl:w-3/5  mx-auto px-2">

		<!--Title-->
		<h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
			ALL USERS
		</h1>


		<!--Card-->
		<div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">


			<table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
				<thead>
					<tr>
						<th data-priority="1">ID</th>
						<th data-priority="2">USERNAME</th>
						<th data-priority="3">EMAIL</th>
						<th data-priority="4">PHONE</th>
					</tr>
				</thead>
				<tbody>

					<?php while ($col = $result->fetch_assoc()) : ?>
						<tr>
							<td><?php echo $col["id_user"]; ?></td>
							<td><?php echo $col["user_name"]; ?></td>
							<td><?php echo $col["user_email"]; ?></td>
							<td><?php echo $col["user_phone"]; ?></td>
						</tr>
					<?php endwhile; ?>

				</tbody>

			</table>


		</div>


	</div>
</body>
<script>
	$(document).ready(function() {

		var table = $('#example').DataTable({
				responsive: true
			})
			.columns.adjust()
			.responsive.recalc();
	});
</script>


<style>
	.dataTables_wrapper select,
	.dataTables_wrapper .dataTables_filter input {
		color: #4a5568;
		padding-left: 1rem;
		padding-right: 1rem;
		padding-top: .5rem;
		padding-bottom: .5rem;
		line-height: 1.25;
		border-width: 2px;
		border-radius: .25rem;
		border-color: #edf2f7;
		background-color: #edf2f7;
	}

	table.dataTable.hover tbody tr:hover,
	table.dataTable.display tbody tr:hover {
		background-color: #ebf4ff;
	}

	.dataTables_wrapper .dataTables_paginate .paginate_button {
		font-weight: 700;
		border-radius: .25rem;
		border: 1px solid transparent;
	}

	.dataTables_wrapper .dataTables_paginate .paginate_button.current {
		color: #fff !important;
		box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
		font-weight: 700;
		border-radius: .25rem;
		background: #667eea !important;
		border: 1px solid transparent;
	}

	.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
		color: #fff !important;
		box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
		font-weight: 700;
		border-radius: .25rem;
		background: #667eea !important;
		border: 1px solid transparent;
	}

	table.dataTable.no-footer {
		border-bottom: 1px solid #e2e8f0;
		margin-top: 0.75em;
		margin-bottom: 0.75em;
	}

	table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
	table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
		background-color: #667eea !important;
		/*bg-indigo-500*/
	}
</style>

</html>