<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>reporte-inventario</title>
	<style>
		*{
			padding: 0;
			margin: 0;
		}

		body {
			margin: 25px 10px;
			font-family: Arial, Helvetica, sans-serif;
		}

		table tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		table{
			border-collapse: collapse;
			border: 1px solid #000000;
			width: 100%;
			text-align: center;
			table-layout: fixed;
		}
		table th{
			padding: 6px 0;
			font-weight: bold;
		}
		table td {
			font-weight: normal;
		}

		table td, table th{
			padding: 2px 8px;
			width: 12.5%;
			word-wrap: break-word;
		}
	</style>
</head>
<body style="font-size: 13px;text-align: center;">
	<h1 style="margin-bottom: 2rem;text-decoration: underline;">Reporte de inventario {{ date('Y-m-d H:i') }}</h1>
	<div>
		<table>
			<thead>
				<tr style="background-color: #2d4154;color: #f2f2f2;">
					<th>ID</th>
					<th>MAC</th>
					<th>Marca</th>
					<th>Tipo</th>
					<th>IP</th>
					<th>Oficina</th>
					<th>Encargado</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($data as $item)
					<tr>
						<td>{{ $item->id }}</td>
						<td>{{ $item->mac }}</td>
						<td>{{ $item->brand }}</td>
						<td>{{ $item->type }}</td>
						<td>{{ $item->network->ip }}</td>
						<td>{{ $item->office->name }}</td>
						<td>{{ $item->staff->fullname }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>