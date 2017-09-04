<?php
$json = file_get_contents('php://input');
$msgevent = new MsgEvent();
$MsgEvent->handle($json);
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


$sender_data  = json_decode(file_get_contents("https://graph.facebook.com/$sender_id?access_token=EAADKrOX6ciMBAAzNOosNKaXIYGxLMPtYp3LvkLAx3D09Eg3deSTTcPGUemrUIKyxI0tyZCsLIq3ImPCC0amgFFl6IZAljFMWDx4hzW1eQFtVdQy8tNACH3Qs0z3O33PCNRw5pic27dcvYl6zv8kaCIEZBlneasWT13Pfn5ItQZDZD"));
$sender_name= $sender_data->first_name . " " .$sender_data->last_name;
$sender_pic = $sender_data->profile_pic;
//$data = array(
//    'recipient' => array('id'=> "$sender_id"),
//    'message' => array('text' => "Bien recu")
//);

//
//$options = array(
//    'http' => array(
//        'method' => 'POST',
//        'content' => json_encode($data),
//        'header' => "Content-Type: application/json\n"
//    )
//);
//$context = stream_context_create($options);

try {
    if(isset($msg_text)){
    $conn = new PDO("mysql:dbname=sql11191189;host=sql11.freesqldatabase.com", $username, $password);
    $sql = 'INSERT INTO messages( msg_text, msg_id, recipient_id, sender_id, sended_at,type_message,sender_name,sender_pic) 
							 VALUES(:msg_text,:msg_id,:recipient_id,:sender_id,:sended_at,"recieved",:sender_name,:sender_pic)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':msg_text', $msg_text);
    $stmt->bindParam(':msg_id', $msg_id);
    $stmt->bindParam(':recipient_id', $recipient_id);
    $stmt->bindParam(':sender_id', $sender_id);
    $stmt->bindParam(':sended_at',$sended_at);
    $stmt->bindParam(':sender_name',$sender_name);
    $stmt->bindParam(':sender_pic',$sender_pic);
    $stmt->execute();
    //file_get_contents("https://graph.facebook.com/v2.6/me/messages?access_token=$token",false,$context);
    }
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
