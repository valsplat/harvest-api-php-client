<?php

namespace Required\Harvest\Api;

/**
 * API client for projects endpoint.
 *
 * @see https://help.getharvest.com/api-v2/reports-api/reports/project-budget-report/
 */
interface ReportInterface
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
     *
     * @return array
     */
    public function projectBudget(array $parameters = []);
}
