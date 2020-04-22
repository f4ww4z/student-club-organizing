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