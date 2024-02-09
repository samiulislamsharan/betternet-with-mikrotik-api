<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Billing;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class UserPaymentTable extends DataTableComponent
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
            Column::make('Package')
                ->label(function ($row) {
                    $query = Billing::firstWhere('invoice', $row->invoice);
                    return __($query->package_name);
                }),
            Column::make("Price" . __(' (') . config('app.currency') . __(')'), "package_price")
                ->sortable()
                ->searchable(),
            Column::make("Payment", "payment_method")
                ->sortable(),
            Column::make("Date", "created_at")
                ->format(function ($value) {
                    return Carbon::parse($value)->format('Y-m-d');
                }),
        ];
    }

    public function builder(): Builder
    {
        return Payment::query()->where('user_id', auth()->id());
    }
}
