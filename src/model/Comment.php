<?php

namespace Src\Model;

class Comments {

    protected $id,
              $comment_chapter,
              $author,
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
            $method = 'set' . ucfirst($key);

            if (is_callable([$this, $method]))
            {
                $this->$method($value);
            }
        }
    }

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function setCommentChapter($commentChapter) 
    {
        $this->comment_chapter = (int) $comment_chapter;
    }

    public function setAuthor($author)
    {
        $this->author = (string) $author;
    }

    public function setContent($content)
    {
        $this->content = (string) $content;
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

    public function getCommentChapter()
    {
        return $this->comment_chapter;
    }

    public function getAuthor()
    {
        return $this->author;
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