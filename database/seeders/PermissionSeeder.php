<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Menu
        Permission::create(['name' => 'menu_rewash']);

        //setting
        Permission::create(['name' => 'menu_karyawan']);
        Permission::create(['name' => 'menu_paket']);

        //outlet
        Permission::create(['name' => 'menu_outlet']);
        Permission::create(['name' => 'show_outlet']);
        Permission::create(['name' => 'insert_outlet']);
        Permission::create(['name' => 'update_outlet']);
        Permission::create(['name' => 'delete_outlet']);

        //Item
        Permission::create(['name' => 'menu_jenis_item']);
        Permission::create(['name' => 'show_jenis_item']);
        Permission::create(['name' => 'insert_jenis_item']);
        Permission::create(['name' => 'update_jenis_item']);
        Permission::create(['name' => 'delete_jenis_item']);

        //Parfum
        Permission::create(['name' => 'menu_parfum']);
        Permission::create(['name' => 'show_parfum']);
        Permission::create(['name' => 'insert_parfum']);
        Permission::create(['name' => 'update_parfum']);
        Permission::create(['name' => 'delete_parfum']);

        //Pengeluaran
        Permission::create(['name' => 'menu_pengeluaran']);
        Permission::create(['name' => 'show_pengeluaran']);
        Permission::create(['name' => 'insert_pengeluaran']);
        Permission::create(['name' => 'update_pengeluaran']);
        Permission::create(['name' => 'delete_pengeluaran']);

        //Pelanggan
        Permission::create(['name' => 'menu_pelanggan']);
        Permission::create(['name' => 'show_pelanggan']);
        Permission::create(['name' => 'insert_pelanggan']);
        Permission::create(['name' => 'update_pelanggan']);
        Permission::create(['name' => 'delete_pelanggan']);

        //Kategori
        Permission::create(['name' => 'menu_kategori']);
        Permission::create(['name' => 'show_kategori']);
        Permission::create(['name' => 'insert_kategori']);
        Permission::create(['name' => 'update_kategori']);
        Permission::create(['name' => 'delete_kategori']);

        //Pickup Delivery
        Permission::create(['name' => 'menu_pickup_delivery']);
        Permission::create(['name' => 'show_pickup_delivery']);
        Permission::create(['name' => 'insert_pickup_delivery']);
        Permission::create(['name' => 'update_pickup_delivery']);
        Permission::create(['name' => 'delete_pickup_delivery']);

        //Item Transaksi
        Permission::create(['name' => 'show_item_transaksi']);
        Permission::create(['name' => 'insert_item_transaksi']);
        Permission::create(['name' => 'update_item_transaksi']);
        Permission::create(['name' => 'delete_item_transaksi']);

        //Transaksi
        Permission::create(['name' => 'menu_transaksi_bucket']);
    }
}
