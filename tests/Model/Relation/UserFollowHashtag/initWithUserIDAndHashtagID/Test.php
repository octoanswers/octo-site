<?php

class UserFollowCategory_Relation_Model__initWithUserIDAndCategoryID__Test extends PHPUnit\Framework\TestCase
{
    public function test__BaseParams()
    {
        $rel = UserFollowCategory_Relation_Model::initWithUserIDAndCategoryID(3, 9);

        $this->assertEquals(null, $rel->id);
        $this->assertEquals(3, $rel->userID);
        $this->assertEquals(9, $rel->categoryID);
        $this->assertEquals(null, $rel->createdAt);
    }
}
