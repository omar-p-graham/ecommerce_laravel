<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full'; //Let the "LatestOrders" widget on the dashboard be full width

    protected static ?int $sort = 2; //Let the LatestOrders widget be the second row
    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at','desc')
            ->columns([
                TextColumn::make('id')
                    ->label('Order ID')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Order Date/Time')
                    ->sortable()
                    ->dateTime(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state):string => match($state){
                        'new' => 'gray',
                        'processing' => 'warning',
                        'shipped' => 'info',
                        'delivered' => 'success',
                        'cancelled' => 'danger'
                    })
                    ->icon(fn(string $state):string => match($state){
                        'new' => 'heroicon-m-sparkles',
                        'processing' => 'heroicon-m-arrow-path',
                        'shipped' => 'heroicon-m-truck',
                        'delivered' => 'heroicon-m-check-badge',
                        'cancelled' => 'heroicon-m-x-circle'
                    })
                    ->sortable()
                    ->formatStateUsing(fn(string $state)=> ucfirst($state)),
                TextColumn::make('payment_status')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(fn(string $state)=> ucfirst($state))
                    ->color(fn(string $state):string => match($state){
                        'pending' => 'warning',
                        'paid' => 'success',
                        'failed' => 'danger'
                    }),
                TextColumn::make('cost')
                    ->label('Grand Total')
                    ->sortable()
                    ->money()
            ])
            ->actions([
                Action::make('View Order')
                    ->url(fn(Order $record):string => OrderResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-o-eye')
            ]);
    }
}
