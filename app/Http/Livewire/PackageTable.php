<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Package;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class PackageTable extends DataTableComponent
{
    protected $model = Package::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['packages.id as id'])
            ->setTableRowUrl(function($row) {
                return route('packages.show', $row);
            });
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
            LinkColumn::make('Action')
                ->title(fn($row) => 'Edit')
                ->location(fn($row) => route('packages.edit', $row)),
        ];
    }
}
