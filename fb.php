<?php
$json = file_get_contents('php://input');
$data=json_decode($json);
$id = $data->entry[0]->id;
$msg_text = $data->entry[0]->messaging[0]->message->text;
$msg_id = $data->entry[0]->messaging[0]->message->mid;
$recipient_id =$data->entry[0]->messaging[0]->recipient->id;
$sender_id = $data->entry[0]->messaging[0]->sender->id;
$sended_at = $data->entry[0]->messaging[0]->timestamp;
// sended
$sended_at= $sended_at/1000;
//sss
$sended_at = date('Y-m-d H:i:s',$sended_at);

$servername = "sql11.freesqldatabase.com";
$username = "sql11191189";
$password = "NbYAQmxQKq";
$dbname = "api_facebook";

try {
    if(isset($msg_text)){
        $conn = new PDO("mysql:dbname=sql11191189;host=sql11.freesqldatabase.com", $username, $password);
        $sql = 'INSERT INTO messages( msg_text, msg_id, recipient_id, sender_id, sended_at,type_message) 
							 VALUES(:msg_text,:msg_id,:recipient_id,:sender_id,:sended_at,"sended")';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':msg_text', $msg_text);
        $stmt->bindParam(':msg_id', $msg_id);
        $stmt->bindParam(':recipient_id', $recipient_id);
        $stmt->bindParam(':sender_id', $sender_id);
        $stmt->bindParam(':sended_at',$sended_at);
        $stmt->execute();

    }
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
