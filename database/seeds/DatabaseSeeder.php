<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* $this->call(UserRoleTableSeeder::class);
         $this->call(LanguageTableSeeder::class);
         $this->call(PermissionTableSeeder::class);
		 $this->call(SettingTableSeeder::class);*/
         //$this->call(ProductStatusTableSeeder::class);

         //Seeder temporary
         /*factory(\App\ProductStatus::class)->create([
            'id' => 0,
            'status' => 'Not Available'
        ]);
        factory(\App\ProductStatus::class)->create([
            'id' => 1,
            'status' => 'Active'
        ]);
        factory(\App\ProductStatus::class)->create([
            'id' => 2,
            'status' => 'Waiting'
        ]);
        factory(\App\ProductStatus::class)->create([
            'id' => 3,
            'status' => 'To check'
        ]);
        factory(\App\ProductStatus::class)->create([
            'id' => 4,
            'status' => 'To correct'
        ]);
        factory(\App\ProductStatus::class)->create([
            'id' => 5,
            'status' => 'Verified & Active'
        ]);
        factory(\App\ProductStatus::class)->create([
            'id' => 6,
            'status' => 'Discontinued'
        ]);*/

        /* Integration du Ticketing */
        
        // factory(\App\Models\Permission::class)->create([
        //     'permission_id' => 48,
        //     'parent_id' => null,
        //     'module_name' => 'Tickets'
        // ]);
        // factory(\App\Models\Permission::class)->create([
        //     'module_name' => 'Priorities',
        //     'parent_id' => 48,
        //     'route' => 'priorities.index,priorities.create,priorities.edit'
        // ]);
        // factory(\App\Models\Permission::class)->create([
        //     'module_name' => 'Categories',
        //     'parent_id' => 48,
        //     'route' => 'categories.index,categories.create,categories.edit'
        // ]);
        // factory(\App\Models\Permission::class)->create([
        //     'module_name' => 'Statuses',
        //     'parent_id' => 48,
        //     'route' => 'statuses.index,statuses.create,statuses.edit'
        // ]);
        // factory(\App\Models\Permission::class)->create([
        //     'module_name' => 'Tickets Lists',
        //     'parent_id' => 48,
        //     'route' => 'tickets.index,tickets.create,tickets.edit,tickets.show'
        // ]);
        factory(\App\Models\Permission::class)->create([
            'parent_id' => 4,
            'module_name' => 'Stripe Accounts',
            'route' => 'stripe_account.index,stripe_account.create,stripe_account.edit'
        ]);
    }
}
