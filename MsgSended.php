<?php


class MsgSended
{
    public function decode($data)
    {
        file_put_contents("fb.txt","sended");
    }
}