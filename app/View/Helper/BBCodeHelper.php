<?php
App::uses('AppHelper', 'View/Helper');

class BBCodeHelper extends AppHelper
{

    public function transformBBCode($string = null)
    {
        $string = preg_replace("/\[b\](.*)\[\/b\]/Usi", "<b>\\1</b>", $string);
        $string = preg_replace("/\[i\](.*)\[\/i\]/Usi", "<i>\\1</i>", $string);
        $string = preg_replace("/\[u\](.*)\[\/u\]/Usi", "<u>\\1</u>", $string);
        $string = preg_replace("/\[quote\](.*)\[\/quote\]/Usi", "<blockquote>\\1</blockquote>", $string);
        $string = preg_replace("/\[color=(.*)\](.*)\[\/color\]/Usi", "<span color=\"\\1\">\\2</span>", $string);
        $string = preg_replace("/\[url=(.*)\](.*)\[\/url\]/Usi", "<a href=\"\\1\">\\2</a>", $string);
        $string = preg_replace("/\[img=(.*)\]/Usi", "<img src=\"\\1\"/>", $string);
        return $string;
    }
}