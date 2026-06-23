<?php

namespace App\Contracts\Repositories;

use App\Enums\ProjectStatus;

interface ProjectRepositoryInterface extends BaseRepositoryInterface
{
    public function findByCustomer(int $customerId);

    public function findByStatus(ProjectStatus $status);

    public function findByAssignedTo(int $userId);

    public function getActive();

    public function getRecentProjects(int $limit = 10);
}
