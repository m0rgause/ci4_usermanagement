<?php

use App\Models\UserApprovalModel;
use App\Models\NotifikasiModel;
use App\Models\TrxPenampunganModel;
use App\Models\TrxUtamaModel;
use App\Models\TrxPengeluaranModel;
use App\Models\GiroModel;
use App\Models\SaldoModel;

function getUserId()
{
    $result = session()->get('id');
    return $result;
}


function getApvList($user_id)
{
    $UserApprovalModel = new UserApprovalModel();
    $list = $UserApprovalModel->select('approved_by')->where('user_id', $user_id)->findAll();
    $apvList = array_column($list, 'approved_by');
    return json_encode($apvList);
}


function getSidebarParent()
{
    $uri = service('uri');
    $controller = $uri->getSegment(1);
    $curr_url = $controller ? substr($controller, 0, 3) : 'das';

    $filepath = FCPATH . 'group_access/' . session()->get('group_id') . '.txt';
    if (file_exists($filepath)) {
        $file = fopen($filepath, "r") or die("Unable to open file!");
        $filecontent = fread($file, filesize($filepath));
        $data = json_decode($filecontent, true);

        $result = '';
        if ($data) foreach ($data as $row) {
            $active = $curr_url == strtolower(substr($row['nama'], 0, 3)) ? 'active' : '';
            $result .= '<a href="#' . $row['link'] . '" class="nav-link ' . $active . '" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="' . $row['nama'] . '">' . PHP_EOL;
            $result .= '<i class="' . $row['icon'] . '"></i>' . PHP_EOL;
            $result .= '</a>' . PHP_EOL;
        }
        return $result;
        fclose($file);
    } else {
        die('Access not found');
    }
}

function getSidebarChild()
{
    $uri = service('uri');
    $controller = $uri->getSegment(1);
    $curr_url = $controller ? substr($controller, 0, 3) : 'das';

    $filepath = FCPATH . 'group_access/' . session()->get('group_id') . '.txt';
    if (file_exists($filepath)) {
        $file = fopen($filepath, "r") or die("Unable to open file!");
        $filecontent = fread($file, filesize($filepath));
        $data = json_decode($filecontent, true);

        $result = '';
        if ($data) foreach ($data as $row) {
            $active = $curr_url == strtolower(substr($row['nama'], 0, 3)) ? 'active' : '';
            if (!empty($row['sub'])) {
                $result .= '<div id="' . $row['link'] . '" class="main-icon-menu-pane ' . $active . '">' . PHP_EOL;
                foreach ($row['sub'] as $subrow) {
                    $result .= '<div class="title-box">' . PHP_EOL;
                    $result .= '<h6 class="menu-title">' . $subrow['nama'] . '</h6>' . PHP_EOL;
                    $result .= '</div>' . PHP_EOL;

                    $result .= '<ul class="nav">' . PHP_EOL;
                    if (!empty($subrow['child'])) foreach ($subrow['child'] as $childrow) {
                        $childactive = $controller == $childrow['link'] ? 'active' : '';

                        $result .= '<li class="nav-item"><a class="nav-link ' . $childactive . '" href="' . site_url($childrow['link']) . '"><i class="' . $childrow['icon'] . '"></i>' . $childrow['nama'] . '</a></li>' . PHP_EOL;
                    }
                    $result .= '</ul>' . PHP_EOL;
                }
                $result .= '</div>' . PHP_EOL;
            }
        }

        return $result;

        fclose($file);
    } else {
        die('Access not found');
    }
}


function guidv4($data = null)
{
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function setDate($date, $format = 'd-m-y')
{
    // $date = '12-11-2022';
    // dd($date);

    if ($format == 'd/m/y') {
        $date_data = explode('/', $date);
        $date_data = explode('/', $date);
        $day = !empty($date_data[0]) ? $date_data[0] : '';
        $month = !empty($date_data[1]) ? $date_data[1] : '';
        $year = !empty($date_data[2]) ? $date_data[2] : '';
        $result = $year . '-' . $month . '-' . $day;
    } else if ($format == 'd-m-y') {
        $date_data = explode('-', $date);
        $day = !empty($date_data[0]) ? $date_data[0] : '';
        $month = !empty($date_data[1]) ? $date_data[1] : '';
        $year = !empty($date_data[2]) ? $date_data[2] : '';
        $result = $year . '-' . $month . '-' . $day;
    } else if ($format == 'm/d/y') {
        $date_data = explode('/', $date);
        $day = !empty($date_data[1]) ? $date_data[1] : '';
        $month = !empty($date_data[0]) ? $date_data[0] : '';
        $year = !empty($date_data[2]) ? $date_data[2] : '';
        $result = $year . '-' . $month . '-' . $day;
    } else if ($format == 'd/m/y H:i') {
        $datetime_data = explode(' ', $date);
        $date_data = explode('/', $datetime_data[0]);
        $day = !empty($date_data[0]) ? $date_data[0] : '';
        $month = !empty($date_data[1]) ? $date_data[1] : '';
        $year = !empty($date_data[2]) ? $date_data[2] : '';

        $time_data = !empty($datetime_data[1]) ? $datetime_data[1] : date('H:i');
        $result = $year . '-' . $month . '-' . $day . ' ' . $time_data;
    } else if ($format == 'm/d/y H:i') {
        $datetime_data = explode(' ', $date);
        $date_data = explode('/', $datetime_data[0]);
        $day = !empty($date_data[1]) ? $date_data[1] : '';
        $month = !empty($date_data[0]) ? $date_data[0] : '';
        $year = !empty($date_data[2]) ? $date_data[2] : '';

        $time_data = !empty($datetime_data[1]) ? $datetime_data[1] : date('H:i');
        $result = $year . '-' . $month . '-' . $day . ' ' . $time_data;
    } else {
        $day = date('d');
        $month = date('m');
        $year = date('Y');
        $result = $year . '-' . $month . '-' . $day;
    }

    return $result;
}

function showDate($date = '', $format = 'd-m-Y')
{
    $date = !empty($date) ? $date : date('Y-m-d');
    $result = date($format, strtotime($date));

    return $result;
}

function showDateTime($date = '', $format = 'd-m-Y H:i')
{
    $date = !empty($date) ? $date : date('Y-m-d H:i:s');
    $result = date($format, strtotime($date));

    return $result;
}

function setNumber($number, $separator = '.')
{
    $result = str_replace($separator, '', $number);
    return $result;
}

function showNumber(float $number, $separator = '.')
{
    if ($number == null) {
        $number = 0;
    }

    $result = $number != '' ? number_format($number, 2, ',', $separator) : 0;
    return $result;
}

function convertTimestampToOracle($timestamp)
{
    // get app.dbtype from env
    $dbtype = getenv('app.dbtype');
    if ($dbtype == 'mysql') {
        // "2024-06-11 12:45:41" format
        return date('Y-m-d H:i:s', strtotime($timestamp));
    }

    $date = date_create($timestamp);
    // Use 'h' for 12-hour format and 'u' for microseconds is not supported directly by Oracle
    $result = date_format($date, 'd-M-y h.i.s A');
    return $result;
}

function convertDateToOracle($date)
{
    // get app.dbtype from env
    $dbtype = getenv('app.dbtype');
    if ($dbtype == 'mysql') {
        return date('Y-m-d', strtotime($date));
    }

    $date = date_create($date);
    $result = date_format($date, 'd-M-y');
    return $result;
}
