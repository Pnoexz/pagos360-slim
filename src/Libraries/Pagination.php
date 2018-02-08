<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Libraries;

/**
 * Class Pagination
 *
 * @SWG\Definition()
 */
class Pagination implements \JsonSerializable
{
    /**
     * If no page is given, this value will be used for the first page.
     *
     * @var int
     */
    const DEFAULT_PAGE = 1;

    /**
     * If items per page is not provided, this value will be used.
     *
     * @var int
     */
    const DEFAULT_ITEMS_PER_PAGE = 10;

    /**
     * Default value for number of maximum items. This is used to delimiter how
     * many results we are showing for performance reasons.
     *
     * @var int
     */
    const DEFAULT_MAX_ITEMS_PER_PAGE = 50;

    /**
     * @var int
     * @SWG\Property(format="int32")
     */
    protected $currentPage;

    /**
     * @var int
     * @SWG\Property(format="int32")
     */
    protected $itemsPerPage;

    /**
     * @var int
     * @SWG\Property(format="int32")
     */
    protected $totalItems;

    /**
     * Pagination constructor.
     *
     * @param null $currentPage
     * @param null $itemsPerPage
     */
    public function __construct($currentPage = null, $itemsPerPage = null)
    {
        $this->setCurrentPage($currentPage);
        $this->setItemsPerPage($itemsPerPage);
    }

    /**
     * Sets the current page. If no value is provided or it's invalid, the
     * default will be used. This value is defined in
     * `self::DEFAULT_MAX_ITEMS_PER_PAGE`. A current page is considered invalid
     * when it's not an int or less than one.
     *
     *
     * @param int|null $currentPage
     */
    public function setCurrentPage($currentPage = null)
    {
        $this->currentPage = (empty($currentPage) || (int) $currentPage < 1) ?
            self::DEFAULT_PAGE : (int) $currentPage;
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return (int)$this->itemsPerPage;
    }

    /**
     * Sets the items per page. If no value is provided, the default will be
     * used. This value is defined in `self::DEFAULT_ITEMS_PER_PAGE`.
     *
     * @param int|null $itemsPerPage
     *
     * @return self
     */
    public function setItemsPerPage($itemsPerPage = null)
    {
        $this->itemsPerPage = (empty($itemsPerPage)) ?
            self::DEFAULT_ITEMS_PER_PAGE : (int)$itemsPerPage;

        return $this;
    }

    /**
     * Sets the total items to build the results array.
     *
     * @param int $totalItems
     *
     * @return self
     */
    public function setTotalItems($totalItems)
    {
        $this->totalItems = (int)$totalItems;

        return $this;
    }

    /**
     * Calculates the offset for SQL queries. Because pages indexes start at 1
     * and SQL limit start at 0 we need to subtract 1 from the current page.
     *
     * @return int
     */
    public function getSqlOffset(): int
    {
        return (int)($this->currentPage - 1) * $this->itemsPerPage;
    }

    /**
     * This is just an alias to assist when dealing with SQL queries.
     *
     * @return int
     */
    public function getSqlLimit(): int
    {
        return (int) $this->itemsPerPage;
    }


    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Export pagination data to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $output = [
            'currentPage' => $this->currentPage,
            'itemsPerPage' => $this->itemsPerPage,
        ];

        // totalItems is optional, so we only display it if it exists.
        if (!empty($this->totalItems)) {
            $output['totalItems'] = $this->totalItems;
        }

        return $output;
    }
}
