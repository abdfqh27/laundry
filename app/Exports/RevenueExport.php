<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class RevenueExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $transactions;
    protected $startDate;
    protected $endDate;

    public function __construct($transactions, $startDate, $endDate)
    {
        $this->transactions = $transactions;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        // Group by date
        return $this->transactions->groupBy(function($item) {
            return Carbon::parse($item->confirmed_at)->format('Y-m-d');
        })->map(function($dayTransactions, $date) {
            return [
                'date' => $date,
                'total' => $dayTransactions->sum('amount'),
                'count' => $dayTransactions->count(),
                'cash' => $dayTransactions->where('payment_method', 'cash')->sum('amount'),
                'transfer' => $dayTransactions->where('payment_method', 'transfer')->sum('amount'),
                'qris' => $dayTransactions->where('payment_method', 'qris')->sum('amount'),
            ];
        })->values();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Total Revenue',
            'Transaction Count',
            'Cash',
            'Transfer',
            'QRIS',
        ];
    }

    public function map($row): array
    {
        return [
            Carbon::parse($row['date'])->format('d/m/Y'),
            $row['total'],
            $row['count'],
            $row['cash'],
            $row['transfer'],
            $row['qris'],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Revenue Report';
    }
}