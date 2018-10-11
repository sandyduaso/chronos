<?php

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Timesheet\Repositories\TimesheetRepository;

Route::middleware(['breadcrumbs:\Timesheet\Models\Timesheet'])->group(function () {
    # tests
    Route::get('timesheets/test', function () {
        $resource = \Timesheet\Models\Timesheet::find(1);
        $repository = new TimesheetRepository();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
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
            ->setSize('8px')
            ->setName('Arial Narrow');

        // Inserting data
        $i = 0;
        foreach ($resource->department() as $department => $employees) {
            $spreadsheet->createSheet();
            $spreadsheet->setActiveSheetIndex($i);
            $activeSheet = $spreadsheet->getActiveSheet($i);

            $activeSheet->setTitle(ucfirst($department));
            $activeSheet->getDefaultColumnDimension()
                ->setWidth(12);

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
                        $coordinates['name-cells'][0]+4, // merge 5 cells. Trust me 4 is 5 in this godforsaken library.
                        $coordinates['name-cells'][1]
                    )
                    ->setCellValueByColumnAndRow(
                        $coordinates['name-cells'][0],
                        $coordinates['name-cells'][1],
                        $employeeName
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
                            $currentEmpColumn++,
                            $currentEmpRow,
                            $date->time_in ?? '00:00:00'
                        )
                        ->setCellValueByColumnAndRow(
                            $currentEmpColumn++,
                            $currentEmpRow,
                            $date->time_out ?? '00:00:00'
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
                            $currentEmpColumn++,
                            $currentEmpRow,
                            $date->offset_hours ?? '00:00:00'
                        );
                    $currentEmpRow++;

                    // Footer
                    if ($employee['calendar']->last()->date === $date->date) {
                        $activeSheet
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0],
                                $c = count($employee['calendar']) + 4,
                                __('No. of lates')
                            )
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0]+1,
                                $c,
                                $repository->punchcard()->totalLateCount($employee['calendar'], 'time_in')
                            )
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0],
                                $c+1,
                                __('Max')
                            )
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0]+1,
                                $c+1,
                                $repository->punchcard()->totalLateCount($employee['calendar'], 'time_in')
                            )
                            // Total Footer
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0]+6,
                                $c,
                                $repository->punchcard()->totalFromKey($employee['calendar']->toArray(), 'tardy_time')
                            )
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0]+7,
                                $c,
                                $repository->punchcard()->totalFromKey($employee['calendar']->toArray(), 'under_time')
                            )
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0]+8,
                                $c,
                                $repository->punchcard()->totalFromKey($employee['calendar']->toArray(), 'over_time')
                            )
                            ->setCellValueByColumnAndRow(
                                $coordinates['footer'][0]+9,
                                $c,
                                $repository->punchcard()->totalFromKey($employee['calendar']->toArray(), 'offset_hours')
                            )
                            ;
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


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="file.xlsx"');
        header("Cache-Control: max-age=0");
        // header("Content-Type: application/octet-stream");
        // header("Content-Description: File Transfer");
        // header("Content-Transfer-Encoding: Binary");

        //new code:
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        // $writer->writeAllSheets();
        $writer->save('php://output');
        exit;
    });

    # TimesheetSoftDeleteResource
    Route::softDeletes('timesheets', 'TimesheetController');

    # TimesheetUploadResource
    Route::post('timesheets/export', 'TimesheetController@export')->name('timesheets.export');
    Route::post('timesheets/preview', 'TimesheetController@preview')->name('timesheets.preview');
    Route::post('timesheets/upload', 'TimesheetController@upload')->name('timesheets.upload');
    Route::post('timesheets/process', 'TimesheetController@process')->name('timesheets.process');

    # TimesheetAdminResource
    Route::resource('timesheets', 'TimesheetController');
});
