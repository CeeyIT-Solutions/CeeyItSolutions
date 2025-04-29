<?php

namespace App\Exports;

use App\Models\LaptopApplication;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Log;

class LaptopApplicationsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $keyword;
    protected $dateSort;
    protected $applyYear;
    protected $operator;

    // Constructor to handle filtering
    public function __construct($keyword = null, $dateSort = "desc", $applyYear = null, $operator = null)
    {
        $this->keyword = $keyword;
        $this->dateSort = $dateSort;
        $this->applyYear = $applyYear;
        $this->operator = $operator;
    }

    // Query the data
    public function query()
    {

        Log::info($this->dateSort);
        return LaptopApplication::query()
            ->with('course')
            ->orderBy('created_at', $this->dateSort ?? 'desc')
            ->when($this->applyYear, function ($query) {
                $query->where('apply_year', $this->operator, $this->applyYear);
            })
            ->when($this->keyword, function ($query) {
                $query->where('full_name', 'LIKE', "%{$this->keyword}%")
                    ->orWhere('email', 'LIKE', "%{$this->keyword}%")
                    ->orWhere('phone', 'LIKE', "%{$this->keyword}%");
            });
    }

    // Add headings to the exported file
    public function headings(): array
    {
        return [
            'ID',
            'Full Name',
            'Email',
            'Phone',
            'Course Name',
            'Reason ',
            'Submission Date',
        ];
    }

    public function map($application): array
    {
        return [
            $application->id ?? '-',                                     // Application ID
            $application->full_name ?? '-',                              // Full Name
            $application->email ?? '-',                                  // Email
            $application->phone ?? '-',                                  // Phone
            $application->course->title ?? '-',                          // Course Title
            $application->reason ?? '-',                          // Course Title
            $application->created_at->format('d-m-Y h:i A'),             // Submission Date (formatted)
        ];
    }
}