<?php
class Pages extends DB
{

    function getPages($bookId)
    {
        return $this->query("SELECT * FROM page WHERE book_id=" . $bookId . "");
    }
    function pushPage($bookId, $number)
    {
        $check = $this->query("SELECT * FROM page WHERE book_id=" . $bookId . " AND number=" . $number);
        if (sizeof($check) > 0) throw new Exception("Number_is_taken_already.");
        $res = $this->query("INSERT INTO page(book_id, number, content) VALUES (" . $bookId . ", " . $number . ", \" \")");
        $len = $this->query("SELECT count(book_id) as len FROM page WHERE book_id=" . $bookId)[0]["len"];

        $this->updateBook($len, $bookId);

        if ($res) {
            $page = $this->query("SELECT * FROM page WHERE book_id=" . $bookId . " AND number=" . $number)[0];
            return $page;
        }
    }
    function updatePage($pageId, $content)
    {
        return $this->query('UPDATE page SET content="' . $content . '" WHERE id=' . $pageId);
    }
    function deletePage($bookId, $number)
    {
        return $this->query("DELETE FROM page WHERE number=" . $number . " AND book_id=" . $bookId);
    }

    private function updateBook($len, $bookId)
    {
        return $this->query("UPDATE book SET pages_amount=" . $len . " WHERE id=" . $bookId);
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
