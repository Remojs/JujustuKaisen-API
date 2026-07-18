<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Character;
use Illuminate\Support\Facades\DB;

class ImportCharactersCommand extends Command
{
    protected $signature = 'import:characters';
    protected $description = 'Import characters from JSON file';

    public function handle()
    {
        $this->info('Starting character import...');
        
        // Read JSON file
        $jsonPath = base_path('../Data/Data/Characters.json');
        if (!file_exists($jsonPath)) {
            $this->error('Characters.json not found at: ' . $jsonPath);
            return;
        }
        
        $data = json_decode(file_get_contents($jsonPath), true);
        $characters = $data['characters'];
        
        $this->info('Found ' . count($characters) . ' characters to import');
        
        DB::beginTransaction();
        
        try {
            foreach ($characters as $characterData) {
                // Handle image path
                if (isset($characterData['image'])) {
                    $characterData['image'] = str_replace('/characters/', '/Media/Characters/', $characterData['image']);
                }
                
                Character::create($characterData);
                $this->info('Imported: ' . $characterData['name']);
            }
            
            DB::commit();
            $this->info('✅ Successfully imported all characters!');
            
        } catch (\Exception $e) {
            DB::rollback();
            $this->error('❌ Import failed: ' . $e->getMessage());
        }
    }
}
