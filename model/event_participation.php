<?php
include_once "event.php";

class EventParticipation
{
    private int $id;
    private int $user_id;
    private int $event_id;
    private bool $can_edit; // whether participant can edit the event or not

    /**
     * Participant constructor.
     * @param int $id
     * @param int $user_id
     * @param int $event_id
     * @param bool $can_edit
     */
    public function __construct(int $id, int $user_id, int $event_id, bool $can_edit)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->event_id = $event_id;
        $this->can_edit = $can_edit;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getEventId(): int
    {
        return $this->event_id;
    }

    /**
     * @param int $event_id
     */
    public function setEventId(int $event_id): void
    {
        $this->event_id = $event_id;
    }

    /**
     * @return bool
     */
    public function canEdit(): bool
    {
        return $this->can_edit;
    }

    /**
     * @param bool $can_edit
     */
    public function setCanEdit(bool $can_edit): void
    {
        $this->can_edit = $can_edit;
    }
}

class EventParticipationAndDetail {
    private Event $event;
    private EventParticipation $event_participation;
    private string $club_name;

    /**
     * EventParticipationAndDetail constructor.
     * @param Event $event
     * @param EventParticipation $event_participation
     * @param string $club_name
     */
    public function __construct(Event $event, EventParticipation $event_participation, string $club_name)
    {
        $this->event = $event;
        $this->event_participation = $event_participation;
        $this->club_name = $club_name;
    }

    /**
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }

    /**
     * @param Event $event
     */
    public function setEvent(Event $event): void
    {
        $this->event = $event;
    }

    /**
     * @return EventParticipation
     */
    public function getEventParticipation(): EventParticipation
    {
        return $this->event_participation;
    }

    /**
     * @param EventParticipation $event_participation
     */
    public function setEventParticipation(EventParticipation $event_participation): void
    {
        $this->event_participation = $event_participation;
    }

    /**
     * @return string
     */
    public function getClubName(): string
    {
        return $this->club_name;
    }

    /**
     * @param string $club_name
     */
    public function setClubName(string $club_name): void
    {
        $this->club_name = $club_name;
    }
}