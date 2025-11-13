<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Order::with(['customer', 'karyawan']);

        if (!empty($this->filters['start_date'])) {
            $query->whereDate('created_at', '>=', $this->filters['start_date']);
        }
        if (!empty($this->filters['end_date'])) {
            $query->whereDate('created_at', '<=', $this->filters['end_date']);
        }
        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }
        if (!empty($this->filters['payment_status'])) {
            $query->where('payment_status', $this->filters['payment_status']);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Order Number',
            'Customer',
            'Karyawan',
            'Total Amount',
            'Status',
            'Payment Status',
            'Pickup Date',
            'Completed At',
            'Created At',
        ];
    }

    public function map($order): array
    {
        return [
            $order->order_number,
            $order->customer->name ?? '-',
            $order->karyawan->name ?? '-',
            $order->total_amount,
            ucfirst($order->status),
            ucfirst($order->payment_status),
            $order->pickup_date ? date('d/m/Y H:i', strtotime($order->pickup_date)) : '-',
            $order->completed_at ? $order->completed_at->format('d/m/Y H:i') : '-',
            $order->created_at->format('d/m/Y H:i'),
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
        return 'Orders';
    }
}
