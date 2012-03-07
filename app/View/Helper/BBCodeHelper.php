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
        $string = preg_replace("/\[size=(.*)\](.*)\[\/size\]/Usi", "<span style=\"font-size:\\1\px\">\\2</span>", $string);
        $string = preg_replace("/\[url=(.*)\](.*)\[\/url\]/Usi", "<a href=\"\\1\">\\2</a>", $string);
        $string = preg_replace("/\[img\](.*)\[\/img\]/Usi", "<img src=\"\\1\"/>", $string);
        $string = preg_replace("/\[email\](.*)\[\/email\]/Usi", "<a href=\"mailto:\\1\"/>\\1</a>", $string);
        $string = nl2br($string);
        return $string;
    }
    
    public function removeBBCode($string = null)
    {
    	$string = preg_replace("/\[b\](.*)\[\/b\]/Usi", "\\1", $string);
        $string = preg_replace("/\[i\](.*)\[\/i\]/Usi", "\\1", $string);
        $string = preg_replace("/\[u\](.*)\[\/u\]/Usi", "\\1", $string);
        $string = preg_replace("/\[quote\](.*)\[\/quote\]/Usi", "\\1", $string);
        $string = preg_replace("/\[color=(.*)\](.*)\[\/color\]/Usi", "\\2", $string);
        $string = preg_replace("/\[url=(.*)\](.*)\[\/url\]/Usi", "\\2", $string);
        $string = preg_replace("/\[img\](.*)\[\/img\]/Usi", "", $string);
        $string = preg_replace("/\[email\](.*)\[\/email\]/Usi", "\\1", $string);
        $string = nl2br($string);
        return $string;
    }
}