<?php
function construct()
{
    load_model('revenue');
}
function indexAction()
{
    $dateTime = getdate();
    $listDay = get_revenue($dateTime['mon'], $dateTime['year']);
    $listProductByMonth = get_revenue_product($dateTime['mon'], $dateTime['year']);
    $num_per_page = 20;
    $getMonth = get_list_day_data();
    $getYear = get_list_year_data();
    $total_row = count($listProductByMonth);
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page_current = $page;
    $start = ($page - 1) * $num_per_page;
    $list_product_buy_month = get_product_buy_month_paging($start, $num_per_page, $dateTime['mon'], $dateTime['year']);
    $base_url = "?mod=order&controller=revenue&action=index";
    if (isset($_POST['btn_search'])) {
        $months = $_POST['search-month'];
        $years = $_POST['search-year'];
        $listDay = get_revenue($months, $years);
        $listProductByMonth = get_revenue_product($months, $years);
        $list_product_buy_month = get_product_buy_month_paging($start, $num_per_page,  $months, $years);
        $base_url = "?mod=order&controller=revenue&action=index&month=$months&year=$years";
    }
    $data = array(
        'num_page' => $num_page,
        'page' => $page,
        'listDay' => $listDay,
        'listProductByMonth' => $listProductByMonth,
        'list_product_buy_month' => $list_product_buy_month,
        'dateTime' => $dateTime,
        'base_url' => $base_url,
        'getMonth' => $getMonth,
        'getYear' => $getYear
    );
    load_view('revenue', $data);
}

function detailProductBuyMonthAction()
{
    $dateTime = getdate();
    global $day, $month, $year;
    if (isset($_GET['pages'])) {
        $page = $_GET['pages'];
        unset($day);
        $day = substr("$_GET[time]", 0, 2);
        $month = substr("$_GET[time]", 3, -5);
        $year = substr("$_GET[time]", 6, 11);
    } else {
        unset($day);
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $day = substr("$_POST[time]", 0, 2);
        $month = substr("$_POST[time]", 3, -5);
        $year = substr("$_POST[time]", 6, 11);
    }
    $list_product_buy_day = get_list_product_buy_day($day, $month, $year);
    $str = '';
    $num_per_page = 10;
    $total_row = count($list_product_buy_day);
    $num_page = ceil($total_row / $num_per_page);
    $start = ($page - 1) * $num_per_page;
    $temp = $start;
    $list_product_buy_day_paging = get_list_product_buy_day_paging($start, $num_per_page, $day, $month, $year);
    $base_url = "?mod=order&controller=revenue&action=index";
    $paging = get_pagging($num_page, $page, $base_url);
    foreach ($list_product_buy_day_paging as $item) {
        $temp++;
        $revenue = currency_format($item['DoanhThu']);
        $str .= "<tr>
                    <td><span class='thead-text'>$temp</span></td>
                    <td class='text-left'><span class='thead-text'>$item[name_product]</span></td>
                    <td><span class='thead-text'>$item[SoLuong]</span></td> 
                    <td><span class='thead-text'>$revenue</span></td>
                </tr>";
    }
    $data = array(
        'day' => $day,
        'paging' => $paging,
        'month' => $month,
        'year' => $year,
        'str' => $str,
        'list_product_buy_day_paging' => $list_product_buy_day_paging
    );
    if (!empty($str)) {
        echo json_encode($data);
    } else {
        echo json_encode("Error");
    }
}
function exportExcelAction()
{
    $username = $_SESSION['user_login'];
    $info_user = get_info_user($username);
    $dateTime = getdate();
    $listDay = get_revenue($dateTime['mon'], $dateTime['year']);
    $listProductByMonth = get_revenue_product($dateTime['mon'], $dateTime['year']);
    $excel = new PHPExcel();
    $excel->setActiveSheetIndex(0);
    $excel->getActiveSheet()->setTitle('TKBC-Tháng');
    $excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $excel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "THỐNG KÊ BÁO CÁO DOANH THU");
    $excel->getActiveSheet()->mergeCells('A1:H1');
    $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );
    $excel->getActiveSheet()->getStyle("A1:H1")->applyFromArray($style);
    $excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
    $excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setSize(18);
    $excel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, "Bảng 1: Doanh thu trong ngày");
    $excel->getActiveSheet()->mergeCells('A3:C3');
    $excel->getActiveSheet()->getStyle('A3:C3')->getFont()->setItalic(true);
    $excel->getActiveSheet()->setCellValueByColumnAndRow(4, 3, "Bảng 2: Danh sách sản phẩm bán ra trong tháng");
    $excel->getActiveSheet()->mergeCells('E3:H3');
    $excel->getActiveSheet()->getStyle('E3:H3')->getFont()->setItalic(true);
    $excel->getActiveSheet()->setCellValue('A4', 'STT');
    $excel->getActiveSheet()->setCellValue('B4', 'Ngày');
    $excel->getActiveSheet()->setCellValue('C4', 'Doanh thu');
    $excel->getActiveSheet()->setCellValue('E4', 'STT');
    $excel->getActiveSheet()->setCellValue('F4', 'Tên sản phẩm');
    $excel->getActiveSheet()->setCellValue('G4', 'Số lượng bán ra');
    $excel->getActiveSheet()->setCellValue('H4', 'Doanh thu đạt được');
    $excel->getActiveSheet()->getStyle('A4:H4')->getFont()->setBold(true);
    $excel->getActiveSheet()->getStyle('A4:C4')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('00ffff00');
    $excel->getActiveSheet()->getStyle('E4:H4')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('00ffff00');
    $excel->getActiveSheet()->getStyle('A4:H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $numRow = 5;
    $temp = 0;
    foreach ($listDay as $row) {
        $temp++;
        $excel->getActiveSheet()->setCellValue('A' . $numRow, $temp);
        $excel->getActiveSheet()->setCellValue('B' . $numRow, $row['Ngay']);
        $excel->getActiveSheet()->setCellValue('C' . $numRow, $row['DoanhThu']);
        $excel->getActiveSheet()->getStyle('C' . $numRow)->getNumberFormat()->setFormatCode('#,###');
        $numRow++;
    }
    // "=SUM(J5:J".($row-1).")"
    // $excel->getActiveSheet()->setCellValue('C'.($numRow),"=SUM(C5:C"."$numRow)/COUNT(C5:C" . "$numRow)");
    $style_boder = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            )
        )
    );
    $excel->getActiveSheet()->getStyle("A4:" . "C" . ($numRow - 1))->applyFromArray($style_boder);
    $numRow1 = 5;
    $temp = 0;
    foreach ($listProductByMonth as $row) {
        $temp++;
        $excel->getActiveSheet()->setCellValue('E' . $numRow1, $temp);
        $excel->getActiveSheet()->setCellValue('F' . $numRow1, $row['name_product']);
        $excel->getActiveSheet()->setCellValue('G' . $numRow1, $row['SoLuong']);
        $excel->getActiveSheet()->setCellValue('H' . $numRow1, $row['DoanhThu']);
        $excel->getActiveSheet()->getStyle('H' . $numRow1)->getNumberFormat()->setFormatCode('#,###');
        $numRow1++;
    }
    $excel->getActiveSheet()->getStyle("E4:" . "H" . ($numRow1 - 1))->applyFromArray($style_boder);
    $excel->getActiveSheet()->setCellValue('H' . ($numRow1 + 1), "Ngày " . $dateTime['mday'] . " tháng " . $dateTime['mon'] . " năm " . $dateTime['year']);
    $excel->getActiveSheet()->setCellValue('H' . ($numRow1 + 2), "Người xuất báo cáo");
    $excel->getActiveSheet()->setCellValue('H' . ($numRow1 + 6), $info_user['fullname']);
    $excel->getActiveSheet()->getStyle('H' . ($numRow1 + 1))->getFont()->setItalic(true);
    $excel->getActiveSheet()->getStyle('H' . ($numRow1 + 2))->getFont()->setBold(true);
    $excel->getActiveSheet()->getStyle('H' . ($numRow1 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->getActiveSheet()->getStyle('H' . ($numRow1 + 2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->getActiveSheet()->getStyle('H' . ($numRow1 + 6))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $export = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    header('Content-type: application/vnd.ms-excel');
    header('Content-Transfer-Ecoding:binary');
    header('Content-Disposition: attachment; filename="BCDT.xlsx"');
    header('Cache-Control: must-revalidate');
    header('Cache-control: max-age=0');
    ob_end_clean();
    $export->save('php://output');
    exit();
}
