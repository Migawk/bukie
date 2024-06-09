<?php

class Books extends DB
{
    function getAllBooks()
    {

        $res = $this->query("SELECT id, name, description, image, author, pages_amount as pagesAmount FROM book LIMIT 10;");
        return $res;
    }
    function searchBook($name)
    {
        try {
        $res = $this->query("
        SELECT
            book.id,
            book.name,
            book.description,
            book.image,
            book.author,
            book.pages_amount,
            book.structure,
            user.name as authorName,
            user.id as authorId
        FROM book
        INNER JOIN user
        ON book.author=user.id
        WHERE book.name
        LIKE \"%" . $name . "%\"
        LIMIT 5
        ;");} catch ( Exception $e) {
            print_r($e->getMessage());
        }
        return $res;
    }
    function getBook($id)
    {
        return $this->query("SELECT * FROM book WHERE id=" . $id . "")[0];
    }
    function getAuthorsBooks($author_id)
    {
        return $this->query("SELECT user.id as userId,
        user.name as userName,
        book.id as id,
        book.name as name,
        book.description as description,
        book.pages_amount as pages,
        book.image as img
    FROM
        book
    JOIN user ON author = user.id
    WHERE user.id =" . $author_id);
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
    function updateBook($name, $description, $img, $id)
    {
        return $this->query('UPDATE book SET name="' . $name . '", description="' . $description . '", image="' . $img . '" WHERE id=' . $id);
    }
}
