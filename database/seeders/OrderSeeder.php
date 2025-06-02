<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class OrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orders')->insert([
        [
            'order_id' => 1,
            'user_id' => 16,
            'order_number' => 'ORD-001',
            'order_date' => '2025-05-20',
            'status' => 'Completed',
            'total_price' => 110000,
            'subtotal' => 100000,
            'taxAmount' => 5000,
            'shippingCost' => 3000,
            'adminCost' => 2000,
            'shipping_address' => 'Jl. Mayjen Sungkono No.45, Surabaya',
            'status_del' => false,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'order_id' => 2,
            'user_id' => 3,
            'order_number' => 'ORD-002',
            'order_date' => '2025-05-02',
            'status' => 'Shipped',
            'total_price' => 200000,
            'subtotal' => 180000,
            'taxAmount' => 10000,
            'shippingCost' => 7000,
            'adminCost' => 3000,
            'shipping_address' => 'Jl. Sudirman No. 5, Bandung',
            'status_del' => false,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'order_id' => 3,
            'user_id' => 4,
            'order_number' => 'ORD-003',
            'order_date' => '2025-05-03',
            'status' => 'Delivered',
            'total_price' => 175000,
            'subtotal' => 160000,
            'taxAmount' => 8000,
            'shippingCost' => 5000,
            'adminCost' => 2000,
            'shipping_address' => 'Jl. Pemuda No. 8, Surabaya',
            'status_del' => false,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'order_id' => 4,
            'user_id' => 5,
            'order_number' => 'ORD-004',
            'order_date' => '2025-05-04',
            'status' => 'Cancelled',
            'total_price' => 100000,
            'subtotal' => 95000,
            'taxAmount' => 2000,
            'shippingCost' => 2000,
            'adminCost' => 1000,
            'shipping_address' => 'Jl. Imam Bonjol No. 2, Medan',
            'status_del' => true,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'order_id' => 5,
            'user_id' => 6,
            'order_number' => 'ORD-005',
            'order_date' => '2025-05-05',
            'status' => 'Processing',
            'total_price' => 225000,
            'subtotal' => 200000,
            'taxAmount' => 10000,
            'shippingCost' => 10000,
            'adminCost' => 5000,
            'shipping_address' => 'Jl. Malioboro No. 1, Yogyakarta',
            'status_del' => false,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'order_id' => 6,
            'user_id' => 7,
            'order_number' => 'ORD-006',
            'order_date' => '2025-05-06',
            'status' => 'Delivered',
            'total_price' => 180000,
            'subtotal' => 165000,
            'taxAmount' => 8000,
            'shippingCost' => 5000,
            'adminCost' => 2000,
            'shipping_address' => 'Jl. Merdeka No. 10, Jakarta',
            'status_del' => false,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'order_id' => 7,
            'user_id' => 2,
            'order_number' => 'ORD-007',
            'order_date' => '2025-05-07',
            'status' => 'Shipped',
            'total_price' => 160000,
            'subtotal' => 150000,
            'taxAmount' => 5000,
            'shippingCost' => 3000,
            'adminCost' => 2000,
            'shipping_address' => 'Jl. Sudirman No. 5, Bandung',
            'status_del' => false,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'order_id' => 8,
            'user_id' => 3,
            'order_number' => 'ORD-008',
            'order_date' => '2025-05-08',
            'status' => 'Processing',
            'total_price' => 190000,
            'subtotal' => 175000,
            'taxAmount' => 7000,
            'shippingCost' => 5000,
            'adminCost' => 3000,
            'shipping_address' => 'Jl. Pemuda No. 8, Surabaya',
            'status_del' => false,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'order_id' => 9,
            'user_id' => 4,
            'order_number' => 'ORD-009',
            'order_date' => '2025-05-09',
            'status' => 'Delivered',
            'total_price' => 140000,
            'subtotal' => 130000,
            'taxAmount' => 5000,
            'shippingCost' => 3000,
            'adminCost' => 2000,
            'shipping_address' => 'Jl. Imam Bonjol No. 2, Medan',
            'status_del' => false,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'order_id' => 10,
            'user_id' => 5,
            'order_number' => 'ORD-010',
            'order_date' => '2025-05-10',
            'status' => 'Cancelled',
            'total_price' => 110000,
            'subtotal' => 100000,
            'taxAmount' => 5000,
            'shippingCost' => 3000,
            'adminCost' => 2000,
            'shipping_address' => 'Jl. Malioboro No. 1, Yogyakarta',
            'status_del' => true,
            'created_at' => now(),
            'updated_at' => now()
        ],
    ]);
    }
}
