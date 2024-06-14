<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #dc3545;
        }
        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            line-height: 1.6;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Paiement échoué</h1>

    <!-- Display the error message, if available -->
    @if(session('error'))
        <div class="alert">
            {{ session('error') }}
        </div>
    @endif

    <p>Il y a eu un problème lors du traitement de votre paiement. Veuillez réessayer ultérieurement ou contacter le support.</p>
    
    <!-- Provide troubleshooting tips or contact information for support -->
    <p>Si vous continuez à rencontrer des problèmes, vous pouvez <a href="mailto:support@example.com">contacter le support</a> pour obtenir de l'aide.</p>
</body>
</html>
