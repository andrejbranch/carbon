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
     * Header to send in the request to set the
     * column we should order the result set by
     *
     * @var string
     */
    const GRID_ORDER_BY_HEADER = "X-CARBON_GRID_ORDER_BY";

    /**
     * Header to send in the request to set the
     * type we should order by ASC | DESC
     *
     * @var string
     */
    const GRID_ORDER_BY_TYPE_HEADER = "X-CARBON_GRID_ORDER_BY_TYPE";

    /**
     * The default per page for the grid
     *
     * @var int
     */
    const GRID_PER_PAGE = 25;

    /**
     * The default per page for the grid
     *
     * @var int
     */
    const GRID_LIKE_SEARCH_HEADER = "X-CARBON_GRID_LIKE_SEARCH";

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

    /**
     * Get amount of results per page
     *
     * @return int
     */
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

    /**
     * Get how many results we must offset by
     *
     * @return int
     */
    protected function getOffset()
    {
        $page = $this->getHeader(self::GRID_PAGE_HEADER) ?: 1;

        return ($page - 1) * $this->getPerPage();
    }

    /**
     * Get the column we should order by
     *
     * @return string
     */
    protected function getOrderBy()
    {
        if ($orderBy = $this->getHeader(self::GRID_ORDER_BY_HEADER)) {
            return array(
                $orderBy,
                $this->getHeader(self::GRID_ORDER_BY_TYPE_HEADER),
            );
        }

        return null;
    }

    /**
     * Get the like search text
     *
     * @return text
     */
    protected function getLikeSearch()
    {
        $likeSearchText = $this->getHeader(self::GRID_LIKE_SEARCH_HEADER);

        if ($likeSearchText) {
            return "%".str_replace(' ', '%', $likeSearchText)."%";
        }

        return null;
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
