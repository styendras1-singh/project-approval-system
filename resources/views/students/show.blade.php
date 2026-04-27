<h2>Student Details</h2>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td>{{ $student->id }}</td>
    </tr>
    <tr>
        <th>Name</th>
        <td>{{ $student->name }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $student->email }}</td>
    </tr>
    <tr>
        <th>Phone</th>
        <td>{{ $student->phone }}</td>
    </tr>
    <tr>
        <th>Date of Birth</th>
        <td>{{ $student->dob }}</td>
    </tr>
    <tr>
        <th>Address</th>
        <td>{{ $student->address }}</td>
    </tr>
</table>

<a href="{{ route('students.index') }}" class="btn btn-primary">Back</a>