<?php

namespace Src\Model;

class Chapter {

    protected $id,
              $chapter_number,
              $author,
              $title,
              $content,
              $date_added,
              $date_modified;

    public function __construct($data = [])
    {
        if (!empty($data))
        {
            $this->hydrate($data);
        }
    }

    public function hydrate($data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set' .  ucfirst($key);

            if (is_callable([$this, $method]))
            {
                $this->$method($value);
            }
        }

        // var_dump($data);
        // return;
    }

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function setChapterNumber($chapterNumber)
    {
        $this->chapter_number = (int) $chapterNumber; 
    }

    public function setAuthor($author)
    {

        $this->author = (string) $author;
    }

    public function setTitle($title)
    {
        $this->title = (string) $title;
    }

    public function setContent($content)
    {

        $this->content = (string) $content;
/*        var_dump($content);
        var_dump("cloche");
        var_dump($this->content);
        return;*/

    }

    public function setDateAdd($dateAdd)
    {

        $this->date_added = $date_added;
        
    }

    public function setDateModif($dateModif)
    {

        $this->date_modified = $date_modified;
        
    }


    public function getId()
    {
        return $this->id;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getChapterNumber()
    {
        return $this->chapter_number;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
/*        var_dump($this->content);
        return;*/
        return $this->content;
    }

    public function getDateAdd()
    {
        return $this->date_added;
    }

    public function getDateModif()
    {
        return $this->date_modified;
    }

}