<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = User::where('role', 'customer')
            ->withCount(['orders'])
            ->withSum(['orders as total_spent' => function($query) {
                $query->where('payment_status', 'paid');
            }], 'total_amount');

        if (!empty($this->filters['start_date']) || !empty($this->filters['end_date'])) {
            $query->whereHas('orders', function($q) {
                if (!empty($this->filters['start_date'])) {
                    $q->whereDate('created_at', '>=', $this->filters['start_date']);
                }
                if (!empty($this->filters['end_date'])) {
                    $q->whereDate('created_at', '<=', $this->filters['end_date']);
                }
            });
        }

        return $query->orderBy('total_spent', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Total Orders',
            'Total Spent',
            'Joined Date',
        ];
    }

    public function map($customer): array
    {
        return [
            $customer->name,
            $customer->email,
            $customer->phone ?? '-',
            $customer->orders_count,
            $customer->total_spent ?? 0,
            $customer->created_at->format('d/m/Y'),
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
        return 'Customers Report';
    }
}