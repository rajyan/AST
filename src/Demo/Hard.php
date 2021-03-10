<?php


namespace ASTDemo\Demo;


class Hard
{
    private function hoge()
    {
        $hoge = "hoge";
        (new hoge())->hoge($hoge);
        \hoge::hoge();
    }
}
