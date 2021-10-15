<?php

class Comment
{
    private $id;
    private $blog_id;
    private $date;
    private $name;
    private $comment;

    public static function find($sql, $bindVal = null)
    {
        global $dbc;
        $comments = $dbc->fetchArray($sql, $bindVal);
        if(!$comments)
        {
            return [];
        }

        foreach($comments as $comment)
        {
            $commentObjArray[] = new self($comment['id'], $comment['blog_id'], $comment['date'], $comment['name'], $comment['comment']);
        }
        
        return $commentObjArray;
    }

    public function __construct(int $id, int $blog_id, int $date, int $name, int $comment)
    {
        $this->id = $id;
        $this->blog_id = $blog_id;
        $this->date = $date;
        $this->name = $name;
        $this->comment = $comment;
    }

    public function create()
    {
        global $dbc;
        $sql = "INSERT INTO `comments`" . 
                "(blog_id,date,name,comment)" . 
                "VALUES(:blog_id, NOW(), :name, :comment);";
        $bindVal = ['blog_id' => $this->blogId,
                    'name' => $this->name,
                    'comment' => $this->comment];

        return $dbc->sqlQuery($sql, $bindVal);
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getblog_id()
    {
        return $this->blog_id;
    }
    public function setblog_id($blog_id)
    {
        $this->blog_id = $blog_id;

        return $this;
    }

    public function getdate()
    {
        return $this->date;
    }
    public function setdate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function getname()
    {
        return $this->name;
    }
    public function setname($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getcomment()
    {
        return $this->comment;
    }
    public function setcomment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

}

?>