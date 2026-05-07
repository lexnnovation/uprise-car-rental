<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'System';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'key';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(2)->schema([
                    TextInput::make('key')
                        ->required()
                        ->maxLength(100)
                        ->unique(Setting::class, 'key', ignoreRecord: true)
                        ->disabledOn('edit'),
                    Select::make('type')
                        ->options([
                            'string' => 'String',
                            'int'    => 'Integer',
                            'bool'   => 'Boolean',
                            'json'   => 'JSON',
                        ])
                        ->default('string')
                        ->required(),
                ]),
                Textarea::make('value')->rows(4)->columnSpanFull(),
                TextInput::make('group')->default('general')->maxLength(60),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')->searchable()->sortable()->copyable(),
                TextColumn::make('value')->limit(60)->searchable(),
                TextColumn::make('type')->badge(),
                TextColumn::make('group')->badge()->color('gray'),
                TextColumn::make('updated_at')->since()->sortable()->toggleable(),
            ])
            ->defaultSort('key')
            ->filters([
                SelectFilter::make('group')
                    ->query(function ($query, array $data) {
                        return blank($data['value']) ? $query : $query->where('group', $data['value']);
                    })
                    ->options(fn () => Setting::query()->distinct()->pluck('group', 'group')->sort()->all()),
            ])
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit'   => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
