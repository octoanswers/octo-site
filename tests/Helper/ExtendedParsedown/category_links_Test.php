<?php

use PHPUnit\Framework\TestCase;

class Helper_ExtendedParsedown__category_links__Test extends TestCase
{
    protected function setUp(): void
    {
        $this->pd = new \Helper\ExtendedParsedown('ru');
    }

    protected function tearDown(): void
    {
        $this->pd = null;
    }

    public function test_Full_category_link()
    {
        $stringMD = 'I eat {honey crisp}(Crisp) every day.';
        $stringHTML = '<p>I eat <a href="https://answeropedia.org/ru/category/Crisp">honey crisp</a> every day.</p>';

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test_Category_link_with_empty_reference_part()
    {
        $stringMD = 'Some {peoples}() are strange.';
        $stringHTML = '<p>Some <a href="https://answeropedia.org/ru/category/peoples">peoples</a> are strange.</p>';

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test_Uncompleted_category_link_without_reference_part()
    {
        $stringMD = 'Some {girls} are beautiful.';
        $stringHTML = '<p>Some <a href="https://answeropedia.org/ru/category/girls">girls</a> are beautiful.</p>';

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test_Category_cannot_be_a_link_to_Answeropedia()
    {
        $stringMD = 'I eat {porridge}(https://answeropedia.org/foo) and drink milk.';
        $stringHTML = '<p>I eat {porridge}(<a href="https://answeropedia.org/foo">https://answeropedia.org/foo</a>) and drink milk.</p>';

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test_Category_cannot_be_a_external_HTTP_link()
    {
        $stringMD = 'I eat {porridge}(http://site.com/foo-page) and drink milk.';
        $stringHTML = '<p>I eat {porridge}(<a href="http://site.com/foo-page" class="link-external" target="_blank" rel="nofollow">http://site.com/foo-page</a>) and drink milk.</p>';

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test_Category_cannot_be_a_external_HTTPS_link()
    {
        $stringMD = 'I eat {porridge}(https://site.com/foo-page) and drink milk.';
        $stringHTML = '<p>I eat {porridge}(<a href="https://site.com/foo-page" class="link-external" target="_blank" rel="nofollow">https://site.com/foo-page</a>) and drink milk.</p>';

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }
}
