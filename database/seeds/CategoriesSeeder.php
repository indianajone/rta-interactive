<?php

use Ravarin\Entities\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    protected $categories = [
        'พระราชบัญญัติการท่องเที่ยวแห่งชาติปี ๕๑' => [
            'แหล่งท่องเที่ยวทางธรรมชาติ',
            'แหล่งท่องเที่ยวทางศิลปวัฒนธรรม',
            'แหล่งท่องเที่ยวทางโบราณสถานและประวัติศาสตร์',
            'แหล่งท่องเที่ยวเพื่อการนันทนาการและการผจญภัย'
        ],
        'ลักษณะภูมิประเทศ' => [
            'ทะเล', 'ภูเขา', 'สวนสาธารณะ', 'อ่างเก็บน้ำ', 'อุทยานแห่งชาติ', 
        ],
        'ที่พัก' => [
            'โรงแรม', 'บังกะโล', 'กางเต๊นท์', 'จัดเลี้ยง', 'ห้องอาหาร', 'ลานจอดรถ', 'WiFi'
        ],
        'กิจกรรม' => [
            'กระโดดหอ', 'ผจญภัย', 'เล่นรอบกองไฟ'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $name => $subcategory) {
            $category = factory(Category::class)->create(['name' => $name]);

            foreach ($subcategory as $name) {
                factory(Category::class)->create([
                    'name' => $name,
                    'parent_id' => $category->id
                ]);
            }
        }
    }
}
