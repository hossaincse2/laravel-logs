<?php

namespace Mdhossain\LaravelLogs\Contracts;

/**
 * Description of Moshuk17ReportInterface
 *
 * @author Rajan Bhatta
 */
interface ActivityLogInterface {

    public function dataSave($id, $log_txt, $ArrayDataByID, $log_title, $log_type);

    public function getAllAuditLogs();

    public function allAuditLogs($search = array());

    public function getAllErrorLogs();

    public function allErrorLogs($search = array());

    public function auditLogDescription($id, $requestExcept, $companyArray);
}

