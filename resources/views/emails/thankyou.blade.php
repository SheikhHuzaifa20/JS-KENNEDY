<!DOCTYPE html>
<html>
<head>
    <title>Thank You</title>
</head>
<body>
    <h2>Thank You, {{ $inquiry->fname }}!</h2>
    <p>We have received your inquiry. Our team will contact you soon.</p>
    <p><strong>Your Message:</strong> {{ $inquiry->notes }}</p>
    <br>
    <p>Best Regards, <br> Website Team</p>
</body>
</html>
