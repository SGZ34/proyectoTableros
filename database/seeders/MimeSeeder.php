<?php

namespace Database\Seeders;

use App\Models\Mime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mime::create(["name" => "application/pdf", "description" => "Archivo pdf"]);
        Mime::create(["name" => "image/jpeg", "description" => "Archivo de imagen formato jpg o jpeg"]);
        Mime::create(["name" => "image/png", "description" => "Archivo en formato png"]);
        Mime::create(["name" => "image/gif", "description" => "Archivo en formato gif"]);
        Mime::create(["name" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "description" => "Archivo en formato word"]);
        Mime::create(["name" => "text/html", "description" => "Archivo en formato HTML"]);
        Mime::create(["name" => "application/vnd.ms-powerpoint", "description" => "Archivo en formato powerPoint"]);
        Mime::create(["name" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "description" => "Archivo en formato excel"]);
    }
}
