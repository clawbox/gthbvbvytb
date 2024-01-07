<?php
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$input=file_get_contents("php://input");
$data = json_decode($input);
$updates = json_decode(file_get_contents('php://input'), true);
$chat_id = $data->message->chat->id;
$text = $data ->message->text;
$user_name = $data ->message ->chat->first_name;
$site_name = "Tnplayer";
$domain = "tnplayer.com";

$apiToken = '6178091920:AAHf3uxS7gyEvWoqztqSbS93CeNUu1mdb0A';
$botUsername = '@tnplayerbot';

$token = $apiToken;
if($text == "/start") {

$sendmassage = urlencode("Hello I'm $site_name Uploader Bot, I can upload Any Video File to my Server and give back link than you can share it and start your earning...\n\n1. Go To 👉 https://$domain/user/dashbord/index.php\n2. Than Copy API Key\n3. Than Type /api than give a single space and than paste your API Key (see example to understand more...).\n\n(See Example.👇)\nExample:\n/api 04e8ee10b5f123456a640c8f33195abc\n");


} else {
    
$regex_pattern = "/^\/api\s+([a-zA-Z0-9]+)$/"; // regex pattern to match the URL path and extract the alphanumeric string

if (preg_match($regex_pattern, $text, $matches)) {
    $api_key = $matches[1]; // extract the API key from the matched regex pattern
   

    $chack_sql = "SELECT * FROM bot WHERE chat_id = '$chat_id'";
    $chack_query = mysqli_query($con,$chack_sql);
    $num_rows = mysqli_num_rows($chack_query);
    if($num_rows == 1) {
        $sendmassage = "API key Already Saved";

    }else {
 // Store the API key in a database or file, or perform an action with it
        $sql = "INSERT INTO bot(chat_id, api) VALUES ('$chat_id','$text')";
            $query = mysqli_query($con,$sql);
    $sendmassage = "API key has been saved: " . $api_key;

    }
}

    $message = $updates['message'];
    $chatId = $message['chat']['id'];
    
    // Check if message is forwarded from another chat
    if (isset($message['forward_from_chat'])) {
        $forwardedChatId = $message['forward_from_chat']['id'];
        $forwardedMessageId = $message['forward_from_message_id'];

        // Get video file info from forwarded message using Telegram Bot API
        $apiUrl = "https://api.telegram.org/bot$apiToken/copyMessage?chat_id=$chatId&from_chat_id=$forwardedChatId&message_id=$forwardedMessageId";
        $response = file_get_contents($apiUrl);
        $result = json_decode($response, true);
        $videoFileId = $result['result']['video']['file_id'];
    } else {
        // Check if message contains a video
        if (isset($message['video'])) {
            $videoFileId = $message['video']['file_id'];
        }
    }

    if (isset($videoFileId)) {
        $chack_sql = "SELECT * FROM bot WHERE chat_id = '$chat_id'";
    $chack_query = mysqli_query($con,$chack_sql);
    $num_rows = mysqli_num_rows($chack_query);
    if($num_rows == 0) {
        $sendmassage = "API not setup yet";

    }else {
               
        // Get video file info from Telegram Bot API
        $apiUrl = "https://api.telegram.org/bot$apiToken/getFile?file_id=$videoFileId";
        $fileInfo = json_decode(file_get_contents($apiUrl), true);
        $videoFileUrl = "https://api.telegram.org/file/bot$apiToken/" . $fileInfo['result']['file_path'];

        // Upload video file to "videos" directory with progress
        $uploadUrl = "https://$domain/bot/up.php/"; // replace with your server's URL

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uploadUrl);
        curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'video' => new \CURLFile($videoFileUrl, 'video/mp4', 'video.mkv', 'video.avi', 'video.mpeg', 'video.wmv'),
    'userId' => $chat_id
]);

// Define $messageId variable before the progress function
$messageId = null;

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, function ($ch, $downloadSize, $downloaded, $uploadSize, $uploaded) use ($chatId, $botUsername, $apiToken, &$messageId) {
    if ($uploadSize > 0) {
        $progress = round($uploaded / $uploadSize * 100);
        $messageText = "Uploading video... $progress%";

        // Send initial message and store the message ID
        if (!$messageId) {
            $apiUrl = "https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chatId&text=$messageText&parse_mode=HTML&disable_notification=true";
            $response = file_get_contents($apiUrl);
            $result = json_decode($response, true);
            $messageId = $result['result']['message_id'];
        }

        // Update progress message every 5 seconds
        $i = 0;
        while ($i < 20) { // 20 loops for a total of 100 seconds
            $i++;
            sleep(5);
            $messageText = "Uploading video... $progress%";
            $apiUrl = "https://api.telegram.org/bot$apiToken/editMessageText?chat_id=$chatId&message_id=$messageId&text=$messageText&parse_mode=HTML";
            file_get_contents($apiUrl);
        }

        // Delete progress message after upload completes
        $apiUrl = "https://api.telegram.org/bot$apiToken/deleteMessage?chat_id=$chatId&message_id=$messageId";
        file_get_contents($apiUrl);
    }
});


curl_exec($ch);


       
$response = trim(curl_exec($ch));

        curl_close($ch);

        // Send confirmation message to user
        $messageText = $response;
        $apiUrl = "https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chatId&text=$messageText&parse_mode=HTML";
        file_get_contents($apiUrl);
    }
}





    
}

$url = "https://api.telegram.org/bot$token/sendMessage?text=$sendmassage&chat_id=$chat_id&parse_mode=html";

file_get_contents($url);





?>