<?php


class Club
{
    private int $id;
    private string $name;
    private int $publish_year;
    private int $president_id;

    /**
     * Club constructor.
     * @param int $id
     * @param string $name
     * @param int $publish_year
     * @param int $president_id
     */
    public function __construct(int $id, string $name, int $publish_year, int $president_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->publish_year = $publish_year;
        $this->president_id = $president_id;
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
     * @return int
     */
    public function getPublishYear(): int
    {
        return $this->publish_year;
    }

    /**
     * @param int $publish_year
     */
    public function setPublishYear(int $publish_year): void
    {
        $this->publish_year = $publish_year;
    }

    /**
     * @return int
     */
    public function getPresidentId(): int
    {
        return $this->president_id;
    }

    /**
     * @param int $president_id
     */
    public function setPresidentId(int $president_id): void
    {
        $this->president_id = $president_id;
    }
}

class ClubWithPresident
{
    private int $id;
    private string $name;
    private int $publish_year;
    private int $president_id;
    private string $president_full_name;

    /**
     * ClubWithPresident constructor.
     * @param int $id
     * @param string $name
     * @param int $publish_year
     * @param int $president_id
     * @param string $president_full_name
     */
    public function __construct(int $id, string $name, int $publish_year, int $president_id, string $president_full_name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->publish_year = $publish_year;
        $this->president_id = $president_id;
        $this->president_full_name = $president_full_name;
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
     * @return int
     */
    public function getPublishYear(): int
    {
        return $this->publish_year;
    }

    /**
     * @param int $publish_year
     */
    public function setPublishYear(int $publish_year): void
    {
        $this->publish_year = $publish_year;
    }

    /**
     * @return int
     */
    public function getPresidentId(): int
    {
        return $this->president_id;
    }

    /**
     * @param int $president_id
     */
    public function setPresidentId(int $president_id): void
    {
        $this->president_id = $president_id;
    }

    /**
     * @return string
     */
    public function getPresidentFullName(): string
    {
        return $this->president_full_name;
    }

    /**
     * @param string $president_full_name
     */
    public function setPresidentFullName(string $president_full_name): void
    {
        $this->president_full_name = $president_full_name;
    }
}