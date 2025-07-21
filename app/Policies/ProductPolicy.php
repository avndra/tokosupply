<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admin bisa lihat semua, user toko bisa lihat produk sendiri
        return $user->email === 'admin@example.com' || $user->tokos()->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        // Admin bisa lihat semua, user toko bisa lihat produk sendiri
        if ($user->email === 'admin@example.com') return true;
        $toko = $user->tokos()->first();
        return $toko && $product->toko_id === $toko->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Admin dan user yang punya toko bisa create produk
        return $user->email === 'admin@example.com' || $user->tokos()->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        // Admin bisa update semua, user toko hanya produk sendiri
        if ($user->email === 'admin@example.com') return true;
        $toko = $user->tokos()->first();
        return $toko && $product->toko_id === $toko->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        // Admin bisa hapus semua, user toko hanya produk sendiri
        if ($user->email === 'admin@example.com') return true;
        $toko = $user->tokos()->first();
        return $toko && $product->toko_id === $toko->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return false;
    }
}
