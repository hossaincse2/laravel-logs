<?php

namespace MDHossain\laravelLogs\Contracts;

/**
 * Description of Moshuk17ReportInterface
 *
 * @author Rajan Bhatta
 */
interface ActivityLogInterface {

    public function dataSave($id, $log_txt, $ArrayDataByID, $log_title, $log_type);

    public function allAuditLogs($search = array());

    public function allErrorLogs($search = array());

    public function auditLogDescription($id, $requestExcept, $companyArray);
}

