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
     * @var int The default per page for the grid
     */
    const GRID_PER_PAGE = 25;

    /**
     * @var int The default per page for the grid
     */
    const GRID_LIKE_SEARCH_HEADER = "X-CARBON_GRID_LIKE_SEARCH";

    /**
     * @var int How many results to return
     */
    protected $perPage;

    /**
     * @var int the current page
     */
    protected $page;

    /**
     * @var int unpaginated total
     */
    protected $unpaginatedTotal;

    /**
     * @var int paginated total
     */
    protected $paginatedTotal;

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
     * Get the current page
     *
     * @return int
     */
    protected function getPage()
    {
        if ($this->page) {
            return $this->page;
        }

        return $this->getHeader(self::GRID_PAGE_HEADER) ?: 1;
    }

    /**
     * Get how many results we must offset by
     *
     * @return int
     */
    protected function getOffset()
    {
        return ($this->getPage() - 1) * $this->getPerPage();
    }

    /**
     * Get the column we should order by
     *
     * @return array | null
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
     * @return string | null
     */
    protected function getLikeSearchString()
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

    /**
     * Set the unpaginated total
     *
     * @param int
     */
    protected function setUnpaginatedTotal($unpaginatedTotal)
    {
        $this->unpaginatedTotal = $unpaginatedTotal;
    }

    /**
     * Set the paginated total
     *
     * @param int
     */
    protected function setPaginatedTotal($paginatedTotal)
    {
        $this->paginatedTotal = $paginatedTotal;
    }

    /**
     * Determine if there is a next page
     *
     * @return boolean
     */
    public function hasNextPage()
    {
        return (($this->getPage() - 1) * $this->getPerPage() + $this->paginatedTotal) != $this->unpaginatedTotal;
    }

    /**
     * Builds the grid response result
     *
     * @param  array $data response data
     * @return array
     */
    protected function buildGridResponse(array $data)
    {
        $this->setPaginatedTotal(count($data));

        return array(
            'page' => $this->getPage(),
            'perPage' => $this->getPerPage(),
            'hasNextPage' => $this->hasNextPage(),
            'unpaginatedTotal' => $this->unpaginatedTotal,
            'paginatedTotal' => $this->paginatedTotal,
            'data' => $data
        );
    }
}
