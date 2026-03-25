<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status - Professional Tutoring</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .status-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }
        h1 {
            margin-top: 0;
            font-size: 2.5rem;
            color: {{ $status == 'Success' ? '#28a745' : '#dc3545' }};
        }
        p {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 25px;
            background-color: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background 0.3s;
        }
        .btn:hover {
            background-color: #4338ca;
        }
        .icon {
            font-size: 50px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="status-card">
        <div class="icon">
            {{ $status == 'Success' ? '✅' : '❌' }}
        </div>
        <h1>{{ $status }}</h1>
        <p>{{ $message }}</p>
        
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        
        <a href="{{ route('dashboard') }}" class="btn">Return to Dashboard</a>
    </div>

</body>
</html>