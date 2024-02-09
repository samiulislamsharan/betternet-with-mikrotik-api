<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Billing;

class BillingTable extends DataTableComponent
{
    protected $model = Billing::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['billings.id as id']);
    }

    public function columns(): array
    {
        return [
            Column::make("Invoice", "invoice")
                ->sortable()
                ->searchable(),
            Column::make("User name", "user.name")
                ->sortable()
                ->searchable(),
            Column::make("Package name", "package_name")
                ->sortable()
                ->searchable(),
            Column::make("Package price" . __(' (') . config('app.currency') . __(')'), "package_price")
                ->sortable()
                ->searchable(),
            Column::make("Package start", "package_start")
                ->sortable(),
            Column::make('Payment')
                ->label(function ($row) {
                    $query = Payment::firstWhere('billing_id', $row->id);
                    if ($query) {
                        return __('Paid');
                    } else {
                        return view('billing.payment', compact('row'));
                    }
                }),
        ];
    }
}
