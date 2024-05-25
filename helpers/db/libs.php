<?php
class Libs extends DB
{
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
}
