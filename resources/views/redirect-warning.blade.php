<!DOCTYPE html>
<html>
<head>
    <title>External Link Warning</title>
</head>
<body>
    <h2>You are leaving our website</h2>
    <p>You are about to visit: <strong>{{ $url }}</strong></p>
    <p>Please make sure this is a trusted site.</p>

    <a href="{{ $url }}" target="_blank" rel="noopener noreferrer">Continue</a> |
    <a href="{{ url('/') }}">Cancel</a>
</body>
</html>
