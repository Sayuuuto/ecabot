<?php

class MsgEvent
{
    public function handle($json)
    {
        $data = json_decode($json);
        if ($data->entry[0]->messaging[0]->message->is_echo) {
            $msgsended = new MsgSended();
            $msgsended->decode($data);
        } else {
            $msgreceived = new MsgReceived();
            $msgreceived->decode($data);
        }
    }
}











//     $id = $data->entry[0]->id;
//     $msg_text = $data->entry[0]->messaging[0]->message->text;
//     $msg_id = $data->entry[0]->messaging[0]->message->mid;
//     $recipient_id =$data->entry[0]->messaging[0]->recipient->id;
//     $sender_id = $data->entry[0]->messaging[0]->sender->id;
//     $sended_at = $data->entry[0]->messaging[0]->timestamp;
//     $sended_at= $sended_at/1000;
//     $sended_at = date('Y-m-d H:i:s',$sended_at);
//     $sender_data  = json_decode(file_get_contents("https://graph.facebook.com/$sender_id?access_token=EAADKrOX6ciMBAAzNOosNKaXIYGxLMPtYp3LvkLAx3D09Eg3deSTTcPGUemrUIKyxI0tyZCsLIq3ImPCC0amgFFl6IZAljFMWDx4hzW1eQFtVdQy8tNACH3Qs0z3O33PCNRw5pic27dcvYl6zv8kaCIEZBlneasWT13Pfn5ItQZDZD"));
//     $sender_name= $sender_data->first_name . " " .$sender_data->last_name;
//     $sender_pic = $sender_data->profile_pic;