<?php

class Word
{
    // TODO: add word (FR) and answer (EN) - (via constructor or not? why?)
    public string $frenchWord;
    public string $englishTranslation;

    public function __construct(string $frenchWord, string $englishTranslation) {
        $this->frenchWord = $frenchWord;
        $this->englishTranslation = $englishTranslation;
    }

    public function verify(string $answer): bool
    {
        // TODO: use this function to verify if the provided answer by the user matches the correct one
        // Bonus: allow answers with different casing (example: both bread or Bread can be correct answers, even though technically it's a different string)
        // Bonus (hard): can you allow answers with small typo's (max one character different)?
         // Convert both the user's answer and the correct answer to lowercase
        $lowercaseAnswer = strtolower($answer);
        $lowercaseCorrectAnswer = strtolower($this->englishTranslation);

        // Allow answers with different casing and small typos (max one character different)
        return levenshtein($lowercaseAnswer, $lowercaseCorrectAnswer) <= 1;
    }

    public function getFrenchWord(): string {
        return $this->frenchWord;
    }
}