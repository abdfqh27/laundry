<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Transaction::with(['order.customer', 'confirmedBy']);

        if (!empty($this->filters['start_date'])) {
            $query->whereDate('created_at', '>=', $this->filters['start_date']);
        }
        if (!empty($this->filters['end_date'])) {
            $query->whereDate('created_at', '<=', $this->filters['end_date']);
        }
        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }
        if (!empty($this->filters['payment_method'])) {
            $query->where('payment_method', $this->filters['payment_method']);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Order Number',
            'Customer',
            'Amount',
            'Payment Method',
            'Status',
            'Confirmed By',
            'Confirmed At',
            'Created At',
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->id,
            $transaction->order->order_number ?? '-',
            $transaction->order->customer->name ?? '-',
            $transaction->amount,
            ucfirst($transaction->payment_method),
            ucfirst($transaction->status),
            $transaction->confirmedBy->name ?? '-',
            $transaction->confirmed_at ? $transaction->confirmed_at->format('d/m/Y H:i') : '-',
            $transaction->created_at->format('d/m/Y H:i'),
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
        return 'Transactions';
    }
}
