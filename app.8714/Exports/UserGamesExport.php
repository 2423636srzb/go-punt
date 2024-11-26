<?php

namespace App\Exports;

use App\Models\UserGame;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserGamesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    // Fetch the user's assigned games from the database
    public function collection()
    {
        return UserGame::where('user_id', $this->userId)->get();
    }

    // Define the headers for the Excel file
    public function headings(): array
    {
        return ['Game Name', 'Game URL', 'Username', 'Password'];
    }

    // Map the data for each row in the Excel file
    public function map($userGame): array
    {
        return [
            $userGame->game->name,
            $userGame->game->login_link,
            $userGame->username,
            $userGame->password
        ];
    }
}
