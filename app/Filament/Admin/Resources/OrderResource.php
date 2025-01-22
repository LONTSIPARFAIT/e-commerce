<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\OrderResource\Pages;
use App\Filament\Admin\Resources\OrderResource\Pages\EditOrder;
use App\Filament\Admin\Resources\OrderResource\Pages\ViewOrder;
use App\Filament\Admin\Resources\OrderResource\Pages\ListOrders;
use App\Filament\Admin\Resources\OrderResource\RelationManagers;
use App\Filament\Admin\Resources\OrderResource\Pages\CreateOrder;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Order information')->schema([
                        Select::make('user_id')
                        ->label('Customer')
                        ->relationship('user', 'name')
                        ->preload()
                        ->searchable()
                        ->required(),

                        Select::make('payment method')
                        ->options([
                            'orange'=>'Orange ',
                            'mtn'=>'MTN',
                            'cod'=>'cash on delivery'
                        ])->required(),

                        Select::make('payment status')
                        ->options([
                            'pending'=>'Pending ',
                            'paid'=>'Paid',
                            'failed'=>'Failed',
                        ])
                        ->default('pending')
                          ->required(),

                          ToggleButtons::make('status')
                          ->inline()
                          ->default('new')
                          ->required()
                          ->options([
                            'new'=>'New',
                            'processing'=>'Processing',
                            'shipped'=>'Shipped',
                            'delivered'=>'Delivered',
                            'cancelled'=>'Cancelled',
                          ])
                          ->colors([
                            'new'=>'info',
                            'processing'=>'warning',
                            'shipped'=>'success',
                            'delivered'=>'success',
                            'cancelled'=>'danger',
                          ])
                          ->icons([
                            'new'=>'heroicon-m-sparkles',
                            'processing'=>'heroicon-m-arrow-path',
                            'shipped'=>'heroicon-m-truck',
                            'delivered'=>'heroicon-m-check-badge',
                            'cancelled'=>'heroicon-m-x-circle',
                          ]),

                          Select::make('currency')
                          ->options([
                          'fcfa'=>'FCFA',
                          'usd'=>'USD',
                          'eur'=>'EUR',
                          'gbp'=>'GBP',
                          ])
                          ->default('fcfa')
                          ->required(),

                          Select::make('shipping_method')
                          ->options([
                          'fedex'=>'FedEx',
                          'ups'=>'UPS',
                          'eur'=>'EUR',
                          'gbp'=>'GBP',
                          ])
                          ->default('fedex'),

                            Textarea::make('notes')    
                            ->columnSpanFull()                       
                      ])->columns(2),

                    //   Section::make('Order Items')->schema([
                    //     Repeater::make('items')
                    //     ->relationship()
                    //     ->schema([
                    //         Select::make('product_id')
                    //         ->relationship('product', 'name')
                    //         ->searchable()
                    //         ->preload()
                    //          ->required()
                    //          ->distinct()
                    //          ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                    //     ])
                    //   ])
                    

                    // 22:09 min
                ]) 
                     ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            //
        ];
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
