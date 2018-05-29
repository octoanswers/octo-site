<?php

class Questions_Humanizer extends Abstract_Humanizer
{
    /**
     * Get humanized & localized phrase for answers count.
     *
     * @example humanize_answers_count('ru', 0) => 'Нет ответов'
     * @example humanize_answers_count('en', 3) => '3 answers'
     *
     * @param int       $count Answers count.
     */
    public function humanize(int $count): string
    {
        if ($count < 0) {
            throw new Exception('Count param '.$count.' must be greater than or equal to 0', 1);
        }

        if ($count === 0) {
            return $this->loc->t('no_questions');
        }

        $wordforms = [
            $this->loc->t('wordform_1_question'),
            $this->loc->t('wordform_2_questions'),
            $this->loc->t('wordform_5_questions'),
        ];
        $count_wordform = $this->humanizeCount($count, $wordforms);

        return $count.' '.$count_wordform;
    }
}
