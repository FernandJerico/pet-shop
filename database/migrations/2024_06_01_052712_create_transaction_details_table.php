<?php

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Transaction::class)->references('id')->on('transactions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(User::class)->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(Product::class)->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(Inventory::class)->references('id')->on('inventories')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantity');
            $table->double('total');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
