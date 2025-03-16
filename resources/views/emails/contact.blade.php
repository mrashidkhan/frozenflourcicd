<!DOCTYPE html>
<html>
<head>
    <title>Frozen Flour Contact Form Submission</title>
</head>
<body>
    <h1>Frozen Flour Contact Form Submission</h1>
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $data['message'] }}</p>
</body>
</html>
