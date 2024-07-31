<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('id')
                    ->label('Order ID')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Order Date/Time')
                    ->sortable(),
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
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Action::make('View Order')
                    ->url(fn(Order $record):string => OrderResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-o-eye'),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
