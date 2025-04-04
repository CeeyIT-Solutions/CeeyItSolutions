<?php

namespace App\Exports;

use App\Models\ScholarshipApplication;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ScholarshipApplicationsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $keyword;

    // Constructor to handle filtering
    public function __construct($keyword = null)
    {
        $this->keyword = $keyword;
    }

    // Query the data
    public function query()
    {
        return ScholarshipApplication::query()
            ->with('course')
            ->when($this->keyword, function ($query) {
                $query->where('full_name', 'LIKE', "%{$this->keyword}%")
                    ->orWhere('email', 'LIKE', "%{$this->keyword}%")
                    ->orWhere('id', 'LIKE', "%{$this->keyword}%")
                    ->orWhere('phone', 'LIKE', "%{$this->keyword}%");
            });
    }

    // Add headings to the exported file
    public function headings(): array
    {
        return [
            'ID',
            'Full Name',
            'Application ID',
            'Email',
            'Phone',
            'Course Name',
            "Occupation",
            "Interest",
            "Challenges",
            "Tech Experience",
            'Tech Experience Details',
            "Goals",
            "Status",
            'Submission Date',
        ];
    }

    public function map($application): array
    {
        return [
            $application->id ?? '-',                                     // Application ID
            $application->full_name ?? '-',                              // Full Name
            'APP-' . str_pad($application->id, 6, '0', STR_PAD_LEFT),    // Custom Application ID (zero-padded)
            $application->email ?? '-',                                  // Email
            $application->phone ?? '-',                                  // Phone
            $application->course->title ?? '-',                          // Course Title
            $application->occupation === 'non_it_professional'
                ? 'Non IT Professional'
                : 'IT Professional',                                     // Occupation
            $application->interest ?? '-',                               // Interest
            $application->challenges ?? '-',                             // Challenges
            strtoupper($application->tech_experience ?? '-'),            // Tech Experience (uppercase)
            $application->tech_experience_details ?? '-',                // Tech Experience Details
            $application->goals ?? '-',                                  // Goals
            $this->getApprovalStatus($application->approval_status),      // Approval Status
            $application->created_at->format('d-m-Y h:i A'),             // Submission Date (formatted)
        ];
    }

    private function getApprovalStatus($status): string
    {
        return match ($status){
            0 => 'Pending',
            1 => 'Accepted',
            2 => 'Rejected',
            default => 'Pending',
        };
    } 
}