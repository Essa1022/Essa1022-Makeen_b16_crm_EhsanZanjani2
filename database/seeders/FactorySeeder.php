<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Factor;
use App\Models\Label;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\Task;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Warranty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Testing\Fakes\Fake;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 3 specific Teams
        $teams = ['A', 'B', 'C'];
        foreach ($teams as $team)
        {
            Team::create(['name' => $team]);
        }

        // create 3 Labels
        $labels = Label::factory(3)->create();

        // create 3 Warranties
        Warranty::factory(3)->create();

        // create 5 specific Brands
        $brands = ['Apple', 'Samsung', 'Sony', 'Microsoft', 'Asus'];
        foreach ($brands as $brand)
        {
            Brand::create(['name' => $brand]);
        }

        // create 9 Users for random Teams and Ticket
        for($i =0; $i<9; $i++)
        {
            $teams = Team::all()->random();
            $users = User::factory()->for($teams)->create();
            $users->assignRole('user');
        }

        // create Ticket for all Users
        $users = User::all();
        foreach ($users as $user)
        {
            Ticket::factory()->for($user)->create();
        }

        // create 10 Products for random Categories, Brands and Warranties and Labels
        for($i =0; $i<10; $i++)
        {
            $brands = Brand::all()->random();
            $categories = Category::all()->random();
            $warranties = Warranty::all()->random();
            $labels = Label::all()->random();
            Product::factory()->for($categories)->for($brands)->hasAttached($warranties)->hasAttached($labels)->create();
        }

        // create 20 Factors for Orders for random Users and attach random Product
        for($i = 0; $i < 20; $i++)
        {
            $users = User::all()->random();
            $products = Product::all()->random();
            $orders = Order::factory()->for($users)->hasAttached($products, ['quantity' => 1])->create();
            Factor::factory()->for($orders)->create();
        }

        // create 10 Tasks for random Users
        $users = User::all();
        $teams = Team::all();
        for ($i = 0; $i < 10; $i++)
        {
            // $taskable_type = [User::class, Team::class][array_rand([User::class, Team::class])];
            $taskable_type = fake()->randomElement([User::class, Team::class]);
            if ($taskable_type === User::class) {
                $taskable = $users->random();
            } else {
                $taskable = $teams->random();
            }
            Task::factory()->for($taskable, 'taskable')->create();
        }

        // create 10 Messages for random Tickets
        for ($i = 0; $i < 10; $i++)
        {
            $tickets = Ticket::all()->random();
            Message::factory()->for($tickets)->create();
        }
    }
}
