<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Billing;

class PackageShow extends DataTableComponent
{
    protected $model = Billing::class;

    public $package;

    public function mount($package)
    {
        $this->package = $package;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Invoice", "invoice")
                ->sortable(),
            Column::make("User name", "user.name")
                ->sortable(),
            Column::make("Package price" . __(' (') . config('app.currency') . __(')'), "package_price")
                ->sortable(),
            Column::make("Package start", "package_start")
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        return Billing::query()->where('package_name', $this->package);
    }
}
