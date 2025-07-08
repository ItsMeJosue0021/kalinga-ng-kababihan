<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; padding: 20px; }
        .container { background: #ffffff; padding: 25px; border-radius: 6px; max-width: 600px; margin: auto; box-shadow: 0 0 5px rgba(0,0,0,0.05); }
        h2 { color: #2196F3; }
        p { font-size: 16px; color: #444; line-height: 1.5; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Donation Instructions</h2>
        <p>Dear {{ $donation->name ?? 'Donor' }},</p>
        <p>Thank you for pledging to donate <strong>₱{{ number_format($donation->amount, 2) }}</strong> in cash.</p>
        <p>Please proceed to <strong>{{ $donation->address ?? 'our office' }}</strong> to hand in your donation. We deeply appreciate your generosity.</p>
    </div>
</body>
</html>
