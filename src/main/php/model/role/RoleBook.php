<?php
namespace mpstyle\mtoolkit\mentity\model\role;

use mpstyle\mtoolkit\mentity\model\role\exception\InsertRoleException;
use MToolkit\Model\Sql\MPDOQuery;

class RoleBook
{
    /**
     * @param Role $role
     * @param \PDO|null $connection
     * @return Role
     * @throws InsertRoleException
     * @throws \Exception
     */
    public static function save(Role $role, \PDO $connection=null){
        $sql = "CALL mentity_role_save(?);";
        $query = new MPDOQuery($sql, $connection);
        $query->bindValue($role->getName());
        $queryResult = $query->exec();

        if ($queryResult == false) {
            throw new InsertRoleException($query->getLastError());
        }

        $result = $query->getResult();
        $id = $result[0]["id"];
        $role->setId($id);

        return $role;
    }

    /**
     * @param ReadableRole $role
     * @param \PDO|null $connection
     * @return bool
     */
    public static function delete(ReadableRole $role, \PDO $connection=null){
        $sql = "CALL mentity_role_delete(?);";
        $query = new MPDOQuery($sql, $connection);
        $query->bindValue($role->getId());
        return $query->exec();
    }

    /**
     * @param int $userId
     * @param Role $role
     * @param \PDO|null $connection
     * @return Role
     * @throws InsertRoleException
     * @throws \Exception
     */
    public static function saveRole($userId, Role $role, \PDO $connection=null){
        $role=self::save($role);

        $sql = "CALL mentity_user_save_role(?,?);";
        $query = new MPDOQuery($sql, $connection);
        $query->bindValue($userId, $role->getId());
        $queryResult = $query->exec();

        if ($queryResult == false) {
            throw new InsertRoleException($query->getLastError());
        }

        return $role;
    }

    /**
     * @param $roleId
     * @param \PDO|null $connection
     * @return Role
     * @throws \Exception
     */
    public static function get($roleId, \PDO $connection=null){
        $toReturn = new Role();
        $sql = "CALL mentity_role_get(?);";
        $query = new MPDOQuery($sql, $connection);
        $query->bindValue($roleId);
        $queryResult = $query->exec();

        if ($queryResult == false || $query->getResult()->rowCount() <= 0) {
            return $toReturn;
        }

        foreach ($query->getResult() as $row) {
            $toReturn->setId($row['id'])
                ->setName($row['name']);
        }

        return $toReturn;
    }

    /**
     * @param $userId
     * @param \PDO|null $connection
     * @return array
     * @throws \Exception
     */
    public static function getList($userId, \PDO $connection=null){
        $toReturn = array();
        $sql = "CALL mentity_role_get_list(?);";
        $query = new MPDOQuery($sql, $connection);
        $query->bindValue($userId);
        $queryResult = $query->exec();

        if ($queryResult == false || $query->getResult()->rowCount() <= 0) {
            return $toReturn;
        }

        foreach ($query->getResult() as $row) {
            $role=new Role();

            $role->setId($row['id'])
                ->setName($row['name']);

            $toReturn[]=$role;
        }

        return $toReturn;
    }
}