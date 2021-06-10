<?php

namespace App\Exports;

use App\Transaction_report;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Maatwebsite\Excel\Concerns\FromQuery;

class ReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(string $program = null)
    {
        // string $nik, string $name, string $program, string $kerja
        // $request->start = $start;
        // $request->end   = $end;
        // $this->start = $start;
        // $this->end = $end;
        // return $this;
        // $this->nik = $nik;
        // $this->name = $name;
        $this->program = $program;
        // $this->kerja = $kerja;
        // return $this;
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:AB1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13);
            },
        ];
    }
    public function headings(): array
    {
        return [
            // 'ID',
            'Editor NIK',
            'Editor Name',
            'Editor Email',
            'Program',
            'Date',
            'Shift',
            'System Kerja',
            'Segment',
            'Episode',
            'User Pendamping',
            'Request ID',
            'Remark',
            'Booth',
            'Alasan_WFO',
            'Alat_WFH',
            'Provider_WFH',
            'Download Speed_WFH',
            'Quotausage_WFH',
            'Screenshoot_WFH',
            'Remark_WFH',
            'Copy Size',
            'Copy Segment',
            'Copy Date',
            'Copy Remark',
            'Code',
            'Prabudget ID ',
            'Report Susulan',
            'Alasan Susulan',
            ' ',
            ' '
        ];
    }
    // public function collection(){
    //     // return Transaction_report::all();
    //     return Transaction_report::where('logeditingreport_date', '2021-05-11 00:00:00.000')->get();
    //     // dd($start);
    //     // return Transaction_report::where('logeditingreport_date','>=',$this->start)->where('logeditingreport_date','<=', $this->end)->select()->get();
    
    //     // $start = $request->start;
    //     // $end = $request->end;
    //     // return Transaction_report::select()->where('logeditingreport_date','>=',array($start))->where('logeditingreport_date','<=', array($end))->get();
    // }
    // public function columnWidths(): array
    // {
    //     return [
    //         'A' => 55,
    //         'B' => 55,            
    //     ];
    // }

    public function collection()
    {
        return Transaction_report::where('logeditingreport_program', '=', $this->program)
                // ->where('logeditingreport_editor_nik', '=', $this->nik)
                // ->where('logeditingreport_editor_name', '=', $this->name)
                // ->where('logeditingreport_systemkerja', '=', $this->kerja)
                ->select()
                ->get();
    }
}
