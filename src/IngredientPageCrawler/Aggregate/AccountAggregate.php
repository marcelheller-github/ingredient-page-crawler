<?php declare(strict_types=1);

namespace Synatix\Account\Aggregate;

use SocialFood\Application\Aggregate\AbstractAggregate;
use SocialFood\Application\Collection\EventCollection;
use SocialFood\IngredientPageCrawler\Command\AddLinkCommand;
use SocialFoodSolutions\Event\CrawledLinkAddedEvent;

class AccountAggregate extends AbstractAggregate
{
    /** @var AccountId */
    private $accountId;

    /** @var PublisherId */
    private $publisherId;

    /** @var EmailAddress */
    private $emailAddress;

    /** @var HashedPassword */
    private $hashedPassword;

    protected function __construct(EventCollection $events)
    {
        parent::__construct($events);
    }

    public static function createAccount(AddLinkCommand $addLinkCommand): self
    {
        $accountCreatedEvent = new CrawledLinkAddedEvent(
            $createAccountCommand->getAccountId(),
            $createAccountCommand->getPublisherId(),
            $createAccountCommand->getEmailAddress(),
            HashedPassword::fromRawPassword($createAccountCommand->getRawPassword())
        );

        $accountAggregate = new self(EventCollection::from([]));
        $accountAggregate->record($accountCreatedEvent);

        return $accountAggregate;
    }

    public static function fromDatabase(AccountLoadedFromDatabaseEvent $accountLoadedFromDatabaseEvent): self
    {
        return new self(EventCollection::from([$accountLoadedFromDatabaseEvent]));
    }

    protected function accountCreatedEventHandler(AccountCreatedEvent $event): void
    {
        $this->accountId      = $event->getAccountId();
        $this->publisherId    = $event->getPublisherId();
        $this->emailAddress   = $event->getEmailAddress();
        $this->hashedPassword = $event->getHashedPassword();
    }

    protected function accountLoadedFromDatabaseEventHandler(AccountLoadedFromDatabaseEvent $event): void
    {
        $this->accountId      = $event->getAccountId();
        $this->publisherId    = $event->getPublisherId();
        $this->emailAddress   = $event->getEmailAddress();
        $this->hashedPassword = $event->getHashedPassword();
    }

    public function getAccountId(): AccountId
    {
        return $this->accountId;
    }

    public function getPublisherId(): PublisherId
    {
        return $this->publisherId;
    }

    public function getEmailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    public function getHashedPassword(): HashedPassword
    {
        return $this->hashedPassword;
    }
}
