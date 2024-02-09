<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Payment;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class PaymentTable extends DataTableComponent
{
    protected $model = Payment::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Invoice", "invoice")
                ->sortable()
                ->searchable(),
            Column::make("User", "user.name")
                ->sortable()
                ->searchable(),
            Column::make("Package", "billing.package_name")
                ->sortable()
                ->searchable(),
            Column::make("Price" . __(' (') . config('app.currency') . __(')'), "package_price")
                ->sortable()
                ->searchable(),
            Column::make("Method", "payment_method")
                ->sortable(),
            Column::make("Date", "created_at")
                ->format(function ($value) {
                    return Carbon::parse($value)->format('Y-m-d');
                }),
            LinkColumn::make('Action')
                ->title(fn($row) => 'Download')
                ->location(fn($row) => route('invoice.download', $row->invoice)),
        ];
    }
}
