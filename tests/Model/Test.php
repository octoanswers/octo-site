<?php

namespace Test\Model;

use Model\Model;
use PHPUnit\Framework\TestCase;

/**
 * @group models
 */
class Test extends TestCase
{
    protected $anonymous_class_from_abstract;

    protected function setUp(): void
    {
        // Create a new instance from the Abstract Model Class
        $this->anonymous_class_from_abstract = new class() extends Model {
            public $bar = 'bar!';

            // Just a sample public function that returns this anonymous instance
            public function get_foo()
            {
                return 'foo';
            }
        };
    }

    protected function tearDown(): void
    {
        $this->anonymous_class_from_abstract = null;
    }

    public function test_Call_exists_method()
    {
        $this->assertEquals('foo', $this->anonymous_class_from_abstract->get_foo());
    }

    public function test_Get_exists_param()
    {
        $this->assertEquals('bar!', $this->anonymous_class_from_abstract->bar);
    }

    public function test_Get_doesnt_exists_param()
    {
        $this->expectExceptionMessage('Property "foo_bar" doesn\'t exists and cannot be get.');

        $this->anonymous_class_from_abstract->foo_bar;
    }

    public function test_Set_exists_param()
    {
        $this->anonymous_class_from_abstract->bar = '123';
        $this->assertEquals('123', $this->anonymous_class_from_abstract->bar);
    }

    public function test_Set_doesnt_exists_param()
    {
        $this->expectExceptionMessage('Property "foo_bar" doesn\'t exists and cannot be set.');
        $this->anonymous_class_from_abstract->foo_bar = '123';
    }
}
