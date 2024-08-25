<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <title>Document</title>
</head>
<body>
<!-- App Bar @include('components.app-bar') -->
<table border = "1">
		<thead>
			<th>#</th>
			<th>Office Name</th>
			<th>Office Task</th>
			<th>New Alloted Time</th>
		</thead>
		<tbody>
        @forelse($data as $counter => $row)

            <tr>
                <td>{{ $loop->iteration}}</td> 
                <td>{{ $row->Office_name }}</td>
                <td>{{ $row->Office_task }}</td>
                <td>{{ $row->New_alloted_time }}</td>
                <td>
                    <a href="{{ route('admin.edit', ['id' => $row->create_id]) }}">edit</a></td>
            <td>
                <form action='{{route('admin.delete', $row->create_id)}}' method="POST">
                    @csrf
                    <button type="submit">delete</button>
                    </form>
                </td>
                

            </tr>
            @empty
                <tr>
                    <td colspan="5">No Users Found</td>
                </tr>
        @endforelse
        
		</tbody>
	</table>
    <a href="{{url('/dashboard')}}">Back</a>
</body>
</html>