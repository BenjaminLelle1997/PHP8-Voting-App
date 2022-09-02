<?php

namespace Bendzsi\Vote;

class ProfanityFilter
{
    private $stopwords=['white','black'];


    public function __construct(array $stopwords=[]){
        $this->stopWords = array_merge($this->stopwords, $stopwords);
    }

    public function isBanned(string $text) : bool
    {
        if(in_array($text,$this->stopwords))
        {
            return true;
        }
        return false;
    }

    public function isFiltered(string $text) : string
    {
        return str_replace($this->stopwords,'*',$text);
    }
}
?>