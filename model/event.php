<?php


class Event
{
    private int $id;
    private int $club_id;
    private string $name;
    private string $description;
    private string $start_date;
    private string $end_date;
    private string $uniform;
    private string $notes;

    /**
     * Event constructor.
     * @param int $id
     * @param int $club_id
     * @param string $name
     * @param string $description
     * @param string $start_date
     * @param string $end_date
     * @param string $uniform
     * @param string $notes
     */
    public function __construct(int $id, int $club_id, string $name, string $description, string $start_date, string $end_date, string $uniform, string $notes)
    {
        $this->id = $id;
        $this->club_id = $club_id;
        $this->name = $name;
        $this->description = $description;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->uniform = $uniform;
        $this->notes = $notes;
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
    public function getClubId(): int
    {
        return $this->club_id;
    }

    /**
     * @param int $club_id
     */
    public function setClubId(int $club_id): void
    {
        $this->club_id = $club_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->start_date;
    }

    /**
     * @param string $start_date
     */
    public function setStartDate(string $start_date): void
    {
        $this->start_date = $start_date;
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->end_date;
    }

    /**
     * @param string $end_date
     */
    public function setEndDate(string $end_date): void
    {
        $this->end_date = $end_date;
    }

    /**
     * @return string
     */
    public function getUniform(): string
    {
        return $this->uniform;
    }

    /**
     * @param string $uniform
     */
    public function setUniform(string $uniform): void
    {
        $this->uniform = $uniform;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }
}
