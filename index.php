<?php


$json = file_get_contents('php://input');

$data=json_decode($json);

var_dump($data);

$id = $data->entry[0]->id;
$msg_text = $data->entry[0]->messaging[0]->message->text;
$msg_id = $data->entry[0]->messaging[0]->message->mid;
$recipient_id =$data->entry[0]->messaging[0]->recipient->id;
$sender_id = $data->entry[0]->messaging[0]->sender->id;
$problem_id = $data->entry[0]->id;
$servername = "sql11.freesqldatabase.com";
$username = "sql11191189";
$password = "NbYAQmxQKq";
$dbname = "api_facebook";
try {

    $conn = new PDO("mysql:dbname=sql11191189;host=sql11.freesqldatabase.com", $username, $password);
    $sql = "select id from problems where fb_user_id = "+$id+" and closed_at is NULL";
    $requete= $conn->prepare($sql);
    $requete->execute();
    $row = $requete->fetch(PDO::FETCH_ASSOC);
    if ($row==false)
    {
        echo "variable id n'existe pas ";
        $req = "INSERT INTO problems (fb_user_id, started_at) 
							VALUES (:fb_user_id ,NOW()) ";
        $stmt = $conn->prepare($req);
        $stmt->bindValue(':fb_user_id', intval($sender_id));
        $res = $stmt->execute();
        $problem_id = $conn->lastInsertId();
    }else {
        echo "variable id existe  ";
        $problem_id = $row['id'];
    }

    $sql = "INSERT INTO messages( msg_text, msg_id, recipient_id, sender_id, problem_id) 
							 VALUES(:msg_text,:msg_id,:recipient_id,:sender_id,:problem_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':msg_text', $msg_text);
    $stmt->bindParam(':msg_id', $msg_id);
    $stmt->bindParam(':recipient_id', $recipient_id);
    $stmt->bindParam(':sender_id', $sender_id);
    $stmt->bindParam(':problem_id', $problem_id, PDO::PARAM_INT);
    $stmt->execute();
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
?>