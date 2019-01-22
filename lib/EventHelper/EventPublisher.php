<?php
/**
 *
 */

namespace TalentedPanda\PuzzleProblem\EventHelper;

use TalentedPanda\PuzzleProblem\Lib\EventHelper\Event;
use TalentedPanda\PuzzleProblem\Lib\EventHelper\EventSubscriberInterface;

/**
 * Class EventPublisher
 */
class EventPublisher
{
    /**
     * @var EventSubscriberInterface[]
     */
    private $subscribers;

    /** @var EventPublisher|null */
    private static $instance = null;

    private $id = 0;

    /**
     * @return EventPublisher
     */
    public static function instance()
    {
        if (null === static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    /**
     * EventPublisher constructor.
     */
    private function __construct()
    {
        $this->subscribers = [];
    }

    /**
     *
     */
    public function __clone()
    {
        throw new \BadMethodCallException('Clone is not supported');
    }

    /**
     * @param EventSubscriberInterface $eventSubscriber
     *
     * @return int
     */
    public function subscribe($eventSubscriber)
    {
        $id = $this->id;
        $this->subscribers[$id] = $eventSubscriber;
        $this->id++;

        return $id;
    }

    /**
     * @param EventSubscriberInterface[] $eventSubscribers
     *
     * @return int[]
     */
    public function register($eventSubscribers = [])
    {
        $subscriberIds = [];
        foreach ($eventSubscribers as $subscriber) {
            $subscriberIds[] = $this->subscribe($subscriber);
        }

        return $subscriberIds;
    }

    /**
     * @param int $id
     *
     * @return EventSubscriberInterface|mixed
     */
    public function ofId($id)
    {
        return $this->subscribers[$id];
    }

    /**
     * @param int $id
     */
    public function unsubscribe($id)
    {
        unset($this->subscribers[$id]);
    }

    /**
     * @param Event $event
     *
     * @throws \Exception
     */
    public function publish(Event $event)
    {
        $subscribers = $this->getSubscribers();
        foreach ($subscribers as $subscriber) {
            if ($subscriber->isSubscribedTo($event)) {
                try {
                    $subscriber->handle($event);
                } catch (\Exception $exception) {
                    print_r($exception->getMessage(), $exception->getTrace());
                }
            }
        }
    }

    /**
     * @return EventSubscriberInterface[]
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }
}
