<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #28a745;
        }
        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
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
    <h1>Paiement Réussi</h1>
    
    <!-- Afficher le message de réussite, s'il est disponible -->
    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <p>Votre paiement a été traité avec succès. Merci!</p>
    
    <!-- Vous pouvez personnaliser davantage cette vue avec des informations supplémentaires ou un message de remerciement. -->
</body>
</html>
