<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Console\Command;

class ImportCSVFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import CSV files into DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $this->importUsers();
        $this->importProducts();
        $this->importPurchases();
    }

    private function importUsers()
    {
        $file = storage_path('app/users.csv');
        $file = fopen($file, "r");
        $i = 0;
        while (($row = fgetcsv($file, 0, ",")) !== false) {
            if ($i++ === 0) {
                continue;
            }
            $new = ['id' => $row[0], 'name' => $row[1], 'email' => $row[2], 'password' => $row[3]];

            $value = User::where('id', $new['id'])->first();
            if (is_null($value)) {
                User::insert($new);
            }
        }
    }

    private function importProducts()
    {
        $file = storage_path('app/products.csv');
        $file = fopen($file, "r");
        $i = 0;
        while (($row = fgetcsv($file, 0, ",")) !== false) {
            if ($i++ === 0) {
                continue;
            }
            $new = ['sku' => $row[0], 'name' => $row[1]];

            $value = Product::where('sku', $new['sku'])->first();
            if (is_null($value)) {
                Product::insert($new);
            }
        }
    }

    private function importPurchases()
    {
        $file = storage_path('app/purchased.csv');
        $file = fopen($file, "r");
        $i = 0;
        while (($row = fgetcsv($file, 0, ",")) !== false) {
            if ($i++ === 0) {
                continue;
            }
            $new = ['user_id' => $row[0], 'product_sku' => $row[1]];

            $value = Purchase::where('user_id', $new['user_id'])->where('product_sku', $new['product_sku'])->first();
            if (is_null($value)) {
                Purchase::insert($new);
            }
        }
    }
}