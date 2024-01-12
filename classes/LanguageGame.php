<?php

class LanguageGame
{
    private array $words;

    public function __construct()
    {
        // :: is used for static functions
        // They can be called without an instance of that class being created
        // and are used mostly for more *static* types of data (a fixed set of translations in this case)
        $this->words = [];
        foreach (Data::words() as $frenchTranslation => $englishTranslation) {
            // TODO: create instances of the Word class to be added to the words array
            $this->words[] = new Word($frenchTranslation, $englishTranslation);
        }
        var_dump($this->words);
    }

    public function getRandomWord(): Word {
        $randomIndex = array_rand($this->words);
        $randomWord = $this->words[$randomIndex];
        return $randomWord;
    }

    public function run(): void
    {
        session_start();
        // TODO: check for option A or B
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_POST['action'])) {
            $this->handleOptionA();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

        if ($action === 'submit_answer') {
            $this->handleOptionB();
        } elseif ($action === 'new_word') {
            $this->handleOptionA(); // Get a new word when the "Get New Word" button is clicked
        }
    }

        // Option A: user visits site first time (or wants a new word)
        // TODO: select a random word for the user to translate

        // Option B: user has just submitted an answer

    }

    private function handleOptionA(): void
    {
        // TODO: select a random word for the user to translate
        $randomWord = $this->getRandomWord();
        $_SESSION["Words"] = $randomWord;

        // Display the word to the user
        echo 'Translate: ' . $randomWord->getFrenchWord();
    }

    public function handleFormSubmission(): void
    {
        $action = $_POST['action'] ?? '';

        if ($action === 'submit_answer') {
            $this->handleOptionB();
        } elseif ($action === 'new_word') {
            $this->handleOptionA(); // Get a new word when the "Get New Word" button is clicked
        }
    }

    private function handleOptionB(): void
    {
        // TODO: verify the answer (use the verify function in the word class) - you'll need to get the used word from the array first
        $userAnswer = $_POST['user_answer'] ?? '';
        $correctWord = $_SESSION["Words"];
        if ($correctWord->verify($userAnswer)) {
                echo 'Correct! Well done!';
            } else {
                echo 'Incorrect. Try again.';
            }
        // TODO: generate a message for the user that can be shown
        // You can create a method to display the message or echo it directly here.
    }

    
}