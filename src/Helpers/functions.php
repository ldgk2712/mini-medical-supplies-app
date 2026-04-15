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

function getLowStockSupplies(array $supplies): array
{
    return array_values(array_filter($supplies, function ($supply) {
        return $supply['quantity'] > 0 && $supply['quantity'] <= 2;
    }));
}

function getOutOfStockSupplies(array $supplies): array
{
    return array_values(array_filter($supplies, function ($supply) {
        return $supply['quantity'] <= 0;
    }));
}

function filterSuppliesByStatus(array $supplies, string $status): array
{
    if ($status === 'available') {
        return array_values(array_filter($supplies, function ($supply) {
            return getSupplyStatus($supply['quantity']) === 'Available';
        }));
    }

    if ($status === 'low') {
        return array_values(array_filter($supplies, function ($supply) {
            return getSupplyStatus($supply['quantity']) === 'Low stock';
        }));
    }

    if ($status === 'out') {
        return array_values(array_filter($supplies, function ($supply) {
            return getSupplyStatus($supply['quantity']) === 'Out of stock';
        }));
    }

    return $supplies;
}

function searchSuppliesByName(array $supplies, string $keyword): array
{
    $keyword = trim($keyword);

    if ($keyword === '') {
        return $supplies;
    }

    return array_values(array_filter($supplies, function ($supply) use ($keyword) {
        return stripos($supply['name'], $keyword) !== false;
    }));
}

function getStatusClass(string $status): string
{
    if ($status === 'Available') {
        return 'status-available';
    }

    if ($status === 'Low stock') {
        return 'status-low';
    }

    return 'status-out';
}