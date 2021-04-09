<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class PaymentExport implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Payment::all();
    }
    public function map($payment) : array {
        return[
            $payment->id,
            $payment->student->user->name,
            $payment->student->nis,
            $payment->officer->user->name,
            $payment->tuition->nominal,
            $payment->month,
            $payment->year,
            url('/').'/storage/' . $payment->photo_path,
            $payment->created_at->format('d F Y')
        ];
    }
    public function headings(): array
    {
        return ['#','Student','Nis','Officer', 'Total Tuition','Month','Year','Proof of Payment','Submited_at',''];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
            $cellRange = 'A1:I1';
            $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
        },
    ];
    }
}
