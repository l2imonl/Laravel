<?php

namespace App\Traits;

trait HtmlTrim
{

    //Schließt HtmlTags beim trimmen von Strings
    public function HtmlTrim($string, $limit)
    {
        //string muss nicht getrimmt werden
        if (strlen($string) <= $limit) {
            return $string;
        }

        $insideTag = false;
        $openTags = 0;
        $tagList = [];
        $return = '';

        for ($i = 0; $i < $limit; $i++) {
            if ($string[$i] == '<') {
                if ($string[$i + 1] == '/') {
                    unset($tagList[$openTags]);
                    $openTags--;
                    if ($openTags == 0) {
                        $insideTag = false;
                    }
                } else {
                    $openTags++;
                    $insideTag = true;

                    $end = '';
                    for ($j = 1; $string[$i + $j] != '>'; $j++) {
                        $end .= $string[$i + $j];
                    }
                    $tagList[$openTags] = $end;
                }
            }
            $return .= $string[$i];
        }

        $return.='...';

        if (!$insideTag) {
            return $return;
        } else {
            for ($openTags; $openTags != 0; $openTags--) {
                $return .= '</' . $tagList[$openTags] . '>';
            }
            return $return;
        }
    }
}
