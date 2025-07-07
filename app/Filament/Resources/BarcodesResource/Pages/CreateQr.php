<?php

namespace App\Filament\Resources\BarcodesResource\Pages;

use App\Filament\Resources\BarcodesResource;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Barcodes;
use Faker\Core\Barcode;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CreateQr extends Page
{
    protected static string $resource = BarcodesResource::class;
    protected static string $view = 'filament.resources.barcodes-resource.pages.create-qr';

    public $table_number;

    public function mount(): void
    {
        $this->form->fill();
        $this->table_number = strtoupper(chr(rand(65, 90)) . rand(1000, 9999));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('table_number')
                    ->required()
                    ->default(fn() => $this->table_number)
                    ->disabled(),
            ]);
    }

    public function save(): void
    {
        $host = $_SERVER['HTTP_HOST'] . '/' . $this->table_number;

        // Generate QR code as SVG image
        $svgContent = QrCode::margin(1)->size(200)->generate($host);
        // Define the path to save the SVG file
        $svgFilePath = 'qr_codes/' . $this->table_number . '.svg';
        // Save the SVG to storage
        Storage::disk('public')->put($svgFilePath, $svgContent);

        // Save data
        Barcodes::create([
            'table_number' => $this->table_number,
            'users_id' => Auth::user()->id,
            'image' => $svgFilePath,
            'qr_value' => $host
        ]);

        //Send success notification
        Notification::make()
            ->title('QR Code Created')
            ->success()
            ->icon('heroicon-o-check-circle')
            ->send();

        //Redirect to barcode list
        $this->redirect(url('admin/barcodes'));
    }
}
