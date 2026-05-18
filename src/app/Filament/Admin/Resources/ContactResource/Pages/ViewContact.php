<?php

namespace App\Filament\Admin\Resources\ContactResource\Pages;

use App\Filament\Admin\Resources\ContactResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;

class ViewContact extends ViewRecord
{
    protected static string $resource = ContactResource::class;

    public function mount(int | string $record): void
    {
        parent::mount($record);
        $this->record->update(['is_read' => true]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('mark_unread')
                ->label('Tandai Belum Dibaca')
                ->icon('heroicon-o-envelope')
                ->color('warning')
                ->visible(fn () => $this->record->is_read)
                ->action(function () {
                    $this->record->update(['is_read' => false]);
                    $this->refreshFormData(['is_read']);
                }),

            DeleteAction::make(),
        ];
    }
}
