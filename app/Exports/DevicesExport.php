<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class DevicesExport implements WithEvents
{
	protected $data;

	public function __construct($data)
	{
		$this->data=$data;
	}

    public function registerEvents(): array
    {
		return [
			AfterSheet::class => function(AfterSheet $event) {
				$sheet = $event->sheet;
                $sheet->autosize(true);
                $sheet->setTitle(('Reporte de inventario'));
                $sheet->mergeCells('A1:G1');

				$sheet->getStyle('A1:G1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 11,
                        'name' => 'Calibri',
                        'color' => ['rgb' => 'FFFFFF']
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '141618',
                        ],
                    ],
                ]);

				$sheet->setCellValue('A1','REPORTE DE INVENTARIO '.date('Y-m-d H:i'));

				$sheet->getStyle('A'.$sheet->getHighestRow()+(2).':G'.$sheet->getHighestRow()+(2))->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 11,
                        'color' => ['rgb' => 'ffffff'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '2d4154'],
                    ],
                ]);

				$sheet->autoSize(true);
                $sheet->setCellValue('A'.$sheet->getHighestRow(), 'ID');
                $sheet->setCellValue('B'.$sheet->getHighestRow(), 'MAC');
                $sheet->setCellValue('C'.$sheet->getHighestRow(), 'Marca');
                $sheet->setCellValue('D'.$sheet->getHighestRow(), 'Tipo');
                $sheet->setCellValue('E'.$sheet->getHighestRow(), 'IP');
                $sheet->setCellValue('F'.$sheet->getHighestRow(), 'Oficina');
                $sheet->setCellValue('G'.$sheet->getHighestRow(), 'Encargado');

				foreach($this->data as $key => $item)
                {
					$sheet->autosize(true);
					$sheet->setCellValue('A'.$sheet->getHighestRow()+(1), $item->id);
                    $sheet->setCellValue('B'.$sheet->getHighestRow(), $item->mac);
                    $sheet->setCellValue('C'.$sheet->getHighestRow(), $item->brand);
                    $sheet->setCellValue('D'.$sheet->getHighestRow(), $item->type);
                    $sheet->setCellValue('E'.$sheet->getHighestRow(), $item->network->ip);
                    $sheet->setCellValue('F'.$sheet->getHighestRow(), $item->office->name);
                    $sheet->setCellValue('G'.$sheet->getHighestRow(), $item->staff->fullname);

					if($key % 2==0)
					{
						$sheet->getStyle('A'.($sheet->getHighestRow()).':G'.$sheet->getHighestRow())->applyFromArray([
							'fill' => [
								'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
								'startColor' => [
									'rgb' => 'FAFDFF',
								],
							],
							'borders' => [
								'outline' => [
									'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
									'color' => ['argb' => '000000'],
								],
							],
						]);
						$sheet->getStyle('A'.($sheet->getHighestRow()).':G'.$sheet->getHighestRow())->applyFromArray([
							'alignment' => [
								'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							],
						]);
					}
					else
					{
						$sheet->getStyle('A'.($sheet->getHighestRow()).':G'.$sheet->getHighestRow())->applyFromArray([
							'fill' => [
								'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
								'startColor' => [
									'rgb' => 'DFE0E0',
								],
							],
							'borders' => [
								'outline' => [
									'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
									'color' => ['argb' => '000000'],
								],
							],
						]);
						$sheet->getStyle('A'.($sheet->getHighestRow()).':G'.$sheet->getHighestRow())->applyFromArray([
							'alignment' => [
								'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							],
						]);
					}
				}
			}
		];
	}
}