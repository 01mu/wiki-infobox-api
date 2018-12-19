<?php
/*
 * wiki-infobox-api
 * github.com/01mu
 */

class infobox_value
{
    public $key;
    public $value;
}

class infobox
{
    private $context;
    private $article;

    private $infobox_raw;
    public $infobox_arr = array();

    public function infobox($person)
    {
        $agent = 'wiki-infobox-api';
        $ctx = array("http" => array("header" => $agent));
        $this->context = stream_context_create($ctx);
        $this->get_article($person);
        $this->get_infobox();
    }

    public function get_article($person)
    {
        $person = str_replace(" ", "_", $person);

        $url = 'https://en.wikipedia.org/w/api.php?action=query' .
            '&titles=' . $person . '&prop=revisions&rvprop=content' .
            '&format=json&formatversion=2';

        $data = file_get_contents($url, false, $this->context);
        $wiki = json_decode($data, true);

        $this->article = $wiki['query']['pages'][0]['revisions'][0]['content'];
    }

    public function get_infobox()
    {
        $lines = array();
        $pos_arr = array();

        $start = strpos($this->article, "\n{{Infobox") + 1;
        $new_s = substr($this->article, $start, strlen($this->article) - 1);

        $ibox_end;

        $last_start;
        $first = 0;

        for($i = 0; $i < strlen($new_s); $i++)
        {
            if($new_s[$i] === "\n" && $new_s[$i + 1] === "|")
            {
                if($first == 0)
                {
                    $first = 1;
                    $last_start = $i;
                }
                else
                {
                    $s = substr($new_s, $last_start + 2, strlen($new_s) - 1);
                    $len = strpos($s, "\n|");
                    $latest = substr($new_s, $last_start, $len + 2);
                    $lines[] = trim($latest, "\n");

                    $last_start = $i;
                }
            }

            if($new_s[$i] == "\n" && $new_s[$i + 1] == '}'
                && $new_s[$i + 2] == '}' && $new_s[$i + 3] == "\n"
                && $new_s[$i + 4] != '|')
            {
                $s = substr($new_s, $last_start, strlen($new_s) - 1);
                $len = strpos($s, "\n|");
                $latest = substr($new_s, $last_start, $len);
                $lines[] = trim($latest, "\n");

                $ibox_end = $i;

                break;
            }
        }

        $this->infobox_raw = substr($new_s, 0, $ibox_end);

        for($i = 0; $i < count($lines); $i++)
        {
            if(!empty($lines[$i]))
            {
                $this->infobox_arr[] = $this->set_line($lines[$i]);
            }
        }
    }

    private function set_line($line)
    {
        $ia = new infobox_value();

        $pos = strpos($line, '=');

        $lsplit = substr($line, 0, $pos-1);
        $rsplit = substr($line, $pos+1, strlen($line));

        $lsplit[strpos($lsplit, '|')] = ' ';

        $lsplit = trim($lsplit);
        $rsplit = trim($rsplit);

        if(!strlen($rsplit))
        {
            $rsplit = '[Empty]';
        }

        $ia->key = $lsplit;
        $ia->value = $rsplit;

        return $ia;
    }

    private function i_arr_add($new_s, $last_start)
    {
        $s = substr($new_s, $last_start + 2, strlen($new_s) - 1);
        $len = strpos($s, "\n|");
        $latest = substr($new_s, $last_start, $len + 2);

        return trim($latest, "\n");
    }
}
