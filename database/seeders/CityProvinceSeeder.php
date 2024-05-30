<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CityProvinceSeeder extends Seeder
{
    public function run(): void
    {
        // Create 7 Provinces
        $provinces = ['Tehran', 'Esfehan', 'Khorasan Razavi', 'Mazandaran', 'Yazd', 'Fars', 'Alborz'];
        foreach ($provinces as $province)
        {
        Province::create(["name" => $province]);
        }

        // Create 5 Cities
        $cities = ['Tehran', 'Rey', 'Shahriar', 'Islam Shahr', 'Varamin'];
        foreach ($cities as $city)
        {
            City::create(["name" => $city, "province_id" => 1]);
        }

        // Create 5 Cities
        $cities = ['Esfehan', 'Kashan', 'Shahin Shahr', 'Golpaigan', 'Mobarake'];
        foreach ($cities as $city)
        {
            City::create(["name" => $city,"province_id" => 2]);
        }

        // Create 5 Cities
        $cities = ['Mashhad', 'Neyshabor', 'Sabzvar', 'Torghabe', 'Sarakhs'];
        foreach ($cities as $city)
        {
            City::create(["name" => $city,"province_id" => 3]);
        }

        // Create 5 Cities
        $cities = ['Sari', 'Amol', 'Babol', 'Noor', 'Ramsar'];
        foreach ($cities as $city)
        {
            City::create(["name" => $city,"province_id" => 4]);
        }

        // Create 5 Cities
        $cities = ['Yazd', 'Meybod', 'Mehriz', 'Ardakan', 'Mehrdasht'];
        foreach ($cities as $city)
        {
            City::create(["name" => $city,"province_id" => 5]);
        }

        // Create 5 Cities
        $cities = ['Shiraz', 'Marvdasht', 'Fasa', 'Lar', 'Kazeroon'];
        foreach ($cities as $city)
        {
            City::create(["name" => $city,"province_id" => 6]);
        }

        // Create 5 Cities
        $cities = ['Karaj', 'Ferdos', 'Mahdasht', 'Golsar', 'Taleghan'];
        foreach ($cities as $city)
        {
            City::create(["name" => $city,"province_id" => 7]);
        }

    }
}
