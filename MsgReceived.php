<?php

class MsgReceived
{
    public function decode($data)
    {
        $id = $data->entry[0]->id;
        $msg_text = $data->entry[0]->messaging[0]->message->text;
        $msg_id = $data->entry[0]->messaging[0]->message->mid;
        $recipient_id = $data->entry[0]->messaging[0]->recipient->id;
        $sender_id = $data->entry[0]->messaging[0]->sender->id;
        $sended_at = $data->entry[0]->messaging[0]->timestamp;
        $sended_at = $sended_at / 1000;
        $sended_at = date('Y-m-d H:i:s', $sended_at);
        $sender_data = json_decode(file_get_contents("https://graph.facebook.com/$sender_id?access_token=EAAZA3MBPS7SYBALlJOYp9fYYSThCw1Qx1bdUZCrR3ODZCvm2T7c6cpW3hku07HVUPZCYpIkjBcMtU0BhIhGkBZBccYE9NfZBKRWJXsCxHxKPd5ffBEZCLqeLxJXSufFEch5KfkgoNI4iEIZBJU1kEh2tZB1ziQxC8sEwmjZCNDnattmgZDZD"));
        $sender_name = $sender_data->first_name . " " . $sender_data->last_name;
        $sender_pic = $sender_data->profile_pic;
        file_put_contents("fb.txt", "received");
       //$this->checkproblems($sender_id);
//        if(!$this->checkproblems($sender_id)){
//            file_put_contents("fb.txt", "vide");
//        }else{
//            file_put_contents("fb.txt", "huh?");
//        }
    }

    public function checkproblems($senderid)
    {
        $conn = null;   
        $conn = new PDO("mysql:dbname=develop;host=172.30.1.248", "develop", "dev");
        $sql = "SELECT * FROM develop.fb_transcripts where fb_user_id=':senderid' and closed_at = null";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':senderid', $senderid);
        $stmt->execute();
        file_put_contents("fb.txt", $stmt);
        $data = $stmt->fetchAll();
        if ($data->rowCount() > 0) {
            file_put_contents("fb.txt", "huh?");
        } else {
            file_put_contents("fb.txt", "vide");
        }
    }
}