<?php


class MsgSended
{
    public function decode($json)
    {
        file_put_contents("fb.txt","Sended");
    }
}