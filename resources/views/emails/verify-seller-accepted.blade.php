<!DOCTYPE html>
<html>

<head>
    <title>Seller Verification Accepted! | Fishora</title>
</head>

<body>
    <h2>Hello {{ $seller->shop_name }},</h2>
    <p>We’re pleased to inform you that your seller verification request has been <strong>approved</strong>.</p>
    <p>You can now proceed to login at {{ route('seller.login') }}</p>
    <p>Thank you,<br>The Team</p>
</body>

</html>
