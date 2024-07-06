<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroResource\Pages;
use App\Filament\Resources\HeroResource\RelationManagers;
use App\Models\Hero;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class HeroResource extends Resource
{
    protected static ?string $model = Hero::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Landing Page Management';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Section::make('Hero Content')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Title')
                                    ->required()
                                    ->placeholder('Enter the title of the hero section'),
                                Forms\Components\TextInput::make('subtitle')
                                    ->label('Subtitle')
                                    ->required()
                                    ->placeholder('Enter the subtitle of the hero section'),
                                Forms\Components\TextInput::make('link1')
                                    ->placeholder('https://example.com')
                                    ->prefixIcon('heroicon-o-link'),
                                Forms\Components\TextInput::make('link2')
                                    ->placeholder('https://example.com')
                                    ->prefixIcon('heroicon-o-link'),

                            ])->columns(1),
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Section::make('Hero Attributes')
                            ->schema([
                                FileUpload::make('image')
                                    ->image()
                                    ->required()
                                    ->rules('image', 'mimes:jpeg,png,webp', 'max:1024'),
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Active')
                                    ->onIcon('heroicon-s-check-circle')
                                    ->offIcon('heroicon-s-x-circle')
                                    ->default(false),

                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')
                    ->wrap()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subtitle')
                    ->wrap()
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_active')
                    ->icon(fn ($state) => $state ? 'heroicon-s-check-circle' : 'heroicon-s-x-circle')
                    ->color(fn ($state) => $state ? 'success' : 'danger')
                    // ->onIcon('heroicon-s-check-circle')
                    // ->offIcon('heroicon-s-x-circle')
                    // ->onColor('success')
                    // ->offColor('danger')
                    ->sortable()
                    ->label('Active'),
                // use this function if using toggle column
                // ->afterStateUpdated(
                //     function (Hero $hero, $state) {
                //         if ($state) {
                //             Hero::where('id', '!=', $hero->id)->update(['is_active' => false]);
                //         }
                //     }
                // ),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
                Filter::make('is_active')
                    ->label('Active')
                    ->toggle()
                    ->query(fn (Builder $query, $state) => $query->where('is_active', $state)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->after(
                    function (\App\Models\Hero $record) {
                        if ($record->image) {
                            Storage::disk('public')->delete($record->image);
                        }
                    }
                ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->after(
                        function (Collection $collection) {
                            foreach ($collection as $record) {
                                if ($record->image) {
                                    Storage::disk('public')->delete($record->image);
                                }
                            }
                        }
                    ),
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
            'index' => Pages\ListHeroes::route('/'),
            'create' => Pages\CreateHero::route('/create'),
            'edit' => Pages\EditHero::route('/{record}/edit'),
        ];
    }
}
