<?php

class UserFollowCategory_Relation_Mapper extends Abstract_Mapper
{
    public function create(UserFollowCategory_Relation_Model $relation): UserFollowCategory_Relation_Model
    {
        UserFollowCategory_Relation_Validator::validateNew($relation);

        $sql = 'INSERT INTO er_users_follow_categories (user_id, category_id) VALUES (:user_id, :category_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $relation->userID, PDO::PARAM_INT);
        $stmt->bindParam(':category_id', $relation->categoryID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $relation->id = (int) $this->pdo->lastInsertId();
        if ($relation->id === 0) {
            throw new Exception('UserFollowCategory relation not saved', 1);
        }

        return $relation;
    }

    private function update(UserFollowCategory_Relation_Model $relation)
    {
        throw new Exception('UserFollowCategory relation "update" method not applicable', 0);
    }

    public function delete_relation(UserFollowCategory_Relation_Model $relation): bool
    {
        UserFollowCategory_Relation_Validator::validateExists($relation);

        $sql = 'DELETE FROM er_users_follow_categories WHERE category_id=:category_id AND user_id=:user_id LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $relation->userID, PDO::PARAM_INT);
        $stmt->bindParam(':category_id', $relation->categoryID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $deleted_rows = $stmt->rowCount();
        if ($deleted_rows == 0) {
            throw new Exception('UserFollowCategory relation not deleted', 1);
        }

        return true;
    }
}
