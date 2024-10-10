<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Number;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 6; //Place the Order navigation 6th in the menu list

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Order Information')->schema([
                        Select::make('user_id')
                            ->label('Customer')
                            ->relationship('user','name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('payment_status')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'failed' => 'Failed'
                            ])
                            ->default('pending')
                            ->required(),
                        Select::make('currency')
                            ->options([
                                'usd' => 'USD',
                                'eur' => 'EUR',
                                'gpb' => 'GBP'
                            ])->default('usd')
                            ->required(),
                        Select::make('shipping_method')
                            ->options([
                                'fedex' => 'FedEx',
                                'dhl' => 'DHL',
                                'ups' => 'UPS',
                                'usps' => 'USPS'
                            ])
                            ->required(),
                        ToggleButtons::make('status')
                            ->inline()
                            ->options([
                                'new' => 'New',
                                'processing' => 'Processing',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled'
                            ])
                            ->colors([
                                'new' => 'gray',
                                'processing' => 'warning',
                                'shipped' => 'info',
                                'delivered' => 'success',
                                'cancelled' => 'danger'
                            ])
                            ->icons([
                                'new' => 'heroicon-m-sparkles',
                                'processing' => 'heroicon-m-arrow-path',
                                'shipped' => 'heroicon-m-truck',
                                'delivered' => 'heroicon-m-check-badge',
                                'cancelled' => 'heroicon-m-x-circle'
                            ])
                            ->required()
                            ->default('new')
                            ->columnSpanFull(),
                        Textarea::make('notes')->columnSpanFull()
                    ])->columns(2),
                    Section::make('Order Items')->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->relationship('product','name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->distinct()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->columnSpan(5)
                                    ->reactive()
                                    ->afterStateUpdated(fn($state, Set $set) => $set('unit_amount', Product::find($state)?->price ?? 0))
                                    ->afterStateUpdated(fn($state, Set $set) => $set('unit_discount', number_format((Product::find($state)?->sale_discount/100)*Product::find($state)?->price,2,'.','') ?? 0))
                                    ->afterStateUpdated(fn($state, Set $set) => $set('total_amount', Product::find($state)?->price ?? 0))
                                    ->afterStateUpdated(fn($state, Set $set, Get $get) => $set('total_amount', number_format($get('quantity') * ($get('unit_amount')-$get('unit_discount')),2,'.',''))),
                                TextInput::make('quantity')
                                    ->numeric()
                                    ->required()
                                    ->default(1)
                                    ->minValue(1)
                                    ->columnSpan(1)
                                    ->reactive()
                                    ->afterStateUpdated(fn($state, Set $set) => ($state==null || $state=='' || $state<1)? $set('quantity',1):'')
                                    ->afterStateUpdated(fn($state, Set $set, Get $get) => $set('total_amount', number_format($state * ($get('unit_amount')-$get('unit_discount')),2,'.',''))),
                                TextInput::make('unit_amount')
                                    ->required()
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(2),
                                TextInput::make('unit_discount')
                                    ->label('Unit Discount ($)')
                                    ->required()
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(2),
                                TextInput::make('total_amount')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->columnSpan(2)
                            ])->columns(12),
                            
                            /*Placeholder::make('shipping_amount_placeholder')
                                ->label('Shipping')
                                ->content(function(Get $get, Set $set){
                                    $total = 0;
                                    $shipping = $get('shipping_amount') ?? 0;

                                    if(!$repeaters = $get('items')){return $total;} //if there are no items, the total is 0
                                    foreach($repeaters as $key => $repeater){ //add the total amount of each order item
                                        $total += $get("items.{$key}.total_amount");
                                    }

                                    if($total>0 && $total<=100){
                                        $shipping = 10;
                                    }elseif ($total>100 && $total<300) {
                                        $shipping = 7;
                                    }else{
                                        $shipping=0;
                                    }

                                    if(!$repeaters = $get('items')){return $shipping=0;} //if there are no items, the total is 0
                                    $set('shipping_amount',$shipping);
                                    return Number::currency($shipping);
                                }),
                            Hidden::make('shipping_amount')
                                ->default(0),
                            Placeholder::make('tax_placeholder')
                                ->label('Tax')
                                ->content(function(Get $get, Set $set){
                                    $total = 0;
                                    $tax = $get('tax') ?? 0;

                                    if(!$repeaters = $get('items')){return $total;} //if there are no items, the total is 0
                                    foreach($repeaters as $key => $repeater){ //add the total amount of each order item
                                        $total += $get("items.{$key}.total_amount");
                                    }

                                    $tax = $total * .013;
                                    
                                    if(!$repeaters = $get('items')){return $tax=0;} //if there are no items, the total is 0
                                    $set('tax',$tax);
                                    return Number::currency($tax);
                                }),
                            Hidden::make('tax')
                                ->default(0),*/
                            Placeholder::make('cost_placeholder')
                                ->label('Grand Total')
                                ->content(function(Get $get, Set $set){
                                    $total = 0;
                                    if(!$repeaters = $get('items')){return $total;} //if there are no items, the total is 0

                                    foreach($repeaters as $key => $repeater){ //add the total amount of each order item
                                        $total += $get("items.{$key}.total_amount");
                                    }
                                    
                                    $set('cost',$total);
                                    return Number::currency($total+$get('shipping_amount'));
                                }),
                            Hidden::make('cost')->default(0),
                    ])
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->sortable(),
                SelectColumn::make('payment_status')
                    ->searchable()
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed'
                    ]),
                SelectColumn::make('shipping_method')
                    ->searchable()
                    ->options([
                        'fedex' => 'FedEx',
                        'dhl' => 'DHL',
                        'ups' => 'UPS',
                        'usps' => 'USPS'
                    ]),
                SelectColumn::make('status')
                    ->searchable()
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled'
                    ]),
                TextColumn::make('currency')
                    ->searchable()
                    ->formatStateUsing(fn(string $state)=> strtoupper($state)),
                TextColumn::make('cost')
                    ->numeric()
                    ->money()
                    ->sortable(),
                /*TextColumn::make('shipping_amount')
                    ->numeric()
                    ->sortable()
                    ->money(),
                TextColumn::make('tax')
                    ->numeric()
                    ->money(),*/
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AddressRelationManager::class
        ];
    }

    public static function getNavigationBadge(): ?string { //Show the amount of orders in the menu badge
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null{
        return static::getModel()::count() < 10 ? 'danger' : 'success';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
