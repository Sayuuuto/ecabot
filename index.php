<?php
file_put_contents("fb.txt",file_get_contents("php://input"));
$json = file_get_contents('php://input');
$data=json_decode($json);
$id = $data->entry[0]->id;
$msg_text = $data->entry[0]->messaging[0]->message->text;
$msg_id = $data->entry[0]->messaging[0]->message->mid;
$recipient_id =$data->entry[0]->messaging[0]->recipient->id;
$sender_id = $data->entry[0]->messaging[0]->sender->id;
$problem_id = $data->entry[0]->id;
var_dump($data);