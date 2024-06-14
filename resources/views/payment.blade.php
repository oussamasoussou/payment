<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        #card-element {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        #card-errors {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h2>Formulaire de Paiement</h2>
    <form action="{{ route('process.payment') }}" method="POST" id="payment-form">
        @csrf

        <div class="form-group">
            <label for="card-element">Carte de crédit ou de débit :</label>
            <div id="card-element">
                <!-- L'élément où les informations de carte seront affichées -->
            </div>
            <!-- Div pour afficher les erreurs de validation de la carte -->
            <div id="card-errors" role="alert"></div>
        </div>

        <input type="hidden" name="stripeToken" id="stripeToken">

        <button type="submit">Payer</button>
    </form>

    <!-- Inclure Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Initialiser Stripe avec votre clé publique
        var stripe = Stripe('{{ config('services.stripe.key') }}');

        // Créer un élément de carte Stripe
        var elements = stripe.elements();
        var cardElement = elements.create('card');

        // Monter l'élément de carte sur l'élément HTML
        cardElement.mount('#card-element');

        // Gérer la soumission du formulaire
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Créer un token de carte lors de la soumission du formulaire
            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    // Gérer les erreurs de validation de la carte
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Ajouter le token de carte dans un champ caché dans le formulaire
                    var tokenInput = document.getElementById('stripeToken');
                    tokenInput.value = result.token.id;

                    // Soumettre le formulaire pour le traitement côté serveur
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
