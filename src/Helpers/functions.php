<?php

function getSupplyStatus(int $quantity): string
{
    if ($quantity <= 0) {
        return 'Out of stock';
    } elseif ($quantity <= 2) {
        return 'Low stock';
    }

    return 'Available';
}

function formatSupplyName(string $name): string
{
    return strtoupper($name);
}

function getTotalSupplyQuantity(array $supplies): int
{
    return array_reduce($supplies, function ($carry, $supply) {
        return $carry + $supply['quantity'];
    }, 0);
}

function getAvailableSupplies(array $supplies): array
{
    return array_values(array_filter($supplies, function ($supply) {
        return $supply['quantity'] > 0;
    }));
}