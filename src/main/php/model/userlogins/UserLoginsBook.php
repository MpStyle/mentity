<?php
namespace mpstyle\mtoolkit\mentity\model\userlogins;

use mpstyle\mtoolkit\mentity\model\userlogins\exception\InsertUserLoginsException;
use MToolkit\Model\Sql\MPDOQuery;

class UserLoginsBook
{
    /**
     * @param UserLogins $role
     * @param \PDO|null $connection
     * @return UserLogins
     * @throws InsertUserLoginsException
     * @throws \Exception
     */
    public static function save(UserLogins $role, \PDO $connection=null){
        $sql = "CALL mentity_user_logins_save(?, ?, ?);";
        $query = new MPDOQuery($sql, $connection);
        $query->bindValue($role->getLoginProvider());
        $query->bindValue($role->getProviderKey());
        $query->bindValue($role->getUserId());
        $queryResult = $query->exec();

        if ($queryResult == false) {
            throw new InsertUserLoginsException($query->getLastError());
        }

        $result = $query->getResult();
        $id = $result[0]["id"];
        $role->setId($id);

        return $role;
    }

    /**
     * @param $userId
     * @param UserLogins $userLogins
     * @param \PDO|null $connection
     * @return UserLogins
     * @throws InsertUserLoginsException
     * @throws \Exception
     */
    public static function saveUserLogins($userId, UserLogins $userLogins, \PDO $connection=null){
        $userLogins=self::save($userLogins);

        $sql = "CALL mentity_user_save_user_logins(?,?);";
        $query = new MPDOQuery($sql, $connection);
        $query->bindValue($userId, $userLogins->getId());
        $queryResult = $query->exec();

        if ($queryResult == false) {
            throw new InsertUserLoginsException($query->getLastError());
        }

        return $userLogins;
    }

    /**
     * @param $userLoginsId
     * @param \PDO|null $connection
     * @return UserLogins
     * @throws \Exception
     */
    public static function get($userLoginsId, \PDO $connection=null){
        $toReturn = new UserLogins();
        $sql = "CALL mentity_user_logins_get(?);";
        $query = new MPDOQuery($sql, $connection);
        $query->bindValue($userLoginsId);
        $queryResult = $query->exec();

        if ($queryResult == false || $query->getResult()->rowCount() <= 0) {
            return $toReturn;
        }

        foreach ($query->getResult() as $row) {
            $toReturn->setLoginProvider($row['login_provider'])
                ->setProviderKey($row['providers_key'])
                ->setUserId($row['user_id'])
                ->setId($userLoginsId);
        }

        return $toReturn;
    }

    /**
     * @param $userLoginsId
     * @param \PDO|null $connection
     * @return array
     * @throws \Exception
     */
    public static function getList($userLoginsId, \PDO $connection=null){
        $toReturn = array();
        $sql = "CALL mentity_user_logins_get_list(?);";
        $query = new MPDOQuery($sql, $connection);
        $query->bindValue($userLoginsId);
        $queryResult = $query->exec();

        if ($queryResult == false || $query->getResult()->rowCount() <= 0) {
            return $toReturn;
        }

        foreach ($query->getResult() as $row) {
            $userLogins=new UserLogins();

            $userLogins->setLoginProvider($row['login_provider'])
                ->setProviderKey($row['providers_key'])
                ->setUserId($row['user_id'])
                ->setId($userLoginsId);

            $toReturn[]=$userLogins;
        }

        return $toReturn;
    }
}