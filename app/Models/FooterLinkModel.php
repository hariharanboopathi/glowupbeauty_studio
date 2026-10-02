<?php

namespace App\Models;

use CodeIgniter\Model;

class FooterLinkModel extends Model
{
    protected $table            = 'footer_links';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'group_name',
        'title',
        'url',
        'sort_order',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get active links ordered by sort_order.
     */
    public function getActiveByGroup(string $groupName): array
    {
        return $this->where('group_name', $groupName)
                    ->where('status', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->orderBy('id', 'ASC')
                    ->findAll();
    }

    /**
     * Get all links for a group (including inactive) for admin management.
     */
    public function getAllByGroup(string $groupName): array
    {
        return $this->where('group_name', $groupName)
                    ->orderBy('sort_order', 'ASC')
                    ->orderBy('id', 'ASC')
                    ->findAll();
    }

    /**
     * Reorder links by an array of IDs.
     */
    public function updateOrder(string $groupName, array $orderedIds): bool
    {
        $order = 1;
        foreach ($orderedIds as $id) {
            $id = (int) $id;
            if ($id > 0) {
                $this->where('id', $id)
                     ->where('group_name', $groupName)
                     ->set(['sort_order' => $order++])
                     ->update();
            }
        }
        return true;
    }

    /**
     * Move link up or down in sort order within its group.
     */
    public function moveItem(int $id, string $direction): bool
    {
        $current = $this->find($id);
        if (!$current) {
            return false;
        }

        $groupName = $current['group_name'];
        $links = $this->where('group_name', $groupName)
                      ->orderBy('sort_order', 'ASC')
                      ->orderBy('id', 'ASC')
                      ->findAll();

        $index = -1;
        foreach ($links as $i => $l) {
            if ((int)$l['id'] === $id) {
                $index = $i;
                break;
            }
        }

        if ($index === -1) {
            return false;
        }

        $swapIndex = ($direction === 'up') ? $index - 1 : $index + 1;
        if ($swapIndex < 0 || $swapIndex >= count($links)) {
            return false;
        }

        $target = $links[$swapIndex];

        $currentOrder = (int)$current['sort_order'];
        $targetOrder  = (int)$target['sort_order'];
        if ($currentOrder === $targetOrder) {
            $targetOrder = ($direction === 'up') ? $currentOrder - 1 : $currentOrder + 1;
        }

        $this->update($current['id'], ['sort_order' => $targetOrder]);
        $this->update($target['id'], ['sort_order' => $currentOrder]);

        // Normalize
        $allLinks = $this->where('group_name', $groupName)
                         ->orderBy('sort_order', 'ASC')
                         ->orderBy('id', 'ASC')
                         ->findAll();
        $order = 1;
        foreach ($allLinks as $l) {
            $this->update($l['id'], ['sort_order' => $order++]);
        }

        return true;
    }
}
