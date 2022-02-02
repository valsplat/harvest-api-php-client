<?php
/**
 * Report class.
 */

namespace Required\Harvest\Api;

use Required\Harvest\Exception\InvalidArgumentException;
use Required\Harvest\Exception\RuntimeException;

/**
 * API client for reports endpoint.
 *
 * @see https://help.getharvest.com/api-v2/reports-api/reports/project-budget-report/
 */
class Report extends AbstractApi implements ReportInterface
{
    /**
     * Project Budget Report.
     *
     * @param array $parameters {
     *                          Optional. Parameters for filtering the list of projects. Default empty array.
     *
     *     @var int $page The page number to use in pagination. For instance, if you make a list request and receive 100 records, your subsequent call can include page=2 to retrieve the next page of the list. (Default: 1)
     *     @var int $per_page The number of records to return per page. Can range between 1 and 1000. (Default: 1000)
     *     @var bool $is_active Pass true to only return active projects and false to return inactive projects.
     * }
     */
    public function projectBudget(array $parameters = []): array
    {
        if (isset($parameters['page']) && !is_int($parameters['page'])) {
            throw new InvalidArgumentException('Parameter page provided, but value is not an integer');
        }

        if (isset($parameters['per_page']) && !is_int($parameters['per_page'])) {
            throw new InvalidArgumentException('Parameter per_page provided, but value is not an integer');
        }

        if (isset($parameters['is_active'])) {
            $parameters['is_active'] = filter_var($parameters['is_active'], FILTER_VALIDATE_BOOLEAN) ? 'true' : 'false';
        }

        $result = $this->get('/reports/project_budget', $parameters);
        if (!isset($result['results']) || !\is_array($result['results'])) {
            throw new RuntimeException('Unexpected result.');
        }

        return $result['results'];
    }

    /**
     * Retrieves a list of items with automatic pagination.
     *
     * @param array $parameters Optional. Parameters for filtering the list of items. Default empty array.
     *
     * @return \Required\Harvest\Api\AutoPagingIterator the iterator
     */
    public function projectBudgetWithAutoPagingIterator(array $parameters = []): AutoPagingIterator
    {
        return new AutoPagingIterator($this, $parameters, 'projectBudget');
    }
}
