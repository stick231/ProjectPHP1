<?php
date_default_timezone_set('Europe/Moscow');

class Book {
    public $title;
    public $author;
    public $year;
    public $price;
    public $added_date;

    public function __construct($title, $author, $year, $price)
    {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->price = $price;
        $this->added_date = date("Y-m-d H:i:s");
    }
}

class Library {
    public $Books = [];

    public function saveLibraryToFile()
    {
        $file = fopen("Library_file.txt", 'w'); 
        if ($file !== false) {
            foreach ($this->Books as $book) {
                $content = "{$book->title}|{$book->author}|{$book->year}|{$book->price}|{$book->added_date}\n";
                fwrite($file, $content); 
            }
            fclose($file);
            echo "\nДанные библиотеки сохранены в файле.";
        } else {
            echo "\nОшибка при открытии файла для записи.";
        }
    }

    public function AddNewBook($book)
    {
        $this->Books[] = $book;
        echo "\nКнига {$book->title} добавлена в библиотеку";
        $this->saveLibraryToFile();
    }

    public function RemoveBook($book)// удаление
    {
        $key = array_search($book, $this->Books);
        if($key !== false)
        {
            unset($this->Books[$key]);
            echo "\nКнига {$book->title} удалена из библиотеки";
            $this->saveLibraryToFile();
        }
    }

    public function FoundBook($criteria)//поиск и вывод
    {
        $foundBooks = [];
        foreach ($this->Books as $book) {
            if (stripos($book->title, $criteria) !== false || stripos($book->author, $criteria) !== false) {
                $foundBooks[] = $book;
            }
            else{
                echo "\nКнига $criteria не найдена";
            }
        }
        foreach($foundBooks as $foundBook){
            echo "<br>По вашему запросу найдена книга $foundBook->title, автор $foundBook->author, написана в $foundBook->year и стоит $foundBook->price р ";
        }
    }

    public function countingBooks() // подсчет книг 
    {
        $count = count($this->Books);
        echo "\nВсего в библиотеке $count книг";
    }
}

date_default_timezone_set('Europe/Moscow');

$Book_Dream = new Book("Дом", "Захаренков В В", "2025", 5000);


$next_Book1 = new Book("Приснилосfdsf", "puradfple", "23024", 999399);


$World_Lidraly = new Library();

$World_Lidraly->AddNewBook($Book_Dream);
$World_Lidraly->AddNewBook($next_Book1);
$World_Lidraly->RemoveBook($Book_Dream);
$World_Lidraly->countingBooks();



$World_Lidraly->FoundBook("Новый мир");

?>
