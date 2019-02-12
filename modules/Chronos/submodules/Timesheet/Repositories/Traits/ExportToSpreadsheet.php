<?php

namespace Timesheet\Repositories\Traits;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;

trait ExportToSpreadsheet
{
    /**
     * Export to spreadsheet format.
     *
     * @param \Timesheet\Models\Timesheet $resource
     * @param array $data
     * @return void
     */
    public function buildSpreadsheet($resource, $data)
    {
        $repository = $this;
        $spreadsheet = new Spreadsheet();
        $spreadsheet
            ->getProperties()
            ->setCreator(user()->fullname)
            ->setLastModifiedBy(user()->fullname)
            ->setTitle($resource->name)
            ->setSubject($resource->name)
            ->setDescription($resource->description);

        $spreadsheet
            ->getDefaultStyle()
            ->getFont()
            ->setSize(8)
            ->setName('Arial Narrow');

        $spreadsheet
            ->getActiveSheet()
            ->getPageSetup()
            ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

        $spreadsheet
            ->getActiveSheet()
            ->getPageSetup()
            ->setFitToPage(true)
            ->setPaperSize(PageSetup::PAPERSIZE_A4);


        // Inserting data
        $i = 0;
        foreach ($resource->department() as $department => $employees) {
            $spreadsheet->createSheet();
            $spreadsheet->setActiveSheetIndex($i);
            $activeSheet = $spreadsheet->getActiveSheet($i);

            $activeSheet->setTitle(ucfirst($department));
            $activeSheet->setShowGridlines(false);

            $activeSheet
                ->getDefaultColumnDimension()
                ->setWidth(14);

            $activeSheet
                ->getPageMargins()
                ->setTop(0.5);

            // More options
            $activeSheet->freezePane('D4');

            // A
            $activeSheet
                ->getColumnDimension('A')
                ->setWidth(3);

            // Starts with B1:B2
            $activeSheet
                ->setCellValue('B2', __(ucfirst($department)))
                ->setCellValue('B1', __($resource->name))
                ->getStyle('B1')
                ->getFont()
                ->setSize('7px')
                ->setBold(true)
                ->setItalic(true);

            $coordinates = [
                'hours-text-headers' => [9,1],
                'hours-value-headers' => [9,2],
                'time-text-headers' => [4,3],
                'name-cells' => [4, 2], // [column, row],
                'calendar' => [2,4],
                'data' => [4,4],
                'footer' => [3,34],
            ];
            $defaults = [
                'default-time-in' => settings('timesheet_default_time_in', '09:00 AM'),
                'default-time-out' => settings('timesheet_default_time_out', '06:15 PM'),
                'default-over-time' => settings('timesheet_default_time_out', '06:15 PM'),
                'default-tardy' => '',
            ];
            foreach ($employees as $card_id => $employee) {
                # Cells for Hours texts/values
                $activeSheet
                    // I1:L1
                    ->setCellValueByColumnAndRow($coordinates['hours-text-headers'][0]++, $coordinates['hours-text-headers'][1], __('Hours Late'))
                    ->setCellValueByColumnAndRow($coordinates['hours-text-headers'][0]++, $coordinates['hours-text-headers'][1], __('Under Time'))
                    ->setCellValueByColumnAndRow($coordinates['hours-text-headers'][0]++, $coordinates['hours-text-headers'][1], __('Over Time'))
                    ->setCellValueByColumnAndRow($coordinates['hours-text-headers'][0]++, $coordinates['hours-text-headers'][1], __('Offset for Tardy'))
                    // I2:L2
                    ->setCellValueByColumnAndRow($coordinates['hours-value-headers'][0]++, $coordinates['hours-value-headers'][1], $defaults['default-time-in'])
                    ->setCellValueByColumnAndRow($coordinates['hours-value-headers'][0]++, $coordinates['hours-value-headers'][1], $defaults['default-time-out'])
                    ->setCellValueByColumnAndRow($coordinates['hours-value-headers'][0]++, $coordinates['hours-value-headers'][1], $defaults['default-over-time'])
                    ->setCellValueByColumnAndRow($coordinates['hours-value-headers'][0]++, $coordinates['hours-value-headers'][1], $defaults['default-tardy'])
                    // D3:H3
                    ->setCellValueByColumnAndRow($coordinates['time-text-headers'][0]++, $coordinates['time-text-headers'][1], __('Time In'))
                    ->setCellValueByColumnAndRow($coordinates['time-text-headers'][0]++, $coordinates['time-text-headers'][1], __('Time Out'))
                    ->setCellValueByColumnAndRow($coordinates['time-text-headers'][0]++, $coordinates['time-text-headers'][1], __('Work TI'))
                    ->setCellValueByColumnAndRow($coordinates['time-text-headers'][0]++, $coordinates['time-text-headers'][1], __('Work TO'))
                    ->setCellValueByColumnAndRow($coordinates['time-text-headers'][0]++, $coordinates['time-text-headers'][1], __('Work Hours'));

                // Employee name
                $employeeName = $employee['user']
                    ? $employee['user']->displayname
                    : ($employee['metadata']->lastname ?? $card_id);

                // Merge cells for name
                $activeSheet
                    ->mergeCellsByColumnAndRow(
                        $coordinates['name-cells'][0],
                        $coordinates['name-cells'][1],
                        $coordinates['name-cells'][0]+4,
                        $coordinates['name-cells'][1]
                    )
                    ->setCellValueByColumnAndRow(
                        $coordinates['name-cells'][0],
                        $coordinates['name-cells'][1],
                        (string) $employeeName
                    );

                // Calendar Loop
                $currentEmpRow = $coordinates['data'][1];
                $currentCalendarRow = $coordinates['calendar'][1];
                foreach ($employee['calendar'] as $j => $date) {
                    $currentEmpColumn = $coordinates['data'][0];
                    $currentEmpRow = $currentEmpRow;
                    $currentCalendarColumn = $coordinates['calendar'][0];
                    $currentCalendarRow = $currentCalendarRow++;
                    $activeSheet
                        // B4
                        ->setCellValueByColumnAndRow(
                            $currentCalendarColumn,
                            $currentCalendarRow,
                            $date->dayletter
                        )
                        // C4
                        ->setCellValueByColumnAndRow(
                            $currentCalendarColumn+1,
                            $currentCalendarRow,
                            $date->dated
                        )
                        ->getStyleByColumnAndRow($currentCalendarColumn+1, $currentCalendarRow)
                        ->getNumberFormat()

                        ->setFormatCode(NumberFormat::FORMAT_DATE_DMYMINUS);
                    $currentCalendarRow++;

                    // Actual Time in/out
                    $activeSheet
                        ->setCellValueByColumnAndRow(
                            $cEC = $currentEmpColumn++,
                            $cER = $currentEmpRow,
                            $date->time_in
                        );
                    // $activeSheet->getStyleByColumnAndRow($cEC, $cER)
                    //     ->getNumberFormat()
                    //     ->setFormatCode(NumberFormat::FORMAT_DATE_TIME6);

                    $activeSheet->setCellValueByColumnAndRow(
                            $currentEmpColumn++,
                            $currentEmpRow,
                            $date->time_out
                        )
                        ->setCellValueByColumnAndRow(
                            $currentEmpColumn++,
                            $currentEmpRow,
                            $date->total_am ?? '00:00:00'
                        )
                        ->setCellValueByColumnAndRow(
                            $currentEmpColumn++,
                            $currentEmpRow,
                            $date->total_pm ?? '00:00:00'
                        )
                        ->setCellValueByColumnAndRow(
                            $currentEmpColumn++,
                            $currentEmpRow,
                            $date->total_time ?? '00:00:00'
                        )
                        ->setCellValueByColumnAndRow(
                            $currentEmpColumn++,
                            $currentEmpRow,
                            $date->tardy_time ?? '00:00:00'
                        )
                        ->setCellValueByColumnAndRow(
                            $currentEmpColumn++,
                            $currentEmpRow,
                            $date->under_time ?? '00:00:00'
                        )
                        ->setCellValueByColumnAndRow(
                            $currentEmpColumn++,
                            $currentEmpRow,
                            $date->over_time ?? '00:00:00'
                        )
                        ->setCellValueByColumnAndRow(
                            $currentEmpColumn,
                            $currentEmpRow,
                            $date->offset_hours ?? '00:00:00'
                        );

                        // highlight
                        if ($date->weekend) {
                            $activeSheet
                                ->getStyleByColumnAndRow(1,$cER,$currentEmpColumn,$currentEmpRow)
                                ->applyFromArray([
                                    'fill' => [
                                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                        'startColor' => [
                                            'argb' => '10C399'],
                                        ],
                                ]);
                        }

                    $currentEmpRow++;


                    // Footer
                    if ($employee['calendar']->last()->date === $date->date) {
                        $activeSheet
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0],
                                $c = count($employee['calendar']) + 4,
                                __('No. of lates')
                            );
                        $activeSheet
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0]+1,
                                $c,
                                $repository->punchcard()->totalLateCount($employee['calendar'], 'time_in')
                            );
                        $activeSheet
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0],
                                $c+1,
                                __('Max')
                            );
                        $activeSheet
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0]+1,
                                $c+1,
                                $repository->punchcard()->maxFromArray($employee['calendar'], 'time_in')
                            );
                            // Total Footer
                        $activeSheet
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0]+6,
                                $c,
                                $repository->punchcard()->totalFromKey($employee['calendar']->where('weekend', 0)->toArray(), 'tardy_time')
                            );
                        $activeSheet
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0]+7,
                                $c,
                                $repository->punchcard()->totalFromKey($employee['calendar']->where('weekend', 0)->toArray(), 'under_time')
                            );
                        $activeSheet
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0]+8,
                                $c,
                                $repository->punchcard()->totalFromKey($employee['calendar']->where('weekend', 0)->toArray(), 'over_time')
                            );
                        $activeSheet
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0]+9,
                                $c,
                                $repository->punchcard()->totalFromKey($employee['calendar']->where('weekend', 0)->toArray(), 'offset_hours')
                            );
                    }

                }
                $coordinates['calendar'][0] = $coordinates['calendar'][0];
                $coordinates['calendar'][1] = $coordinates['calendar'][1];
                $coordinates['data'][0] = $coordinates['data'][0]+10;
                $coordinates['data'][1] = $coordinates['data'][1];
                $coordinates['footer'][0] = $coordinates['footer'][0]+10;
                $coordinates['footer'][1] = $coordinates['footer'][1];

                $coordinates['hours-text-headers'][0] = $coordinates['hours-text-headers'][0]+6;
                $coordinates['hours-value-headers'][0] = $coordinates['hours-value-headers'][0]+6;
                $coordinates['time-text-headers'][0] = $coordinates['time-text-headers'][0]+5;
                $coordinates['name-cells'][0] = $coordinates['name-cells'][0]+10;
            }
            $i++;
        }

        return $spreadsheet;
    }

    /**
     * Export to pdf.
     *
     * @param \Timesheet\Models\Timesheet $resource
     * @param array $data
     * @return void
     */
    public function toPDF($resource, $data)
    {
        $spreadsheet = $this->buildSpreadsheet($resource, $data);
        // dd($spreadsheet);

        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$data['filename'].'.pdf"');
        // header("Cache-Control: max-age=0");
        // header("Content-Type: application/octet-stream");
        // header("Content-Description: File Transfer");
        // header("Content-Transfer-Encoding: Binary");

        $writer = new Dompdf($spreadsheet);
        $writer->setPreCalculateFormulas(false);
        $writer->writeAllSheets();
        $writer->save('php://output');
    }

    /**
     * Export to spreadsheet format.
     *
     * @param \Timesheet\Models\Timesheet $resource
     * @param array $data
     * @return void
     */
    public function toSpreadsheet($resource, $data)
    {
        $spreadsheet = $this->buildSpreadsheet($resource, $data);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$data['filename'].'.xlsx"');
        header("Cache-Control: max-age=0");
        header("Content-Type: application/octet-stream");
        header("Content-Description: File Transfer");
        header("Content-Transfer-Encoding: Binary");

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
