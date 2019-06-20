<?php declare(strict_types=1);

namespace Synatix\Account\Repository;

use SocialFood\Application\Aggregate\AbstractAggregate;
use SocialFood\Application\Repository\RepositoryInterface;
use Synatix\Account\Aggregate\AccountAggregate;

abstract class AbstractAggregateMysqlRepository implements RepositoryInterface
{
    /** @var MysqlWrapper */
    private $mysqlWrapper;

    public function __construct(MysqlWrapper $mysqlWrapper)
    {
        $this->mysqlWrapper = $mysqlWrapper;
    }

    /**
     * @param AbstractAggregate $abstractAggregate
     */
    public function saveObject(AbstractAggregate $abstractAggregate): void
    {
        $id           = $abstractAggregate->getAccountId()->asString();
        $publisherId  = $abstractAggregate->getPublisherId()->asString();
        $emailAddress = $abstractAggregate->getEmailAddress()->asString();
        $password     = $abstractAggregate->getHashedPassword()->asString();

        $results = $this->mysqlWrapper->fetchAll('select id from ' . $this->table . ' where id = :id', [':id' => $id]);

        $queryString = 'INSERT INTO accounts (id, publisherId, emailAddress, password) VALUES '.
            '(:id, :publisherId, :emailAddress, :password)';

        if ($results && count($results) > 0) {
            $queryString = 'UPDATE accounts SET publisherId = :publisherId, emailAddress = :emailAddress , '.
                'password = :password WHERE id = :id';
        }

        $objectParameters = [
            ':id'           => $id,
            ':publisherId'  => $publisherId,
            ':emailAddress' => $emailAddress,
            ':password'     => $password,
        ];

        $this->mysqlWrapper->query($queryString, $objectParameters);
    }

    /**
     * @param AccountId | PrimaryKeyInterface  $id
     * @return AccountAggregate | AbstractAggregate
     */
    public function readObject(PrimaryKeyInterface $id): AbstractAggregate
    {
        $idParam = $id->asString();
        $result  = $this->mysqlWrapper->fetchOne('SELECT * FROM accounts WHERE id = :id', [':id' => $idParam]);

        $accountLoadedFromDatabaseEvent = new AccountLoadedFromDatabaseEvent(
            AccountId::from($result['id']),
            PublisherId::from($result['publisherId']),
            EmailAddress::from($result['emailAddress']),
            HashedPassword::from($result['password'])
        );

        return AccountAggregate::fromDatabase($accountLoadedFromDatabaseEvent);
    }

    public function readAll(): Accounts
    {
        $accounts      = [];
        $accountsArray = $this->mysqlWrapper->fetchAll('SELECT * FROM accounts', []);

        foreach ($accountsArray as $accountArray) {
            $accountLoadedFromDatabaseEvent = new AccountLoadedFromDatabaseEvent(
                AccountId::from($accountArray['id'] ?? ''),
                PublisherId::from($accountArray['publisherId'] ?? ''),
                EmailAddress::from($accountArray['emailAddress'] ?? ''),
                HashedPassword::from($accountArray['password'] ?? '')
            );

            $accounts[] = AccountAggregate::fromDatabase($accountLoadedFromDatabaseEvent);
        }

        return Accounts::fromArray($accounts);
    }

    public function readBy(array $params): Accounts
    {
        $where          = '';
        $preparedParams = [];
        $accounts       = [];

        foreach ($params as $paramName => $paramValue) {
            $where .= ' ' . $paramName . ' = :' . $paramName;
            $preparedParams[':' . $paramName] = $paramValue;
        }

        $query = 'SELECT * FROM accounts WHERE' . $where;

        $accountsArray = $this->mysqlWrapper->fetchAll($query, $preparedParams);

        foreach ($accountsArray as $accountArray) {
            $accountLoadedFromDatabaseEvent = new AccountLoadedFromDatabaseEvent(
                AccountId::from($accountArray['id'] ?? ''),
                PublisherId::from($accountArray['publisherId'] ?? ''),
                EmailAddress::from($accountArray['emailAddress'] ?? ''),
                HashedPassword::from($accountArray['password'] ?? '')
            );

            $accounts[] = AccountAggregate::fromDatabase($accountLoadedFromDatabaseEvent);
        }

        return Accounts::fromArray($accounts);
    }

    public function delete(string $accountIdAsString)
    {
        $this->mysqlWrapper->query('DELETE FROM accounts WHERE id = :id', [':id' => $accountIdAsString]);
    }
}
