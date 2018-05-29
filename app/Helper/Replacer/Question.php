<?php

class Question_Replacer_Helper
{
    /**
     * Заменяет "плохую букву эй" в вопросах.
     * Исторически так получилось, что многие вопросы содержат вкрапления латинской буквы "a", вместо
     * кирилической "а". Это незаметно пользователю, но влияет на SEO и подбор в блоке "related questions".
     *
     * Т.е. функция заменяет "К[a]кие р[a]змеры существуют?" на "Кaкие рaзмеры существуют?"
     *
     * @param string $questionTitle Question title.
     *
     * @throws Exception
     *
     * @return string
     */
    public static function replaceBadAInTitle(string $title): string
    {
        $title = mb_eregi_replace('([а-я])a', '\\1а', $title);
        $title = mb_eregi_replace('a([а-я])', 'а\\1', $title);

        return $title;
    }
}
