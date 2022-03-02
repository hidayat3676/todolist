<?php

use App\Customer;
use Illuminate\Database\Seeder;
use function App\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param \Faker\Generator $generator
     * @return void
     */
    public function run(\Faker\Generator $generator)
    {
        Customer::truncate();
        $i = 0;
        $max_record = 1000000;
        $data = [];
        for ($i; $i <= $max_record; $i++){

            $data[] = array(
                    'name'    => $generator->unique()->name,
                    'email'   => $generator->unique()->safeEmail,
                    'phone'   => $generator->unique()->phoneNumber,
                    'address' => $generator->unique()->address
                  );

            if ( $i % 100 == 0){

                try {

                    Customer::insert($data);

                }catch(\Exception $e){
                    continue;
                }

            }

            if(($i % 1000) == 0){
                unset($data);
            }
            $this->command->line('Generating record '. $i . ' Out of ' . $max_record);


        }
    }
}
