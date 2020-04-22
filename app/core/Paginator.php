<?php

namespace Core;


class Paginator
{
    protected $page = null;
    protected $limit = null;
    protected $repository;

    public function __construct(array $date)
    {
        if (isset($date['limit']))
            $this->setLimit($date['limit']);
        if (isset($date['data']))
            $this->setRepository($date['data']);
        if (isset($date['page']))
            $this->setPage($date['page']);
    }

    /**
     * @return integer
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param null $limit
     */
    public function setLimit($limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @return integer
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param null $page
     */
    public function setPage($page): void
    {
        $this->page = $page <= 0 ? 1 : $page;
    }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param mixed $repository
     */
    public function setRepository($repository): void
    {
        $this->repository = $repository;
    }

    public function paginate()
    {
        $data = $this->getRepository();
        $offset = $this->getPage() * $this->getLimit() - $this->getLimit();
        $data = array_slice($data, $offset, $this->getLimit());
        return $data;
    }
}