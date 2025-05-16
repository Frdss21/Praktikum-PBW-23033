<?php

class Book {
    private $code_book;
    private $name;
    private $qty;

    // Constructor untuk menginisialisasi properti melalui setter
    public function __construct($code_book, $name, $qty) {
        $this->setCodeBook($code_book);
        $this->name = $name; // Name tidak memiliki aturan khusus, langsung assign
        $this->setQty($qty);
    }

    // Private setter untuk code_book
    private function setCodeBook($code_book) {
        // Validasi format: 2 huruf besar diikuti 2 angka (contoh: BB00)
        if (preg_match('/^[A-Z]{2}[0-9]{2}$/', $code_book)) {
            $this->code_book = $code_book;
        } else {
            throw new Exception("Error: Code book harus dalam format BB00 (2 huruf besar diikuti 2 angka).");
        }
    }

    // Private setter untuk qty
    private function setQty($qty) {
        // Validasi qty: harus integer positif
        if (is_int($qty) && $qty > 0) {
            $this->qty = $qty;
        } else {
            throw new Exception("Error: Quantity harus berupa angka integer positif.");
        }
    }

    // Public getter untuk code_book
    public function getCodeBook() {
        return $this->code_book;
    }

    // Public getter untuk qty
    public function getQty() {
        return $this->qty;
    }

    // Getter untuk name (opsional, karena tidak diminta di soal)
    public function getName() {
        return $this->name;
    }
}

// Contoh penggunaan
try {
    // Input valid
    $book1 = new Book("AB12", "Programming 101", 5);
    echo "Book Code: " . $book1->getCodeBook() . "\n";
    echo "Book Name: " . $book1->getName() . "\n";
    echo "Quantity: " . $book1->getQty() . "\n";

    // Input tidak valid untuk code_book
    $book2 = new Book("abc1", "Invalid Book", 3); // Akan menampilkan error
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    // Input tidak valid untuk qty
    $book3 = new Book("CD34", "Another Book", -2); // Akan menampilkan error
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

?>