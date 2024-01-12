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
            //create instances of the Word class to be added to the words array
            $this->words[] = new Word($frenchTranslation, $englishTranslation);
        }
    }

    public function getRandomWord(): Word {
        $randomIndex = array_rand($this->words);
        $randomWord = $this->words[$randomIndex];
        return $randomWord;
    }

    public function run(): void
    {
        session_start();
        // Option A: user visits site first time (or wants a new word)
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_POST['action'])) {
            //select a random word for the user to translate
            $this->handleOptionA();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

            if ($action === 'submit_answer') {
                // Option B: user has just submitted an answer
                $this->handleOptionB();
            } elseif ($action === 'new_word') {
                $this->handleOptionA(); 
            }
        }
    }

    private function handleOptionA(): void
    {
        //select a random word for the user to translate
        $randomWord = $this->getRandomWord();
        $_SESSION["Words"] = $randomWord;

        // Display the word to the user
        echo 'Translate: ' . $randomWord->getFrenchWord();
    }

    private function handleOptionB(): void
    {
        //verify the answer (use the verify function in the word class) - you'll need to get the used word from the array first
        $userAnswer = $_POST['user_answer'] ?? '';
        $correctWord = $_SESSION["Words"];
        if ($correctWord->verify($userAnswer)) {
                echo 'Correct! Well done!';
            } else {
                echo 'Incorrect. Try again.';
            }
    }

    
}