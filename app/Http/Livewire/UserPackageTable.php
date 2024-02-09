<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Package;

class UserPackageTable extends DataTableComponent
{
    protected $model = Package::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Package name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Price" . __(' (') . config('app.currency') . __(')'), "price")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->format(function ($value) {
                    return Carbon::parse($value)->format('Y-m-d');
                }),
        ];
    }
}
