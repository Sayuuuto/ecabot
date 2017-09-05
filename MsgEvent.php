<?php

class MsgEvent
{
    public function __construct()
    {
    }

    public function test($json)
    {
        $data = array(
            'recipient' => array('id'=> "1440697529370822"),
            'message' => array('text' => "azeeza")
        );
        $token = "EAAD6U9fLLI8BAAhbtkQIloZBmasEk6ZC4315FSiWfecDQ9opERFw0NLUrJQVdxbM6w58VSE3VVhDqGm5g63YkXojE3ixk2oD2Ui3U0BmbVGYybQ31aYfsDM2n8ychI4AOlBMdg0mWZB7jaRurHwwkTZCQ5trN0KBOJSgtXWXNwZDZD";
        $options = array(
            'http' => array(
                'method' => 'POST',
                'content' => json_encode($data),
                'header' => "Content-Type: application/json\n"
            )
        );
        $context = stream_context_create($options);
       file_get_contents("https://graph.facebook.com/v2.10/me/messages?access_token=$token",false,$context);
        //
//        $data = json_decode($json);
//        if ($data->entry[0]->messaging[0]->message->is_echo) {
//            $msgsended = new MsgSended();
//            $msgsended->decode($data);
//        } else {
//            $msgreceived = new MsgReceived();
//            $msgreceived->decode($data);
//        }
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