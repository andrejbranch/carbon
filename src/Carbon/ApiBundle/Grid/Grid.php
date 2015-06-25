<?php

namespace Carbon\ApiBundle\Grid;

use Carbon\ApiBundle\Service\CarbonAnnotationReader;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class Grid implements GridInterface
{
    /**
     * Query param to send in the request to override the
     * grids per page
     *
     * @var string
     */
    const QUERY_PER_PAGE = "c_per_page";

    /**
     * Query param to send in the request to set the page
     *
     * @var string
     */
    const QUERY_PAGE = "c_page";

    /**
     * Query param to send in the request to set the
     * column we should order the result set by
     *
     * @var string
     */
    const QUERY_ORDER_BY = "c_order_by";

    /**
     * @var int The default per page for the grid
     */
    const QUERY_LIKE_SEARCH = "c_search";

    /**
     * Query param to send in the request to set the
     * direction we should order by ASC | DESC
     *
     * @var string
     */
    const QUERY_ORDER_BY_DIRECTION = "c_order_by_dir";

    /**
     * @var int The default per page for the grid
     */
    const GRID_PER_PAGE = 25;

    /**
     * Array of valid query params
     *
     * @var array
     */
    protected $validGridQueryParams = array(
        self::QUERY_PER_PAGE,
        self::QUERY_PAGE,
        self::QUERY_ORDER_BY,
        self::QUERY_LIKE_SEARCH,
        self::QUERY_ORDER_BY_DIRECTION,
    );

    /**
     * @var Symfony\Component\HttpFoundation\RequestStack
     */
    protected $requestStack;

    /**
     * @var Doctrine\Common\Annotations\AnnotationReader
     */
    protected $annotationReader;

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
    public function __construct(RequestStack $requestStack, CarbonAnnotationReader $annotationReader)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->annotationReader = $annotationReader;
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

        return $this->perPage = $this->getQueryParam(self::QUERY_PER_PAGE)
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

        return $this->getQueryParam(self::QUERY_PAGE) ?: 1;
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
        if ($orderBy = $this->getQueryParam(self::QUERY_ORDER_BY)) {
            return array(
                $orderBy,
                $this->getQueryParam(self::QUERY_ORDER_BY_DIRECTION),
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
        $likeSearchText = $this->getQueryParam(self::QUERY_LIKE_SEARCH);

        if ($likeSearchText !== NULL) {
            return "%".str_replace(' ', '%', $likeSearchText)."%";
        }

        return null;
    }

    /**
     * Get a query param from the request
     *
     * @param  string $param
     * @return mixed
     */
    protected function getQueryParam($param)
    {
        return $this->request->query->get($param);
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
