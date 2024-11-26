<?php

namespace App\Imports;

use App\Models\UserGame;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class UserGamesImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    protected $userId;
    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    public function model(array $row)
    {
        $userId = $this->getUserId();
        // Find the game by name
        $game = \App\Models\Game::where('name', $row['game_name'])->first();

        if ($game) {
            // Find the user_game record for the specific user and game
            $userGame = UserGame::where('user_id', $userId)->where('game_id', $game->id)->first();

            if ($userGame) {
                // Update the username and password
                $userGame->username = $row['username'];
                $userGame->password = $row['password'];
                $userGame->save();
            }
        }
        return null;  // No need to return anything specifically
    }

    public function headingRow(): int
    {
        return 1; // Indicates that the first row is the heading
    }

    private function getGameIdByName($gameName)
    {
        // Get the game ID by name
        $game = \App\Models\Game::where('name', $gameName)->first();
        return $game ? $game->id : null;
    }

    private function getUserId()
    {
        return $this->userId;
    }
}
