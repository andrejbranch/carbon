<?php

namespace Carbon\ApiBundle\Grid;

use Symfony\Component\HttpFoundation\RequestStack;

abstract class Grid implements GridInterface
{
    /**
     * Header to send in the request to override the
     * grids per page
     *
     * @var string
     */
    const GRID_PER_PAGE_HEADER = "X-CARBON_GRID_PER_PAGE";

    /**
     * Header to send in the request to set the page
     *
     * @var string
     */
    const GRID_PAGE_HEADER = "X-CARBON_GRID_PAGE";

    /**
     * The default per page for the grid
     *
     * @var int
     */
    const GRID_PER_PAGE = 25;

    /**
     * How many results to return
     *
     * @var int
     */
    protected $perPage;

    /**
     * Initialize new CarbonGrid instance
     *
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    protected function getPerPage()
    {
        // check to see if it was already set
        if ($this->perPage) {
            return $this->perPage;
        }

        return $this->perPage = $this->getHeader(self::GRID_PER_PAGE_HEADER)
            ?: self::GRID_PER_PAGE
        ;
    }

    protected function getOffset()
    {
        $page = $this->getHeader(self::GRID_PAGE_HEADER) ?: 0;

        return ($page - 1) * $this->getPerPage();
    }

    /**
     * Get a header from the request
     *
     * @param  string $header
     * @return mixed
     */
    protected function getHeader($header)
    {
        return $this->request->headers->get($header);
    }
}
