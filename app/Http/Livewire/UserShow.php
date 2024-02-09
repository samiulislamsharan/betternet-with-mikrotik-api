<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Billing;

class UserShow extends DataTableComponent
{
    protected $model = Billing::class;

    public $user;

    public function mount($user)
    {
        $this->user = $user;
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
            Column::make("Package name", "package_name")
                ->sortable(),
            Column::make("Package price" . __(' (') . config('app.currency') . __(')'), "package_price")
                ->sortable(),
            Column::make("Package start", "package_start")
                ->sortable(),
            Column::make('Method')
                ->label(function ($row) {
                    $query = Payment::firstWhere('invoice', $row->invoice);
                    if ($query) {
                        return $query->payment_method;
                    } else {
                        return view('billing.payment', compact('row'));
                    }
                }),
            Column::make('Payment date')
                ->label(function ($row) {
                    $query = Payment::firstWhere('invoice', $row->invoice);
                    if ($query) {
                        return date('Y-m-d', strtotime($query->created_at));
                    } else {
                        return '-';
                    }
                }),
        ];
    }

    public function builder(): Builder
    {
        return Billing::query()->where('user_id', $this->user);
    }
}
