<!DOCTYPE html>
<html>
<body>

<h2>Project Status Update</h2>

<p>Hello,</p>

<p>Your project <strong>{{ $project->title }}</strong> has been 
<strong>{{ ucfirst($status) }}</strong>.</p>

@if($status === 'rejected')
    <p><strong>Reason:</strong> {{ $reason }}</p>
@endif

<p>Date: {{ now() }}</p>

<p>Thank you.</p>

</body>
</html>