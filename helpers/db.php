<?php

class DB
{
    public $conn;
    public $actions;

    function __construct()
    {
        $this->conn = mysqli_connect($_ENV["DB_HOST"], $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"], $_ENV["DB_NAME"]);
        $this->actions = new Actions();
    }

    function query($q)
    {
        $res = mysqli_query($this->conn, $q);
        if (gettype($res) == "object") {
            return $res->fetch_all(MYSQLI_ASSOC);
        } else {
            return $res;
        }
    }
    function getAllBooks()
    {

        $res = $this->query("SELECT * FROM book LIMIT 5;");
        return $res;
    }
    function searchBook($name)
    {
        $res = $this->query("SELECT * FROM book WHERE name LIKE \"%" . $name . "%\" LIMIT 5;");
        return $res;
    }
    function getBook($id)
    {
        return $this->query("SELECT * FROM book WHERE id=" . $id . "")[0];
    }
    function getAuthorsBooks($author_id)
    {
        return $this->query("SELECT * FROM book WHERE author=" . $author_id . "");
    }
    function findBook($name)
    {
        return $this->query("SELECT * FROM book WHERE name LIKE \"%" . $name . "%\"");
    }
    function createBook($author, $name, $url, $description)
    {
        return $this->query('INSERT INTO
            book(author, name, image, description)
            VALUES (' . $author . ', "' . $name . '", "' . $url . '", "' . $description . '")
        ');
    }

    function getPages($bookId)
    {
        return $this->query("SELECT * FROM page WHERE book_id=" . $bookId . "");
    }
    function pushPage($bookId, $number)
    {
        $res = $this->query("INSERT INTO page(book_id, number, content) VALUES (" . $bookId . ", " . $number . ", \" \")");
        $len = $this->query("SELECT count(book_id) as len FROM page WHERE book_id=" . $bookId)[0]["len"];

        $this->query("UPDATE book
        SET
            pages_amount=" . $len . "
        WHERE id=" . $bookId);
        return $res;
    }
    function updatePage($pageId, $content)
    {
        return $this->query('UPDATE page
        SET
            content="' . $content . '"
        WHERE
            id=' . $pageId);
    }

    function createUser($name, $email, $password)
    {
        try {
            if (!isset($password)) {
                throw "password_absence";
            }
            return $this->query(
                "INSERT INTO user(name, email, password) VALUES(\"" .
                    $name . "\", \"" . $email . "\", \"" .
                    $this->actions->hash($password) . "\")"
            );
        } catch (Exception $e) {
            return $e;
        }
    }
    function getUser($name)
    {
        $user =  $this->query("SELECT id, name FROM user WHERE name LIKE \"%" . $name . "%\"");
        unset($user["password"]);
        return $user;
    }
    function logIn($name, $password)
    {
        $user = $this->query("SELECT * FROM user WHERE name LIKE \"%" . $name . "%\"")[0];
        if (isset($user["password"])) {
            if ($this->actions->hash($password) == $user["password"]) {
                unset($user["password"]);
                return $user;
            }
            throw new Exception("password_absence");
        } else {
            throw new Exception("password_incorrect");
        }
    }

    function getLib($userId)
    {
        return $this->query("SELECT
        user.id as userId,
        user.name as userName,
        book.id as bookId,
        book.name as bookName,
        book.description as bookDescription,
        book.pages_amount as bookPages,
        book.image as bookImg,
        pages,
        progress
    FROM
        rack
    JOIN user ON user_id = user.id
    JOIN book ON book_id = book.id
    WHERE user.id = " . $userId);
    }
    function addToLib($userId, $bookId)
    {
        return $this->query("INSERT INTO rack(user_id, book_id) VALUES (" . $userId . ", " . $bookId . ")");
    }
    function deleteLib($userId, $bookId)
    {
        return $this->query('DELETE FROM rack WHERE book_id=' . $bookId . ' AND user_id=' . $userId);
    }

    function setPage($userId, $bookId, $pages, $progress)
    {
        return $this->query("UPDATE
        rack
    SET
        pages = " . $pages . ",
        progress = " . $progress . "
    WHERE
        user_id = " . $userId . " AND book_id =" . $bookId);
    }
}
