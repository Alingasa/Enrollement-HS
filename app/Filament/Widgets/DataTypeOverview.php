<?php

namespace App\Filament\Widgets;

use App\Models\Enrollment;
use App\Models\Section;
use App\Models\Strand;
use App\Models\Student;
use App\Models\Subject;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DataTypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Enrolled', Enrollment::query()->count()),
            Stat::make('Subjects', Subject::query()->count()),
            Stat::make('Strands', Strand::query()->count()),
            Stat::make('Students', Student::query()->count()),
            Stat::make('Section', Section::query()->count()),
        ];
    }
}
